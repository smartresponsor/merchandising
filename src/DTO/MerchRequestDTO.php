<?php

declare(strict_types=1);

namespace App\Merchandising\DTO;

/**
 * Defines the MerchRequestDTO contract and behavior within Merchandising.
 */
final readonly class MerchRequestDTO
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
