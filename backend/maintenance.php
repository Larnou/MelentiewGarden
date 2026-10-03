<?php
/**
 * Полный экран обслуживания для саженцы-иркутск.рф.
 *
 * Включено, пока в этой же папке (корень сайта) лежит файл maintenance.on.
 * Выключить: удалить maintenance.on. Перезапуск PHP не нужен.
 * Кого пускать на обычный сайт: maintenance-allowlist.txt, один IP на строку.
 *
 * Адрес посетителя берётся только из REMOTE_ADDR.
 * Заголовки X-Forwarded-For и X-Real-IP не читаются.
 *
 * Локальный `npm start` этот файл не запускает: его отдаёт только PHP на сервере.
 */

declare(strict_types=1);

const MG_BRAND = 'САЖЕНЦЫ-ИРКУТСК';
const MG_PHONE_HREF = 'tel:+79526248656';
const MG_PHONE_LABEL = '+7 (952) 624-86-56';
const MG_EMAIL_HREF = 'mailto:melentev.garden@mail.ru';
const MG_EMAIL_LABEL = 'melentev.garden@mail.ru';
const MG_ADDRESS = 'р.п. Марково, Ново-Иркутский';
const MG_RETRY_AFTER = '3600';
const MG_GATE = '/maintenance.php';

function mg_client_ip(): string
{
    $ip = $_SERVER['REMOTE_ADDR'] ?? '';

    return is_string($ip) ? $ip : '';
}

function mg_enabled(string $docroot): bool
{
    $path = $docroot . '/maintenance.on';
    clearstatcache(true, $path);

    return is_file($path);
}

/** @return array<string, true> */
function mg_allowlist(string $docroot): array
{
    $path = $docroot . '/maintenance-allowlist.txt';
    clearstatcache(true, $path);
    if (!is_file($path)) {
        return [];
    }

    $lines = file($path, FILE_IGNORE_NEW_LINES);
    if ($lines === false) {
        return [];
    }

    $allowed = [];
    foreach ($lines as $line) {
        $line = trim($line);
        if ($line === '' || str_starts_with($line, '#')) {
            continue;
        }
        $token = preg_split('/\s+/', $line)[0] ?? '';
        if ($token !== '' && filter_var($token, FILTER_VALIDATE_IP)) {
            $allowed[$token] = true;
        }
    }

    return $allowed;
}

function mg_path_from_uri(string $uri): ?string
{
    $path = parse_url($uri, PHP_URL_PATH);
    if (!is_string($path) || $path === '' || str_contains($path, "\0")) {
        return null;
    }
    $path = rawurldecode($path);
    if (!str_starts_with($path, '/') || str_contains($path, '\\')) {
        return null;
    }

    return $path;
}

function mg_original_path(): string
{
    foreach (['REDIRECT_MG_ORIGINAL', 'MG_ORIGINAL'] as $key) {
        $value = $_SERVER[$key] ?? null;
        if (is_string($value) && $value !== '') {
            $path = mg_path_from_uri($value);
            if ($path !== null) {
                return $path;
            }
        }
    }

    $requestUri = $_SERVER['REQUEST_URI'] ?? '/';
    if (!is_string($requestUri) || $requestUri === '') {
        $requestUri = '/';
    }
    $path = mg_path_from_uri($requestUri) ?? '/';

    if ($path === MG_GATE) {
        $redirect = $_SERVER['REDIRECT_URL'] ?? null;
        if (is_string($redirect) && $redirect !== '' && $redirect !== MG_GATE) {
            $fromRedirect = mg_path_from_uri($redirect);
            if ($fromRedirect !== null) {
                return $fromRedirect;
            }
        }
    }

    return $path;
}

function mg_is_gate_path(string $path): bool
{
    return $path === MG_GATE;
}

function mg_is_hidden(string $full): bool
{
    $base = basename($full);
    if (str_starts_with($base, '.')) {
        return true;
    }

    return in_array($base, [
        'maintenance-allowlist.txt',
        'maintenance.on',
        'maintenance.php',
        'apache.htaccess',
        'nginx.conf',
    ], true);
}

function mg_resolve(string $docroot, string $urlPath): ?string
{
    $root = realpath($docroot);
    if ($root === false) {
        return null;
    }

    $candidate = $root . $urlPath;
    if (is_dir($candidate)) {
        foreach (['index.php', 'index.html', 'index.htm'] as $index) {
            $indexPath = rtrim($candidate, '/') . '/' . $index;
            if (is_file($indexPath)) {
                $candidate = $indexPath;
                break;
            }
        }
    }

    $full = realpath($candidate);
    if ($full === false || is_dir($full)) {
        return null;
    }
    if ($full !== $root && !str_starts_with($full, $root . DIRECTORY_SEPARATOR)) {
        return null;
    }
    if (mg_is_hidden($full)) {
        return null;
    }

    return $full;
}

function mg_mime(string $path): string
{
    return match (strtolower(pathinfo($path, PATHINFO_EXTENSION))) {
        'html', 'htm' => 'text/html; charset=utf-8',
        'css' => 'text/css; charset=utf-8',
        'js' => 'text/javascript; charset=utf-8',
        'svg' => 'image/svg+xml',
        'png' => 'image/png',
        'jpg', 'jpeg' => 'image/jpeg',
        'gif' => 'image/gif',
        'webp' => 'image/webp',
        'ico' => 'image/x-icon',
        'woff' => 'font/woff',
        'woff2' => 'font/woff2',
        'json', 'webmanifest' => 'application/json',
        'xml' => 'application/xml',
        'txt' => 'text/plain; charset=utf-8',
        'pdf' => 'application/pdf',
        default => 'application/octet-stream',
    };
}

function mg_begin_response(): void
{
    header_remove('Content-Type');
    header_remove('Content-Length');
    header_remove('Retry-After');
    header_remove('Cache-Control');
    header_remove('X-Robots-Tag');
}

function mg_send_not_found(): void
{
    mg_begin_response();
    http_response_code(404);
    header('Content-Type: text/plain; charset=utf-8');
    if (($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'HEAD') {
        echo "Not Found\n";
    }
}

function mg_font_css(string $docroot): string
{
    $path = $docroot . '/maintenance-fonts.css';
    if (!is_file($path)) {
        return '';
    }
    $css = file_get_contents($path);

    return is_string($css) ? $css : '';
}

function mg_h(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function mg_maintenance_html(string $docroot): string
{
    $brand = mg_h(MG_BRAND);
    $phoneHref = mg_h(MG_PHONE_HREF);
    $phoneLabel = mg_h(MG_PHONE_LABEL);
    $emailHref = mg_h(MG_EMAIL_HREF);
    $emailLabel = mg_h(MG_EMAIL_LABEL);
    $address = mg_h(MG_ADDRESS);
    $fonts = mg_font_css($docroot);

    return <<<HTML
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="robots" content="noindex, nofollow">
  <meta name="theme-color" content="#f5f5f5">
  <title>Техническое обслуживание — {$brand}</title>
  <style>
    {$fonts}
    html, body { height: 100%; }
    body {
      margin: 0;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 32px 16px;
      box-sizing: border-box;
      color: #1D2126;
      background-color: #f5f5f5;
      background-image:
        radial-gradient(ellipse at 8% 0%, rgba(104, 129, 41, 0.22), transparent 52%),
        radial-gradient(ellipse at 100% 100%, rgba(64, 80, 19, 0.16), transparent 48%);
      font-family: "Montserrat", "Helvetica", Arial, sans-serif;
      font-weight: 500;
      font-size: 16px;
      line-height: 1.5;
    }
    .card {
      width: 100%;
      max-width: 640px;
      background: #fff;
      border-radius: 16px;
      box-shadow: 0 4px 8px rgba(29, 33, 38, 0.1);
      overflow: hidden;
    }
    .card__accent { height: 6px; background: #688129; }
    .card__body { padding: 40px 40px 36px; }
    .brand {
      display: flex;
      align-items: center;
      gap: 16px;
      margin: 0 0 28px;
    }
    .brand svg { display: block; flex-shrink: 0; }
    .brand__name {
      margin: 0;
      font-size: 24px;
      font-weight: 700;
      line-height: 1.3;
      letter-spacing: 0.01em;
    }
    h1 {
      margin: 0 0 16px;
      font-size: 36px;
      font-weight: 700;
      line-height: 1.25;
      letter-spacing: 0;
    }
    .lead { margin: 0 0 12px; }
    .contacts {
      display: flex;
      flex-direction: column;
      gap: 12px;
      margin-top: 28px;
    }
    .contacts a {
      display: flex;
      align-items: center;
      gap: 12px;
      min-height: 48px;
      color: #405013;
      font-weight: 700;
      text-decoration: none;
      overflow-wrap: anywhere;
    }
    .contacts a:hover { color: #688129; }
    .contacts a:focus-visible {
      outline: 2px solid #688129;
      outline-offset: 4px;
      border-radius: 8px;
    }
    .contacts__icon {
      width: 40px;
      height: 40px;
      flex-shrink: 0;
      display: grid;
      place-items: center;
      border-radius: 50%;
      background: #688129;
    }
    .address {
      margin: 24px 0 0;
      color: #333;
      font-size: 14px;
      font-weight: 500;
    }
    @media (max-width: 767px) {
      body { padding: 16px 12px; }
      .card__body { padding: 28px 20px 24px; }
      .brand { gap: 12px; margin-bottom: 20px; }
      .brand svg { width: 32px; height: 32px; }
      .brand__name { font-size: 16px; }
      h1 { font-size: 28px; }
      .lead { font-size: 15px; }
    }
  </style>
</head>
<body>
  <main class="card">
    <div class="card__accent"></div>
    <div class="card__body">
      <div class="brand">
        <svg width="40" height="40" viewBox="0 0 40 40" fill="#688129" aria-hidden="true">
          <path d="M17.3078 4.62531C17.4602 0.145313 12.3935 -0.554531 10.5859 0.33625C11.057 5.50281 14.9989 5.61656 17.3078 4.62531Z"/>
          <path d="M37.1055 15.1228C37.194 15.3479 37.2395 15.4642 37.2546 15.5022C37.2338 15.4497 37.1737 15.2954 37.1055 15.1228Z"/>
          <path d="M37.0609 15.0052C37.0761 15.0444 37.0912 15.0837 37.1064 15.1228C37.0919 15.0843 37.078 15.0495 37.0602 15.0039C36.7074 14.103 36.8838 14.5538 37.0596 15.0034C35.9337 12.126 33.6841 9.75399 30.7424 8.72086C27.5491 7.60055 24.2204 8.23656 21.0598 9.10906C20.9998 7.38242 21.1458 5.65078 21.3911 3.94117C21.5302 2.97641 22.1959 0.98047 20.5444 0.912189C19.1738 0.855314 19.17 2.69 19.0366 3.6257C18.7787 5.42063 18.6263 7.23961 18.6756 9.05406C17.9163 8.92766 17.1666 8.645 16.4103 8.4882C15.2824 8.25555 14.1337 8.11016 12.9811 8.10883C10.7601 8.10883 8.56812 8.69742 6.74039 9.98281C3.19109 12.4802 1.80898 16.8375 1.86906 21.0241C1.93476 25.5571 3.46984 29.8859 6.0525 33.5833C7.19242 35.2157 8.50296 36.7811 10.1228 37.9589C11.697 39.1032 13.4552 39.6394 15.364 39.9124C16.1744 40.0295 16.9996 40.0326 17.8075 39.9005C18.513 39.7855 19.1737 39.4877 19.8736 39.3694C20.4022 39.2802 21.1476 39.6963 21.659 39.81C22.5309 40.006 23.428 40.0465 24.3162 39.9453C27.5666 39.5748 30.1416 38.1087 32.2805 35.6505C36.9844 30.2445 39.7877 21.9687 37.0609 15.0052ZM11.5852 19.319C9.91617 19.319 8.56382 17.9666 8.56382 16.2976C8.56382 14.6285 9.91617 13.2762 11.5852 13.2762C13.2537 13.2762 14.6066 14.6285 14.6066 16.2976C14.6066 17.9666 13.2537 19.319 11.5852 19.319Z"/>
        </svg>
        <p class="brand__name">{$brand}</p>
      </div>
      <h1>Сайт на техническом обслуживании</h1>
      <p class="lead">Мы обновляем сайт, поэтому сейчас он закрыт для посетителей. Зайдите, пожалуйста, немного позже.</p>
      <p class="lead">Если вопрос срочный, позвоните или напишите — мы на связи.</p>
      <div class="contacts">
        <a href="{$phoneHref}">
          <span class="contacts__icon" aria-hidden="true">
            <svg width="22" height="22" viewBox="0 0 64 64" fill="none">
              <path d="M38.2148 42.507L41.7615 38.9601C42.3073 38.4078 42.9572 37.9689 43.6735 37.6697C44.39 37.3705 45.1585 37.2166 45.9348 37.2166C46.7113 37.2166 47.4799 37.3705 48.1964 37.6697C48.9127 37.9689 49.5625 38.4078 50.1081 38.9601L54.2681 43.1204C54.8204 43.666 55.2591 44.3153 55.5583 45.0318C55.8575 45.7481 56.0116 46.5172 56.0116 47.2934C56.0116 48.07 55.8575 48.8388 55.5583 49.5553C55.2591 50.2716 54.8204 50.9209 54.2681 51.4665L52.3748 53.3865C51.0703 54.7038 49.3831 55.5758 47.5537 55.8774C45.7244 56.179 43.8465 55.8956 42.1881 55.0668C27.9169 47.7204 16.2929 36.1054 8.93489 21.8403C8.10537 20.1801 7.82371 18.2996 8.13038 16.4692C8.43705 14.6388 9.31625 12.9527 10.6416 11.6535L12.5348 9.73357C13.644 8.63111 15.1443 8.01221 16.7082 8.01221C18.272 8.01221 19.7724 8.63111 20.8815 9.73357L25.0682 13.9204C26.1706 15.0296 26.7895 16.5297 26.7895 18.0936C26.7895 19.6574 26.1706 21.1576 25.0682 22.2668L21.5215 25.8136C23.8666 28.9857 26.4425 31.9801 29.2281 34.7732C31.9977 37.5476 34.9753 40.1065 38.1348 42.427L38.2148 42.507Z" stroke="#fff" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </span>
          {$phoneLabel}
        </a>
        <a href="{$emailHref}">
          <span class="contacts__icon" aria-hidden="true">
            <svg width="22" height="22" viewBox="0 0 64 64" fill="none">
              <path d="M10.666 18.6666L27.1993 31.0665C30.0439 33.1998 33.9548 33.1998 36.7993 31.0665L53.3327 18.6665" stroke="#fff" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
              <path d="M50.6667 13.3335H13.3333C10.3878 13.3335 8 15.7213 8 18.6668V45.3335C8 48.279 10.3878 50.6668 13.3333 50.6668H50.6667C53.6122 50.6668 56 48.279 56 45.3335V18.6668C56 15.7213 53.6122 13.3335 50.6667 13.3335Z" stroke="#fff" stroke-width="3" stroke-linecap="round"/>
            </svg>
          </span>
          {$emailLabel}
        </a>
      </div>
      <p class="address">{$address}</p>
    </div>
  </main>
</body>
</html>
HTML;
}

function mg_send_maintenance(string $docroot): void
{
    mg_begin_response();
    http_response_code(503);
    header('Content-Type: text/html; charset=utf-8');
    header('Retry-After: ' . MG_RETRY_AFTER);
    header('Cache-Control: no-store');
    header('X-Robots-Tag: noindex, nofollow');
    if (($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'HEAD') {
        echo mg_maintenance_html($docroot);
    }
}

function mg_serve(string $docroot, string $urlPath): void
{
    $full = mg_resolve($docroot, $urlPath);
    if ($full === null) {
        mg_send_not_found();
        return;
    }

    mg_begin_response();
    http_response_code(200);

    $extension = strtolower(pathinfo($full, PATHINFO_EXTENSION));
    if ($extension === 'php') {
        $root = realpath($docroot);
        $scriptName = $root === false ? $urlPath : substr($full, strlen($root));
        if ($scriptName === '' || $scriptName[0] !== '/') {
            $scriptName = '/' . ltrim((string) $scriptName, '/');
        }
        $_SERVER['SCRIPT_FILENAME'] = $full;
        $_SERVER['SCRIPT_NAME'] = $scriptName;
        $_SERVER['PHP_SELF'] = $scriptName;
        $previous = getcwd();
        chdir(dirname($full));
        try {
            require $full;
        } finally {
            if (is_string($previous) && $previous !== '' && is_dir($previous)) {
                chdir($previous);
            }
        }
        return;
    }

    header('Content-Type: ' . mg_mime($full));
    header('Content-Length: ' . (string) filesize($full));
    if (($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'HEAD') {
        readfile($full);
    }
}

function mg_dispatch(string $docroot): void
{
    $root = realpath($docroot);
    if ($root === false) {
        mg_send_maintenance($docroot);
        return;
    }

    $path = mg_original_path();
    if (!mg_enabled($root)) {
        if (mg_is_gate_path($path)) {
            mg_send_not_found();
            return;
        }
        mg_serve($root, $path);
        return;
    }

    $allowed = mg_allowlist($root);
    $ip = mg_client_ip();
    if ($ip !== '' && isset($allowed[$ip])) {
        mg_serve($root, mg_is_gate_path($path) ? '/' : $path);
        return;
    }

    mg_send_maintenance($root);
}

$mgScript = realpath((string) ($_SERVER['SCRIPT_FILENAME'] ?? ''));
if (PHP_SAPI !== 'cli' && $mgScript !== false && $mgScript === realpath(__FILE__)) {
    mg_dispatch(__DIR__);
}
