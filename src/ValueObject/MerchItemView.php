<?php

declare(strict_types=1);

namespace App\Merchandising\ValueObject;

/**
 * Defines the MerchItemView contract and behavior within Merchandising.
 */
final readonly class MerchItemView
{
    /**
     * @param list<string> $tags
     * @param list<MerchActionView> $actions
     * @param array<string, scalar|null> $metadata
     */
    public function __construct(
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
        public array $metadata = [],
    ) {
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return [
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
            'metadata' => $this->metadata,
        ];
    }
}
