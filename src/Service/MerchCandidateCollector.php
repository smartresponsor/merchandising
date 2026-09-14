<?php

declare(strict_types=1);

namespace App\Merchandising\Service;

use App\Merchandising\DTO\MerchRequestDTO;
use App\Merchandising\ServiceInterface\MerchCandidateCollectorInterface;
use App\Merchandising\ServiceInterface\MerchSourceTopologyProviderInterface;
use App\Merchandising\ServiceInterface\Source\MerchCandidateSourceInterface;
use App\Merchandising\ServiceInterface\Source\MerchDirectNeighborSourceInterface;
use App\Merchandising\ValueObject\MerchCandidateView;

/**
 * Defines the MerchCandidateCollector contract and behavior within Merchandising.
 */
final readonly class MerchCandidateCollector implements MerchCandidateCollectorInterface, MerchSourceTopologyProviderInterface
{
    /**
     * @param iterable<MerchCandidateSourceInterface> $sources
     */
    public function __construct(
        private iterable $sources,
    ) {
    }

    /**
     * Collects display-safe candidates for one slot, orders them by merchandising priority, and enforces the requested limit.
     *
     * @return list<MerchCandidateView>
     */
    public function collectForSlot(MerchRequestDTO $request, string $slotKey, int $limit = 8): array
    {
        $candidates = [];

        foreach ($this->sources as $source) {
            if (!$source->supportsSlot($slotKey)) {
                continue;
            }

            foreach ($source->provideCandidates($request, $slotKey, $limit) as $candidate) {
                if ($candidate->displaySafe) {
                    $candidates[] = $candidate;
                }
            }
        }

        usort(
            $candidates,
            static fn (MerchCandidateView $left, MerchCandidateView $right): int => $left->priority <=> $right->priority,
        );

        return array_slice($candidates, 0, $limit);
    }

    /**
     * Returns registered direct-neighbor source contracts.
     */
    public function registeredSources(): array
    {
        $contracts = [];

        foreach ($this->sources as $source) {
            if ($source instanceof MerchDirectNeighborSourceInterface) {
                $contracts[] = $source->contractView();
            }
        }

        return $contracts;
    }

}
