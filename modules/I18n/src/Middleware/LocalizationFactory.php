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

/**
 * Class LocalizationFactory
 *
 * @package I18n\Middleware
 */
class LocalizationFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return LocalizationMiddleware
     */
    public function __invoke(ContainerInterface $container)
    {
        $translator = $container->get(Translator::class);

        return new LocalizationMiddleware($translator);
    }
}
