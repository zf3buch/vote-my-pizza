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
     * GuestRole constructor.
     */
    public function __construct()
    {
        $this->addPermission('home');
        $this->addPermission('pizza-intro');
        $this->addPermission('pizza-show');
    }
    /**
     * @var string
     */
    protected $name = 'guest';
}
