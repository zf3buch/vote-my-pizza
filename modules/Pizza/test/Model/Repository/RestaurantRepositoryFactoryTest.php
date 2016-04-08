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
use Pizza\Model\Repository\RestaurantRepository;
use Pizza\Model\Repository\RestaurantRepositoryFactory;
use Pizza\Model\Table\PizzaTableInterface;
use Pizza\Model\Table\RestaurantTableInterface;
use Prophecy\Prophecy\MethodProphecy;

/**
 * Class RestaurantRepositoryFactoryTest
 *
 * @package PizzaTest\Model\Repository
 */
class RestaurantRepositoryFactoryTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test input filter factory
     */
    public function testFactory()
    {
        /** @var ContainerInterface $container */
        $container = $this->prophesize(ContainerInterface::class);

        /** @var RestaurantTableInterface $restaurantTable */
        $restaurantTable = $this->prophesize(
            RestaurantTableInterface::class
        );

        /** @var MethodProphecy $method */
        $method = $container->get(RestaurantTableInterface::class);
        $method->willReturn($restaurantTable);
        $method->shouldBeCalled();

        $factory = new RestaurantRepositoryFactory();

        $this->assertTrue(
            $factory instanceof RestaurantRepositoryFactory
        );

        /** @var RestaurantRepository $repository */
        $repository = $factory($container->reveal());

        $this->assertTrue($repository instanceof RestaurantRepository);
    }
}
