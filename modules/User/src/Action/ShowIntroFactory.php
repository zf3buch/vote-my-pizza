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
use User\Form\RegisterForm;
use Zend\Expressive\Template\TemplateRendererInterface;

/**
 * Class ShowIntroFactory
 *
 * @package User\Action
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
        $renderer     = $container->get(TemplateRendererInterface::class);
        $loginForm    = $container->get(LoginForm::class);
        $registerForm = $container->get(RegisterForm::class);

        return new ShowIntroAction($renderer, $loginForm, $registerForm);
    }
}
