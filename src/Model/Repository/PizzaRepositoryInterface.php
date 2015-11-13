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
 * Interface PizzaRepositoryInterface
 *
 * @package Application\Model\Repository
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
}
