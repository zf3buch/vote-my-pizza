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
use Pizza\Form\RestaurantPriceForm;
use Pizza\Model\Repository\PizzaRepositoryInterface;
use Pizza\Model\Repository\RestaurantRepositoryInterface;
use Zend\Expressive\Router\RouterInterface;

/**
 * Class DeleteRestaurantFactory
 *
 * @package Pizza\Action
 */
class DeleteRestaurantFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return DeleteRestaurantAction
     */
    public function __invoke(ContainerInterface $container)
    {
        $router     = $container->get(RouterInterface::class);
        $repository = $container->get(RestaurantRepositoryInterface::class);

        return new DeleteRestaurantAction(
            $router, $repository
        );
    }
}
