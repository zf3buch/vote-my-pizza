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
use Pizza\Model\Storage\RestaurantStorageInterface;

/**
 * Class RestaurantRepositoryFactory
 *
 * @package Pizza\Model\Repository
 */
class RestaurantRepositoryFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return RestaurantRepository
     */
    public function __invoke(ContainerInterface $container)
    {
        $restaurantStorage = $container->get(
            RestaurantStorageInterface::class
        );

        return new RestaurantRepository($restaurantStorage);
    }
}