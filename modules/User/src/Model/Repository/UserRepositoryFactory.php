<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/vote-my-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace User\Model\Repository;

use Interop\Container\ContainerInterface;
use User\Model\Storage\Db\UserTableInterface;

/**
 * Class UserRepositoryFactory
 *
 * @package User\Model\Repository
 */
class UserRepositoryFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return UserRepository
     */
    public function __invoke(ContainerInterface $container)
    {
        $userTable = $container->get(UserTableInterface::class);

        return new UserRepository($userTable);
    }
}
