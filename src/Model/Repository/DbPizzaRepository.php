<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/vote-my-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace Application\Model\Repository;
use Application\Model\TableGateway\PizzaTableGatewayInterface;

/**
 * Class DbPizzaRepository
 *
 * @package Application\Model\Repository
 */
class DbPizzaRepository implements PizzaRepositoryInterface
{
    /**
     * @var PizzaTableGatewayInterface
     */
    private $pizzaTableGateway;

    /**
     * DbPizzaRepository constructor.
     *
     * @param PizzaTableGatewayInterface $pizzaTableGateway
     */
    public function __construct(
        PizzaTableGatewayInterface $pizzaTableGateway
    ) {
        $this->pizzaTableGateway = $pizzaTableGateway;
    }

    /**
     * Get two pizzas for voting
     *
     * @return array
     */
    public function getPizzasForVoting()
    {
        $pizzas = $this->pizzaTableGateway->fetchRandomPizzas(2);

        return [
            'left'  => $pizzas[0],
            'right' => $pizzas[1],
        ];
    }

    /**
     * Get three top pizzas
     *
     * @return array
     */
    public function getTopPizzas()
    {
        return [];
    }

    /**
     * Get three flop pizzas
     *
     * @return array
     */
    public function getFlopPizzas()
    {
        return [];
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
