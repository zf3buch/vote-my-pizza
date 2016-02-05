<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/vote-my-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace User\Form;

/**
 * Trait RegisterFormAwareTrait
 *
 * @package User\Form
 */
trait RegisterFormAwareTrait
{
    /**
     * @var RegisterForm
     */
    private $registerForm;

    /**
     * @param RegisterForm $registerForm
     */
    public function setRegisterForm(RegisterForm $registerForm)
    {
        $this->registerForm = $registerForm;
    }
}
