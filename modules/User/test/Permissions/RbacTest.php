<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/vote-my-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace UserTest\Form;

use PHPUnit_Framework_TestCase;
use User\Permissions\Rbac;

/**
 * Class RbacTest
 *
 * @package UserTest\Form
 */
class RbacTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test guest permissions
     */
    public function testGuestPermissions()
    {
        $rbac = new Rbac();

        $this->assertTrue($rbac->isGranted('guest', 'home'));
        $this->assertTrue($rbac->isGranted('guest', 'pizza-intro'));
        $this->assertTrue($rbac->isGranted('guest', 'pizza-show'));
        $this->assertFalse($rbac->isGranted('guest', 'pizza-voting'));
        $this->assertFalse($rbac->isGranted('guest', 'pizza-handle-voting'));
        $this->assertFalse($rbac->isGranted('guest', 'pizza-handle-restaurant'));
        $this->assertFalse($rbac->isGranted('guest', 'pizza-delete-restaurant'));
        $this->assertTrue($rbac->isGranted('guest', 'user-intro'));
        $this->assertTrue($rbac->isGranted('guest', 'user-handle-login'));
        $this->assertTrue($rbac->isGranted('guest', 'user-handle-register'));
        $this->assertFalse($rbac->isGranted('guest', 'user-handle-logout'));
        $this->assertTrue($rbac->isGranted('guest', 'user-registered'));
    }

    /**
     * Test member permissions
     */
    public function testMemberPermissions()
    {
        $rbac = new Rbac();

        $this->assertTrue($rbac->isGranted('member', 'home'));
        $this->assertTrue($rbac->isGranted('member', 'pizza-intro'));
        $this->assertTrue($rbac->isGranted('member', 'pizza-show'));
        $this->assertTrue($rbac->isGranted('member', 'pizza-voting'));
        $this->assertTrue($rbac->isGranted('member', 'pizza-handle-voting'));
        $this->assertTrue($rbac->isGranted('member', 'pizza-handle-restaurant'));
        $this->assertFalse($rbac->isGranted('member', 'pizza-delete-restaurant'));
        $this->assertFalse($rbac->isGranted('member', 'user-intro'));
        $this->assertFalse($rbac->isGranted('member', 'user-handle-login'));
        $this->assertFalse($rbac->isGranted('member', 'user-handle-register'));
        $this->assertTrue($rbac->isGranted('member', 'user-handle-logout'));
        $this->assertFalse($rbac->isGranted('member', 'user-registered'));
    }

    /**
     * Test admin permissions
     */
    public function testAdminPermissions()
    {
        $rbac = new Rbac();

        $this->assertTrue($rbac->isGranted('admin', 'home'));
        $this->assertTrue($rbac->isGranted('admin', 'pizza-intro'));
        $this->assertTrue($rbac->isGranted('admin', 'pizza-show'));
        $this->assertTrue($rbac->isGranted('admin', 'pizza-voting'));
        $this->assertTrue($rbac->isGranted('admin', 'pizza-handle-voting'));
        $this->assertTrue($rbac->isGranted('admin', 'pizza-handle-restaurant'));
        $this->assertTrue($rbac->isGranted('admin', 'pizza-delete-restaurant'));
        $this->assertFalse($rbac->isGranted('admin', 'user-intro'));
        $this->assertFalse($rbac->isGranted('admin', 'user-handle-login'));
        $this->assertFalse($rbac->isGranted('admin', 'user-handle-register'));
        $this->assertTrue($rbac->isGranted('admin', 'user-handle-logout'));
        $this->assertFalse($rbac->isGranted('admin', 'user-registered'));
    }
}
