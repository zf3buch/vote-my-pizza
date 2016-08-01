<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/vote-my-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace Pizza\Model\Repository;

use Pizza\Model\Storage\PizzaStorageInterface;
use Pizza\Model\Storage\RestaurantStorageInterface;

/**
 * Class PizzaRepository
 *
 * @package Pizza\Model\Repository
 */
class PizzaRepository implements PizzaRepositoryInterface
{
    /**
     * @var PizzaStorageInterface
     */
    private $pizzaStorage;

    /**
     * @var RestaurantStorageInterface
     */
    private $restaurantStorage;

    /**
     * PizzaRepository constructor.
     *
     * @param PizzaStorageInterface      $pizzaStorage
     * @param RestaurantStorageInterface $restaurantStorage
     */
    public function __construct(
        PizzaStorageInterface $pizzaStorage,
        RestaurantStorageInterface $restaurantStorage
    ) {
        $this->pizzaStorage      = $pizzaStorage;
        $this->restaurantStorage = $restaurantStorage;
    }

    /**
     * Get two pizzas for voting
     *
     * @return array
     */
    public function getPizzasForVoting()
    {
        $pizzas = $this->pizzaStorage->fetchRandomPizzas(2);

        foreach ($pizzas as $key => $pizza) {
            $restaurants = $this->restaurantStorage->fetchRestaurantsByPizza(
                $pizza['id']
            );

            $pizzas[$key]['restaurants'] = $restaurants;
        }

        return [
            'left'  => $pizzas[0],
            'right' => $pizzas[1],
        ];
    }

    /**
     * Get single pizza
     *
     * @param integer $id
     *
     * @return array
     */
    public function getSinglePizza($id)
    {
        $pizza = $this->pizzaStorage->fetchPizzaById($id);

        if (!$pizza) {
            return false;
        }

        $pizza['restaurants'] = $this->restaurantStorage->fetchRestaurantsByPizza(
            $id
        );

        return $pizza;
    }

    /**
     * Get three top pizzas
     *
     * @return array
     */
    public function getTopPizzas()
    {
        return $this->pizzaStorage->fetchPizzasSortedByRate(
            3, 'DESC'
        );
    }

    /**
     * Get three flop pizzas
     *
     * @return array
     */
    public function getFlopPizzas()
    {
        return $this->pizzaStorage->fetchPizzasSortedByRate(3, 'ASC');
    }

    /**
     * Save voting
     *
     * @param $pos
     * @param $neg
     *
     * @return boolean
     */
    public function saveVoting($pos, $neg)
    {
        $this->pizzaStorage->increasePos($pos);
        $this->pizzaStorage->increaseNeg($neg);

        return true;
    }
}
