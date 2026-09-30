<?php
/**
 * Проверка страницы обслуживания без веб-сервера.
 * Запуск: php tools/test-maintenance.php
 */

declare(strict_types=1);

require_once dirname(__DIR__) . '/deploy/ispmanager/maintenance.php';

$failures = 0;

function check(bool $ok, string $message): void
{
    global $failures;
    if ($ok) {
        echo "ok  {$message}\n";
        return;
    }
    $failures++;
    echo "FAIL {$message}\n";
}

function dispatch(string $docroot, string $ip, string $uri, array $server = []): array
{
    header_remove();
    http_response_code(200);
    $_SERVER = array_merge([
        'REMOTE_ADDR' => $ip,
        'REQUEST_URI' => $uri,
        'REQUEST_METHOD' => 'GET',
    ], $server);
    $_GET = [];
    $query = parse_url($uri, PHP_URL_QUERY);
    if (is_string($query) && $query !== '') {
        parse_str($query, $_GET);
    }

    ob_start();
    mg_dispatch($docroot);
    $body = ob_get_clean();
    if (!is_string($body)) {
        $body = '';
    }

    return [
        'code' => http_response_code() ?: 0,
        'headers' => headers_list(),
        'body' => $body,
    ];
}

ob_start();

$source = file_get_contents(dirname(__DIR__) . '/deploy/ispmanager/maintenance.php');
$nginx = file_get_contents(dirname(__DIR__) . '/deploy/ispmanager/nginx.conf');
$apache = file_get_contents(dirname(__DIR__) . '/deploy/ispmanager/apache.htaccess');
$nginxCode = is_string($nginx) ? preg_replace('/#[^\n]*/', '', $nginx) : '';
$apacheCode = is_string($apache) ? preg_replace('/#[^\n]*/', '', $apache) : '';
check(is_string($source) && !preg_match('/\$_SERVER\s*\[\s*[\'"]HTTP_(X_FORWARDED_FOR|X_REAL_IP|CF_CONNECTING_IP)/', $source), 'php does not read forwarded headers');
check(is_string($nginxCode) && !str_contains($nginxCode, 'X-Forwarded-For') && !str_contains($nginxCode, 'X-Real-IP'), 'nginx snippet does not trust forwarded headers');
check(is_string($nginxCode) && str_contains($nginxCode, '$remote_addr = "91.132.224.222"'), 'nginx lets the owner IP through by remote address');
check(is_string($apacheCode) && !str_contains($apacheCode, 'X-Forwarded-For') && !str_contains($apacheCode, 'X-Real-IP'), 'apache rules do not trust forwarded headers');

$shipped = file(dirname(__DIR__) . '/deploy/ispmanager/maintenance-allowlist.txt', FILE_IGNORE_NEW_LINES);
$ips = [];
foreach ($shipped ?: [] as $line) {
    $line = trim($line);
    if ($line !== '' && !str_starts_with($line, '#')) {
        $ips[] = preg_split('/\s+/', $line)[0];
    }
}
check($ips === ['91.132.224.222'], 'shipped allowlist is exactly 91.132.224.222');
check(is_file(dirname(__DIR__) . '/deploy/ispmanager/maintenance.on'), 'maintenance is shipped ON');

$dir = sys_get_temp_dir() . '/mg-maint-' . getmypid();
mkdir($dir);
file_put_contents($dir . '/maintenance.on', "\n");
file_put_contents($dir . '/maintenance-allowlist.txt', "# note\n\n91.132.224.222 owner\nnot-an-ip\n");
file_put_contents($dir . '/index.html', 'MG-FIXTURE-HTML');
file_put_contents($dir . '/index.php', '<?php echo "MG-FIXTURE-PHP " . ($_GET["k"] ?? "");');
mkdir($dir . '/css');
file_put_contents($dir . '/css/style.css', 'body{color:red}');
mkdir($dir . '/pages');
file_put_contents($dir . '/pages/catalog.php', '<?php echo "CATALOG";');
file_put_contents(dirname($dir) . '/mg-outside-secret.txt', 'SECRET');

$blocked = dispatch($dir, '203.0.113.10', '/index.html', [
    'HTTP_X_FORWARDED_FOR' => '91.132.224.222',
    'HTTP_X_REAL_IP' => '91.132.224.222',
]);
check($blocked['code'] === 503, 'other IP gets 503');
check(str_contains($blocked['body'], 'Сайт на техническом обслуживании'), 'russian maintenance heading');
check(str_contains($blocked['body'], 'САЖЕНЦЫ-ИРКУТСК'), 'brand on the page');
check(str_contains($blocked['body'], '+7 (952) 624-86-56'), 'phone label');
check(str_contains($blocked['body'], 'tel:+79526248656'), 'phone link');
check(str_contains($blocked['body'], 'melentev.garden@mail.ru'), 'email');
check(str_contains($blocked['body'], 'mailto:melentev.garden@mail.ru'), 'email link');
check(str_contains($blocked['body'], 'р.п. Марково, Ново-Иркутский'), 'address');
check(!str_contains($blocked['body'], 'MG-FIXTURE-HTML'), 'fixture site is not in the 503 body');
preg_match_all('/href="([^"]*)"/', $blocked['body'], $hrefs);
$hrefList = $hrefs[1] ?? [];
sort($hrefList);
check($hrefList === ['mailto:melentev.garden@mail.ru', 'tel:+79526248656'], 'only phone and email links');
check(!preg_match('/href="[^"]*(catalog|articles)/', $blocked['body']), 'no catalog or article links');

$css = dispatch($dir, '198.51.100.4', '/css/style.css');
check($css['code'] === 503 && str_contains($css['body'], 'техническом обслуживании'), 'static css is also the maintenance page');

$catalog = dispatch($dir, '198.51.100.4', '/pages/catalog.php');
check($catalog['code'] === 503 && !str_contains($catalog['body'], 'CATALOG'), 'php page is not executed for other IPs');

$owner = dispatch($dir, '91.132.224.222', '/index.html');
check($owner['code'] === 200 && $owner['body'] === 'MG-FIXTURE-HTML', 'allowlisted IP gets html');

$ownerPhp = dispatch($dir, '91.132.224.222', '/index.php?k=7');
check($ownerPhp['code'] === 200 && $ownerPhp['body'] === 'MG-FIXTURE-PHP 7', 'allowlisted IP gets php with query');

$ownerCss = dispatch($dir, '91.132.224.222', '/css/style.css');
check($ownerCss['code'] === 200 && $ownerCss['body'] === 'body{color:red}', 'allowlisted IP gets css');

$near = dispatch($dir, '91.132.224.22', '/index.html');
check($near['code'] === 503, 'prefix of the allowlisted IP is blocked');

$spoof = dispatch($dir, '127.0.0.1', '/index.html', ['HTTP_X_FORWARDED_FOR' => '91.132.224.222']);
check($spoof['code'] === 503, 'X-Forwarded-For does not grant access');

$escape = dispatch($dir, '91.132.224.222', '/../mg-outside-secret.txt');
check($escape['code'] === 404 && !str_contains($escape['body'], 'SECRET'), 'path escape is rejected');
$outside = dispatch($dir, '91.132.224.222', '/../../etc/passwd');
check($outside['code'] === 404, 'passwd path is rejected');

$list = dispatch($dir, '91.132.224.222', '/maintenance-allowlist.txt');
check($list['code'] === 404 && !str_contains($list['body'], '91.132.224.222'), 'allowlist file is not served');

$flag = dispatch($dir, '203.0.113.10', '/');
check($flag['code'] === 503, 'directory index is maintenance for other IPs');
$home = dispatch($dir, '91.132.224.222', '/');
check($home['code'] === 200 && str_starts_with($home['body'], 'MG-FIXTURE-PHP'), 'allowlisted directory index prefers index.php');

unlink($dir . '/maintenance.on');
clearstatcache();
$open = dispatch($dir, '203.0.113.10', '/index.html');
check($open['code'] === 200 && $open['body'] === 'MG-FIXTURE-HTML', 'without maintenance.on everyone gets the site');
$gate = dispatch($dir, '203.0.113.10', '/maintenance.php');
check($gate['code'] === 404, 'gate url without the flag is not the maintenance page');

file_put_contents($dir . '/maintenance.on', "\n");
$direct = dispatch($dir, '91.132.224.222', '/maintenance.php');
check($direct['code'] === 200 && str_starts_with($direct['body'], 'MG-FIXTURE-PHP'), 'allowlisted direct gate url opens the site');
$directOther = dispatch($dir, '203.0.113.9', '/maintenance.php');
check($directOther['code'] === 503, 'other IP opening the gate still sees maintenance');

$emptyIp = dispatch($dir, '', '/index.html');
check($emptyIp['code'] === 503, 'empty REMOTE_ADDR is blocked');

$httpDir = sys_get_temp_dir() . '/mg-http-' . getmypid();
mkdir($httpDir);
foreach (['maintenance.php', 'maintenance.on', 'maintenance-allowlist.txt', 'maintenance-fonts.css'] as $name) {
    copy(dirname(__DIR__) . '/deploy/ispmanager/' . $name, $httpDir . '/' . $name);
}
file_put_contents($httpDir . '/index.html', 'MG-FIXTURE-HTML');
mkdir($httpDir . '/.well-known');
file_put_contents($httpDir . '/.well-known/acme', 'CERT-OK');
file_put_contents($httpDir . '/router.php', <<<'PHP'
<?php
$uri = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
$uri = is_string($uri) ? $uri : '/';
clearstatcache(true, __DIR__ . '/maintenance.on');
$enabled = is_file(__DIR__ . '/maintenance.on');
$skip = $uri === '/maintenance.php' || str_starts_with($uri, '/.well-known/');
if ($enabled && !$skip) {
    require_once __DIR__ . '/maintenance.php';
    mg_dispatch(__DIR__);
    return true;
}
return false;
PHP);
$port = 18080;
$log = $httpDir . '/server.log';
$proc = proc_open(
    [PHP_BINARY, '-S', '127.0.0.1:' . $port, 'router.php'],
    [1 => ['file', $log, 'w'], 2 => ['file', $log, 'a']],
    $pipes,
    $httpDir
);
$up = false;
for ($i = 0; $i < 40; $i++) {
    $fp = @fsockopen('127.0.0.1', $port, $errno, $err, 0.2);
    if (is_resource($fp)) {
        fclose($fp);
        $up = true;
        break;
    }
    usleep(50000);
}
check($up && is_resource($proc), 'php server started');
if ($up) {
    $fetch = static function (string $url, array $headers = []) use ($port): array {
        $context = stream_context_create([
            'http' => [
                'ignore_errors' => true,
                'header' => implode("\r\n", $headers),
                'timeout' => 5,
            ],
        ]);
        $body = file_get_contents('http://127.0.0.1:' . $port . $url, false, $context);
        $raw = $http_response_header ?? [];
        $status = 0;
        if (isset($raw[0]) && preg_match('/\s(\d{3})\s/', $raw[0], $m)) {
            $status = (int) $m[1];
        }
        $map = [];
        foreach ($raw as $line) {
            if (str_contains($line, ':')) {
                [$name, $value] = explode(':', $line, 2);
                $map[strtolower(trim($name))] = trim($value);
            }
        }
        return ['code' => $status, 'headers' => $map, 'body' => is_string($body) ? $body : ''];
    };
    $live = $fetch('/index.html', ['X-Forwarded-For: 91.132.224.222']);
    check($live['code'] === 503, 'live server returns 503 for a non-allowlisted IP');
    check(($live['headers']['retry-after'] ?? '') === '3600', 'live Retry-After is 3600');
    check(str_starts_with($live['headers']['content-type'] ?? '', 'text/html'), 'live 503 is html');
    check(str_contains($live['body'], 'Сайт на техническом обслуживании'), 'live body is the maintenance page');
    check(!str_contains($live['body'], 'MG-FIXTURE-HTML'), 'live response hides the site');
    $cert = $fetch('/.well-known/acme');
    check($cert['code'] === 200 && $cert['body'] === 'CERT-OK', 'certificate path stays reachable');
    unlink($httpDir . '/maintenance.on');
    clearstatcache();
    $opened = $fetch('/index.html');
    check($opened['code'] === 200 && $opened['body'] === 'MG-FIXTURE-HTML', 'deleting maintenance.on opens the site');
}
if (is_resource($proc)) {
    proc_terminate($proc);
    proc_close($proc);
}

echo $failures === 0 ? "passed\n" : "{$failures} failed\n";
ob_end_flush();
exit($failures === 0 ? 0 : 1);
