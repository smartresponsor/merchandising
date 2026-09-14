<?php

declare(strict_types=1);

namespace App\Merchandising\Controller;

use App\Merchandising\DTO\MerchSurfaceRequestDTO;
use App\Merchandising\ProviderInterface\MerchInterfacingPayloadProviderInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

/**
 * Defines the MerchSurfaceController contract and behavior within Merchandising.
 */
final readonly class MerchSurfaceController
{
    /**
     * Initializes the MerchSurfaceController.
     */
    public function __construct(
        private MerchInterfacingPayloadProviderInterface $payloadProvider,
    ) {
    }

    #[Route('/merchandising/surface/{surfaceKey}', name: 'merchandising_surface_payload', methods: ['GET'])]
    /**
     * Builds the JSON payload for a merchandising surface request.
     */
    public function payload(Request $request, string $surfaceKey = 'home'): JsonResponse
    {
        $surfaceRequest = new MerchSurfaceRequestDTO(
            userKey: $request->query->getString('user') ?: null,
            locale: $request->getLocale(),
            channel: 'web',
            context: [
                'route' => $request->getPathInfo(),
                'preview' => $request->query->getBoolean('preview'),
            ],
        );

        return new JsonResponse($this->payloadProvider->provideInterfacingPayload($surfaceKey, $surfaceRequest));
    }
}
