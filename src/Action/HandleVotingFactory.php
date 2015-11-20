<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/vote-my-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace Application\Action;

use Application\Model\Service\PizzaServiceInterface;
use Interop\Container\ContainerInterface;
use Zend\Expressive\Router\RouterInterface;

/**
 * Class HandleVotingFactory
 *
 * @package Application\Action
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
        $repository = $container->get(PizzaServiceInterface::class);

        return new HandleVotingAction($router, $repository);
    }
}
