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
use Pizza\Action\ShowIntroAction;
use Pizza\Model\Repository\PizzaRepositoryInterface;
use Prophecy\Prophecy\MethodProphecy;
use Zend\Diactoros\Response;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\ServerRequest;
use Zend\Expressive\Template\TemplateRendererInterface;

/**
 * Class ShowIntroActionTest
 *
 * @package PizzaTest\Action
 */
class ShowIntroActionTest extends PHPUnit_Framework_TestCase
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
        $topPizzas  = ['1' => 'Pizza A', '2' => 'Pizza B'];
        $flopPizzas = ['3' => 'Pizza C', '4' => 'Pizza D'];
        $data       = [
            'welcome'    => 'pizza_heading_welcome',
            'topPizzas'  => $topPizzas,
            'flopPizzas' => $flopPizzas,
        ];

        /** @var MethodProphecy $renderMethod */
        $renderMethod = $this->template->render('pizza::intro', $data);
        $renderMethod->willReturn('Whatever');
        $renderMethod->shouldBeCalled();

        /** @var MethodProphecy $getTopPizzasMethod */
        $getTopPizzasMethod = $this->pizzaRepository->getTopPizzas();
        $getTopPizzasMethod->willReturn($topPizzas);
        $getTopPizzasMethod->shouldBeCalled();

        /** @var MethodProphecy $getFlopPizzasMethod */
        $getFlopPizzasMethod = $this->pizzaRepository->getFlopPizzas();
        $getFlopPizzasMethod->willReturn($flopPizzas);
        $getFlopPizzasMethod->shouldBeCalled();

        $action = new ShowIntroAction();
        $action->setTemplateRenderer($this->template->reveal());
        $action->setPizzaRepository($this->pizzaRepository->reveal());

        /** @var HtmlResponse $response */
        $response = $action(
            new ServerRequest(['/de']), new Response()
        );

        $this->assertTrue($response instanceof HtmlResponse);
    }
}
