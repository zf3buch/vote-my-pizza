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
use Pizza\Model\Table\RestaurantTable;
use Pizza\Model\Table\RestaurantTableInterface;
use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

/**
 * Class RestaurantTableTest
 *
 * @package PizzaTest\Model\Table
 */
class RestaurantTableTest extends PHPUnit_Extensions_Database_TestCase
{
    /**
     * @var RestaurantTableInterface
     */
    private $restaurantTable;

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
        if (!$this->restaurantTable) {
            $dbConfig = include __DIR__
                . '/../../../../../config/autoload/database.test.php';

            $this->adapter = new Adapter($dbConfig['db']);

            $resultSet = new ResultSet(ResultSet::TYPE_ARRAY);

            $tableGateway = new TableGateway(
                'restaurant', $this->adapter, null, $resultSet
            );

            $this->restaurantTable = new RestaurantTable($tableGateway);
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
            __DIR__ . '/assets/restaurant-test-data.xml'
        );
    }

    /**
     * Test fetch restaurants by pizza
     *
     * @param $pizzaId
     *
     * @dataProvider provideRestaurantsByPizzaData
     */
    public function testFetchRestaurantsByPizza($pizzaId)
    {
        $restaurants = $this->restaurantTable->fetchRestaurantsByPizza(
            $pizzaId
        );

        $queryTable = $this->getConnection()->createQueryTable(
            'fetchAllRestaurants',
            'SELECT * FROM restaurant WHERE pizza = "' . $pizzaId . '";'
        );

        $allRestaurants = [];

        for ($key = 0; $key < $queryTable->getRowCount(); $key++) {
            $restaurant = $queryTable->getRow($key);

            $allRestaurants[] = $restaurant;
        }

        foreach ($restaurants as $key => $restaurant) {
            $this->assertEquals($restaurant, $allRestaurants[$key]);
        }
    }

    /**
     * Data provider for Restaurants sorted tests
     *
     * @return array
     */
    public function provideRestaurantsByPizzaData()
    {
        return [
            [1],
            [6],
            [9],
            [3],
            [2],
        ];
    }

    /**
     * Test save restaurant
     *
     * @param $data
     *
     * @dataProvider provideSaveRestaurantData
     */
    public function testSaveRestaurant($data)
    {
        $result = $this->restaurantTable->saveRestaurant($data);

        $queryTable = $this->getConnection()->createQueryTable(
            'fetchPizzaById',
            'SELECT * FROM restaurant WHERE id = "' . $data['id'] . '";'
        );

        $expectedData = $queryTable->getRow(0);

        $this->assertEquals(1, $result);
        $this->assertEquals($expectedData, $data);
    }

    /**
     * Data provider for save restaurant
     *
     * @return array
     */
    public function provideSaveRestaurantData()
    {
        return [
            [
                [
                    'id'    => '10',
                    'pizza' => '5',
                    'date'  => '2016-04-09 16:46:43',
                    'name'  => 'Test Restaurant',
                    'price' => 6.95,
                ],
            ],
            [
                [
                    'id'    => '11',
                    'pizza' => '6',
                    'date'  => '2016-04-09 16:47:25',
                    'name'  => 'Another Test Restaurant',
                    'price' => 7.95,
                ],
            ],
        ];
    }

    /**
     * Test delete restaurant
     *
     * @param $id
     *
     * @dataProvider provideDeleteRestaurantData
     */
    public function testDeleteRestaurant($id)
    {
        $queryTable = $this->getConnection()->createQueryTable(
            'fetchPizzaById',
            'SELECT * FROM restaurant WHERE id = "' . $id . '";'
        );

        $this->assertEquals(1, $queryTable->getRowCount());

        $result = $this->restaurantTable->deleteRestaurant($id);

        $this->assertEquals(1, $result);

        $queryTable = $this->getConnection()->createQueryTable(
            'fetchPizzaById',
            'SELECT * FROM restaurant WHERE id = "' . $id . '";'
        );

        $this->assertEquals(0, $queryTable->getRowCount());
    }

    /**
     * Data provider for delete restaurant tests
     *
     * @return array
     */
    public function provideDeleteRestaurantData()
    {
        return [
            [1],
            [5],
            [9],
            [6],
            [2],
        ];
    }
}
