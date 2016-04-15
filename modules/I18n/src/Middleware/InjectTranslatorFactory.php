<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/vote-my-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace I18n\Middleware;

use Interop\Container\ContainerInterface;
use Zend\I18n\Translator\Translator;
use Zend\View\HelperPluginManager;

/**
 * Class InjectTranslatorFactory
 *
 * @package I18n\Middleware
 */
class InjectTranslatorFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return InjectTranslatorMiddleware
     */
    public function __invoke(ContainerInterface $container)
    {
        $translator          = $container->get(Translator::class);
        $helperPluginManager = $container->get(HelperPluginManager::class);

        return new InjectTranslatorMiddleware(
            $translator, $helperPluginManager
        );
    }
}