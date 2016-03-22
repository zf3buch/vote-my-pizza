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
use Pizza\Action\ShowPizzaAction;
use Pizza\Action\ShowPizzaFactory;
use Pizza\Form\RestaurantPriceForm;
use Pizza\Model\Repository\PizzaRepositoryInterface;
use Prophecy\Exception\Call\UnexpectedCallException;
use Zend\Expressive\Template\TemplateRendererInterface;

/**
 * Class ShowPizzaFactoryTest
 *
 * @package PizzaTest\Action
 */
class ShowPizzaFactoryTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @var TemplateRendererInterface
     */
    private $template;

    /**
     * @var PizzaRepositoryInterface
     */
    private $pizzaRepository;

    /**
     * @var RestaurantPriceForm
     */
    private $restaurantPriceForm;

    /**
     * Setup test cases
     */
    public function setUp()
    {
        $this->template = $this->prophesize(
            TemplateRendererInterface::class
        );

        $this->pizzaRepository = $this->prophesize(
            PizzaRepositoryInterface::class
        );

        $this->restaurantPriceForm = $this->prophesize(
            RestaurantPriceForm::class
        );

        $this->container = $this->prophesize(ContainerInterface::class);
    }

    /**
     * Test factory with all dependencies
     */
    public function testFactoryWithAllDependencies()
    {
        $this->container->get(TemplateRendererInterface::class)
            ->willReturn($this->template);
        $this->container->get(PizzaRepositoryInterface::class)
            ->willReturn($this->pizzaRepository);
        $this->container->get(RestaurantPriceForm::class)
            ->willReturn($this->restaurantPriceForm);

        $factory = new ShowPizzaFactory();

        $this->assertTrue($factory instanceof ShowPizzaFactory);

        $action = $factory($this->container->reveal());

        $this->assertTrue($action instanceof ShowPizzaAction);
    }

    /**
     * Test factory with template dependency only
     */
    public function testFactoryWithTemplateOnly()
    {
        $this->container->get(TemplateRendererInterface::class)
            ->willReturn($this->template);

        $factory = new ShowPizzaFactory();

        $this->assertTrue($factory instanceof ShowPizzaFactory);

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
        $this->container->get(PizzaRepositoryInterface::class)
            ->willReturn($this->pizzaRepository);

        $factory = new ShowPizzaFactory();

        $this->assertTrue($factory instanceof ShowPizzaFactory);

        $this->setExpectedException(UnexpectedCallException::class);

        try {
            $action = $factory($this->container->reveal());
        } catch (UnexpectedCallException $e) {
            throw $e;
        }
    }

    /**
     * Test factory with form dependency only
     */
    public function testFactoryWithFormOnly()
    {
        $this->container->get(RestaurantPriceForm::class)
            ->willReturn($this->restaurantPriceForm);

        $factory = new ShowPizzaFactory();

        $this->assertTrue($factory instanceof ShowPizzaFactory);

        $this->setExpectedException(UnexpectedCallException::class);

        try {
            $action = $factory($this->container->reveal());
        } catch (UnexpectedCallException $e) {
            throw $e;
        }
    }
}
