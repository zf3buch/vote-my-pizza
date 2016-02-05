<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/vote-my-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace User\Permissions;

use Zend\Permissions\Rbac\AbstractRole;

/**
 * Class GuestRole
 *
 * @package User\Permissions
 */
class GuestRole extends AbstractRole
{
    /**
     * @var string name of role
     */
    const NAME = 'guest';

    /**
     * @var string
     */
    protected $name = self::NAME;

    /**
     * GuestRole constructor.
     */
    public function __construct()
    {
        $this->addPermission('home');
        $this->addPermission('pizza-intro');
        $this->addPermission('pizza-show');
        $this->addPermission('user-intro');
        $this->addPermission('user-handle-login');
        $this->addPermission('user-handle-register');
        $this->addPermission('user-registered');
    }
}
