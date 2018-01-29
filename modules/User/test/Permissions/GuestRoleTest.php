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
use User\Permissions\GuestRole;

/**
 * Class GuestRoleTest
 *
 * @package UserTest\Form
 */
class GuestRoleTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test role name
     */
    public function testRoleName()
    {
        $role = new GuestRole();

        $this->assertEquals('guest', $role->getName());
    }

    /**
     * Test role permissions
     */
    public function testRolePermissions()
    {
        $role = new GuestRole();

        $this->assertTrue($role->hasPermission('home'));
        $this->assertTrue($role->hasPermission('pizza-intro'));
        $this->assertTrue($role->hasPermission('pizza-show'));
        $this->assertFalse($role->hasPermission('pizza-voting'));
        $this->assertFalse($role->hasPermission('pizza-handle-voting'));
        $this->assertFalse($role->hasPermission('pizza-handle-restaurant'));
        $this->assertFalse($role->hasPermission('pizza-delete-restaurant'));
        $this->assertTrue($role->hasPermission('user-intro'));
        $this->assertTrue($role->hasPermission('user-handle-login'));
        $this->assertTrue($role->hasPermission('user-handle-register'));
        $this->assertFalse($role->hasPermission('user-handle-logout'));
        $this->assertTrue($role->hasPermission('user-registered'));
    }
}