<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/vote-my-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace User\Model\Storage\Db;

/**
 * Interface UserTableInterface
 *
 * @package User\Model\Storage\Db
 */
interface UserTableInterface
{
    /**
     * Fetch user by id
     *
     * @param integer $id
     *
     * @return array
     */
    public function fetchUserById($id);

    /**
     * Insert a user
     *
     * @param array $data
     *
     * @return mixed
     */
    public function insertUser(array $data = array());
}
