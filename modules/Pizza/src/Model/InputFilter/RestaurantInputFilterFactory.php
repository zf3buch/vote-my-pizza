<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/vote-my-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace Pizza\Model\InputFilter;

use Interop\Container\ContainerInterface;

/**
 * Class RestaurantInputFilterFactory
 *
 * @package Pizza\Model\InputFilter
 */
class RestaurantInputFilterFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return RestaurantInputFilter
     */
    public function __invoke(ContainerInterface $container)
    {
        $inputFilter = new RestaurantInputFilter();
        $inputFilter->init();

        return $inputFilter;
    }
}
