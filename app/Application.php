<?php
use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Routing\RouteCollectionBuilder;

class Application extends Kernel
{
    use MicroKernelTrait;
    use KernelDirectoryStructureTrait;

    public function registerBundles()
    {
        $bundles = [
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle,
            new Symfony\Bundle\TwigBundle\TwigBundle,
            new Symfony\Bundle\MonologBundle\MonologBundle,
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle,
            new AppBundle\AppBundle,
        ];
        if ($this->isDebug()) {
            $bundles = array_merge($bundles, [
                new Symfony\Bundle\DebugBundle\DebugBundle,
                new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle,
            ]);
        }
        return $bundles;
    }

    protected function configureContainer(ContainerBuilder $container, LoaderInterface $loader)
    {
        $loader->load($this->getRootDir() . '/app/config.yml');
    }

    protected function configureRoutes(RouteCollectionBuilder $routes)
    {
        if ($this->isDebug()) {
            $routes->mount('/_wdt', $routes->import('@WebProfilerBundle/Resources/config/routing/wdt.xml'));
            $routes->mount('/_profiler', $routes->import('@WebProfilerBundle/Resources/config/routing/profiler.xml'));
        }
        $routes->add('/', 'AppBundle:Default:index');
    }
}
