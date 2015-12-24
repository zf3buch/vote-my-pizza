<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/vote-my-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace User\Model\InputFilter;

use Interop\Container\ContainerInterface;

/**
 * Class RegisterInputFilterFactory
 *
 * @package User\Model\InputFilter
 */
class RegisterInputFilterFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return RegisterInputFilter
     */
    public function __invoke(ContainerInterface $container)
    {
        $inputFilter = new RegisterInputFilter();
        $inputFilter->init();

        return $inputFilter;
    }
}
