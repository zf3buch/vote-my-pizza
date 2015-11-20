<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/vote-my-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace Application\Model\Table;

use Zend\Db\TableGateway\TableGatewayInterface;

/**
 * Interface RestaurantTableInterface
 *
 * @package Application\Model\Table
 */
interface RestaurantTableInterface extends TableGatewayInterface
{
    /**
     * Fetch restaurants by pizza id
     *
     * @param integer $pizzaId
     *
     * @return array
     */
    public function fetchRestaurantsByPizza($pizzaId);
}