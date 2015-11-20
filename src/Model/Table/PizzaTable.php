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
use Zend\Db\Sql\Expression;
use Zend\Db\TableGateway\TableGateway;

/**
 * Class PizzaTable
 *
 * @package Application\Model\Table
 */
class PizzaTable extends TableGateway implements PizzaTableInterface
{
    /**
     * PizzaTable constructor.
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
        // select pizzas
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
    public function fetchPizzasSortedByRate($count, $order = 'DESC')
    {
        // select pizzas
        $select = $this->getSql()->select();
        $select->order(['rate' => $order]);
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
        $platform  = $this->getAdapter()->getPlatform();
        $posColumn = $platform->quoteIdentifier('pos');
        $negColumn = $platform->quoteIdentifier('neg');

        // increase
        $update = $this->getSql()->update();
        $update->set(
            [
                $recalcColumn => new Expression($recalcColumn . ' + 1')
            ]
        );
        $update->where->equalTo('id', $id);

        $this->updateWith($update);

        // recalc
        $update = $this->getSql()->update();
        $update->set(
            [
                'rate' => new Expression(
                    $posColumn . '/(' . $posColumn . '+' . $negColumn . ')'
                )
            ]
        );
        $update->where->equalTo('id', $id);

        $this->updateWith($update);

        return true;
    }

}