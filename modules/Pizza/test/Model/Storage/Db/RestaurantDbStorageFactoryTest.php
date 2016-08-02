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
        /** @var RestaurantStorageInterface $RestaurantDbStorage */
        $dbAdapter = $this->prophesize(AdapterInterface::class);

        /** @var ContainerInterface $container */
        $container = $this->prophesize(ContainerInterface::class);
        $container->get(AdapterInterface::class)->willReturn($dbAdapter)
            ->shouldBeCalled();

        $factory = new RestaurantDbStorageFactory();

        $this->assertTrue(
            $factory instanceof RestaurantDbStorageFactory
        );

        /** @var RestaurantDbStorage $table */
        $table = $factory($container->reveal());

        $this->assertTrue($table instanceof RestaurantDbStorage);
    }
}
