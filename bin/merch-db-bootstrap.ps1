$ErrorActionPreference = 'Stop'

$projectDir = Split-Path -Parent $PSScriptRoot
$appDir = Join-Path $projectDir '..\App'

$databaseUrl = $env:DATABASE_URL
if ([string]::IsNullOrWhiteSpace($databaseUrl)) {
    foreach ($candidate in @('.env.local', '.env.dev.local', '.env')) {
        $path = Join-Path $appDir $candidate
        if (-not (Test-Path -LiteralPath $path)) {
            continue
        }

        foreach ($line in Get-Content -LiteralPath $path) {
            if ($line -notmatch '^\s*DATABASE_URL\s*=\s*(.+?)\s*$') {
                continue
            }

            $databaseUrl = $Matches[1].Trim()
            if (($databaseUrl.StartsWith('"') -and $databaseUrl.EndsWith('"')) -or ($databaseUrl.StartsWith("'") -and $databaseUrl.EndsWith("'"))) {
                $databaseUrl = $databaseUrl.Substring(1, $databaseUrl.Length - 2)
            }
            break
        }

        if (-not [string]::IsNullOrWhiteSpace($databaseUrl)) {
            break
        }
    }
}

if ([string]::IsNullOrWhiteSpace($databaseUrl)) {
    throw 'DATABASE_URL was not found in the process environment or App local environment files.'
}

$queryIndex = $databaseUrl.IndexOf('?')
$baseUrl = if ($queryIndex -ge 0) { $databaseUrl.Substring(0, $queryIndex) } else { $databaseUrl }
$query = if ($queryIndex -ge 0) { $databaseUrl.Substring($queryIndex) } else { '' }
$slashIndex = $baseUrl.LastIndexOf('/')
if ($slashIndex -lt 0) {
    throw 'DATABASE_URL does not contain a database path.'
}

$adminUrl = $baseUrl
$merchUrl = $baseUrl.Substring(0, $slashIndex + 1) + 'merchandising' + $query

$exists = & psql.exe $adminUrl -X --no-psqlrc -tA -c "SELECT 1 FROM pg_database WHERE datname = 'merchandising'"
if ($LASTEXITCODE -ne 0) {
    throw 'Unable to inspect PostgreSQL databases using the App connection.'
}

if ([string]::IsNullOrWhiteSpace(($exists | Out-String).Trim())) {
    & psql.exe $adminUrl -X --no-psqlrc -v ON_ERROR_STOP=1 -c 'CREATE DATABASE merchandising'
    if ($LASTEXITCODE -ne 0) {
        throw 'Unable to create the local merchandising database.'
    }
}

$env:MERCH_DATA_DATABASE_URL = $merchUrl

Push-Location $projectDir
try {
    php bin/console doctrine:migrations:migrate --no-interaction
    if ($LASTEXITCODE -ne 0) { throw 'Doctrine migration failed.' }

    php bin/console doctrine:migrations:up-to-date --no-interaction
    if ($LASTEXITCODE -ne 0) { throw 'Doctrine migration currentness check failed.' }

    php bin/console doctrine:schema:validate --no-interaction
    if ($LASTEXITCODE -ne 0) { throw 'Doctrine schema validation failed.' }
} finally {
    Pop-Location
    Remove-Item Env:MERCH_DATA_DATABASE_URL -ErrorAction SilentlyContinue
}
