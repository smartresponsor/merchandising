<?php

declare(strict_types=1);

namespace App\Merchandising\ValueObject;

/**
 * Display-safe candidate received from a neighboring component through an explicit merchandising source contract.
 *
 * The candidate is not a Doctrine entity and is not a direct database projection from another component. It is a
 * source-owned view model that Merchandising can rank, place, and compose into surfaces without owning the source object.
 */
final readonly class MerchCandidateView
{
    /**
     * @param list<string> $tags
     * @param list<MerchActionView> $actions
     * @param array<string, scalar|null> $metadata
     */
    public function __construct(
        public string $sourceComponent,
        public string $sourceType,
        public string $sourceId,
        public string $key,
        public string $title,
        public string $summary,
        public string $kind,
        public ?string $href = null,
        public ?string $eyebrow = null,
        public ?string $image = null,
        public ?string $price = null,
        public ?string $oldPrice = null,
        public ?string $badge = null,
        public array $tags = [],
        public array $actions = [],
        public int $priority = 100,
        public bool $displaySafe = true,
        public array $metadata = [],
    ) {
    }

    /**
     * Executes the to item view operation.
     */
    public function toItemView(): MerchItemView
    {
        return new MerchItemView(
            key: $this->key,
            title: $this->title,
            summary: $this->summary,
            kind: $this->kind,
            href: $this->href,
            eyebrow: $this->eyebrow,
            image: $this->image,
            price: $this->price,
            oldPrice: $this->oldPrice,
            badge: $this->badge,
            tags: $this->tags,
            actions: $this->actions,
            metadata: [
                'sourceComponent' => $this->sourceComponent,
                'sourceType' => $this->sourceType,
                'sourceId' => $this->sourceId,
                'priority' => $this->priority,
                'displaySafe' => $this->displaySafe,
            ] + $this->metadata,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return [
            'sourceComponent' => $this->sourceComponent,
            'sourceType' => $this->sourceType,
            'sourceId' => $this->sourceId,
            'key' => $this->key,
            'title' => $this->title,
            'summary' => $this->summary,
            'kind' => $this->kind,
            'href' => $this->href,
            'eyebrow' => $this->eyebrow,
            'image' => $this->image,
            'price' => $this->price,
            'oldPrice' => $this->oldPrice,
            'badge' => $this->badge,
            'tags' => $this->tags,
            'actions' => array_map(static fn (MerchActionView $action): array => $action->toArray(), $this->actions),
            'priority' => $this->priority,
            'displaySafe' => $this->displaySafe,
            'metadata' => $this->metadata,
        ];
    }
}
