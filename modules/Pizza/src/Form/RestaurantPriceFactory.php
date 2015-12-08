<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/vote-my-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace Pizza\Form;

use Interop\Container\ContainerInterface;
use Zend\Form\Form;

/**
 * Class RestaurantPriceFactory
 *
 * @package Pizza\Form
 */
class RestaurantPriceFactory extends Form
{
    /**
     * @param ContainerInterface $container
     *
     * @return RestaurantPriceForm
     */
    public function __invoke(ContainerInterface $container)
    {
        return new RestaurantPriceForm();
    }
}