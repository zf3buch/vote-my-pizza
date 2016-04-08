<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/vote-my-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace UserTest\Action;

use User\Action\HandleRegisterAction;
use User\Action\HandleRegisterFactory;

/**
 * Class HandleRegisterFactoryTest
 *
 * @package UserTest\Action
 */
class HandleRegisterFactoryTest extends AbstractTest
{
    /**
     * Setup test cases
     */
    public function setUp()
    {
        $this->mockRouter();
        $this->mockUserRepository();
        $this->mockRegisterForm();
        $this->mockDiContainer();
    }

    /**
     * Test factory with all dependencies
     */
    public function testFactoryWithAllDependencies()
    {
        $this->prepareDiContainer(
            ['router', 'userRepository', 'registerForm']
        );

        $factory = new HandleRegisterFactory();

        $this->assertTrue($factory instanceof HandleRegisterFactory);

        /** @var HandleRegisterAction $action */
        $action = $factory($this->container->reveal());

        $this->assertTrue($action instanceof HandleRegisterAction);
    }
}
