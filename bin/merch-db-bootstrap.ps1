$ErrorActionPreference = 'Stop'

$projectDir = Split-Path -Parent $PSScriptRoot

$databaseUrl = $env:MERCH_DATA_DATABASE_URL
if ([string]::IsNullOrWhiteSpace($databaseUrl)) {
    throw 'MERCH_DATA_DATABASE_URL must be supplied by the invoking environment.'
}

$env:MERCH_DATA_DATABASE_URL = $databaseUrl

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
