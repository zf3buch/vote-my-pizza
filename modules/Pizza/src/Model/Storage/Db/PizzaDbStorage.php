<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/vote-my-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace Pizza\Model\Storage\Db;

use Pizza\Model\Storage\PizzaStorageInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Sql\Expression;
use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\TableGateway\TableGatewayInterface;

/**
 * Class PizzaDbStorage
 *
 * @package Pizza\Model\Storage\Db
 */
class PizzaDbStorage implements PizzaStorageInterface
{
    /**
     * @var TableGatewayInterface|AbstractTableGateway
     */
    private $tableGateway;

    /**
     * PizzaDbStorage constructor.
     *
     * @param TableGatewayInterface $tableGateway
     */
    public function __construct(TableGatewayInterface $tableGateway)
    {
        $this->tableGateway = $tableGateway;
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
        // select pizzas
        $select = $this->tableGateway->getSql()->select();
        $select->order(new Expression('RAND()'));
        $select->limit($count);

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
     * Fetch pizza by id
     *
     * @param integer $id
     *
     * @return array
     */
    public function fetchPizzaById($id)
    {
        // select pizzas
        $select = $this->tableGateway->getSql()->select();
        $select->where->equalTo('id', $id);

        /** @var ResultSet $resultSet */
        $resultSet = $this->tableGateway->selectWith($select);

        // return data
        return $resultSet->current();
    }

    /**
     * Fetch pizzas sorted by rate
     *
     * @param integer $count
     * @param string  $order
     *
     * @return array
     */
    public function fetchPizzasSortedByRate($count, $order = 'DESC')
    {
        // select pizzas
        $select = $this->tableGateway->getSql()->select();
        $select->order(['rate' => $order]);
        $select->limit($count);

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
     * Increase pos column
     *
     * @param integer $id
     *
     * @return bool
     */
    public function increasePos($id)
    {
        return $this->increaseAndRecalc($id, 'pos');
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
        return $this->increaseAndRecalc($id, 'neg');
    }

    /**
     * Increase calc and recalc rate
     *
     * @param integer $id
     * @param string  $recalcColumn
     *
     * @return bool
     */
    private function increaseAndRecalc($id, $recalcColumn)
    {
        $platform  = $this->tableGateway->getAdapter()->getPlatform();
        $posColumn = $platform->quoteIdentifier('pos');
        $negColumn = $platform->quoteIdentifier('neg');

        // increase
        $update = $this->tableGateway->getSql()->update();
        $update->set(
            [
                $recalcColumn => new Expression($recalcColumn . ' + 1'),
            ]
        );
        $update->where->equalTo('id', $id);

        $this->tableGateway->updateWith($update);

        // recalc
        $update = $this->tableGateway->getSql()->update();
        $update->set(
            [
                'rate' => new Expression(
                    $posColumn . '/(' . $posColumn . '+' . $negColumn . ')'
                ),
            ]
        );
        $update->where->equalTo('id', $id);

        $this->tableGateway->updateWith($update);

        return true;
    }
}
