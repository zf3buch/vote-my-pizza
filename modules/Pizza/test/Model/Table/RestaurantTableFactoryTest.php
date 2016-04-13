<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/vote-my-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace PizzaTest\Model\Table;

use Interop\Container\ContainerInterface;
use PHPUnit_Framework_TestCase;
use Pizza\Model\Table\RestaurantTable;
use Pizza\Model\Table\RestaurantTableFactory;
use Pizza\Model\Table\RestaurantTableInterface;
use Prophecy\Prophecy\MethodProphecy;
use Zend\Db\Adapter\AdapterInterface;

/**
 * Class RestaurantTableFactoryTest
 *
 * @package PizzaTest\Model\Table
 */
class RestaurantTableFactoryTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test input filter factory
     */
    public function testFactory()
    {
        /** @var ContainerInterface $container */
        $container = $this->prophesize(ContainerInterface::class);

        /** @var RestaurantTableInterface $RestaurantTable */
        $dbAdapter = $this->prophesize(AdapterInterface::class);

        /** @var MethodProphecy $method */
        $method = $container->get(AdapterInterface::class);
        $method->willReturn($dbAdapter);
        $method->shouldBeCalled();

        $factory = new RestaurantTableFactory();

        $this->assertTrue(
            $factory instanceof RestaurantTableFactory
        );

        /** @var RestaurantTable $table */
        $table = $factory($container->reveal());

        $this->assertTrue($table instanceof RestaurantTable);
    }
}
