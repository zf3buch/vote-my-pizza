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
use Zend\Expressive\Template\TemplateRendererInterface;

/**
 * Class ShowIntroFactory
 *
 * @package Application\Action
 */
class ShowIntroFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return ShowIntroAction
     */
    public function __invoke(ContainerInterface $container)
    {
        $renderer   = $container->get(TemplateRendererInterface::class);
        $repository = $container->get(PizzaRepositoryInterface::class);

        $action = new ShowIntroAction();
        $action->setTemplateRenderer($renderer);
        $action->setPizzaRepository($repository);

        return $action;
    }
}
