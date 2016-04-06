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
use Pizza\Action\DeleteRestaurantAction;
use Pizza\Action\DeleteRestaurantFactory;
use Pizza\Model\Repository\RestaurantRepositoryInterface;
use Prophecy\Exception\Call\UnexpectedCallException;
use Prophecy\Prophecy\MethodProphecy;
use Zend\Expressive\Router\RouterInterface;

/**
 * Class DeleteRestaurantFactoryTest
 *
 * @package PizzaTest\Action
 */
class DeleteRestaurantFactoryTest extends PHPUnit_Framework_TestCase
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
     * @var RestaurantRepositoryInterface
     */
    private $restaurantRepository;

    /**
     * Setup test cases
     */
    public function setUp()
    {
        $this->router = $this->prophesize(
            RouterInterface::class
        );

        $this->restaurantRepository = $this->prophesize(
            RestaurantRepositoryInterface::class
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
            RestaurantRepositoryInterface::class
        );
        $getRepositoryMethod->willReturn($this->restaurantRepository);
        $getRepositoryMethod->shouldBeCalled();

        $factory = new DeleteRestaurantFactory();

        $this->assertTrue($factory instanceof DeleteRestaurantFactory);

        /** @var DeleteRestaurantAction $action */
        $action = $factory($this->container->reveal());

        $this->assertTrue($action instanceof DeleteRestaurantAction);
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

        $factory = new DeleteRestaurantFactory();

        $this->assertTrue($factory instanceof DeleteRestaurantFactory);

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
            RestaurantRepositoryInterface::class
        );
        $getRepositoryMethod->willReturn($this->restaurantRepository);
        $getRepositoryMethod->shouldNotBeCalled();

        $factory = new DeleteRestaurantFactory();

        $this->assertTrue($factory instanceof DeleteRestaurantFactory);

        $this->setExpectedException(UnexpectedCallException::class);

        try {
            $action = $factory($this->container->reveal());
        } catch (UnexpectedCallException $e) {
            throw $e;
        }
    }
}
