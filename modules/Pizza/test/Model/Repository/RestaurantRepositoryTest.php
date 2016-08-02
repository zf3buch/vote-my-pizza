<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/vote-my-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace Pizza\Model\Repository;

/**
 * Overwrite date
 *
 * @param string $format
 *
 * @return string
 */
function date($format)
{
    return \date($format, mktime(15, 39, 33, 4, 13, 2016));
}

namespace PizzaTest\Model\Repository;

use PHPUnit_Framework_TestCase;
use Pizza\Model\Repository\RestaurantRepository;
use Pizza\Model\Repository\RestaurantRepositoryInterface;
use Pizza\Model\Storage\RestaurantStorageInterface;

/**
 * Class RestaurantRepositoryTest
 *
 * @package PizzaTest\Model\Repository
 */
class RestaurantRepositoryTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var RestaurantRepositoryInterface
     */
    private $restaurantRepository;

    /**
     * @var RestaurantStorageInterface
     */
    private $restaurantStorage;

    /**
     * Sets up the test
     */
    protected function setUp()
    {
        $this->restaurantStorage = $this->prophesize(
            RestaurantStorageInterface::class
        );

        $this->restaurantRepository = new RestaurantRepository(
            $this->restaurantStorage->reveal()
        );
    }

    /**
     * Test save restaurant with data
     */
    public function testSaveRestaurantWithData()
    {
        $id   = '1';
        $data = [
            'name'  => 'Test Restaurant',
            'price' => 7.95,
        ];

        $insertData = [
            'pizza' => $id,
            'date'  => date(
                'Y-m-d H:i:s', mktime(15, 39, 33, 4, 13, 2016)
            ),
            'name'  => $data['name'],
            'price' => $data['price'],
        ];

        $this->restaurantStorage->saveRestaurant($insertData)
            ->willReturn(true)->shouldBeCalled();

        $this->assertTrue(
            $this->restaurantRepository->saveRestaurant($id, $data)
        );
    }

    /**
     * Test save restaurant with empty data
     */
    public function testSaveRestaurantWithEmptyData()
    {
        $id   = '1';
        $data = [];

        $insertData = [
            'pizza' => $id,
            'date'  => date(
                'Y-m-d H:i:s', mktime(15, 39, 33, 4, 13, 2016)
            ),
            'name'  => 'unbekannt',
            'price' => 0.00,
        ];

        $this->restaurantStorage->saveRestaurant($insertData)
            ->willReturn(true)->shouldBeCalled();

        $this->assertTrue(
            $this->restaurantRepository->saveRestaurant($id, $data)
        );
    }

    /**
     * Test save restaurant failed
     */
    public function testSaveRestaurantFailed()
    {
        $id   = '1';
        $data = [];

        $insertData = [
            'pizza' => $id,
            'date'  => date(
                'Y-m-d H:i:s', mktime(15, 39, 33, 4, 13, 2016)
            ),
            'name'  => 'unbekannt',
            'price' => 0.00,
        ];

        $this->restaurantStorage->saveRestaurant($insertData)
            ->willReturn(false)->shouldBeCalled();

        $this->assertFalse(
            $this->restaurantRepository->saveRestaurant($id, $data)
        );
    }

    /**
     * Test delete restaurant success
     */
    public function testDeleteRestaurantSuccess()
    {
        $id = '1';

        $this->restaurantStorage->deleteRestaurant($id)
            ->willReturn(true)->shouldBeCalled();

        $this->assertTrue(
            $this->restaurantRepository->deleteRestaurant($id)
        );
    }

    /**
     * Test delete restaurant failed
     */
    public function testDeleteRestaurantFailed()
    {
        $id = '1';

        $this->restaurantStorage->deleteRestaurant($id)->willReturn(false)
            ->shouldBeCalled();

        $this->assertFalse(
            $this->restaurantRepository->deleteRestaurant($id)
        );
    }
}
