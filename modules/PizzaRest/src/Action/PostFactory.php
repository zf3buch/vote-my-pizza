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
 * Class PostFactory
 *
 * @package PizzaRest\Action
 */
class PostFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return PostAction
     */
    public function __invoke(ContainerInterface $container)
    {
        $repository = $container->get(PizzaRepositoryInterface::class);

        $action = new PostAction();
        $action->setPizzaRepository($repository);

        return $action;
    }
}
