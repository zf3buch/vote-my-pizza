<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/vote-my-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace PizzaTest\Action;

use Pizza\Action\HandleVotingAction;
use Pizza\Action\HandleVotingFactory;

/**
 * Class HandleVotingFactoryTest
 *
 * @package PizzaTest\Action
 */
class HandleVotingFactoryTest extends AbstractTest
{
    /**
     * Setup test cases
     */
    public function setUp()
    {
        $this->mockRouter();
        $this->mockPizzaRepository();
        $this->mockDiContainer();
    }

    /**
     * Test factory with all dependencies
     */
    public function testFactoryWithAllDependencies()
    {
        $this->mockRouter();
        $this->mockPizzaRepository();
        $this->prepareDiContainer(['router', 'pizzaRepository']);

        $factory = new HandleVotingFactory();

        /** @var HandleVotingAction $action */
        $action = $factory($this->container->reveal());

        $this->assertTrue($action instanceof HandleVotingAction);

        $this->assertAttributeEquals(
            $this->router->reveal(), 'router', $action
        );

        $this->assertAttributeEquals(
            $this->pizzaRepository->reveal(),
            'pizzaRepository',
            $action
        );
    }
}
