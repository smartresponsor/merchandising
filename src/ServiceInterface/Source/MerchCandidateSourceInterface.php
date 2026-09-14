<?php

declare(strict_types=1);

namespace App\Merchandising\ServiceInterface\Source;

use App\Merchandising\DTO\MerchSurfaceRequestDTO;
use App\Merchandising\ValueObject\MerchCandidateView;

/**
 * Generic source contract for display-safe candidates supplied by neighboring components.
 *
 * Implementations must not expose source Doctrine entities. They should return bridge-safe candidate view models that
 * already respect the source component visibility, publication, pricing, stock, security, locale, and segment rules.
 *
 * Canonical owner-side implementations should also implement MerchDirectNeighborSourceInterface, which exposes
 * a machine-readable contractView() for diagnostics and agent routing.
 */
interface MerchCandidateSourceInterface
{
    /**
     * Returns the stable source registration key.
     */
    public function sourceKey(): string;

    /**
     * Reports whether the source can provide candidates for the requested slot.
     */
    public function supportsSlot(string $slotKey): bool;

    /**
     * Provides source-owned, display-safe candidates for the requested merchandising slot and request context.
     *
     * @return list<MerchCandidateView>
     */
    public function provideCandidates(MerchSurfaceRequestDTO $request, string $slotKey, int $limit = 8): array;
}
