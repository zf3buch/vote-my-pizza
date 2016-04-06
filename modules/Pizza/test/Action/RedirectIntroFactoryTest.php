<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/vote-my-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace PizzaTest\Action;

use Interop\Container\ContainerInterface;
use PHPUnit_Framework_TestCase;
use Pizza\Action\RedirectIntroAction;
use Pizza\Action\RedirectIntroFactory;
use Prophecy\Prophecy\MethodProphecy;
use Zend\Expressive\Router\RouterInterface;

/**
 * Class RedirectIntroFactoryTest
 *
 * @package PizzaTest\Action
 */
class RedirectIntroFactoryTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * Setup test cases
     */
    public function setUp()
    {
        $this->router = $this->prophesize(
            RouterInterface::class
        );

        $this->container = $this->prophesize(ContainerInterface::class);
    }

    /**
     * Test factory with all dependencies
     */
    public function testFactoryWithAllDependencies()
    {
        /** @var MethodProphecy $getRouterMethod */
        $getRouterMethod = $this->container->get(RouterInterface::class);
        $getRouterMethod->willReturn($this->router);
        $getRouterMethod->shouldBeCalled();

        $factory = new RedirectIntroFactory();

        $this->assertTrue($factory instanceof RedirectIntroFactory);

        /** @var RedirectIntroAction $action */
        $action = $factory($this->container->reveal());

        $this->assertTrue($action instanceof RedirectIntroAction);
    }
}
