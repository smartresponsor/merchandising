<?php

declare(strict_types=1);

use App\Merchandising\Controller\MerchSurfaceController;
use App\Merchandising\Service\MerchCandidateCollector;
use App\Merchandising\Provider\MerchInterfacingPayloadProvider;
use App\Merchandising\Provider\MerchSurfaceProvider;
use App\Merchandising\ServiceInterface\MerchCandidateCollectorInterface;
use App\Merchandising\ProviderInterface\MerchInterfacingPayloadProviderInterface;
use App\Merchandising\ProviderInterface\MerchSurfaceProviderInterface;
use App\Merchandising\ServiceInterface\MerchSourceTopologyProviderInterface;
use App\Merchandising\ServiceInterface\Source\MerchCandidateSourceInterface;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use function Symfony\Component\DependencyInjection\Loader\Configurator\tagged_iterator;

return static function (ContainerConfigurator $container): void {
    $services = $container->services()
        ->defaults()
        ->autowire()
        ->autoconfigure();

    $services->instanceof(MerchCandidateSourceInterface::class)
        ->tag('app.merchandising.candidate_source')
        ->tag('app.merchandising.direct_neighbor_source');

    $services->load('App\\Merchandising\\', '../src/')
        ->exclude('../src/{DTO,DependencyInjection,Entity,Enum,ValueObject,MerchBundle.php}');

    $services->set(MerchCandidateCollector::class)
        ->arg('$sources', tagged_iterator('app.merchandising.candidate_source'));
    $services->alias(MerchCandidateCollectorInterface::class, MerchCandidateCollector::class);
    $services->alias(MerchSourceTopologyProviderInterface::class, MerchCandidateCollector::class);

    $services->set(MerchSurfaceProvider::class);
    $services->alias(MerchSurfaceProviderInterface::class, MerchSurfaceProvider::class);

    $services->set(MerchInterfacingPayloadProvider::class);
    $services->alias(MerchInterfacingPayloadProviderInterface::class, MerchInterfacingPayloadProvider::class);

    $services->set(MerchSurfaceController::class)
        ->tag('controller.service_arguments');
};
