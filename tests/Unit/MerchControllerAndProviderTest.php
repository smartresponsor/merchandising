<?php

declare(strict_types=1);

namespace App\Merchandising\Tests\Unit;

use App\Merchandising\Controller\MerchController;
use App\Merchandising\DTO\MerchRequestDTO;
use App\Merchandising\Provider\MerchProvider;
use App\Merchandising\ProviderInterface\MerchInterfacingPayloadProviderInterface;
use App\Merchandising\Service\MerchCandidateCollector;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;

final class MerchControllerAndProviderTest extends TestCase
{
    public function testProviderRejectsUnknownComposition(): void
    {
        $provider = new MerchProvider(new MerchCandidateCollector([]));

        $this->expectException(\InvalidArgumentException::class);
        $provider->provide('unknown', new MerchRequestDTO());
    }

    public function testControllerMapsRequestContextIntoPayloadProvider(): void
    {
        $payloadProvider = new class () implements MerchInterfacingPayloadProviderInterface {
            public ?MerchRequestDTO $request = null;

            public function provideInterfacingPayload(string $merchKey, MerchRequestDTO $request): array
            {
                $this->request = $request;

                return ['merchKey' => $merchKey, 'locale' => $request->locale];
            }
        };
        $controller = new MerchController($payloadProvider);
        $request = Request::create('/merchandising/home?user=vendor-1&preview=1');
        $request->setLocale('en_US');

        $response = $controller->payload($request, 'home');

        self::assertSame(200, $response->getStatusCode());
        self::assertSame(
            ['merchKey' => 'home', 'locale' => 'en_US'],
            json_decode((string) $response->getContent(), true, flags: JSON_THROW_ON_ERROR),
        );
        self::assertInstanceOf(MerchRequestDTO::class, $payloadProvider->request);
        self::assertSame('vendor-1', $payloadProvider->request->userKey);
        self::assertSame('web', $payloadProvider->request->channel);
        self::assertSame('/merchandising/home', $payloadProvider->request->context['route']);
        self::assertTrue($payloadProvider->request->context['preview']);
    }
}
