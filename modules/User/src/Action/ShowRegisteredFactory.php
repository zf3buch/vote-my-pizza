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
use User\Form\LoginForm;
use Zend\Expressive\Template\TemplateRendererInterface;

/**
 * Class ShowRegisteredFactory
 *
 * @package User\Action
 */
class ShowRegisteredFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return ShowRegisteredAction
     */
    public function __invoke(ContainerInterface $container)
    {
        $renderer  = $container->get(TemplateRendererInterface::class);
        $loginForm = $container->get(LoginForm::class);

        return new ShowRegisteredAction($renderer, $loginForm);
    }
}
