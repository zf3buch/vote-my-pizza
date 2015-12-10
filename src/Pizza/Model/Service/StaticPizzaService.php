<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/vote-my-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace Pizza\Model\Service;

/**
 * Class StaticPizzaService
 *
 * @package Pizza\Model\Service
 */
class StaticPizzaService implements PizzaServiceInterface
{
    /**
     * @var array
     */
    private $pizzaList = [];

    /**
     * Sort descending by rate
     *
     * @param $a
     * @param $b
     *
     * @return int
     */
    private function sortDescByRate($a, $b)
    {
        if ($a['rate'] == $b['rate']) {
            return 0;
        }

        return ($a['rate'] < $b['rate']) ? +1 : -1;
    }

    /**
     * Sort ascending by rate
     *
     * @param $a
     * @param $b
     *
     * @return int
     */
    private function sortAscByRate($a, $b)
    {
        if ($a['rate'] == $b['rate']) {
            return 0;
        }

        return ($a['rate'] > $b['rate']) ? +1 : -1;
    }

    /**
     * StaticPizzaService constructor.
     *
     * @param array $pizzaList
     */
    public function __construct(array $pizzaList)
    {
        $this->pizzaList = $pizzaList;
    }

    /**
     * Get two pizzas for voting
     *
     * @return array
     */
    public function getPizzasForVoting()
    {
        srand(microtime(true));

        $randomKeys = array_rand($this->pizzaList, 2);

        return [
            'left'  => $this->pizzaList[$randomKeys[0]],
            'right' => $this->pizzaList[$randomKeys[1]],
        ];
    }

    /**
     * Get single pizza
     *
     * @param integer $id
     *
     * @return array|boolean
     */
    public function getSinglePizza($id)
    {
        if (!isset($this->pizzaList[$id])) {
            return false;
        }

        return $this->pizzaList[$id];
    }

    /**
     * Get three top pizzas
     *
     * @return array
     */
    public function getTopPizzas()
    {
        $topPizzas = $this->pizzaList;

        usort(
            $topPizzas,
            array(
                'Pizza\Model\Service\StaticPizzaService',
                'sortDescByRate'
            )
        );

        return array_slice($topPizzas, 0, 3);
    }

    /**
     * Get three flop pizzas
     *
     * @return array
     */
    public function getFlopPizzas()
    {
        $flopPizzas = $this->pizzaList;

        usort(
            $flopPizzas,
            array(
                'Pizza\Model\Service\StaticPizzaService',
                'sortAscByRate'
            )
        );

        return array_slice($flopPizzas, 0, 3);
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
        return true;
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
        return true;
    }
}