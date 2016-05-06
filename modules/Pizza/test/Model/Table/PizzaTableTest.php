<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/vote-my-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace PizzaTest\Model\Table;

use PHPUnit_Extensions_Database_DataSet_IDataSet;
use PHPUnit_Extensions_Database_DB_DefaultDatabaseConnection;
use PHPUnit_Extensions_Database_DB_IDatabaseConnection;
use PHPUnit_Extensions_Database_TestCase;
use Pizza\Model\Table\PizzaTable;
use Pizza\Model\Table\PizzaTableInterface;
use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

/**
 * Class PizzaTableTest
 *
 * @package PizzaTest\Model\Table
 */
class PizzaTableTest extends PHPUnit_Extensions_Database_TestCase
{
    /**
     * @var PizzaTableInterface
     */
    private $pizzaTable;

    /**
     * @var Adapter
     */
    private $adapter = null;

    /**
     * @var PHPUnit_Extensions_Database_DB_DefaultDatabaseConnection
     */
    private $connection = null;

    /**
     * Sets up the test
     */
    protected function setUp()
    {
        if (!$this->pizzaTable) {
            $dbConfig = include __DIR__
                . '/../../../../../config/autoload/database.test.php';

            $this->adapter = new Adapter($dbConfig['db']);

            $resultSet = new ResultSet(ResultSet::TYPE_ARRAY);

            $tableGateway = new TableGateway(
                'pizza', $this->adapter, null, $resultSet
            );

            $this->pizzaTable = new PizzaTable($tableGateway);
        }

        parent::setUp();
    }

    /**
     * Returns the test database connection.
     *
     * @return PHPUnit_Extensions_Database_DB_IDatabaseConnection
     */
    protected function getConnection()
    {
        if (!$this->connection) {
            $this->connection = $this->createDefaultDBConnection(
                $this->adapter->getDriver()->getConnection()->getResource(
                ),
                'vote-my-pizza-test'
            );
        }

        return $this->connection;
    }

    /**
     * Returns the test dataset.
     *
     * @return PHPUnit_Extensions_Database_DataSet_IDataSet
     */
    protected function getDataSet()
    {
        return $this->createXmlDataSet(
            __DIR__ . '/assets/pizza-test-data.xml'
        );
    }

    /**
     * Test fetch random pizzas
     */
    public function testFetchRandomPizzas()
    {
        $randomPizzas = $this->pizzaTable->fetchRandomPizzas(3);

        $queryTable = $this->getConnection()->createQueryTable(
            'fetchAllPizzas', 'SELECT * FROM pizza ORDER BY id;'
        );

        $allPizzas = [];

        for ($key = 0; $key < $queryTable->getRowCount(); $key++) {
            $pizza = $queryTable->getRow($key);

            $allPizzas[$pizza['id']] = $pizza;
        }

        foreach ($randomPizzas as $pizza) {
            $this->assertTrue(
                in_array($pizza['id'], array_keys($allPizzas))
            );
        }
    }

    /**
     * Test fetch pizza by id
     *
     * @param $id
     *
     * @dataProvider providePizzaByIdData
     */
    public function testFetchPizzaById($id)
    {
        $pizzaById = $this->pizzaTable->fetchPizzaById($id);

        $queryTable = $this->getConnection()->createQueryTable(
            'fetchPizzaById',
            'SELECT * FROM pizza WHERE id = "' . $id . '";'
        );

        $this->assertEquals($queryTable->getRow(0), $pizzaById);
    }

    /**
     * Data provider for pizzas sorted tests
     *
     * @return array
     */
    public function providePizzaByIdData()
    {
        return [
            [1],
            [5],
            [9],
            [6],
            [2],
        ];
    }

    /**
     * Test fetch pizzas sorted by rate desc
     *
     * @param $count
     * @param $order
     *
     * @dataProvider providePizzasSortedData
     */
    public function testPizzasSortedByRate($count, $order)
    {
        $sortedPizzas = $this->pizzaTable->fetchPizzasSortedByRate(
            $count, $order
        );

        $queryTable = $this->getConnection()->createQueryTable(
            'fetchAllPizzas',
            'SELECT * FROM pizza ORDER BY rate ' . $order . ' LIMIT ' . $count . ';'
        );

        $this->assertEquals($count, $queryTable->getRowCount());

        foreach ($sortedPizzas as $key => $pizza) {
            $expectedRow = $queryTable->getRow($key);

            $this->assertEquals($expectedRow, $pizza);
        }
    }

    /**
     * Data provider for pizzas sorted tests
     *
     * @return array
     */
    public function providePizzasSortedData()
    {
        return [
            [3, 'DESC'],
            [5, 'ASC'],
        ];
    }

    /**
     * Test increase pos
     *
     * @param $id
     * @param $pos
     * @param $neg
     * @param $rate
     *
     * @dataProvider provideIncreasePosData
     */
    public function testIncreasePos($id, $pos, $neg, $rate)
    {
        $result = $this->pizzaTable->increasePos($id);

        $queryTable = $this->getConnection()->createQueryTable(
            'fetchPizzaById',
            'SELECT * FROM pizza WHERE id = "' . $id . '";'
        );

        $expectedData = $queryTable->getRow(0);

        $this->assertTrue($result);
        $this->assertEquals($pos, $expectedData['pos']);
        $this->assertEquals($neg, $expectedData['neg']);
        $this->assertEquals($rate, $expectedData['rate']);
    }

    /**
     * Data provider for increase pos tests
     *
     * @return array
     */
    public function provideIncreasePosData()
    {
        return [
            [1, 11, 3, 0.7857],
            [5, 7, 7, 0.5000],
            [9, 7, 8, 0.4667],
            [6, 3, 9, 0.2500],
            [2, 13, 5, 0.7222],
        ];
    }

    /**
     * Test increase neg
     *
     * @param $id
     * @param $pos
     * @param $neg
     * @param $rate
     *
     * @dataProvider provideIncreaseNegData
     */
    public function testIncreaseNeg($id, $pos, $neg, $rate)
    {
        $result = $this->pizzaTable->increaseNeg($id);

        $queryTable = $this->getConnection()->createQueryTable(
            'fetchPizzaById',
            'SELECT * FROM pizza WHERE id = "' . $id . '";'
        );

        $expectedData = $queryTable->getRow(0);

        $this->assertTrue($result);
        $this->assertEquals($pos, $expectedData['pos']);
        $this->assertEquals($neg, $expectedData['neg']);
        $this->assertEquals($rate, $expectedData['rate']);
    }

    /**
     * Data provider for increase neg tests
     *
     * @return array
     */
    public function provideIncreaseNegData()
    {
        return [
            [1, 10, 4, 0.7143],
            [5, 6, 8, 0.4286],
            [9, 6, 9, 0.4000],
            [6, 2, 10, 0.1667],
            [2, 12, 6, 0.6667],
        ];
    }
}
