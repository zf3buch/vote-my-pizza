<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/vote-my-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace Application\I18n\Translator;

use Interop\Container\ContainerInterface;
use Zend\I18n\Translator\Translator;

/**
 * Class TranslatorFactory
 *
 * @package Application\I18n\Translator
 */
class TranslatorFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return Translator
     */
    public function __invoke(ContainerInterface $container)
    {
        $config = $container->get('config');

        $translator = Translator::factory($config['translate']);

        return $translator;
    }
}