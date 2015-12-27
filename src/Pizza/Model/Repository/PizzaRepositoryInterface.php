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
 * Interface PizzaRepositoryInterface
 *
 * @package Pizza\Model\Repository
 */
interface PizzaRepositoryInterface
{
    /**
     * Get two pizzas for voting
     *
     * @return array
     */
    public function getPizzasForVoting();

    /**
     * Get single pizza
     *
     * @param integer $id
     *
     * @return array
     */
    public function getSinglePizza($id);

    /**
     * Get three top pizzas
     *
     * @return array
     */
    public function getTopPizzas();

    /**
     * Get three flop pizzas
     *
     * @return array
     */
    public function getFlopPizzas();

    /**
     * Save voting
     *
     * @param integer $pos
     * @param integer $neg
     *
     * @return boolean
     */
    public function saveVoting($pos, $neg);
}
