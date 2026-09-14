# Merchandising Architecture Manifest

## Canonical identity

- Repository/component: `Merchandising`
- Composer package: `merchandising/merch`
- PHP namespace: `App\Merchandising`
- Business short stem: `Merch`
- Database/config prefix: `merch_`
- PHP: `^8.4`
- Symfony: `^8.0`

## Responsibility

Merchandising owns storefront composition: surfaces, sections, placements, priorities, campaigns, and source-backed presentation choices.

Merchandising does not own product, category, project, vendor, account, payment, shipping, or advertising truth. Those components expose source contracts. Merchandising composes them into UI-ready surfaces.

## Output contract

The canonical output contract is value-object based:

- `MerchSurfaceView`
- `MerchSectionView`
- `MerchItemView`
- `MerchActionView`

The Bridging layer consumes `MerchInterfacingPayloadProviderInterface` and maps the payload to Interfacing screens/widgets.

## Naming and structure canon

- No `/src/Domain/`.
- Use Symfony-oriented type layers: `Entity`, `Repository`, `Controller`, `Service`, `ServiceInterface`, `Value`, `Event`.
- Mirror service contracts under `src/ServiceInterface`.
- Source bridges are mirrored:
  - `src/Service/Source/*`
  - `src/ServiceInterface/Source/*`
- Class names use the component prefix `Merchandising` unless a Symfony convention requires otherwise.
- Doctrine table names start with `merch_`.
- Config keys start with `merch_`.

## Integration canon

- Cataloging supplies categories.
- Producting/Cataloging product surface supplies products.
- Projecting supplies intellectual products/projects.
- Vendoring supplies vendor highlights.
- Accessing/Usering supplies user context and segments.
- Advertising/Campaigning can later supply sponsored/promo placements.
- Bridging translates Merchandising output contracts for Interfacing.
- Interfacing renders the shell, widgets, and visual templates.
- Managing may edit CMS/campaign content consumed by Merchandising.

## First surfaces

- `home`: storefront home
- `category`: category merchandising surface
- `product`: product merchandising surface
- `project`: intellectual product/project merchandising surface
- `vendor`: vendor highlight surface

## Clean candidate acquisition canon

Merchandising uses neighboring component source contracts as its primary and canonical acquisition path.

Forbidden as a primary path:

- querying Producting/Cataloging/Projecting/Vendoring tables directly;
- injecting neighboring Doctrine repositories to build storefront candidates;
- duplicating source-component visibility, publication, price, stock, security, locale, or segment rules inside Merchandising.

Required flow:

```text
Neighbor component source contract
→ display-safe MerchCandidateView
→ MerchCandidateCollector
→ MerchSurfaceProviderInterface
→ MerchSurfaceView
→ Bridging for Interfacing
→ Interfacing rendering
```

Merchandising may persist only its own surfaces, sections, placements, priorities, slots, campaigns, and optional display snapshots. Such snapshots are merchandising-owned read models, not source-of-truth product/category/project/vendor records.


## Direct Neighbor Data Contract Canon

Merchandising uses direct neighbor source contracts for data acquisition.

- Merchandising defines candidate DTOs and source interfaces.
- Neighbor components implement those interfaces on the owner side.
- Host applications wire implementations through Symfony service tags.
- UIBridging is presentation-facing only and must not become a general data bus.
- Universal DTO/data bridge components are forbidden by default.
- Direct reads of neighbor component tables are forbidden as the primary integration path.

Canonical flow:

```text
Owner component source implementation
→ MerchCandidateView
→ MerchCandidateCollector
→ MerchSurfaceView
→ UIBridging
→ Interfacing
```
