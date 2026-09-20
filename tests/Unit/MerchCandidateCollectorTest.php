<?php

declare(strict_types=1);

namespace App\Merchandising\Tests\Unit;

use App\Merchandising\DTO\MerchRequestDTO;
use App\Merchandising\Service\MerchCandidateCollector;
use App\Merchandising\ServiceInterface\Source\MerchCandidateSourceInterface;
use App\Merchandising\ServiceInterface\Source\MerchDirectNeighborSourceInterface;
use App\Merchandising\ValueObject\MerchCandidateView;
use App\Merchandising\ValueObject\MerchSourceContractView;
use PHPUnit\Framework\TestCase;

final class MerchCandidateCollectorTest extends TestCase
{
    public function testCollectorFiltersUnsafeCandidatesSortsAndLimitsResults(): void
    {
        $request = new MerchRequestDTO(locale: 'en');
        $source = new class () implements MerchCandidateSourceInterface {
            public function sourceKey(): string
            {
                return 'products';
            }

            public function supportsSlot(string $slotKey): bool
            {
                return 'top_products' === $slotKey;
            }

            public function provideCandidates(MerchRequestDTO $request, string $slotKey, int $limit = 8): array
            {
                return [
                    new MerchCandidateView('producting', 'product', '3', 'three', 'Three', '', 'product', priority: 30),
                    new MerchCandidateView('producting', 'product', '1', 'one', 'One', '', 'product', priority: 10),
                    new MerchCandidateView('producting', 'product', '2', 'two', 'Two', '', 'product', priority: 20, displaySafe: false),
                ];
            }
        };

        $unsupported = new class () implements MerchCandidateSourceInterface {
            public function sourceKey(): string
            {
                return 'unsupported';
            }

            public function supportsSlot(string $slotKey): bool
            {
                return false;
            }

            public function provideCandidates(MerchRequestDTO $request, string $slotKey, int $limit = 8): array
            {
                throw new \LogicException('Unsupported sources must not be invoked.');
            }
        };

        $collector = new MerchCandidateCollector([$source, $unsupported]);

        $result = $collector->collectForSlot($request, 'top_products', 1);

        self::assertCount(1, $result);
        self::assertSame('one', $result[0]->key);
        self::assertSame([], $collector->collectForSlot($request, 'unknown'));
    }

    public function testRegisteredSourcesExposeOnlyDirectNeighborContracts(): void
    {
        $direct = new class () implements MerchDirectNeighborSourceInterface {
            public function sourceKey(): string
            {
                return 'catalog';
            }

            public function supportsSlot(string $slotKey): bool
            {
                return true;
            }

            public function provideCandidates(MerchRequestDTO $request, string $slotKey, int $limit = 8): array
            {
                return [];
            }

            public function contractView(): MerchSourceContractView
            {
                return new MerchSourceContractView('catalog', 'cataloging', 'category', 'Cataloging', self::class);
            }
        };
        $plain = new class () implements MerchCandidateSourceInterface {
            public function sourceKey(): string
            {
                return 'plain';
            }

            public function supportsSlot(string $slotKey): bool
            {
                return true;
            }

            public function provideCandidates(MerchRequestDTO $request, string $slotKey, int $limit = 8): array
            {
                return [];
            }
        };

        $contracts = (new MerchCandidateCollector([$direct, $plain]))->registeredSources();

        self::assertCount(1, $contracts);
        self::assertSame('catalog', $contracts[0]->sourceKey);
    }

    public function testCollectorRejectsNonPositiveLimit(): void
    {
        $collector = new MerchCandidateCollector([]);

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Merchandising candidate limit must be greater than zero.');

        $collector->collectForSlot(new MerchRequestDTO(), 'top_products', 0);
    }

    public function testCollectorDeduplicatesOwnerIdentityAndUsesDeterministicOrdering(): void
    {
        $first = new class () implements MerchCandidateSourceInterface {
            public function sourceKey(): string
            {
                return 'first';
            }

            public function supportsSlot(string $slotKey): bool
            {
                return true;
            }

            public function provideCandidates(MerchRequestDTO $request, string $slotKey, int $limit = 8): array
            {
                return [
                    new MerchCandidateView('producting', 'product', '2', 'z-key', 'Second', '', 'product', priority: 10),
                    new MerchCandidateView('producting', 'product', '1', 'old-key', 'Duplicate old', '', 'product', priority: 30),
                ];
            }
        };
        $second = new class () implements MerchCandidateSourceInterface {
            public function sourceKey(): string
            {
                return 'second';
            }

            public function supportsSlot(string $slotKey): bool
            {
                return true;
            }

            public function provideCandidates(MerchRequestDTO $request, string $slotKey, int $limit = 8): array
            {
                return [
                    new MerchCandidateView('producting', 'product', '1', 'best-key', 'Duplicate best', '', 'product', priority: 5),
                    new MerchCandidateView('cataloging', 'category', '1', 'a-key', 'First', '', 'category', priority: 10),
                ];
            }
        };

        $result = (new MerchCandidateCollector([$first, $second]))
            ->collectForSlot(new MerchRequestDTO(), 'top_products', 8);

        self::assertCount(3, $result);
        self::assertSame(['best-key', 'a-key', 'z-key'], array_map(
            static fn (MerchCandidateView $candidate): string => $candidate->key,
            $result,
        ));
        self::assertSame('Duplicate best', $result[0]->title);
    }
}
