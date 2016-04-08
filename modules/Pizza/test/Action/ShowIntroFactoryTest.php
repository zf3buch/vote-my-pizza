<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/vote-my-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace PizzaTest\Action;

use Pizza\Action\ShowIntroAction;
use Pizza\Action\ShowIntroFactory;

/**
 * Class ShowIntroFactoryTest
 *
 * @package PizzaTest\Action
 */
class ShowIntroFactoryTest extends AbstractTest
{
    /**
     * Setup test cases
     */
    public function setUp()
    {
        $this->mockTemplate();
        $this->mockPizzaRepository();
        $this->mockDiContainer();
    }

    /**
     * Test factory with all dependencies
     */
    public function testFactoryWithAllDependencies()
    {
        $this->prepareDiContainer(['template', 'pizzaRepository']);

        $factory = new ShowIntroFactory();

        $this->assertTrue($factory instanceof ShowIntroFactory);

        /** @var ShowIntroAction $action */
        $action = $factory($this->container->reveal());

        $this->assertTrue($action instanceof ShowIntroAction);
    }
}
