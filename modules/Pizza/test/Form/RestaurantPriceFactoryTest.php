<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/vote-my-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace PizzaTest\Form;

use Interop\Container\ContainerInterface;
use PHPUnit_Framework_TestCase;
use Pizza\Form\RestaurantPriceFactory;
use Pizza\Form\RestaurantPriceForm;
use Pizza\Model\InputFilter\RestaurantInputFilter;
use Prophecy\Prophecy\MethodProphecy;

/**
 * Class RestaurantPriceFactoryTest
 *
 * @package PizzaTest\Form
 */
class RestaurantPriceFactoryTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test input filter factory
     */
    public function testFactory()
    {
        $container = $this->prophesize(ContainerInterface::class);

        /** @var RestaurantInputFilter $inputFilter */
        $inputFilter = $this->prophesize(RestaurantInputFilter::class);

        /** @var MethodProphecy $method */
        $method = $container->get(RestaurantInputFilter::class);
        $method->willReturn($inputFilter);
        $method->shouldBeCalled();

        $expectedElementKeys = ['name', 'price', 'save_price'];

        $factory = new RestaurantPriceFactory();

        $this->assertTrue(
            $factory instanceof RestaurantPriceFactory
        );

        /** @var RestaurantPriceForm $form */
        $form = $factory($container->reveal());

        $this->assertTrue($form instanceof RestaurantPriceForm);
        $this->assertEquals(
            $expectedElementKeys, array_keys($form->getElements())
        );
    }
}
