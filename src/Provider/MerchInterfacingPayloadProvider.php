<?php

declare(strict_types=1);

namespace App\Merchandising\Provider;

use App\Merchandising\DTO\MerchSurfaceRequestDTO;
use App\Merchandising\ProviderInterface\MerchInterfacingPayloadProviderInterface;
use App\Merchandising\ProviderInterface\MerchSurfaceProviderInterface;

/**
 * Defines the MerchInterfacingPayloadProvider contract and behavior within Merchandising.
 */
final readonly class MerchInterfacingPayloadProvider implements MerchInterfacingPayloadProviderInterface
{
    /**
     * Initializes the MerchInterfacingPayloadProvider.
     */
    public function __construct(
        private MerchSurfaceProviderInterface $surfaceProvider,
    ) {
    }

    /**
     * Builds the renderer-neutral payload consumed by the Interfacing presentation boundary.
     *
     * @return array<string, mixed>
     */
    public function provideInterfacingPayload(string $surfaceKey, MerchSurfaceRequestDTO $request): array
    {
        $surface = $this->surfaceProvider->provideSurface($surfaceKey, $request);

        return [
            'component' => 'merchandising',
            'contract' => 'merchandising.interfacing.payload.v1',
            'screen' => [
                'key' => 'merchandising.' . $surface->key,
                'title' => $surface->title,
                'kind' => 'merchandising_surface',
            ],
            'surface' => $surface->toArray(),
        ];
    }
}
