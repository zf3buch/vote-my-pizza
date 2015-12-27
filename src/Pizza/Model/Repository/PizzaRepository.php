<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/vote-my-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace Pizza\Model\Repository;

use Pizza\Model\Table\PizzaTableInterface;
use Pizza\Model\Table\RestaurantTableInterface;

/**
 * Class PizzaRepository
 *
 * @package Pizza\Model\Repository
 */
class PizzaRepository implements PizzaRepositoryInterface
{
    /**
     * @var PizzaTableInterface
     */
    private $pizzaTable;

    /**
     * @var RestaurantTableInterface
     */
    private $restaurantTable;

    /**
     * PizzaRepository constructor.
     *
     * @param PizzaTableInterface      $pizzaTable
     * @param RestaurantTableInterface $restaurantTable
     */
    public function __construct(
        PizzaTableInterface $pizzaTable,
        RestaurantTableInterface $restaurantTable
    ) {
        $this->pizzaTable      = $pizzaTable;
        $this->restaurantTable = $restaurantTable;
    }

    /**
     * Get two pizzas for voting
     *
     * @return array
     */
    public function getPizzasForVoting()
    {
        $pizzas = $this->pizzaTable->fetchRandomPizzas(2);

        foreach ($pizzas as $key => $pizza) {
            $restaurants = $this->restaurantTable->fetchRestaurantsByPizza(
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
        $pizza = $this->pizzaTable->fetchPizzaById($id);

        if (!$pizza) {
            return false;
        }

        $pizza['restaurants'] = $this->restaurantTable->fetchRestaurantsByPizza(
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
        return $this->pizzaTable->fetchPizzasSortedByRate(
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
        return $this->pizzaTable->fetchPizzasSortedByRate(3, 'ASC');
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
        $this->pizzaTable->increasePos($pos);
        $this->pizzaTable->increaseNeg($neg);

        return true;
    }
}
