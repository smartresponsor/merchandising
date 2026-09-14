<?php

declare(strict_types=1);

namespace App\Merchandising\ValueObject;

/**
 * Defines the MerchView contract and behavior within Merchandising.
 */
final readonly class MerchView
{
    /**
     * @param list<MerchSectionView> $sections
     * @param list<MerchActionView> $actions
     * @param array<string, scalar|null> $metadata
     */
    public function __construct(
        public string $key,
        public string $title,
        public string $type,
        public array $sections,
        public ?string $summary = null,
        public array $actions = [],
        public array $metadata = [],
    ) {
    }

    /**
     * Serializes the complete merchandising surface into the renderer-neutral contract consumed downstream.
     *
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return [
            'key' => $this->key,
            'title' => $this->title,
            'type' => $this->type,
            'summary' => $this->summary,
            'sections' => array_map(static fn (MerchSectionView $section): array => $section->toArray(), $this->sections),
            'actions' => array_map(static fn (MerchActionView $action): array => $action->toArray(), $this->actions),
            'metadata' => $this->metadata,
        ];
    }
}
