<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/vote-my-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace Application;

use Zend\Config\Config;
use Zend\Config\Factory;

define('APPLICATION_ROOT', __DIR__ . '/..');

/**
 * Class ConfigProvider
 *
 * @package Application
 */
class ConfigProvider
{
    /**
     * Read configuration
     *
     * @return array|Config
     */
    public function __invoke()
    {
        return Factory::fromFile(
            APPLICATION_ROOT . '/config/module.config.php'
        );
    }
}