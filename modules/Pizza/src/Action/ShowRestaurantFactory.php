<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/vote-my-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace Pizza\Action;

use Pizza\Form\RestaurantPriceForm;
use Pizza\Model\Service\PizzaServiceInterface;
use Interop\Container\ContainerInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

/**
 * Class ShowRestaurantFactory
 *
 * @package Pizza\Action
 */
class ShowRestaurantFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return ShowRestaurantAction
     */
    public function __invoke(ContainerInterface $container)
    {
        $template   = $container->get(TemplateRendererInterface::class);
        $repository = $container->get(PizzaServiceInterface::class);
        $form       = $container->get(RestaurantPriceForm::class);

        return new ShowRestaurantAction($template, $repository, $form);
    }
}
