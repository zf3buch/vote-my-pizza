<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/vote-my-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace PizzaTest\Model\InputFilter;

use Interop\Container\ContainerInterface;
use PHPUnit_Framework_TestCase;
use Pizza\Model\InputFilter\RestaurantInputFilter;
use Pizza\Model\InputFilter\RestaurantInputFilterFactory;

/**
 * Class RestaurantInputFilterFactoryTest
 *
 * @package PizzaTest\Model\InputFilter
 */
class RestaurantInputFilterFactoryTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test input filter factory
     */
    public function testFactory()
    {
        $container = $this->prophesize(ContainerInterface::class);

        $expectedInputKeys = ['name', 'price'];

        $factory = new RestaurantInputFilterFactory();

        $this->assertTrue(
            $factory instanceof RestaurantInputFilterFactory
        );

        /** @var RestaurantInputFilter $inputFilter */
        $inputFilter = $factory($container->reveal());

        $this->assertTrue($inputFilter instanceof RestaurantInputFilter);
        $this->assertEquals(
            $expectedInputKeys, array_keys($inputFilter->getInputs())
        );
    }
}
