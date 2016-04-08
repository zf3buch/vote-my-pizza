<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/vote-my-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace PizzaTest\Model\Repository;

use Interop\Container\ContainerInterface;
use PHPUnit_Framework_TestCase;
use Pizza\Model\Repository\PizzaRepository;
use Pizza\Model\Repository\PizzaRepositoryFactory;
use Pizza\Model\Table\PizzaTableInterface;
use Pizza\Model\Table\RestaurantTableInterface;
use Prophecy\Prophecy\MethodProphecy;

/**
 * Class PizzaRepositoryFactoryTest
 *
 * @package PizzaTest\Model\Repository
 */
class PizzaRepositoryFactoryTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test input filter factory
     */
    public function testFactory()
    {
        /** @var ContainerInterface $container */
        $container = $this->prophesize(ContainerInterface::class);

        /** @var PizzaTableInterface $pizzaTable */
        $pizzaTable = $this->prophesize(PizzaTableInterface::class);

        /** @var RestaurantTableInterface $restaurantTable */
        $restaurantTable = $this->prophesize(
            RestaurantTableInterface::class
        );

        /** @var MethodProphecy $method */
        $method = $container->get(PizzaTableInterface::class);
        $method->willReturn($pizzaTable);
        $method->shouldBeCalled();

        /** @var MethodProphecy $method */
        $method = $container->get(RestaurantTableInterface::class);
        $method->willReturn($restaurantTable);
        $method->shouldBeCalled();

        $factory = new PizzaRepositoryFactory();

        $this->assertTrue(
            $factory instanceof PizzaRepositoryFactory
        );

        /** @var PizzaRepository $repository */
        $repository = $factory($container->reveal());

        $this->assertTrue($repository instanceof PizzaRepository);
    }
}
