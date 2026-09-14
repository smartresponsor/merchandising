<?php

declare(strict_types=1);

namespace App\Merchandising;

use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\HttpKernel\Bundle\BundleInterface;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;

/**
 * Defines the Kernel contract and behavior within Merchandising.
 */
final class Kernel extends BaseKernel
{
    use MicroKernelTrait;

    /**
     * Executes the register bundles operation.
     */
    public function registerBundles(): iterable
    {
        $contents = require $this->getProjectDir() . '/config/bundles.php';

        foreach ($contents as $class => $envs) {
            if ($envs['all'] ?? $envs[$this->environment] ?? false) {
                if (!is_string($class) || !is_a($class, BundleInterface::class, true)) {
                    throw new \LogicException('Standalone bundle registration must reference a Symfony BundleInterface implementation.');
                }

                yield new $class();
            }
        }
    }
}
