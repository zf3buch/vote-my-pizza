<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/vote-my-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace Application\Model\Service;

use Application\Model\Table\PizzaTableInterface;
use Application\Model\Table\RestaurantTableInterface;
use Interop\Container\ContainerInterface;

/**
 * Class DbPizzaServiceFactory
 *
 * @package Application\Model\Service
 */
class DbPizzaServiceFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return DbPizzaService
     */
    public function __invoke(ContainerInterface $container)
    {
        $pizzaTable = $container->get(PizzaTableInterface::class);

        $restaurantTable = $container->get(
            RestaurantTableInterface::class
        );

        return new DbPizzaService($pizzaTable, $restaurantTable);
    }
}