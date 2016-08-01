<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/vote-my-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace Pizza\Model\Storage;

/**
 * Interface RestaurantStorageInterface
 *
 * @package Pizza\Model\Storage
 */
interface RestaurantStorageInterface
{
    /**
     * Fetch restaurants by pizza id
     *
     * @param integer $pizzaId
     *
     * @return array
     */
    public function fetchRestaurantsByPizza($pizzaId);

    /**
     * Save a restaurant
     *
     * @param array $data
     *
     * @return mixed
     */
    public function saveRestaurant(array $data = array());

    /**
     * Delete a restaurant
     *
     * @param integer $id
     *
     * @return mixed
     */
    public function deleteRestaurant($id);
}
