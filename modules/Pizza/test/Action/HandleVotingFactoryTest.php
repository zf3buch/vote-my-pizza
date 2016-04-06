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
use Pizza\Action\HandleVotingAction;
use Pizza\Action\HandleVotingFactory;
use Pizza\Model\Repository\PizzaRepositoryInterface;
use Prophecy\Exception\Call\UnexpectedCallException;
use Prophecy\Prophecy\MethodProphecy;
use Zend\Expressive\Router\RouterInterface;

/**
 * Class HandleVotingFactoryTest
 *
 * @package PizzaTest\Action
 */
class HandleVotingFactoryTest extends PHPUnit_Framework_TestCase
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
     * @var PizzaRepositoryInterface
     */
    private $pizzaRepository;

    /**
     * Setup test cases
     */
    public function setUp()
    {
        $this->router = $this->prophesize(
            RouterInterface::class
        );

        $this->pizzaRepository = $this->prophesize(
            PizzaRepositoryInterface::class
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

        /** @var MethodProphecy $getRepositoryMethod */
        $getRepositoryMethod = $this->container->get(
            PizzaRepositoryInterface::class
        );
        $getRepositoryMethod->willReturn($this->pizzaRepository);
        $getRepositoryMethod->shouldBeCalled();

        $factory = new HandleVotingFactory();

        $this->assertTrue($factory instanceof HandleVotingFactory);

        /** @var HandleVotingAction $action */
        $action = $factory($this->container->reveal());

        $this->assertTrue($action instanceof HandleVotingAction);
    }

    /**
     * Test factory with router dependency only
     */
    public function testFactoryWithRouterOnly()
    {
        /** @var MethodProphecy $getRouterMethod */
        $getRouterMethod = $this->container->get(RouterInterface::class);
        $getRouterMethod->willReturn($this->router);
        $getRouterMethod->shouldBeCalled();

        $factory = new HandleVotingFactory();

        $this->assertTrue($factory instanceof HandleVotingFactory);

        $this->setExpectedException(UnexpectedCallException::class);

        try {
            $action = $factory($this->container->reveal());
        } catch (UnexpectedCallException $e) {
            throw $e;
        }
    }

    /**
     * Test factory with repository dependency only
     */
    public function testFactoryWithRepositoryOnly()
    {
        /** @var MethodProphecy $getRepositoryMethod */
        $getRepositoryMethod = $this->container->get(
            PizzaRepositoryInterface::class
        );
        $getRepositoryMethod->willReturn($this->pizzaRepository);
        $getRepositoryMethod->shouldNotBeCalled();

        $factory = new HandleVotingFactory();

        $this->assertTrue($factory instanceof HandleVotingFactory);

        $this->setExpectedException(UnexpectedCallException::class);

        try {
            $action = $factory($this->container->reveal());
        } catch (UnexpectedCallException $e) {
            throw $e;
        }
    }
}
