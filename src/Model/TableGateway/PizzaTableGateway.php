<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/vote-my-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace Application\Model\TableGateway;

use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Sql\Expression;
use Zend\Db\TableGateway\TableGateway;

/**
 * Class PizzaTableGateway
 *
 * @package Application\Model\TableGateway
 */
class PizzaTableGateway extends TableGateway
    implements PizzaTableGatewayInterface
{
    /**
     * PizzaTableGateway constructor.
     *
     * @param AdapterInterface $adapter
     */
    public function __construct(AdapterInterface $adapter)
    {
        $resultSet = new ResultSet(ResultSet::TYPE_ARRAY);

        parent::__construct('pizza', $adapter, null, $resultSet);
    }

    /**
     * Fetch random pizzas
     *
     * @param integer $count
     *
     * @return array
     */
    public function fetchRandomPizzas($count)
    {
        // select ids
        $select = $this->getSql()->select();
        $select->order(new Expression('RAND()'));
        $select->limit($count);

        // initialize data
        $data = array();

        // loop through rows
        foreach ($this->selectWith($select) as $row) {
            $data[] = $row;
        }

        // return data
        return $data;
    }

    /**
     * Fetch pizzas sorted by rate
     *
     * @param integer $count
     * @param string  $order
     *
     * @return array
     */
    public function fetchPizzasSortedByRate($count, $order)
    {
        // TODO: Implement fetchPizzasSortedByRate() method.
    }

    /**
     * Increase pos column
     *
     * @param integer $id
     *
     * @return bool
     */
    public function increasePos($id)
    {
        // TODO: Implement increasePos() method.
    }

    /**
     * Increase neg column
     *
     * @param integer $id
     *
     * @return bool
     */
    public function increaseNeg($id)
    {
        // TODO: Implement increaseNeg() method.
    }

}