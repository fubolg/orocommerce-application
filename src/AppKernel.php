<?php

/**
 * @codingStandardsIgnoreFile
 */

use Symfony\Component\Config\Loader\LoaderInterface;

use Oro\Bundle\DistributionBundle\OroKernel;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class AppKernel extends OroKernel
{
    public function registerBundles(): iterable
    {
        $bundles = array(
            // bundles
        );

        if ('dev' === $this->getEnvironment()) {
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Symfony\Bundle\DebugBundle\DebugBundle();
            if (class_exists('Oro\TwigInspector\Bundle\OroTwigInspectorBundle')) {
                $bundles[] = new Oro\TwigInspector\Bundle\OroTwigInspectorBundle();
            }
        }

        if ('test' === $this->getEnvironment()) {
            $bundles[] = new Nelmio\Alice\Bridge\Symfony\NelmioAliceBundle();
            $bundles[] = new Fidry\AliceDataFixtures\Bridge\Symfony\FidryAliceDataFixturesBundle();
            $bundles[] = new Oro\Bundle\TestFrameworkBundle\OroTestFrameworkBundle();
            $bundles[] = new Oro\Bundle\TestFrameworkCRMBundle\OroTestFrameworkCRMBundle();
            $bundles[] = new Oro\Bundle\FrontendTestFrameworkBundle\OroFrontendTestFrameworkBundle();
        }

        return array_merge(parent::registerBundles(), $bundles);
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(function (ContainerBuilder $container) {
            $container->setParameter('container.dumper.inline_class_loader', true);
            $container->addObjectResource($this);
        });

        $loader->load(__DIR__.'/../config/config_'.$this->getEnvironment().'.yml');
    }

    /**
     * {@inheritdoc}
     */
    public function getCacheDir()
    {
        return dirname(__DIR__).'/var/cache/'.$this->environment;
    }

    /**
     * {@inheritdoc}
     */
    public function getLogDir()
    {
        return dirname(__DIR__).'/var/logs';
    }
}
