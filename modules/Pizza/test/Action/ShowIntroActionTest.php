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
use Prophecy\Prophecy\MethodProphecy;
use Zend\Diactoros\Response;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\ServerRequest;

/**
 * Class ShowIntroActionTest
 *
 * @package PizzaTest\Action
 */
class ShowIntroActionTest extends AbstractTest
{
    /**
     * Prepare pizza repository
     *
     * @param $topPizzas
     * @param $flopPizzas
     */
    protected function preparePizzaRepostory($topPizzas, $flopPizzas)
    {
        $this->pizzaRepository->getTopPizzas()->willReturn($topPizzas)
            ->shouldBeCalled();

        $this->pizzaRepository->getFlopPizzas()->willReturn($flopPizzas)
            ->shouldBeCalled();
    }

    /**
     * Setup test cases
     */
    public function setUp()
    {
        $this->mockTemplate();
        $this->mockPizzaRepository();
    }

    /**
     * Test Response object
     */
    public function testResponse()
    {
        $lang         = 'de';
        $topPizzas    = ['1' => 'Pizza A', '2' => 'Pizza B'];
        $flopPizzas   = ['3' => 'Pizza C', '4' => 'Pizza D'];
        $templateVars = [
            'welcome'    => 'pizza_heading_welcome',
            'topPizzas'  => $topPizzas,
            'flopPizzas' => $flopPizzas,
        ];
        $templateName = 'pizza::intro';
        $requestUri   = '/' . $lang;

        $this->prepareRenderer($templateName, $templateVars);
        $this->preparePizzaRepostory($topPizzas, $flopPizzas);

        $action = new ShowIntroAction();
        $action->setTemplateRenderer($this->template->reveal());
        $action->setPizzaRepository($this->pizzaRepository->reveal());

        $serverRequest = new ServerRequest([$requestUri]);

        $serverResponse = new Response();

        /** @var HtmlResponse $response */
        $response = $action($serverRequest, $serverResponse);

        $this->assertTrue($response instanceof HtmlResponse);
    }
}
