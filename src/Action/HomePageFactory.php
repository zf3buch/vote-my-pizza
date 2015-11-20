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
use Zend\Expressive\Template\TemplateRendererInterface;

/**
 * Class HomePageFactory
 *
 * @package Application\Action
 */
class HomePageFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return HomePageAction
     */
    public function __invoke(ContainerInterface $container)
    {
        $template = $container->get(TemplateRendererInterface::class);
        $repository = $container->get(PizzaServiceInterface::class);

        return new HomePageAction($template, $repository);
    }
}
