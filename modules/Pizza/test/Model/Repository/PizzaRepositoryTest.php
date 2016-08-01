<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/vote-my-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace PizzaTest\Model\Repository;

use PHPUnit_Framework_TestCase;
use Pizza\Model\Repository\PizzaRepository;
use Pizza\Model\Repository\PizzaRepositoryInterface;
use Pizza\Model\Storage\PizzaStorageInterface;
use Pizza\Model\Storage\RestaurantStorageInterface;
use Prophecy\Prophecy\MethodProphecy;

/**
 * Class PizzaRepositoryTest
 *
 * @package PizzaTest\Model\Repository
 */
class PizzaRepositoryTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var PizzaRepositoryInterface
     */
    private $pizzaRepository;

    /**
     * @var PizzaStorageInterface
     */
    private $pizzaStorage;

    /**
     * @var RestaurantStorageInterface
     */
    private $restaurantStorage;

    /**
     * @var array
     */
    private $pizzaData = [
        [
            'id'    => '1',
            'name'  => 'Pizza Test',
            'image' => '/path/to/image/1.png',
            'pos'   => 10,
            'neg'   => 10,
            'rate'  => 0.5,
        ],
        [
            'id'    => '2',
            'name'  => 'Pizza Another Test',
            'image' => '/path/to/image/2.png',
            'pos'   => 15,
            'neg'   => 5,
            'rate'  => 0.75,
        ],
        [
            'id'    => '3',
            'name'  => 'Pizza Third Test',
            'image' => '/path/to/image/3.png',
            'pos'   => 5,
            'neg'   => 15,
            'rate'  => 0.25,
        ],
    ];

    /**
     * @var array
     */
    private $restaurantData = [
        '1' => [
            [
                'id'    => '1',
                'pizza' => '1',
                'date'  => '2016-04-08 15:45:11',
                'name'  => 'Test Restaurant',
                'price' => 7.95,
            ],
            [
                'id'    => '3',
                'pizza' => '1',
                'date'  => '2016-04-08 15:45:29',
                'name'  => 'Another Test Restaurant',
                'price' => 8.95,
            ],
        ],
        '2' => [
            [
                'id'    => '2',
                'pizza' => '2',
                'date'  => '2016-04-08 15:45:22',
                'name'  => 'Another Test Restaurant',
                'price' => 8.95,
            ],
        ],
    ];

    /**
     * Sets up the test
     */
    protected function setUp()
    {
        $this->pizzaStorage = $this->prophesize(
            PizzaStorageInterface::class
        );

        $this->restaurantStorage = $this->prophesize(
            RestaurantStorageInterface::class
        );

        $this->pizzaRepository = new PizzaRepository(
            $this->pizzaStorage->reveal(), $this->restaurantStorage->reveal()
        );
    }

    /**
     * Test get pizzas for voting
     */
    public function testGetPizzasForVoting()
    {
        $pizzaData       = array_slice($this->pizzaData, 0, 2);
        $restaurantData1 = $this->restaurantData[$pizzaData[0]['id']];
        $restaurantData2 = $this->restaurantData[$pizzaData[1]['id']];

        $expectedData = [
            'left'  => $pizzaData[0],
            'right' => $pizzaData[1],
        ];

        $expectedData['left']['restaurants']  = $restaurantData1;
        $expectedData['right']['restaurants'] = $restaurantData2;

        /** @var MethodProphecy $method */
        $method = $this->pizzaStorage->fetchRandomPizzas(2);
        $method->willReturn($pizzaData);
        $method->shouldBeCalled();

        /** @var MethodProphecy $method */
        $method = $this->restaurantStorage->fetchRestaurantsByPizza('1');
        $method->willReturn($restaurantData1);
        $method->shouldBeCalled();

        /** @var MethodProphecy $method */
        $method = $this->restaurantStorage->fetchRestaurantsByPizza('2');
        $method->willReturn($restaurantData2);
        $method->shouldBeCalled();

        $this->assertEquals(
            $expectedData, $this->pizzaRepository->getPizzasForVoting()
        );
    }

    /**
     * Test get single pizza
     */
    public function testGetSinglePizza()
    {
        $pizzaData      = $this->pizzaData[0];
        $restaurantData = $this->restaurantData[$pizzaData['id']];

        $expectedData                = $pizzaData;
        $expectedData['restaurants'] = $restaurantData;

        /** @var MethodProphecy $method */
        $method = $this->pizzaStorage->fetchPizzaById($pizzaData['id']);
        $method->willReturn($pizzaData);
        $method->shouldBeCalled();

        /** @var MethodProphecy $method */
        $method = $this->restaurantStorage->fetchRestaurantsByPizza(
            $pizzaData['id']
        );
        $method->willReturn($restaurantData);
        $method->shouldBeCalled();

        $this->assertEquals(
            $expectedData,
            $this->pizzaRepository->getSinglePizza($pizzaData['id'])
        );
    }

    /**
     * Test get top pizzas
     */
    public function testGetTopPizzas()
    {
        $pizzaData = $this->pizzaData;
        krsort($pizzaData);

        $expectedData = $pizzaData;

        /** @var MethodProphecy $method */
        $method = $this->pizzaStorage->fetchPizzasSortedByRate(3, 'DESC');
        $method->willReturn($pizzaData);
        $method->shouldBeCalled();

        $this->assertEquals(
            $expectedData,
            $this->pizzaRepository->getTopPizzas()
        );
    }

    /**
     * Test get flop pizzas
     */
    public function testGetFlopPizzas()
    {
        $pizzaData = $this->pizzaData;
        rsort($pizzaData);

        $expectedData = $pizzaData;

        /** @var MethodProphecy $method */
        $method = $this->pizzaStorage->fetchPizzasSortedByRate(3, 'ASC');
        $method->willReturn($pizzaData);
        $method->shouldBeCalled();

        $this->assertEquals(
            $expectedData,
            $this->pizzaRepository->getFlopPizzas()
        );
    }

    /**
     * Test save voting
     */
    public function testSaveVoting()
    {
        $pos = $this->pizzaData[0];
        $neg = $this->pizzaData[1];

        /** @var MethodProphecy $method */
        $method = $this->pizzaStorage->increasePos($pos);
        $method->shouldBeCalled();

        /** @var MethodProphecy $method */
        $method = $this->pizzaStorage->increaseNeg($neg);
        $method->shouldBeCalled();

        $this->assertTrue($this->pizzaRepository->saveVoting($pos, $neg));
    }
}
