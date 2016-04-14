<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/vote-my-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace PizzaTest\Action;

use Pizza\Action\DeleteRestaurantAction;
use Pizza\Action\DeleteRestaurantFactory;

/**
 * Class DeleteRestaurantFactoryTest
 *
 * @package PizzaTest\Action
 */
class DeleteRestaurantFactoryTest extends AbstractTest
{
    /**
     * Setup test cases
     */
    public function setUp()
    {
        $this->mockRouter();
        $this->mockRestaurantRepository();
        $this->mockDiContainer();
    }

    /**
     * Test factory with all dependencies
     */
    public function testFactoryWithAllDependencies()
    {
        $this->prepareDiContainer(['router', 'restaurantRepository']);

        $factory = new DeleteRestaurantFactory();

        $this->assertTrue($factory instanceof DeleteRestaurantFactory);

        /** @var DeleteRestaurantAction $action */
        $action = $factory($this->container->reveal());

        $this->assertTrue($action instanceof DeleteRestaurantAction);

        $this->assertAttributeEquals(
            $this->router->reveal(), 'router', $action
        );

        $this->assertAttributeEquals(
            $this->restaurantRepository->reveal(),
            'restaurantRepository',
            $action
        );
    }
}
