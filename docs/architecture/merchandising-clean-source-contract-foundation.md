# Merchandising clean source-contract foundation

This wave establishes the canonical integration path for Merchandising.

## Decision

Merchandising does not read neighboring component databases directly. Producting, Cataloging, Projecting, Vendoring, Accessing/Usering, and Advertising/Campaigning expose source contracts that return display-safe merchandising candidates.

## New foundation

- `MerchCandidateView`: source-owned, display-safe candidate view model.
- `MerchCandidateSourceInterface`: generic source contract for all neighboring components.
- Source-specific marker interfaces for category/product/project/vendor/user/advertising candidate sources.
- `MerchCandidateCollectorInterface` and `MerchCandidateCollector`: collect, filter, sort, and limit candidates from tagged sources.
- Owner-side source implementations are supplied by neighboring components and wired through the tagged candidate-source contract; Merchandising does not ship demo source providers.
- `MerchProvider` now composes sections from source contracts instead of embedding product/category/project/vendor items directly.

## Canon

```text
Source components own business truth.
Merchandising owns storefront composition.
Bridging maps Merchandising surfaces to Interfacing payloads.
Interfacing renders.
```

Direct neighbor table reads are allowed only for explicitly marked temporary diagnostics or migration tooling, not for storefront composition.
