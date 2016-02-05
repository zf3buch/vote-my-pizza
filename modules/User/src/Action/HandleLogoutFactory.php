<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/vote-my-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace User\Action;

use Interop\Container\ContainerInterface;
use Zend\Authentication\AuthenticationServiceInterface;
use Zend\Expressive\Router\RouterInterface;

/**
 * Class HandleLogoutFactory
 *
 * @package User\Action
 */
class HandleLogoutFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return HandleLogoutAction
     */
    public function __invoke(ContainerInterface $container)
    {
        $router = $container->get(RouterInterface::class);

        $authenticationService = $container->get(
            AuthenticationServiceInterface::class
        );

        $action = new HandleLogoutAction();
        $action->setAuthenticationService($authenticationService);
        $action->setRouter($router);

        return $action;
    }
}
