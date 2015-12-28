<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/vote-my-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace Application\I18n\Observer;

use Interop\Container\ContainerInterface;
use Zend\I18n\Translator\Translator;

/**
 * Class SetLanguageObserverFactory
 *
 * @package Application\I18n\Observer
 */
class SetLanguageObserverFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return SetLanguageObserver
     */
    public function __invoke(ContainerInterface $container)
    {
        $translator = $container->get(Translator::class);

        return new SetLanguageObserver($translator);
    }
}
