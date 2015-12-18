<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/vote-my-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace Application\I18n;

use Interop\Container\ContainerInterface;
use Zend\I18n\Translator\Translator;
use Zend\View\HelperPluginManager;

/**
 * Class InjectTranslatorMiddlewareFactory
 *
 * @package Application\I18n
 */
class InjectTranslatorMiddlewareFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return InjectTranslatorMiddleware
     */
    public function __invoke(ContainerInterface $container)
    {
        $helperPluginManager = $container->get(HelperPluginManager::class);

        $translator      = $container->get(Translator::class);
        $translateHelper = $helperPluginManager->get('translate');

        return new InjectTranslatorMiddleware(
            $translator, $translateHelper
        );
    }
}
