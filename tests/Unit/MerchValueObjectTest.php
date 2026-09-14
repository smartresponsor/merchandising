<?php

declare(strict_types=1);

namespace App\Merchandising\Tests\Unit;

use App\Merchandising\ValueObject\MerchActionView;
use App\Merchandising\ValueObject\MerchCandidateView;
use App\Merchandising\ValueObject\MerchSectionView;
use App\Merchandising\ValueObject\MerchSourceContractView;
use App\Merchandising\ValueObject\MerchSurfaceView;
use PHPUnit\Framework\TestCase;

final class MerchValueObjectTest extends TestCase
{
    public function testCandidateAndSurfaceSerializationPreserveContractData(): void
    {
        $action = new MerchActionView('Open', '/item/1');
        $candidate = new MerchCandidateView(
            sourceComponent: 'producting',
            sourceType: 'product',
            sourceId: '1',
            key: 'product-1',
            title: 'Product 1',
            summary: 'Summary',
            kind: 'product',
            href: '/product/1',
            eyebrow: 'Featured',
            image: '/image.jpg',
            price: '$10',
            oldPrice: '$12',
            badge: 'Sale',
            tags: ['featured'],
            actions: [$action],
            priority: 5,
            metadata: ['stock' => 3],
        );

        $candidateArray = $candidate->toArray();
        self::assertSame('producting', $candidateArray['sourceComponent']);
        self::assertSame([['label' => 'Open', 'href' => '/item/1', 'kind' => 'link']], $candidateArray['actions']);
        self::assertSame(5, $candidateArray['priority']);

        $item = $candidate->toItemView();
        self::assertSame('product-1', $item->key);
        self::assertSame('producting', $item->metadata['sourceComponent']);
        self::assertSame(3, $item->metadata['stock']);

        $section = new MerchSectionView(
            key: 'featured',
            title: 'Featured',
            type: 'product_strip',
            priority: 10,
            items: [$item],
            actions: [$action],
            metadata: ['slot' => 'featured'],
        );
        $surface = new MerchSurfaceView(
            key: 'home',
            title: 'Home',
            surfaceType: 'storefront_home',
            sections: [$section],
            actions: [$action],
            metadata: ['contract' => 'merchandising.surface.v1'],
        );

        $surfaceArray = $surface->toArray();
        self::assertSame('home', $surfaceArray['key']);
        self::assertSame('featured', $surfaceArray['sections'][0]['key']);
        self::assertSame('product-1', $surfaceArray['sections'][0]['items'][0]['key']);
        self::assertSame('/item/1', $surfaceArray['actions'][0]['href']);
    }

    public function testSourceContractSerializationIsStable(): void
    {
        $contract = new MerchSourceContractView(
            sourceKey: 'product',
            sourceComponent: 'producting',
            sourceType: 'product',
            ownerComponent: 'Producting',
            implementationClass: 'ProductSource',
            providedSlots: ['top_products'],
            metadata: ['version' => 1],
        );

        self::assertSame([
            'sourceKey' => 'product',
            'sourceComponent' => 'producting',
            'sourceType' => 'product',
            'ownerComponent' => 'Producting',
            'implementationClass' => 'ProductSource',
            'providedSlots' => ['top_products'],
            'ownerSide' => true,
            'metadata' => ['version' => 1],
        ], $contract->toArray());
    }
}
