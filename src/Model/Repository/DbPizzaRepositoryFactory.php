<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/vote-my-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace Application\Model\Repository;

use Application\Model\TableGateway\PizzaTableGatewayInterface;
use Interop\Container\ContainerInterface;

/**
 * Class DbPizzaRepositoryFactory
 *
 * @package Application\Model\Repository
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
        $pizzaTableGateway = $container->get(
            PizzaTableGatewayInterface::class
        );

        return new DbPizzaRepository($pizzaTableGateway);
    }
}