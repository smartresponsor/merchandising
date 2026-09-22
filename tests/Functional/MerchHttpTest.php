<?php

declare(strict_types=1);

namespace App\Merchandising\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Verifies the standalone HTTP composition surface through the real Symfony kernel.
 */
final class MerchHttpTest extends WebTestCase
{
    public function testMerchandisingPayloadRespondsWithJson(): void
    {
        $client = self::createClient();
        $client->request('GET', '/merchandising/home');

        self::assertResponseIsSuccessful();
        self::assertResponseHeaderSame('content-type', 'application/json');
    }
}
