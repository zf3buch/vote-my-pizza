<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/vote-my-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace User;

use Zend\Config\Factory;

/**
 * Class UserConfig
 *
 * @package User
 */
class UserConfig
{
    /**
     * Root path for pizza module
     */
    const ROOT = __DIR__ . '/..';

    /**
     * Read configuration
     *
     * @return array|\Zend\Config\Config
     */
    public function __invoke()
    {
        return Factory::fromFile(self::ROOT . '/config/user.config.php');
    }
}
