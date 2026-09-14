<?php

declare(strict_types=1);

use App\Merchandising\Controller\MerchController;
use App\Merchandising\Service\MerchCandidateCollector;
use App\Merchandising\Provider\MerchInterfacingPayloadProvider;
use App\Merchandising\Provider\MerchProvider;
use App\Merchandising\ServiceInterface\MerchCandidateCollectorInterface;
use App\Merchandising\ProviderInterface\MerchInterfacingPayloadProviderInterface;
use App\Merchandising\ProviderInterface\MerchProviderInterface;
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

    $services->set(MerchProvider::class);
    $services->alias(MerchProviderInterface::class, MerchProvider::class);

    $services->set(MerchInterfacingPayloadProvider::class);
    $services->alias(MerchInterfacingPayloadProviderInterface::class, MerchInterfacingPayloadProvider::class);

    $services->set(MerchController::class)
        ->tag('controller.service_arguments');
};
