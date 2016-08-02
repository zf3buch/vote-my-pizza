<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/vote-my-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace PizzaTest\Action;

use Pizza\Action\ShowVotingAction;
use Pizza\Model\Repository\PizzaRepositoryInterface;
use Prophecy\Prophecy\MethodProphecy;
use Zend\Diactoros\Response;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\ServerRequest;

/**
 * Class ShowVotingActionTest
 *
 * @package PizzaTest\Action
 */
class ShowVotingActionTest extends AbstractTest
{
    /**
     * Prepare pizza repository
     *
     * @param $votingPizzas
     */
    protected function preparePizzaRepository($votingPizzas)
    {
        $this->pizzaRepository->getPizzasForVoting()
            ->willReturn($votingPizzas)->shouldBeCalled();
    }

    /**
     * Sets up the test
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
        $votingPizzas = ['1' => 'Pizza A', '2' => 'Pizza B'];
        $templateVars = [
            'title'  => 'pizza_heading_voting',
            'pizzas' => $votingPizzas,
        ];
        $templateName = 'pizza::voting';
        $requestUri   = '/' . $lang . '/pizza/voting';

        $this->prepareRenderer($templateName, $templateVars);
        $this->preparePizzaRepository($votingPizzas);

        $action = new ShowVotingAction();
        $action->setTemplateRenderer($this->template->reveal());
        $action->setPizzaRepository($this->pizzaRepository->reveal());

        $serverRequest = new ServerRequest([$requestUri]);

        $serverResponse = new Response();

        /** @var HtmlResponse $response */
        $response = $action($serverRequest, $serverResponse);

        $this->assertTrue($response instanceof HtmlResponse);
    }
}
