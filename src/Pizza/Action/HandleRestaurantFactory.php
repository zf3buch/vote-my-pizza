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
use Pizza\Model\Service\PizzaServiceInterface;
use Zend\Expressive\Router\RouterInterface;

/**
 * Class HandleRestaurantFactory
 *
 * @package Pizza\Action
 */
class HandleRestaurantFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return HandleRestaurantAction
     */
    public function __invoke(ContainerInterface $container)
    {
        $router     = $container->get(RouterInterface::class);
        $repository = $container->get(PizzaServiceInterface::class);
        $form       = $container->get(RestaurantPriceForm::class);
        $nextAction = $container->get(ShowPizzaAction::class);

        return new HandleRestaurantAction(
            $router, $repository, $form, $nextAction
        );
    }
}
