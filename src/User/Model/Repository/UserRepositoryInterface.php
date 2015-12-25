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
 * Interface UserRepositoryInterface
 *
 * @package User\Model\Repository
 */
interface UserRepositoryInterface
{
    /**
     * Get single user
     *
     * @param integer $id
     *
     * @return array
     */
    public function getSingleUser($id);

    /**
     * Save user
     *
     * @param array $data
     *
     * @return boolean
     */
    public function registerUser($data);
}
