<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/vote-my-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace PizzaTest\Action;

use Pizza\Action\HandleRestaurantAction;
use Pizza\Action\HandleRestaurantFactory;

/**
 * Class HandleRestaurantFactoryTest
 *
 * @package PizzaTest\Action
 */
class HandleRestaurantFactoryTest extends AbstractTest
{
    /**
     * Setup test cases
     */
    public function setUp()
    {
        $this->mockRouter();
        $this->mockRestaurantRepository();
        $this->mockRestaurantPriceForm();
        $this->mockDiContainer();
    }

    /**
     * Test factory with all dependencies
     */
    public function testFactoryWithAllDependencies()
    {
        $this->prepareDiContainer(
            ['router', 'restaurantRepository', 'restaurantPriceForm']
        );

        $factory = new HandleRestaurantFactory();

        /** @var HandleRestaurantAction $action */
        $action = $factory($this->container->reveal());

        $this->assertTrue($action instanceof HandleRestaurantAction);

        $this->assertAttributeEquals(
            $this->router->reveal(), 'router', $action
        );

        $this->assertAttributeEquals(
            $this->restaurantRepository->reveal(),
            'restaurantRepository',
            $action
        );

        $this->assertAttributeEquals(
            $this->restaurantPriceForm->reveal(),
            'restaurantPriceForm',
            $action
        );
    }
}
