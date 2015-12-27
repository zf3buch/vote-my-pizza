<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/vote-my-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace Pizza\Model\Repository;

/**
 * Class StaticRestaurantRepository
 *
 * @package Pizza\Model\Repository
 */
class StaticRestaurantRepository implements RestaurantRepositoryInterface
{
    /**
     * Save restaurant
     *
     * @param integer $id
     * @param array   $data
     *
     * @return boolean
     */
    public function saveRestaurant($id, $data)
    {
        return true;
    }

    /**
     * Delete restaurant
     *
     * @param integer $id
     *
     * @return boolean
     */
    public function deleteRestaurant($id)
    {
        return true;
    }
}
