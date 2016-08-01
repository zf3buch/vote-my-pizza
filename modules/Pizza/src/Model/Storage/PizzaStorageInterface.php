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
 * Interface PizzaStorageInterface
 *
 * @package Pizza\Model\Storage
 */
interface PizzaStorageInterface
{
    /**
     * Fetch random pizzas
     *
     * @param integer $count
     *
     * @return array
     */
    public function fetchRandomPizzas($count);

    /**
     * Fetch pizza by id
     *
     * @param integer $id
     *
     * @return array
     */
    public function fetchPizzaById($id);

    /**
     * Fetch pizzas sorted by rate
     *
     * @param integer $count
     * @param string  $order
     *
     * @return array
     */
    public function fetchPizzasSortedByRate($count, $order);

    /**
     * Increase pos column
     *
     * @param integer $id
     *
     * @return bool
     */
    public function increasePos($id);

    /**
     * Increase neg column
     *
     * @param integer $id
     *
     * @return bool
     */
    public function increaseNeg($id);
}
