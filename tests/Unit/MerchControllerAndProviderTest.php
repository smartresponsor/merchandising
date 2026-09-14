<?php

declare(strict_types=1);

namespace App\Merchandising\Tests\Unit;

use App\Merchandising\Controller\MerchSurfaceController;
use App\Merchandising\DTO\MerchSurfaceRequestDTO;
use App\Merchandising\Provider\MerchSurfaceProvider;
use App\Merchandising\ProviderInterface\MerchInterfacingPayloadProviderInterface;
use App\Merchandising\Service\MerchCandidateCollector;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;

final class MerchControllerAndProviderTest extends TestCase
{
    public function testSurfaceProviderRejectsUnknownSurface(): void
    {
        $provider = new MerchSurfaceProvider(new MerchCandidateCollector([]));

        $this->expectException(\InvalidArgumentException::class);
        $provider->provideSurface('unknown', new MerchSurfaceRequestDTO());
    }

    public function testControllerMapsRequestContextIntoPayloadProvider(): void
    {
        $payloadProvider = new class () implements MerchInterfacingPayloadProviderInterface {
            public ?MerchSurfaceRequestDTO $request = null;

            public function provideInterfacingPayload(string $surfaceKey, MerchSurfaceRequestDTO $request): array
            {
                $this->request = $request;

                return ['surfaceKey' => $surfaceKey, 'locale' => $request->locale];
            }
        };
        $controller = new MerchSurfaceController($payloadProvider);
        $request = Request::create('/merchandising/surface/home?user=vendor-1&preview=1');
        $request->setLocale('en_US');

        $response = $controller->payload($request, 'home');

        self::assertSame(200, $response->getStatusCode());
        self::assertSame(
            ['surfaceKey' => 'home', 'locale' => 'en_US'],
            json_decode((string) $response->getContent(), true, flags: JSON_THROW_ON_ERROR),
        );
        self::assertInstanceOf(MerchSurfaceRequestDTO::class, $payloadProvider->request);
        self::assertSame('vendor-1', $payloadProvider->request->userKey);
        self::assertSame('web', $payloadProvider->request->channel);
        self::assertSame('/merchandising/surface/home', $payloadProvider->request->context['route']);
        self::assertTrue($payloadProvider->request->context['preview']);
    }
}
