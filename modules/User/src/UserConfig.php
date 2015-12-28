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

define('USER_ROOT', __DIR__ . '/..');

/**
 * Class UserConfig
 *
 * @package User
 */
class UserConfig
{
    /**
     * Read configuration
     *
     * @return array|\Zend\Config\Config
     */
    public function __invoke()
    {
        return Factory::fromFile(USER_ROOT . '/config/user.config.php');
    }
}
