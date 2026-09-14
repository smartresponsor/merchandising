<?php

declare(strict_types=1);

namespace App\Merchandising\Provider;

use App\Merchandising\DTO\MerchRequestDTO;
use App\Merchandising\ProviderInterface\MerchProviderInterface;
use App\Merchandising\ServiceInterface\MerchCandidateCollectorInterface;
use App\Merchandising\ValueObject\MerchCandidateView;
use App\Merchandising\ValueObject\MerchItemView;
use App\Merchandising\ValueObject\MerchSectionView;
use App\Merchandising\ValueObject\MerchView;

/**
 * Defines the MerchProvider contract and behavior within Merchandising.
 */
final readonly class MerchProvider implements MerchProviderInterface
{
    /**
     * Initializes the MerchProvider.
     */
    public function __construct(
        private MerchCandidateCollectorInterface $candidateCollector,
    ) {
    }

    /**
     * Builds a merchandising surface from registered candidate sources.
     */
    public function provide(string $merchKey, MerchRequestDTO $request): MerchView
    {
        if ('home' !== $merchKey) {
            throw new \InvalidArgumentException(sprintf('Unsupported merchandising surface "%s".', $merchKey));
        }

        return new MerchView(
            key: $merchKey,
            title: 'Storefront home',
            type: 'storefront_home',
            summary: 'Storefront composition assembled from owner-provided merchandising candidates.',
            sections: [
                $this->section($request, 'hero', 'Smart storefront', 'hero', 10, 'Primary storefront attention slot for campaigns, discovery, and conversion.'),
                $this->section($request, 'featured_categories', 'Featured categories', 'category_grid', 20),
                $this->section($request, 'top_products', 'Top products', 'product_strip', 30),
                $this->section($request, 'discount_products', 'Discount products', 'product_strip', 35),
                $this->section($request, 'recommended_projects', 'Recommended projects', 'project_strip', 40),
                $this->section($request, 'vendor_highlights', 'Vendor highlights', 'vendor_strip', 50),
            ],
            actions: [],
            metadata: [
                'component' => 'merchandising',
                'contract' => 'merchandising.output.v1',
                'candidateFlow' => 'neighbor-source-contracts',
                'directNeighborDatabaseReads' => 'forbidden',
                'renderTarget' => 'interfacing',
            ],
        );
    }

    /**
     * Builds one merchandising section for the requested slot.
     */
    private function section(
        MerchRequestDTO $request,
        string $slotKey,
        string $title,
        string $type,
        int $priority,
        ?string $summary = null,
    ): MerchSectionView {
        $candidates = $this->candidateCollector->collectForSlot($request, $slotKey, 8);

        return new MerchSectionView(
            key: $slotKey,
            title: $title,
            type: $type,
            priority: $priority,
            items: array_map(static fn (MerchCandidateView $candidate): MerchItemView => $candidate->toItemView(), $candidates),
            summary: $summary,
            metadata: [
                'candidateCount' => count($candidates),
                'candidateFlow' => 'source-contract',
            ],
        );
    }
}
