<?php

declare(strict_types=1);

namespace App\Merchandising\ProviderInterface;

use App\Merchandising\DTO\MerchRequestDTO;
use App\Merchandising\ValueObject\MerchView;

/**
 * Defines the MerchProviderInterface contract and behavior within Merchandising.
 */
interface MerchProviderInterface
{
    /**
     * Builds a merchandising surface from registered candidate sources.
     */
    public function provide(string $merchKey, MerchRequestDTO $request): MerchView;
}
