<?php

declare(strict_types=1);

namespace App\Merchandising\ValueObject;

/**
 * Describes one owner-side direct source implementation registered for Merchandising.
 *
 * This view is for diagnostics, manifests, and agent-readable topology. It is not a business candidate and must not be
 * rendered as a storefront item.
 */
final readonly class MerchSourceContractView
{
    /**
     * @param list<string> $providedSlots
     * @param array<string, scalar|null> $metadata
     */
    public function __construct(
        public string $sourceKey,
        public string $sourceComponent,
        public string $sourceType,
        public string $ownerComponent,
        public string $implementationClass,
        public array $providedSlots = [],
        public bool $ownerSide = true,
        public array $metadata = [],
    ) {
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return [
            'sourceKey' => $this->sourceKey,
            'sourceComponent' => $this->sourceComponent,
            'sourceType' => $this->sourceType,
            'ownerComponent' => $this->ownerComponent,
            'implementationClass' => $this->implementationClass,
            'providedSlots' => $this->providedSlots,
            'ownerSide' => $this->ownerSide,
            'metadata' => $this->metadata,
        ];
    }
}
