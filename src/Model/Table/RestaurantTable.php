<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/vote-my-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace Application\Model\Table;

use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

/**
 * Class RestaurantTable
 *
 * @package Application\Model\Table
 */
class RestaurantTable extends TableGateway
    implements RestaurantTableInterface
{
    /**
     * RestaurantTable constructor.
     *
     * @param AdapterInterface $adapter
     */
    public function __construct(AdapterInterface $adapter)
    {
        $resultSet = new ResultSet(ResultSet::TYPE_ARRAY);

        parent::__construct('restaurant', $adapter, null, $resultSet);
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
        $select = $this->getSql()->select();
        $select->where->equalTo('pizza', $pizzaId);
        $select->order(['date' => 'ASC']);

        // initialize data
        $data = array();

        // loop through rows
        foreach ($this->selectWith($select) as $row) {
            $data[] = $row;
        }

        // return data
        return $data;
    }

}