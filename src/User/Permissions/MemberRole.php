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
 * Class MemberRole
 *
 * @package User\Permissions
 */
class MemberRole extends AbstractRole
{
    /**
     * @var string
     */
    protected $name = 'member';

    /**
     * MemberRole constructor.
     */
    public function __construct()
    {
        $this->addChild(new GuestRole());

        $this->addPermission('pizza-voting');
        $this->addPermission('pizza-handle-voting');
        $this->addPermission('pizza-handle-restaurant');
    }
}
