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
 * Class AdminRole
 *
 * @package User\Permissions
 */
class AdminRole extends AbstractRole
{
    /**
     * @var string
     */
    protected $name = 'admin';

    /**
     * AdminRole constructor.
     */
    public function __construct()
    {
        $this->addChild(new MemberRole());

        $this->addPermission('pizza-delete-restaurant');
    }
}
