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
use Pizza\Action\ShowVotingAction;
use Pizza\Action\ShowVotingFactory;
use Pizza\Model\Repository\PizzaRepositoryInterface;
use Prophecy\Exception\Call\UnexpectedCallException;
use Prophecy\Prophecy\MethodProphecy;
use Zend\Expressive\Template\TemplateRendererInterface;

/**
 * Class ShowVotingFactoryTest
 *
 * @package PizzaTest\Action
 */
class ShowVotingFactoryTest extends PHPUnit_Framework_TestCase
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

        $this->container = $this->prophesize(ContainerInterface::class);
    }

    /**
     * Test factory with all dependencies
     */
    public function testFactoryWithAllDependencies()
    {
        /** @var MethodProphecy $getTemplateMethod */
        $getTemplateMethod = $this->container->get(
            TemplateRendererInterface::class
        );
        $getTemplateMethod->willReturn($this->template);
        $getTemplateMethod->shouldBeCalled();

        /** @var MethodProphecy $getRepositoryMethod */
        $getRepositoryMethod = $this->container->get(
            PizzaRepositoryInterface::class
        );
        $getRepositoryMethod->willReturn($this->pizzaRepository);
        $getRepositoryMethod->shouldBeCalled();

        $factory = new ShowVotingFactory();

        $this->assertTrue($factory instanceof ShowVotingFactory);

        /** @var ShowVotingAction $action */
        $action = $factory($this->container->reveal());

        $this->assertTrue($action instanceof ShowVotingAction);
    }

    /**
     * Test factory with template dependency only
     */
    public function testFactoryWithTemplateOnly()
    {
        /** @var MethodProphecy $getTemplateMethod */
        $getTemplateMethod = $this->container->get(
            TemplateRendererInterface::class
        );
        $getTemplateMethod->willReturn($this->template);
        $getTemplateMethod->shouldBeCalled();

        $factory = new ShowVotingFactory();

        $this->assertTrue($factory instanceof ShowVotingFactory);

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

        $factory = new ShowVotingFactory();

        $this->assertTrue($factory instanceof ShowVotingFactory);

        $this->setExpectedException(UnexpectedCallException::class);

        try {
            $action = $factory($this->container->reveal());
        } catch (UnexpectedCallException $e) {
            throw $e;
        }
    }
}
