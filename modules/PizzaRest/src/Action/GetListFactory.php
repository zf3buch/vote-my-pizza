<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/vote-my-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace PizzaRest\Action;

use Interop\Container\ContainerInterface;
use Pizza\Model\Repository\PizzaRepositoryInterface;

/**
 * Class GetListFactory
 *
 * @package PizzaRest\Action
 */
class GetListFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return GetListAction
     */
    public function __invoke(ContainerInterface $container)
    {
        $repository = $container->get(PizzaRepositoryInterface::class);

        $action = new GetListAction();
        $action->setPizzaRepository($repository);

        return $action;
    }
}
