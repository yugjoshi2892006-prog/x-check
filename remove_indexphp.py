import re
from pathlib import Path
root = Path(r'c:\xampp\htdocs\new_company\application')

patterns = [
    (re.compile(r"base_url\(\s*(['\"])index\.php/"), r"base_url(\1"),
    (re.compile(r"site_url\(\s*(['\"])index\.php/"), r"site_url(\1"),
    (re.compile(r"base_url\(\s*(['\"])index\.php\s*\)"), r"base_url(\1)"),
    (re.compile(r"site_url\(\s*(['\"])index\.php\s*\)"), r"site_url(\1)"),
]

files = list(root.rglob('*'))
changed = 0
for p in files:
    if p.is_file() and p.suffix in {'.php', '.html', '.js'}:
        text = p.read_text(encoding='utf-8', errors='ignore')
        new = text
        for pat, repl in patterns:
            new = pat.sub(repl, new)
        if new != text:
            p.write_text(new, encoding='utf-8')
            changed += 1
            print(f'Updated: {p}')
print(f'Files changed: {changed}')
