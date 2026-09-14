# Merchandising Composer Stable Baseline

## Decision

The Merchandising skeleton uses stable Doctrine ORM 3.x, not Doctrine ORM 4.x.

Doctrine ORM 4 is not a stable release line for this component baseline. The package constraint must stay on the stable ORM 3 line until the ecosystem explicitly promotes Doctrine ORM 4.

## Canon

- PHP: `^8.4`
- Symfony packages: `^8.0`
- Doctrine ORM: `^3.6`
- Composer package: `merchandising/merch`
- Root skeleton version: `0.1.0-dev`

## Quality script aliases

The component exposes the normal quality scripts and short owner-review aliases:

- `composer quality`
- `composer quality:po`
- `composer quality:post`
- `composer quality:post-seal-owner-handoff-index`
- `composer quality:rc-owner-review-final-seal`
