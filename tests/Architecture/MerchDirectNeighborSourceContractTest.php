<?php

declare(strict_types=1);

namespace App\Merchandising\Tests\Architecture;

use App\Merchandising\ServiceInterface\Source\MerchCategorySourceInterface;
use App\Merchandising\ServiceInterface\Source\MerchDirectNeighborSourceInterface;
use App\Merchandising\ServiceInterface\Source\MerchProductSourceInterface;
use PHPUnit\Framework\TestCase;

final class MerchDirectNeighborSourceContractTest extends TestCase
{
    public function testTypedSourceContractsAreDirectNeighborContracts(): void
    {
        self::assertContains(MerchDirectNeighborSourceInterface::class, class_implements(MerchProductSourceInterface::class));
        self::assertContains(MerchDirectNeighborSourceInterface::class, class_implements(MerchCategorySourceInterface::class));
    }
}
