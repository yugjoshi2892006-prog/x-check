import re
from pathlib import Path
root = Path(r'c:\xampp\htdocs\new_company\application')
pattern = re.compile(r"base_url\(\s*['\"]index\.php|site_url\(\s*['\"]index\.php")
print('Scanning application directory...')
count = 0
for p in sorted(root.rglob('*')):
    if p.is_file() and p.suffix in {'.php', '.html', '.js'}:
        for i, line in enumerate(p.read_text(encoding='utf-8', errors='ignore').splitlines(), 1):
            if pattern.search(line):
                print(f'{p}:{i}:{line}')
                count += 1
print('Total matches:', count)
