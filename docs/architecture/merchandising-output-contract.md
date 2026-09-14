# Merchandising Output Contract

`MerchView` is the renderer-neutral contract consumed by Bridging. It is intentionally not Twig, React, Ant Design, or ProComponents specific.

The bridge maps section types to Interfacing widgets:

- `hero` → hero widget
- `category_grid` → category grid
- `product_strip` → product carousel/strip
- `project_strip` → project/intellectual product strip
- `vendor_strip` → vendor highlights
- `banner` → promotion/ad slot
- `masonry` → dashboard-style mixed surface
