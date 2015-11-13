<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/vote-my-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace Application\Model\Repository;

/**
 * Class PizzaRepository
 *
 * @package Application\Model\Repository
 */
class PizzaRepository implements PizzaRepositoryInterface
{
    /**
     * @var array
     */
    private $pizzaList = [];

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

        return ($a['rate'] < $b['rate']) ? +1 : -1;
    }

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

        return ($a['rate'] > $b['rate']) ? +1 : -1;
    }

    /**
     * PizzaRepository constructor.
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
                'Application\Model\Repository\PizzaRepository',
                'sortAscByRate'
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
                'Application\Model\Repository\PizzaRepository',
                'sortDescByRate'
            )
        );

        return array_slice($flopPizzas, 0, 3);
    }
}
