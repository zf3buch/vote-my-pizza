<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/vote-my-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace Pizza\Model\Repository;

use Interop\Container\ContainerInterface;
use Pizza\Model\Table\PizzaTableInterface;
use Pizza\Model\Table\RestaurantTableInterface;

/**
 * Class DbPizzaRepositoryFactory
 *
 * @package Pizza\Model\Repository
 */
class DbPizzaRepositoryFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return DbPizzaRepository
     */
    public function __invoke(ContainerInterface $container)
    {
        $pizzaTable = $container->get(PizzaTableInterface::class);

        $restaurantTable = $container->get(
            RestaurantTableInterface::class
        );

        return new DbPizzaRepository($pizzaTable, $restaurantTable);
    }
}