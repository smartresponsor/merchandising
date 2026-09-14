<?php

declare(strict_types=1);

namespace App\Merchandising\ValueObject;

/**
 * Defines the MerchSectionView contract and behavior within Merchandising.
 */
final readonly class MerchSectionView
{
    /**
     * @param list<MerchItemView> $items
     * @param list<MerchActionView> $actions
     * @param array<string, scalar|null> $metadata
     */
    public function __construct(
        public string $key,
        public string $title,
        public string $type,
        public int $priority,
        public array $items = [],
        public ?string $summary = null,
        public array $actions = [],
        public array $metadata = [],
    ) {
    }

    /**
     * Serializes a composed merchandising section with ordered items, actions, and presentation metadata.
     *
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return [
            'key' => $this->key,
            'title' => $this->title,
            'type' => $this->type,
            'priority' => $this->priority,
            'summary' => $this->summary,
            'items' => array_map(static fn (MerchItemView $item): array => $item->toArray(), $this->items),
            'actions' => array_map(static fn (MerchActionView $action): array => $action->toArray(), $this->actions),
            'metadata' => $this->metadata,
        ];
    }
}
