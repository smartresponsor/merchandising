<?php

declare(strict_types=1);

namespace App\Merchandising\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\PhpFileLoader;

/**
 * Defines the MerchExtension contract and behavior within Merchandising.
 */
final class MerchExtension extends Extension
{
    /**
     * Loads Merchandising service definitions into the Symfony container.
     */
    public function load(array $configs, ContainerBuilder $container): void
    {
        $loader = new PhpFileLoader($container, new FileLocator(__DIR__ . '/../../config'));
        $loader->load('services.php');
    }
}
