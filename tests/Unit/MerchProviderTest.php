<?php

declare(strict_types=1);

namespace App\Merchandising\Tests\Unit;

use App\Merchandising\DTO\MerchRequestDTO;
use App\Merchandising\Provider\MerchProvider;
use App\Merchandising\Service\MerchCandidateCollector;
use PHPUnit\Framework\TestCase;

final class MerchProviderTest extends TestCase
{
    public function testItProvidesBridgeReadyCompositionFromSourceContracts(): void
    {
        $collector = new MerchCandidateCollector([]);

        $merch = (new MerchProvider($collector))->provide('home', new MerchRequestDTO());

        self::assertSame('home', $merch->key);
        self::assertSame('storefront_home', $merch->type);
        self::assertNotEmpty($merch->sections);
        self::assertSame('merchandising.output.v1', $merch->metadata['contract']);
        self::assertSame('neighbor-source-contracts', $merch->metadata['candidateFlow']);
        self::assertSame('forbidden', $merch->metadata['directNeighborDatabaseReads']);
    }
}
