# Direct Neighbor Source Contracts

Merchandising uses direct neighbor data contracts as the canonical acquisition path.

## Canon

- Merchandising owns candidate DTOs and source interfaces.
- Source components own implementations for their own data.
- Host applications wire owner-side implementations through Symfony service tags.
- UIBridging is used only after Merchandising has produced a surface/output view.
- Universal DTO/data bridging is forbidden by default.
- Direct reads of neighbor tables are forbidden as the primary integration path.

## Runtime flow

```text
ProductingMerchandisingProductSource
CatalogingMerchandisingCategorySource
ProjectingMerchandisingProjectSource
VendoringMerchandisingVendorSource
        ↓ tagged app.merchandising.candidate_source
MerchCandidateCollector
        ↓
MerchProvider
        ↓
MerchView
        ↓
UIBridging
        ↓
Interfacing
```

## Owner-side implementation names

Recommended class names:

```text
ProductingMerchandisingProductSource
CatalogingMerchandisingCategorySource
ProjectingMerchandisingProjectSource
VendoringMerchandisingVendorSource
UseringMerchandisingUserSource
AdvertisingMerchandisingAdvertisingSource
```

Implementations should live in the data-owner component, for example:

```text
Producting/src/Service/Merchandising/ProductingMerchandisingProductSource.php
Cataloging/src/Service/Merchandising/CatalogingMerchandisingCategorySource.php
```

## Machine-readable contract view

Owner-side implementations should implement `MerchDirectNeighborSourceInterface` and expose `contractView()`.
This gives agents a direct topology map without guessing from routes, table names, or controller fallbacks.

## Aggregation guarantees

- Candidate collection requires a positive limit and rejects non-positive values instead of delegating PHP slice semantics to callers.
- `displaySafe=false` candidates are never emitted.
- Overlapping owner registrations are deduplicated by `sourceComponent + sourceType + sourceId`.
- When the same source-owned identity is supplied more than once, the candidate with the strongest merchandising priority wins.
- Equal-priority output is ordered deterministically by source component, source type, source id, and candidate key.
- If duplicate candidates also tie on those ranking keys, their complete serialized candidate contract provides the final deterministic tie-break; Symfony service registration order never defines the winner.
- Source exceptions remain observable. Merchandising does not silently convert a mandatory source failure into an empty candidate set.

## Forbidden shortcuts

- Do not add a generic `DtoBridging` component as the default data path.
- Do not place product/category/project visibility logic in Merchandising.
- Do not query source component Doctrine repositories from Merchandising.
- Do not use UIBridging for source data acquisition.
