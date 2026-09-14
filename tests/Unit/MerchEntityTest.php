<?php

declare(strict_types=1);

namespace App\Merchandising\Tests\Unit;

use App\Merchandising\Entity\MerchPlacementEntity;
use App\Merchandising\Entity\MerchSectionEntity;
use App\Merchandising\Entity\MerchSurfaceEntity;
use PHPUnit\Framework\TestCase;

final class MerchEntityTest extends TestCase
{
    public function testEntitiesExposeTheirBusinessFields(): void
    {
        $surface = (new MerchSurfaceEntity())
            ->setSurfaceKey('home')
            ->setTitle('Home')
            ->setSurfaceType('storefront_home')
            ->setStatus('active');
        self::assertNull($surface->getId());
        self::assertSame('home', $surface->getSurfaceKey());
        self::assertSame('Home', $surface->getTitle());
        self::assertSame('storefront_home', $surface->getSurfaceType());
        self::assertSame('active', $surface->getStatus());

        $section = (new MerchSectionEntity())
            ->setSectionKey('top_products')
            ->setTitle('Top products')
            ->setSectionType('product_strip')
            ->setPriority(20);
        self::assertNull($section->getId());
        self::assertSame('top_products', $section->getSectionKey());
        self::assertSame('Top products', $section->getTitle());
        self::assertSame('product_strip', $section->getSectionType());
        self::assertSame(20, $section->getPriority());

        $placement = (new MerchPlacementEntity())
            ->setPlacementKey('hero-1')
            ->setSourceType('product')
            ->setSourceReference('42')
            ->setPriority(5);
        self::assertNull($placement->getId());
        self::assertSame('hero-1', $placement->getPlacementKey());
        self::assertSame('product', $placement->getSourceType());
        self::assertSame('42', $placement->getSourceReference());
        self::assertSame(5, $placement->getPriority());
        self::assertNull($placement->setSourceReference(null)->getSourceReference());
    }
}
