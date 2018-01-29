<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/vote-my-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace PizzaTest\Action;

use Pizza\Action\ShowVotingAction;
use Pizza\Action\ShowVotingFactory;

/**
 * Class ShowVotingFactoryTest
 *
 * @package PizzaTest\Action
 */
class ShowVotingFactoryTest extends AbstractTest
{
    /**
     * Setup test cases
     */
    public function setUp()
    {
        $this->mockRenderer();
        $this->mockPizzaRepository();
        $this->mockDiContainer();
    }

    /**
     * Test factory with all dependencies
     */
    public function testFactoryWithAllDependencies()
    {
        $this->prepareDiContainer(['renderer', 'pizzaRepository']);

        $factory = new ShowVotingFactory();

        /** @var ShowVotingAction $action */
        $action = $factory($this->container->reveal());

        $this->assertTrue($action instanceof ShowVotingAction);

        $this->assertAttributeEquals(
            $this->renderer->reveal(), 'renderer', $action
        );

        $this->assertAttributeEquals(
            $this->pizzaRepository->reveal(),
            'pizzaRepository',
            $action
        );
    }
}