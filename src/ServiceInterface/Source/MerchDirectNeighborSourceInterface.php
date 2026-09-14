<?php

declare(strict_types=1);

namespace App\Merchandising\ServiceInterface\Source;

use App\Merchandising\ValueObject\MerchSourceContractView;

/**
 * Marker for direct owner-side source implementations.
 *
 * Implement this interface in the component that owns the source data, for example:
 * Producting\Service\Merchandising\ProductingMerchandisingProductSource.
 *
 * This is not a general data bridge and not a UI bridge. It is a direct, explicit source contract implementation for
 * display-safe Merchandising candidates.
 */
interface MerchDirectNeighborSourceInterface extends MerchCandidateSourceInterface
{
    /**
     * Returns the machine-readable direct-neighbor source contract.
     */
    public function contractView(): MerchSourceContractView;
}
