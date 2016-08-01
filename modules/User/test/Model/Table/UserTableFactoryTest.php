<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/vote-my-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace UserTest\Model\Storage\Db;

use Interop\Container\ContainerInterface;
use PHPUnit_Framework_TestCase;
use User\Model\Storage\Db\UserTable;
use User\Model\Storage\Db\UserTableFactory;
use User\Model\Storage\Db\UserTableInterface;
use Prophecy\Prophecy\MethodProphecy;
use Zend\Db\Adapter\AdapterInterface;

/**
 * Class UserTableFactoryTest
 *
 * @package UserTest\Model\Storage\Db
 */
class UserTableFactoryTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test input filter factory
     */
    public function testFactory()
    {
        /** @var ContainerInterface $container */
        $container = $this->prophesize(ContainerInterface::class);

        /** @var UserTableInterface $userTable */
        $dbAdapter = $this->prophesize(AdapterInterface::class);

        /** @var MethodProphecy $method */
        $method = $container->get(AdapterInterface::class);
        $method->willReturn($dbAdapter);
        $method->shouldBeCalled();

        $factory = new UserTableFactory();

        $this->assertTrue(
            $factory instanceof UserTableFactory
        );

        /** @var UserTable $table */
        $table = $factory($container->reveal());

        $this->assertTrue($table instanceof UserTable);
    }
}
