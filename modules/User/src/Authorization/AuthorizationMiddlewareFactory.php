<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/vote-my-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace User\Authorization;

use Interop\Container\ContainerInterface;
use Zend\Expressive\Application;

/**
 * Class AuthorizationMiddlewareFactory
 *
 * @package User\Authorization
 */
class AuthorizationMiddlewareFactory
{
    /**
     * Create and return a AuthorizationMiddleware instance.
     *
     * @param ContainerInterface $container
     *
     * @return AuthorizationMiddleware
     */
    public function __invoke(ContainerInterface $container)
    {
        return new AuthorizationMiddleware(
            $container->get(AuthorizationObserver::class),
            $container->get(Application::class)
        );
    }
}
