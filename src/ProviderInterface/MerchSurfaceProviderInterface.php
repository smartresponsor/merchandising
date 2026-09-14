<?php

declare(strict_types=1);

namespace App\Merchandising\ProviderInterface;

use App\Merchandising\DTO\MerchSurfaceRequestDTO;
use App\Merchandising\ValueObject\MerchSurfaceView;

/**
 * Defines the MerchSurfaceProviderInterface contract and behavior within Merchandising.
 */
interface MerchSurfaceProviderInterface
{
    /**
     * Builds a merchandising surface from registered candidate sources.
     */
    public function provideSurface(string $surfaceKey, MerchSurfaceRequestDTO $request): MerchSurfaceView;
}
