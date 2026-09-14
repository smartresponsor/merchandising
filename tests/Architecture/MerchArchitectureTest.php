<?php

declare(strict_types=1);

namespace App\Merchandising\Tests\Architecture;

use PHPUnit\Framework\TestCase;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

final class MerchArchitectureTest extends TestCase
{
    public function testDomainDirectoryIsNotUsed(): void
    {
        self::assertDirectoryDoesNotExist(dirname(__DIR__, 2) . '/src/Domain');
    }

    public function testDoctrineTablesUseMerchPrefix(): void
    {
        $root = dirname(__DIR__, 2) . '/src/Entity';
        $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($root));

        foreach ($files as $file) {
            if (!$file->isFile() || $file->getExtension() !== 'php') {
                continue;
            }

            $contents = (string) file_get_contents($file->getPathname());
            preg_match_all("/Table\(name: '([^']+)'\)/", $contents, $matches);

            foreach ($matches[1] as $tableName) {
                self::assertStringStartsWith('merch_', $tableName);
            }
        }
    }

    public function testComposerIdentityAndMandatoryDependenciesStayCanonical(): void
    {
        $composer = json_decode(
            (string) file_get_contents(dirname(__DIR__, 2) . '/composer.json'),
            true,
            flags: JSON_THROW_ON_ERROR,
        );

        self::assertSame('merchandising/merch', $composer['name']);
        self::assertSame('src/', $composer['autoload']['psr-4']['App\\Merchandising\\']);
        self::assertSame('dev', $composer['minimum-stability']);
        self::assertTrue($composer['prefer-stable']);

        $localPackages = [
            '../Collectioning' => 'collectioning/collection',
            '../Cruding' => 'cruding/crud',
            '../Interfacing' => 'interfacing/interface',
            '../Objecting' => 'objecting/object',
            '../Tabling' => 'tabling/table',
            '../Viewing' => 'viewing/view',
        ];

        foreach ($localPackages as $package) {
            self::assertSame('dev-master', $composer['require'][$package]);
        }

        $repositories = [];
        foreach ($composer['repositories'] as $repository) {
            $repositories[$repository['url']] = $repository;
        }

        foreach ($localPackages as $url => $package) {
            self::assertArrayHasKey($url, $repositories);
            self::assertTrue($repositories[$url]['options']['symlink']);
            self::assertSame('dev-master', $repositories[$url]['options']['versions'][$package]);
        }
    }
}
