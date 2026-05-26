#!/usr/bin/env node
/**
 * Генерирует sitemap.xml и robots.txt с PHP-URL для продакшена (backend/).
 * Список страниц — из frontend/build/*.html; базовый домен — site.pug (publicUrl).
 */
import fs from 'node:fs';
import path from 'node:path';
import { fileURLToPath } from 'node:url';
import { domainToASCII } from 'node:url';

const ROOT = path.resolve(path.dirname(fileURLToPath(import.meta.url)), '..');
const BUILD_DIR = path.join(ROOT, 'frontend/build');
const OUTPUT_DIR = path.join(ROOT, 'backend');
const SITE_PUG = path.join(ROOT, 'frontend/source/pug/data/site.pug');
const PUG_CATALOG_DIR = path.join(ROOT, 'frontend/source/pug/catalog');
const PUG_ARTICLES_DIR = path.join(ROOT, 'frontend/source/pug/articles');

/** Страницы, которые не должны попадать в индекс. */
const EXCLUDED_SLUGS = new Set([
  'example',
  'seedling-apple-test',
]);

const STATIC_PAGES = {
  index: { priority: '1.0', changefreq: 'weekly' },
  catalog: { priority: '0.9', changefreq: 'weekly' },
  articles: { priority: '0.9', changefreq: 'weekly' },
  history: { priority: '0.8', changefreq: 'monthly' },
  oferta: { priority: '0.3', changefreq: 'yearly' },
  privacy: { priority: '0.3', changefreq: 'yearly' },
};

function readPublicUrl() {
  const content = fs.readFileSync(SITE_PUG, 'utf8');
  const match = content.match(/publicUrl:\s*['"]([^'"]+)['"]/);
  if (!match) {
    throw new Error(`publicUrl not found in ${SITE_PUG}`);
  }
  return match[1].replace(/\/$/, '');
}

function slugsFromPugDir(dir) {
  if (!fs.existsSync(dir)) {
    return new Set();
  }
  return new Set(
    fs.readdirSync(dir)
      .filter((name) => name.endsWith('.pug'))
      .map((name) => name.replace(/\.pug$/, '')),
  );
}

function toAsciiBaseUrl(publicUrl) {
  const parsed = new URL(publicUrl.startsWith('http') ? publicUrl : `https://${publicUrl}`);
  parsed.hostname = domainToASCII(parsed.hostname);
  parsed.pathname = '';
  parsed.search = '';
  parsed.hash = '';
  return parsed.toString().replace(/\/$/, '');
}

function formatLastmod(filePath) {
  const { mtime } = fs.statSync(filePath);
  return mtime.toISOString().slice(0, 10);
}

function escapeXml(value) {
  return value
    .replace(/&/g, '&amp;')
    .replace(/</g, '&lt;')
    .replace(/>/g, '&gt;')
    .replace(/"/g, '&quot;')
    .replace(/'/g, '&apos;');
}

/** Путь на проде (от корня сайта), см. html-to-php-page-transfer.mdc */
function buildPath(slug, catalogSlugs) {
  if (slug === 'index') return '/index.php';
  if (slug === 'catalog') return '/pages/catalog.php';
  if (slug === 'articles') return '/pages/articles.php';
  if (slug === 'history') return '/pages/history.php';
  if (slug === 'oferta') return '/pages/legal/oferta.php';
  if (slug === 'privacy') return '/pages/legal/privacy.php';
  if (catalogSlugs.has(slug)) return `/pages/catalog/${slug}.php`;
  return `/pages/articles/${slug}.php`;
}

function phpCandidates(slug, catalogSlugs) {
  switch (slug) {
    case 'index':
      return [
        path.join(ROOT, 'backend/index.php'),
        path.join(ROOT, 'backend/pages/index.php'),
      ];
    case 'catalog':
      return [path.join(ROOT, 'backend/pages/catalog.php')];
    case 'articles':
      return [path.join(ROOT, 'backend/pages/articles.php')];
    case 'history':
      return [path.join(ROOT, 'backend/pages/history.php')];
    case 'oferta':
      return [path.join(ROOT, 'backend/pages/legal/oferta.php')];
    case 'privacy':
      return [path.join(ROOT, 'backend/pages/legal/privacy.php')];
    default:
      if (catalogSlugs.has(slug)) {
        return [path.join(ROOT, 'backend/pages/catalog', `${slug}.php`)];
      }
      return [path.join(ROOT, 'backend/pages/articles', `${slug}.php`)];
  }
}

function resolveLastmodSource(slug, catalogSlugs) {
  const candidates = [
    ...phpCandidates(slug, catalogSlugs),
    path.join(BUILD_DIR, `${slug}.html`),
  ];
  const found = candidates.find((p) => fs.existsSync(p));
  if (!found) {
    throw new Error(`No source file for slug "${slug}"`);
  }
  return found;
}

function collectPages(catalogSlugs) {
  if (!fs.existsSync(BUILD_DIR)) {
    throw new Error(`Build directory not found: ${BUILD_DIR}. Run "npm run build" first.`);
  }

  const htmlFiles = fs.readdirSync(BUILD_DIR)
    .filter((name) => name.endsWith('.html'))
    .map((name) => name.replace(/\.html$/, ''));

  const entries = [];

  for (const slug of htmlFiles) {
    if (EXCLUDED_SLUGS.has(slug)) {
      continue;
    }

    let meta;
    if (STATIC_PAGES[slug]) {
      meta = STATIC_PAGES[slug];
    } else if (catalogSlugs.has(slug)) {
      meta = { priority: '0.7', changefreq: 'monthly' };
    } else {
      meta = { priority: '0.7', changefreq: 'monthly' };
    }

    entries.push({
      slug,
      path: buildPath(slug, catalogSlugs),
      lastmod: formatLastmod(resolveLastmodSource(slug, catalogSlugs)),
      ...meta,
    });
  }

  entries.sort((a, b) => {
    const order = (slug) => {
      if (slug === 'index') return 0;
      if (slug === 'catalog' || slug === 'articles') return 1;
      if (slug === 'history') return 2;
      if (slug === 'oferta' || slug === 'privacy') return 9;
      return 5;
    };
    const diff = order(a.slug) - order(b.slug);
    return diff !== 0 ? diff : a.slug.localeCompare(b.slug, 'ru');
  });

  return entries;
}

function renderSitemap(baseUrl, entries) {
  const urls = entries.map((entry) => {
    const loc = `${baseUrl}${entry.path}`;
    return [
      '  <url>',
      `    <loc>${escapeXml(loc)}</loc>`,
      `    <lastmod>${entry.lastmod}</lastmod>`,
      `    <changefreq>${entry.changefreq}</changefreq>`,
      `    <priority>${entry.priority}</priority>`,
      '  </url>',
    ].join('\n');
  });

  return [
    '<?xml version="1.0" encoding="UTF-8"?>',
    '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">',
    ...urls,
    '</urlset>',
    '',
  ].join('\n');
}

function renderRobots(sitemapUrl) {
  return [
    'User-agent: *',
    'Allow: /',
    '',
    `Sitemap: ${sitemapUrl}`,
    '',
  ].join('\n');
}

function main() {
  const publicUrl = readPublicUrl();
  const baseUrl = toAsciiBaseUrl(publicUrl);
  const catalogSlugs = slugsFromPugDir(PUG_CATALOG_DIR);
  const entries = collectPages(catalogSlugs);

  fs.mkdirSync(OUTPUT_DIR, { recursive: true });

  const sitemapPath = path.join(OUTPUT_DIR, 'sitemap.xml');
  const robotsPath = path.join(OUTPUT_DIR, 'robots.txt');
  const sitemapUrl = `${baseUrl}/sitemap.xml`;

  fs.writeFileSync(sitemapPath, renderSitemap(baseUrl, entries), 'utf8');
  fs.writeFileSync(robotsPath, renderRobots(sitemapUrl), 'utf8');

  console.log(`Sitemap: ${entries.length} URLs -> ${sitemapPath}`);
  console.log(`Robots: ${robotsPath}`);
  console.log(`Base URL: ${baseUrl}`);
}

main();
