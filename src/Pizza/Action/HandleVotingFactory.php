<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/vote-my-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace Pizza\Action;

use Interop\Container\ContainerInterface;
use Pizza\Model\Repository\PizzaRepositoryInterface;
use Zend\Expressive\Router\RouterInterface;

/**
 * Class HandleVotingFactory
 *
 * @package Pizza\Action
 */
class HandleVotingFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return HandleVotingAction
     */
    public function __invoke(ContainerInterface $container)
    {
        $router     = $container->get(RouterInterface::class);
        $repository = $container->get(PizzaRepositoryInterface::class);

        return new HandleVotingAction($router, $repository);
    }
}
