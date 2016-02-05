<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/vote-my-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace Application\Router;

use Zend\Expressive\Router\RouterInterface;

/**
 * Trait RouterAwareTrait
 *
 * @package Application\Router
 */
trait RouterAwareTrait
{
    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * @param RouterInterface $router
     */
    public function setRouter(RouterInterface $router)
    {
        $this->router = $router;
    }
}
