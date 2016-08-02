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
use Pizza\Model\Storage\PizzaStorageInterface;
use Pizza\Model\Storage\RestaurantStorageInterface;

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
        /** @var PizzaStorageInterface $pizzaStorage */
        $pizzaStorage = $this->prophesize(PizzaStorageInterface::class);

        /** @var RestaurantStorageInterface $restaurantStorage */
        $restaurantStorage = $this->prophesize(
            RestaurantStorageInterface::class
        );

        /** @var ContainerInterface $container */
        $container = $this->prophesize(ContainerInterface::class);
        $container->get(PizzaStorageInterface::class)
            ->willReturn($pizzaStorage)->shouldBeCalled();
        $container->get(RestaurantStorageInterface::class)
            ->willReturn($restaurantStorage)->shouldBeCalled();

        $factory = new PizzaRepositoryFactory();

        $this->assertTrue(
            $factory instanceof PizzaRepositoryFactory
        );

        /** @var PizzaRepository $repository */
        $repository = $factory($container->reveal());

        $this->assertTrue($repository instanceof PizzaRepository);
    }
}
