<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/vote-my-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace Application\Action;

use Application\Model\Repository\PizzaRepository;
use Interop\Container\ContainerInterface;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

/**
 * Class VotingFactory
 *
 * @package Application\Action
 */
class VotingFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return VotingAction
     */
    public function __invoke(ContainerInterface $container)
    {
        $template   = $container->get(TemplateRendererInterface::class);
        $repository = $container->get(PizzaRepository::class);

        return new VotingAction($template, $repository);
    }
}
