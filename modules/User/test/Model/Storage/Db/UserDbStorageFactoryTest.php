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
use User\Model\Storage\Db\UserDbStorage;
use User\Model\Storage\Db\UserDbStorageFactory;
use User\Model\Storage\UserStorageInterface;
use Zend\Db\Adapter\AdapterInterface;

/**
 * Class UserDbStorageFactoryTest
 *
 * @package UserTest\Model\Storage\Db
 */
class UserDbStorageFactoryTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test input filter factory
     */
    public function testFactory()
    {
        /** @var UserStorageInterface $userStorage */
        $dbAdapter = $this->prophesize(AdapterInterface::class);

        /** @var ContainerInterface $container */
        $container = $this->prophesize(ContainerInterface::class);
        $container->get(AdapterInterface::class)->willReturn($dbAdapter)
            ->shouldBeCalled();

        $factory = new UserDbStorageFactory();

        $this->assertTrue(
            $factory instanceof UserDbStorageFactory
        );

        /** @var UserDbStorage $table */
        $table = $factory($container->reveal());

        $this->assertTrue($table instanceof UserDbStorage);
    }
}
