<?php

declare(strict_types=1);

namespace App\Merchandising\ProviderInterface;

use App\Merchandising\DTO\MerchRequestDTO;

/**
 * Defines the MerchInterfacingPayloadProviderInterface contract and behavior within Merchandising.
 */
interface MerchInterfacingPayloadProviderInterface
{
    /**
     * @return array<string, mixed>
     */
    public function provideInterfacingPayload(string $merchKey, MerchRequestDTO $request): array;
}
