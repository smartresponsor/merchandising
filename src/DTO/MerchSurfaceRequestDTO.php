<?php

declare(strict_types=1);

namespace App\Merchandising\DTO;

/**
 * Defines the MerchSurfaceRequestDTO contract and behavior within Merchandising.
 */
final readonly class MerchSurfaceRequestDTO
{
    /**
     * @param array<string, scalar|null> $context
     */
    public function __construct(
        public ?string $userKey = null,
        public ?string $locale = null,
        public ?string $channel = 'web',
        public array $context = [],
    ) {
    }
}
