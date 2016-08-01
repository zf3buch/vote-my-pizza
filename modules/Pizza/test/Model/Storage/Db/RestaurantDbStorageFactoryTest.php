<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/vote-my-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace PizzaTest\Model\Storage\Db;

use Interop\Container\ContainerInterface;
use PHPUnit_Framework_TestCase;
use Pizza\Model\Storage\Db\RestaurantDbStorage;
use Pizza\Model\Storage\Db\RestaurantDbStorageFactory;
use Pizza\Model\Storage\RestaurantStorageInterface;
use Prophecy\Prophecy\MethodProphecy;
use Zend\Db\Adapter\AdapterInterface;

/**
 * Class RestaurantDbStorageFactoryTest
 *
 * @package PizzaTest\Model\Storage
 */
class RestaurantDbStorageFactoryTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test input filter factory
     */
    public function testFactory()
    {
        /** @var ContainerInterface $container */
        $container = $this->prophesize(ContainerInterface::class);

        /** @var RestaurantStorageInterface $RestaurantDbStorage */
        $dbAdapter = $this->prophesize(AdapterInterface::class);

        /** @var MethodProphecy $method */
        $method = $container->get(AdapterInterface::class);
        $method->willReturn($dbAdapter);
        $method->shouldBeCalled();

        $factory = new RestaurantDbStorageFactory();

        $this->assertTrue(
            $factory instanceof RestaurantDbStorageFactory
        );

        /** @var RestaurantDbStorage $table */
        $table = $factory($container->reveal());

        $this->assertTrue($table instanceof RestaurantDbStorage);
    }
}
