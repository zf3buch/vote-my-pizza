<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/vote-my-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace Application\Permissions;

use Zend\Permissions\Rbac\Rbac as ZendRbac;

/**
 * Class Rbac
 *
 * @package Application\Permissions
 */
class Rbac extends ZendRbac
{
    public function __construct()
    {
        $this->addRole(new GuestRole());
        $this->addRole(new MemberRole());
        $this->addRole(new AdminRole());
    }
}
