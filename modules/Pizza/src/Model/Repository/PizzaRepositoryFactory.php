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
use Pizza\Model\Storage\PizzaStorageInterface;
use Pizza\Model\Storage\RestaurantStorageInterface;

/**
 * Class PizzaRepositoryFactory
 *
 * @package Pizza\Model\Repository
 */
class PizzaRepositoryFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return PizzaRepository
     */
    public function __invoke(ContainerInterface $container)
    {
        $pizzaStorage = $container->get(PizzaStorageInterface::class);

        $restaurantStorage = $container->get(
            RestaurantStorageInterface::class
        );

        return new PizzaRepository($pizzaStorage, $restaurantStorage);
    }
}