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
use Pizza\Form\RestaurantPriceForm;
use Pizza\Model\Repository\PizzaRepositoryInterface;
use Pizza\Model\Repository\RestaurantRepositoryInterface;
use Prophecy\Prophecy\MethodProphecy;
use Zend\Diactoros\Response;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

/**
 * Class AbstractTest
 *
 * @package PizzaTest\Action
 */
abstract class AbstractTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @var TemplateRendererInterface
     */
    protected $template;

    /**
     * @var RouterInterface
     */
    protected $router;

    /**
     * @var PizzaRepositoryInterface
     */
    protected $pizzaRepository;

    /**
     * @var RestaurantRepositoryInterface
     */
    protected $restaurantRepository;

    /**
     * @var RestaurantPriceForm
     */
    protected $restaurantPriceForm;

    /**
     * Mock DI container
     */
    protected function mockDiContainer()
    {
        $this->container = $this->prophesize(ContainerInterface::class);
    }

    /**
     * Mock template
     */
    protected function mockTemplate()
    {
        $this->template = $this->prophesize(
            TemplateRendererInterface::class
        );
    }

    /**
     * Mock router
     */
    protected function mockRouter()
    {
        $this->router = $this->prophesize(RouterInterface::class);
    }

    /**
     * Mock pizza repository
     */
    protected function mockPizzaRepository()
    {
        $this->pizzaRepository = $this->prophesize(
            PizzaRepositoryInterface::class
        );
    }

    /**
     * Mock restaurant repository
     */
    protected function mockRestaurantRepository()
    {
        $this->restaurantRepository = $this->prophesize(
            RestaurantRepositoryInterface::class
        );
    }

    /**
     * Mock restaurant price form
     */
    protected function mockRestaurantPriceForm()
    {
        $this->restaurantPriceForm = $this->prophesize(
            RestaurantPriceForm::class
        );
    }

    /**
     * Prepare DI container
     *
     * @param array $map
     */
    protected function prepareDiContainer($map = [])
    {
        $this->container = $this->prophesize(ContainerInterface::class);

        if (in_array('router', $map)) {
            /** @var MethodProphecy $method */
            $method = $this->container->get(RouterInterface::class);
            $method->willReturn($this->router);
            $method->shouldBeCalled();
        }

        if (in_array('template', $map)) {
            /** @var MethodProphecy $method */
            $method = $this->container->get(
                TemplateRendererInterface::class
            );
            $method->willReturn($this->template);
            $method->shouldBeCalled();
        }

        if (in_array('pizzaRepository', $map)) {
            /** @var MethodProphecy $method */
            $method = $this->container->get(
                PizzaRepositoryInterface::class
            );
            $method->willReturn($this->pizzaRepository);
            $method->shouldBeCalled();
        }

        if (in_array('restaurantRepository', $map)) {
            /** @var MethodProphecy $method */
            $method = $this->container->get(
                RestaurantRepositoryInterface::class
            );
            $method->willReturn($this->restaurantRepository);
            $method->shouldBeCalled();
        }

        if (in_array('restaurantPriceForm', $map)) {
            /** @var MethodProphecy $method */
            $method = $this->container->get(RestaurantPriceForm::class);
            $method->willReturn($this->restaurantPriceForm);
            $method->shouldBeCalled();
        }
    }

    /**
     * Prepare template mock
     *
     * @param string $templateName
     * @param array  $templateVars
     */
    protected function prepareRenderer($templateName, $templateVars)
    {
        /** @var MethodProphecy $method */
        $method = $this->template->render($templateName, $templateVars);
        $method->willReturn('Whatever');
        $method->shouldBeCalled();
    }

    /**
     * Prepare router mock
     *
     * @param string $routeName
     * @param array  $routeParams
     * @param string $uri
     * @param bool   $called
     */
    protected function prepareRouter(
        $routeName,
        $routeParams,
        $uri,
        $called = true
    ) {
        /** @var MethodProphecy $method */
        $method = $this->router->generateUri($routeName, $routeParams);
        $method->willReturn($uri);

        if ($called) {
            $method->shouldBeCalled();
        } else {
            $method->shouldNotBeCalled();
        }
    }
}
