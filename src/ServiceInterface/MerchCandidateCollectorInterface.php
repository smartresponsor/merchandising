<?php

declare(strict_types=1);

namespace App\Merchandising\ServiceInterface;

use App\Merchandising\DTO\MerchRequestDTO;
use App\Merchandising\ValueObject\MerchCandidateView;

/**
 * Defines the MerchCandidateCollectorInterface contract and behavior within Merchandising.
 */
interface MerchCandidateCollectorInterface
{
    /**
     * @return list<MerchCandidateView>
     */
    public function collectForSlot(MerchRequestDTO $request, string $slotKey, int $limit = 8): array;
}
