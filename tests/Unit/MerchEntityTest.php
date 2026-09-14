<?php

declare(strict_types=1);

namespace App\Merchandising\Tests\Unit;

use App\Merchandising\Entity\MerchEntity;
use App\Merchandising\Entity\MerchPlacementEntity;
use App\Merchandising\Entity\MerchSectionEntity;
use PHPUnit\Framework\TestCase;

final class MerchEntityTest extends TestCase
{
    public function testEntitiesExposeTheirBusinessFields(): void
    {
        $merch = (new MerchEntity())
            ->setMerchKey('home')
            ->setTitle('Home')
            ->setType('storefront_home')
            ->setStatus('active');
        self::assertNull($merch->getId());
        self::assertSame('home', $merch->getMerchKey());
        self::assertSame('Home', $merch->getTitle());
        self::assertSame('storefront_home', $merch->getType());
        self::assertSame('active', $merch->getStatus());

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
