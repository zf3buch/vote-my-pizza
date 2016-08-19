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
use Zend\Expressive\Template\TemplateRendererInterface;

/**
 * Class ShowPizzaFactory
 *
 * @package Application\Action
 */
class ShowPizzaFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return ShowPizzaAction
     */
    public function __invoke(ContainerInterface $container)
    {
        $renderer   = $container->get(TemplateRendererInterface::class);
        $repository = $container->get(PizzaRepositoryInterface::class);
        $form       = $container->get(RestaurantPriceForm::class);

        $action = new ShowPizzaAction();
        $action->setTemplateRenderer($renderer);
        $action->setPizzaRepository($repository);
        $action->setRestaurantPriceForm($form);

        return $action;
    }
}
