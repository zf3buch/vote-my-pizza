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

/**
 * Class StaticRestaurantRepositoryFactory
 *
 * @package Pizza\Model\Repository
 */
class StaticRestaurantRepositoryFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return StaticRestaurantRepository
     */
    public function __invoke(ContainerInterface $container)
    {
        return new StaticRestaurantRepository();
    }
}