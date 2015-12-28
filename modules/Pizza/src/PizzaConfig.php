<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/vote-my-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace Pizza;

use Zend\Config\Factory;

define('PIZZA_ROOT', __DIR__ . '/..');

/**
 * Class PizzaConfig
 *
 * @package Pizza
 */
class PizzaConfig
{
    /**
     * Read configuration
     *
     * @return array|\Zend\Config\Config
     */
    public function __invoke()
    {
        return Factory::fromFile(PIZZA_ROOT . '/config/pizza.config.php');
    }
}
