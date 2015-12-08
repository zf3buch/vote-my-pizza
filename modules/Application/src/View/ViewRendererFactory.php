<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/vote-my-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace Application\View;

use Interop\Container\ContainerInterface;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\ZendView\ServerUrlHelper;
use Zend\Expressive\ZendView\UrlHelper;
use Zend\Expressive\ZendView\ZendViewRenderer;
use Zend\Expressive\ZendView\ZendViewRendererFactory;
use Zend\View\HelperPluginManager;
use Zend\View\Renderer\PhpRenderer;
use Zend\View\Resolver;

/**
 * Class ViewRendererFactory
 *
 * @package Application\View
 */
class ViewRendererFactory
{
    /**
     * @param ContainerInterface $container
     * @returns ZendViewRenderer
     */
    public function __invoke(ContainerInterface $container)
    {
        $config   = $container->has('config') ? $container->get('config') : [];
        $config   = isset($config['templates']) ? $config['templates'] : [];

        // Configuration
        $resolver = new Resolver\AggregateResolver();
        $resolver->attach(
            new Resolver\TemplateMapResolver(isset($config['map']) ? $config['map'] : []),
            100
        );

        // Create the renderer
        $renderer = new PhpRenderer();
        $renderer->setResolver($resolver);

        // Inject helpers
        $this->injectHelpers($renderer, $container);

        // Inject renderer
        $view = new ZendViewRenderer($renderer, isset($config['layout']) ? $config['layout'] : null);

        // Add template paths
        $allPaths = isset($config['paths']) && is_array($config['paths']) ? $config['paths'] : [];
        foreach ($allPaths as $namespace => $paths) {
            $namespace = is_numeric($namespace) ? null : $namespace;
            foreach ((array) $paths as $path) {
                $view->addPath($path, $namespace);
            }
        }

        return $view;
    }

    /**
     * Inject helpers into the PhpRenderer instance.
     *
     * If a HelperPluginManager instance is present in the container, uses that;
     * otherwise, instantiates one.
     *
     * In each case, injects with the custom url/serverurl implementations.
     *
     * @param PhpRenderer $renderer
     * @param ContainerInterface $container
     */
    private function injectHelpers(PhpRenderer $renderer, ContainerInterface $container)
    {
        $helpers = $container->has(HelperPluginManager::class)
            ? $container->get(HelperPluginManager::class)
            : new HelperPluginManager();

        $helpers->setFactory('url', function () use ($container) {
            return new UrlHelper($container->get(RouterInterface::class));
        });
        $helpers->setInvokableClass('serverurl', ServerUrlHelper::class);

        $renderer->setHelperPluginManager($helpers);
    }
}