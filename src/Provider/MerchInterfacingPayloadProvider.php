<?php

declare(strict_types=1);

namespace App\Merchandising\Provider;

use App\Merchandising\DTO\MerchRequestDTO;
use App\Merchandising\ProviderInterface\MerchInterfacingPayloadProviderInterface;
use App\Merchandising\ProviderInterface\MerchProviderInterface;

/**
 * Defines the MerchInterfacingPayloadProvider contract and behavior within Merchandising.
 */
final readonly class MerchInterfacingPayloadProvider implements MerchInterfacingPayloadProviderInterface
{
    /**
     * Initializes the MerchInterfacingPayloadProvider.
     */
    public function __construct(
        private MerchProviderInterface $merchProvider,
    ) {
    }

    /**
     * Builds the renderer-neutral payload consumed by the Interfacing presentation boundary.
     *
     * @return array<string, mixed>
     */
    public function provideInterfacingPayload(string $merchKey, MerchRequestDTO $request): array
    {
        $merch = $this->merchProvider->provide($merchKey, $request);

        return [
            'component' => 'merchandising',
            'contract' => 'merchandising.interfacing.payload.v1',
            'screen' => [
                'key' => 'merchandising.' . $merch->key,
                'title' => $merch->title,
                'kind' => 'merchandising',
            ],
            'merch' => $merch->toArray(),
        ];
    }
}
