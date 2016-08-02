<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/vote-my-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace PizzaTest\Action;

use Pizza\Action\ShowPizzaAction;
use Prophecy\Prophecy\MethodProphecy;
use Zend\Diactoros\Response;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\ServerRequest;

/**
 * Class ShowPizzaActionTest
 *
 * @package PizzaTest\Action
 */
class ShowPizzaActionTest extends AbstractTest
{
    /**
     * Prepare pizza repository
     *
     * @param $id
     * @param $pizza
     */
    protected function preparePizzaRepository($id, $pizza)
    {
        $this->pizzaRepository->getSinglePizza($id)->willReturn($pizza)
            ->shouldBeCalled();
    }

    /**
     * Sets up the test
     */
    public function setUp()
    {
        $this->mockTemplate();
        $this->mockPizzaRepository();
        $this->mockRestaurantPriceForm();
    }

    /**
     * Test Response object
     */
    public function testResponse()
    {
        $lang         = 'de';
        $id           = '1';
        $pizza        = [$id => 'Pizza A'];
        $templateVars = [
            'pizza'               => $pizza,
            'restaurantPriceForm' => $this->restaurantPriceForm,
        ];
        $templateName = 'pizza::show';
        $requestUri   = '/' . $lang . '/pizza/show/' . $id;

        $this->prepareRenderer($templateName, $templateVars);
        $this->preparePizzaRepository($id, $pizza);

        $action = new ShowPizzaAction();
        $action->setTemplateRenderer($this->template->reveal());
        $action->setPizzaRepository($this->pizzaRepository->reveal());
        $action->setRestaurantPriceForm(
            $this->restaurantPriceForm->reveal()
        );

        $serverRequest = new ServerRequest([$requestUri]);
        $serverRequest = $serverRequest->withAttribute('id', $id);

        $serverResponse = new Response();

        /** @var HtmlResponse $response */
        $response = $action($serverRequest, $serverResponse);

        $this->assertTrue($response instanceof HtmlResponse);
    }
}
