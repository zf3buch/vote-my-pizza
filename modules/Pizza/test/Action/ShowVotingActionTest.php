<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/vote-my-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace PizzaTest\Action;

use PHPUnit_Framework_TestCase;
use Pizza\Action\ShowVotingAction;
use Pizza\Model\Repository\PizzaRepositoryInterface;
use Prophecy\Prophecy\MethodProphecy;
use Zend\Diactoros\Response;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\ServerRequest;
use Zend\Expressive\Template\TemplateRendererInterface;

/**
 * Class ShowVotingActionTest
 *
 * @package PizzaTest\Action
 */
class ShowVotingActionTest extends PHPUnit_Framework_TestCase
{
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
    }

    /**
     * Test Response object
     */
    public function testResponse()
    {
        $votingPizzas = ['1' => 'Pizza A', '2' => 'Pizza B'];
        $data         = [
            'title'  => 'pizza_heading_voting',
            'pizzas' => $votingPizzas,
        ];

        /** @var MethodProphecy $renderMethod */
        $renderMethod = $this->template->render('pizza::voting', $data);
        $renderMethod->willReturn('Whatever');
        $renderMethod->shouldBeCalled();

        /** @var MethodProphecy $getVotingPizzasMethod */
        $getVotingPizzasMethod = $this->pizzaRepository->getPizzasForVoting(
        );
        $getVotingPizzasMethod->willReturn($votingPizzas);
        $getVotingPizzasMethod->shouldBeCalled();

        $action = new ShowVotingAction();
        $action->setTemplateRenderer($this->template->reveal());
        $action->setPizzaRepository($this->pizzaRepository->reveal());

        /** @var HtmlResponse $response */
        $response = $action(
            new ServerRequest(['/de/pizza/voting']), new Response()
        );

        $this->assertTrue($response instanceof HtmlResponse);
    }
}
