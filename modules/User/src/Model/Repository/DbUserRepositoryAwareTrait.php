<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/vote-my-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace User\Model\Repository;

/**
 * Trait DbUserRepositoryAwareTrait
 *
 * @package User\Model\Repository
 */
trait DbUserRepositoryAwareTrait
{
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    /**
     * @param UserRepositoryInterface $userRepository
     */
    public function setUserRepository(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }
}
