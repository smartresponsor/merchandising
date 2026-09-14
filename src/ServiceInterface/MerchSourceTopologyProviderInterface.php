<?php

declare(strict_types=1);

namespace App\Merchandising\ServiceInterface;

use App\Merchandising\ValueObject\MerchSourceContractView;

/**
 * Defines the MerchSourceTopologyProviderInterface contract and behavior within Merchandising.
 */
interface MerchSourceTopologyProviderInterface
{
    /**
     * @return list<MerchSourceContractView>
     */
    public function registeredSources(): array;
}
