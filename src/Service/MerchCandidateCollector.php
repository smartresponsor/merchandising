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
        if ($limit < 1) {
            throw new \InvalidArgumentException('Merchandising candidate limit must be greater than zero.');
        }

        /** @var array<string, MerchCandidateView> $candidatesByIdentity */
        $candidatesByIdentity = [];

        foreach ($this->sources as $source) {
            if (!$source->supportsSlot($slotKey)) {
                continue;
            }

            foreach ($source->provideCandidates($request, $slotKey, $limit) as $candidate) {
                if (!$candidate->displaySafe) {
                    continue;
                }

                $identity = self::candidateIdentity($candidate);
                $current = $candidatesByIdentity[$identity] ?? null;

                if (null === $current || self::compareCandidates($candidate, $current) < 0) {
                    $candidatesByIdentity[$identity] = $candidate;
                }
            }
        }

        $candidates = array_values($candidatesByIdentity);
        usort($candidates, self::compareCandidates(...));

        return array_slice($candidates, 0, $limit);
    }

    /**
     * Returns the source-owned identity used to suppress duplicate candidates supplied through overlapping registrations.
     */
    private static function candidateIdentity(MerchCandidateView $candidate): string
    {
        return $candidate->sourceComponent . "\\0" . $candidate->sourceType . "\\0" . $candidate->sourceId;
    }

    /**
     * Orders candidates by business priority and stable source identity so output does not depend on service registration order.
     */
    private static function compareCandidates(MerchCandidateView $left, MerchCandidateView $right): int
    {
        return [
            $left->priority,
            $left->sourceComponent,
            $left->sourceType,
            $left->sourceId,
            $left->key,
            self::candidateFingerprint($left),
        ] <=> [
            $right->priority,
            $right->sourceComponent,
            $right->sourceType,
            $right->sourceId,
            $right->key,
            self::candidateFingerprint($right),
        ];
    }

    /**
     * Returns a stable full-contract fingerprint used only to resolve otherwise identical ranking ties.
     */
    private static function candidateFingerprint(MerchCandidateView $candidate): string
    {
        return json_encode(
            $candidate->toArray(),
            JSON_THROW_ON_ERROR | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE,
        );
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
