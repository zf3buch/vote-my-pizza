<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/vote-my-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace Pizza\Model\Storage\Db;

use Pizza\Model\Storage\RestaurantStorageInterface;
use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\TableGateway\TableGatewayInterface;

/**
 * Class RestaurantDbStorage
 *
 * @package Pizza\Model\Storage\Db
 */
class RestaurantDbStorage implements RestaurantStorageInterface
{
    /**
     * @var TableGatewayInterface|AbstractTableGateway
     */
    private $tableGateway;

    /**
     * RestaurantDbStorage constructor.
     *
     * @param TableGatewayInterface $tableGateway
     */
    public function __construct($tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    /**
     * Fetch restaurants by pizza id
     *
     * @param integer $pizzaId
     *
     * @return array
     */
    public function fetchRestaurantsByPizza($pizzaId)
    {
        // select restaurants
        $select = $this->tableGateway->getSql()->select();
        $select->where->equalTo('pizza', $pizzaId);
        $select->order(['date' => 'ASC']);

        // initialize data
        $data = [];

        // loop through rows
        foreach ($this->tableGateway->selectWith($select) as $row) {
            $data[] = $row;
        }

        // return data
        return $data;
    }

    /**
     * Save a restaurant
     *
     * @param array $data
     *
     * @return mixed
     */
    public function saveRestaurant(array $data = [])
    {
        return $this->tableGateway->insert($data);
    }

    /**
     * Delete a restaurant
     *
     * @param integer $id
     *
     * @return mixed
     */
    public function deleteRestaurant($id)
    {
        return $this->tableGateway->delete(['id' => $id]);
    }
}
