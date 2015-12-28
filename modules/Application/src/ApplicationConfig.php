<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/vote-my-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace Application;

use Zend\Config\Factory;

define('APPLICATION_ROOT', __DIR__ . '/..');

/**
 * Class ApplicationConfig
 *
 * @package Application
 */
class ApplicationConfig
{
    /**
     * Read configuration
     *
     * @return array|\Zend\Config\Config
     */
    public function __invoke()
    {
        return Factory::fromFile(
            APPLICATION_ROOT . '/config/application.config.php'
        );
    }
}
