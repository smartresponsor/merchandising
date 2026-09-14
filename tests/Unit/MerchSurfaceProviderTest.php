<?php

declare(strict_types=1);

namespace App\Merchandising\Tests\Unit;

use App\Merchandising\DTO\MerchSurfaceRequestDTO;
use App\Merchandising\Provider\MerchSurfaceProvider;
use App\Merchandising\Service\MerchCandidateCollector;
use PHPUnit\Framework\TestCase;

final class MerchSurfaceProviderTest extends TestCase
{
    public function testItProvidesBridgeReadySurfaceFromSourceContracts(): void
    {
        $collector = new MerchCandidateCollector([]);

        $surface = (new MerchSurfaceProvider($collector))->provideSurface('home', new MerchSurfaceRequestDTO());

        self::assertSame('home', $surface->key);
        self::assertSame('storefront_home', $surface->surfaceType);
        self::assertNotEmpty($surface->sections);
        self::assertSame('merchandising.surface.v1', $surface->metadata['contract']);
        self::assertSame('neighbor-source-contracts', $surface->metadata['candidateFlow']);
        self::assertSame('forbidden', $surface->metadata['directNeighborDatabaseReads']);
    }
}
