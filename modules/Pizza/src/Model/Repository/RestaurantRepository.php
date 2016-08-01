<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/vote-my-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace Pizza\Model\Repository;

use Pizza\Model\Storage\RestaurantStorageInterface;

/**
 * Class RestaurantRepository
 *
 * @package Pizza\Model\Repository
 */
class RestaurantRepository implements RestaurantRepositoryInterface
{
    /**
     * @var RestaurantStorageInterface
     */
    private $restaurantStorage;

    /**
     * RestaurantRepository constructor.
     *
     * @param RestaurantStorageInterface $restaurantStorage
     */
    public function __construct(
        RestaurantStorageInterface $restaurantStorage
    ) {
        $this->restaurantStorage = $restaurantStorage;
    }

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
        $insertData = [
            'pizza' => $id,
            'date'  => date('Y-m-d H:i:s'),
            'name'  => isset($data['name']) ? $data['name'] : 'unbekannt',
            'price' => isset($data['price']) ? $data['price'] : 0.00,
        ];

        return $this->restaurantStorage->saveRestaurant($insertData);
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
        return $this->restaurantStorage->deleteRestaurant($id);
    }
}
