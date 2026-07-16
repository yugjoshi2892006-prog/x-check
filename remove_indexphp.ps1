$root = 'c:\xampp\htdocs\new_company\application'
$patterns = @(
    @{ pat="base_url\(\s*'index\.php/"; rep="base_url('" },
    @{ pat='base_url\(\s*"index\.php/'; rep='base_url("' },
    @{ pat="site_url\(\s*'index\.php/"; rep="site_url('" },
    @{ pat='site_url\(\s*"index\.php/'; rep='site_url("' }
)
Get-ChildItem -Path $root -Recurse -Include *.php,*.html,*.js -File | ForEach-Object {
    $text = Get-Content -Raw -Encoding UTF8 $_.FullName
    $new = $text
    foreach ($p in $patterns) {
        $new = [regex]::Replace($new, $p.pat, $p.rep)
    }
    if ($new -ne $text) {
        Set-Content -Path $_.FullName -Value $new -Encoding UTF8
        Write-Host "Updated: $($_.FullName)"
    }
}
Write-Host 'Cleanup complete.'
