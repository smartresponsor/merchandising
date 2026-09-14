<?php

declare(strict_types=1);

namespace App\Merchandising\Controller;

use App\Merchandising\DTO\MerchRequestDTO;
use App\Merchandising\ProviderInterface\MerchInterfacingPayloadProviderInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

/**
 * Defines the MerchController contract and behavior within Merchandising.
 */
final readonly class MerchController
{
    /**
     * Initializes the MerchController.
     */
    public function __construct(
        private MerchInterfacingPayloadProviderInterface $payloadProvider,
    ) {
    }

    #[Route('/merchandising/{merchKey}', name: 'merchandising_payload', methods: ['GET'])]
    /**
     * Builds the JSON payload for a merchandising surface request.
     */
    public function payload(Request $request, string $merchKey = 'home'): JsonResponse
    {
        $merchRequest = new MerchRequestDTO(
            userKey: $request->query->getString('user') ?: null,
            locale: $request->getLocale(),
            channel: 'web',
            context: [
                'route' => $request->getPathInfo(),
                'preview' => $request->query->getBoolean('preview'),
            ],
        );

        return new JsonResponse($this->payloadProvider->provideInterfacingPayload($merchKey, $merchRequest));
    }
}
