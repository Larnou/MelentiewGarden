#!/usr/bin/env python3
"""Sync seedlings grid in backend/pages/catalog.php from frontend/build/catalog.html."""
import re
from pathlib import Path

ROOT = Path(__file__).resolve().parents[1]
raw = (ROOT / "frontend/build/catalog.html").read_text(encoding="utf-8")
pattern = r'<div class="seedlings__list seedlings__list--grid">(.*)</div>\s*</div>\s*</section>'
m = re.search(pattern, raw, re.S | re.I)
if not m:
    raise SystemExit("Could not extract seedlings list from catalog.html")

inner = m.group(1).strip()
inner = re.sub(r'src="img/', 'src="/assets/img/', inner)
inner = re.sub(
    r'href="([a-z0-9-]+)\.html"',
    r'href="/pages/catalog/\1.php"',
    inner,
    flags=re.I,
)

replacement = (
    '<div class="seedlings__list seedlings__list--grid">'
    + inner
    + '</div>\n            </div>\n        </section>'
)

php_path = ROOT / "backend/pages/catalog.php"
php = php_path.read_text(encoding="utf-8")
php, n = re.subn(
    r'<div class="seedlings__list seedlings__list--grid">.*?</div>\s*</div>\s*</section>',
    replacement,
    php,
    count=1,
    flags=re.S,
)
if n != 1:
    raise SystemExit(f"catalog.php replace failed (n={n})")

php_path.write_text(php, encoding="utf-8", newline="\n")
cards = len(re.findall(r'href="/pages/catalog/', inner))
print(f"Updated catalog.php with {cards} cards")
