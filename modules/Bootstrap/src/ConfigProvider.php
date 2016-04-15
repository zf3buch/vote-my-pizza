<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/vote-my-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace Bootstrap;

use Zend\Config\Factory;

define('BOOTSTRAP_ROOT', __DIR__ . '/..');

/**
 * Class ConfigProvider
 *
 * @package Bootstrap
 */
class ConfigProvider
{
    /**
     * Read configuration
     *
     * @return array|\Zend\Config\Config
     */
    public function __invoke()
    {
        return Factory::fromFile(
            BOOTSTRAP_ROOT . '/config/module.config.php'
        );
    }
}
