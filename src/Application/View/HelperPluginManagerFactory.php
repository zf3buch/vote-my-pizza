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
use Zend\Form\View\HelperConfig as FormHelperConfig;
use Zend\ServiceManager\Config;
use Zend\View\HelperPluginManager;

/**
 * Class HelperPluginManagerFactory
 *
 * @package App\View
 */
class HelperPluginManagerFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return HelperPluginManager
     */
    public function __invoke(ContainerInterface $container)
    {
        $config = $container->has('config')
            ? $container->get('config')
            : [];
        $config = isset($config['view_helpers'])
            ? $config['view_helpers']
            : [];

        $manager = new HelperPluginManager(new Config($config));
        $manager->setServiceLocator($container);

        // Add zend-form view helper configuration:
        $formConfig = new FormHelperConfig();
        $formConfig->configureServiceManager($manager);

        return $manager;
    }
}