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
use User\Permissions\AdminRole;
use User\Permissions\MemberRole;

/**
 * Class AdminRoleTest
 *
 * @package UserTest\Form
 */
class AdminRoleTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test role name
     */
    public function testRoleName()
    {
        $role = new AdminRole();

        $this->assertEquals('admin', $role->getName());
    }

    /**
     * Test role permissions
     */
    public function testRolePermissions()
    {
        $role = new AdminRole();

        $this->assertTrue($role->hasPermission('home'));
        $this->assertTrue($role->hasPermission('pizza-intro'));
        $this->assertTrue($role->hasPermission('pizza-show'));
        $this->assertTrue($role->hasPermission('pizza-voting'));
        $this->assertTrue($role->hasPermission('pizza-handle-voting'));
        $this->assertTrue($role->hasPermission('pizza-handle-restaurant'));
        $this->assertTrue($role->hasPermission('pizza-delete-restaurant'));
        $this->assertFalse($role->hasPermission('user-intro'));
        $this->assertFalse($role->hasPermission('user-handle-login'));
        $this->assertFalse($role->hasPermission('user-handle-register'));
        $this->assertTrue($role->hasPermission('user-handle-logout'));
        $this->assertFalse($role->hasPermission('user-registered'));
    }

    /**
     * Test role children
     */
    public function testRoleChildren()
    {
        $adminRole = new AdminRole();

        $this->assertTrue($adminRole->hasChildren());

        $member = new MemberRole();
        $member->setParent(new AdminRole());

        $this->assertEquals($member, $adminRole->getChildren());
    }
}
