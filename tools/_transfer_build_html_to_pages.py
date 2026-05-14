#!/usr/bin/env python3
"""One-off: generate backend/pages/articles|catalog/*.php from frontend/build/*.html."""
from __future__ import annotations

import re
import sys
from pathlib import Path

ROOT = Path(__file__).resolve().parents[1]
BUILD = ROOT / "frontend" / "build"
PUG_ART = ROOT / "frontend" / "source" / "pug" / "articles"
PUG_CAT = ROOT / "frontend" / "source" / "pug" / "catalog"
OUT_ART = ROOT / "backend" / "pages" / "articles"
OUT_CAT = ROOT / "backend" / "pages" / "catalog"

MAIN_RE = re.compile(r"<main\b[^>]*>(.*)</main>", re.IGNORECASE | re.DOTALL)
TITLE_RE = re.compile(r"<title>(.*?)</title>", re.IGNORECASE | re.DOTALL)
DESC_RE = re.compile(
    r'<meta\s+name="description"\s+content="([^"]*)"', re.IGNORECASE
)
META_RE = re.compile(
    r'<p\s+class="article__meta"[^>]*>(.*?)</p>', re.IGNORECASE | re.DOTALL
)


def php_escape(s: str) -> str:
    return s.replace("\\", "\\\\").replace("'", "\\'")


def transform_inner(html: str, catalog_slugs: set[str], article_slugs: set[str]) -> str:
    html = re.sub(r'src="img/', 'src="/assets/img/', html)
    html = re.sub(r"src='img/", "src='/assets/img/", html)
    html = re.sub(r'src="assets/img/', 'src="/assets/img/', html)
    html = re.sub(r"src='assets/img/", "src='/assets/img/", html)

    html = re.sub(
        r'href="\.\./catalog\.html"', 'href="/pages/catalog.php"', html, flags=re.I
    )
    html = re.sub(r'href="catalog\.html"', 'href="/pages/catalog.php"', html, flags=re.I)
    html = re.sub(r'href="articles\.html"', 'href="/pages/articles.php"', html, flags=re.I)
    html = re.sub(r'href="index\.html#', 'href="/index.php#', html, flags=re.I)
    html = re.sub(r'href="index\.html"', 'href="/index.php"', html, flags=re.I)
    html = re.sub(
        r'href="history\.html#history"', 'href="/pages/history.php#history"', html, flags=re.I
    )
    html = re.sub(r'href="history\.html"', 'href="/pages/history.php"', html, flags=re.I)
    html = re.sub(r'href="oferta\.html"', 'href="/pages/legal/oferta.php"', html, flags=re.I)
    html = re.sub(r'href="privacy\.html"', 'href="/pages/legal/privacy.php"', html, flags=re.I)

    def slug_href(m: re.Match[str]) -> str:
        slug = m.group(1)
        if slug in catalog_slugs:
            return f'href="/pages/catalog/{slug}.php"'
        if slug in article_slugs:
            return f'href="/pages/articles/{slug}.php"'
        return f'href="/pages/articles/{slug}.php"'

    html = re.sub(r'href="([a-z0-9-]+)\.html"', slug_href, html, flags=re.I)
    return html


def build_php(
    title: str,
    description: str,
    active: str,
    inner: str,
) -> str:
    return f"""<?php
$pageTitle = '{php_escape(title)}';
$pageDescription = '{php_escape(description)}';
$activePage = '{php_escape(active)}';
?>

<!DOCTYPE html>
<html lang="ru">
<?php include __DIR__ . '/../../includes/head.php'; ?>

<body class="body">
    <?php include __DIR__ . '/../../includes/svg-sprite.php'; ?>
    <?php include __DIR__ . '/../../includes/header.php'; ?>

    <main class="main main--article">
{inner}
    </main>

    <?php include __DIR__ . '/../../includes/footer.php'; ?>
    <script src="/assets/js/main.js"></script>
</body>

</html>
"""


def main() -> int:
    article_slugs = {p.stem for p in PUG_ART.glob("*.pug")}
    catalog_slugs = {p.stem for p in PUG_CAT.glob("*.pug")}

    OUT_ART.mkdir(parents=True, exist_ok=True)
    OUT_CAT.mkdir(parents=True, exist_ok=True)

    written = 0
    for slug in sorted(article_slugs | catalog_slugs):
        html_path = BUILD / f"{slug}.html"
        if not html_path.is_file():
            print(f"skip (no build html): {slug}", file=sys.stderr)
            continue

        raw = html_path.read_text(encoding="utf-8")
        tm = MAIN_RE.search(raw)
        if not tm:
            print(f"skip (no <main>): {slug}", file=sys.stderr)
            continue

        title_m = TITLE_RE.search(raw)
        desc_m = DESC_RE.search(raw)
        title = title_m.group(1).strip() if title_m else slug
        description = desc_m.group(1).strip() if desc_m else ""
        if description in ("---", "...", ""):
            inner_preview = tm.group(1)
            mm = META_RE.search(inner_preview)
            if mm:
                description = re.sub(r"\s+", " ", mm.group(1)).strip()

        inner = tm.group(1).strip()
        inner = transform_inner(inner, catalog_slugs, article_slugs)

        if slug in catalog_slugs:
            active = "catalog"
            out = OUT_CAT / f"{slug}.php"
        else:
            active = "articles"
            out = OUT_ART / f"{slug}.php"

        content = build_php(title, description, active, inner)
        out.write_text(content, encoding="utf-8", newline="\n")
        written += 1
        print(out.relative_to(ROOT))

    print(f"written: {written}", file=sys.stderr)
    return 0


if __name__ == "__main__":
    raise SystemExit(main())
