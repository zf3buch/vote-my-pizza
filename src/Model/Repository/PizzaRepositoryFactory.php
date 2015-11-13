<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/vote-my-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace Application\Model\Repository;

use Interop\Container\ContainerInterface;

/**
 * Class PizzaRepositoryFactory
 *
 * @package Application\Model\Repository
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
        $pizzaList = include APPLICATION_ROOT . '/data/pizza-list.php';

        return new PizzaRepository($pizzaList);
    }
}