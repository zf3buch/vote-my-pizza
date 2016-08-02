<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/vote-my-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace PizzaTest\Action;

use Pizza\Action\HandleVotingAction;
use Prophecy\Prophecy\MethodProphecy;
use Zend\Diactoros\Response;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Diactoros\ServerRequest;

/**
 * Class HandleVotingActionTest
 *
 * @package PizzaTest\Action
 */
class HandleVotingActionTest extends AbstractTest
{
    /**
     * Prepare pizza repository
     *
     * @param $pos
     * @param $neg
     */
    protected function preparePizzaRepository($pos, $neg)
    {
        $this->pizzaRepository->saveVoting($pos, $neg)->shouldBeCalled();
    }

    /**
     * Setup test cases
     */
    public function setUp()
    {
        $this->mockRouter();
        $this->mockPizzaRepository();
    }

    /**
     * Test Response object
     */
    public function testResponse()
    {
        $lang        = 'de';
        $pos         = 1;
        $neg         = 2;
        $uri         = '/' . $lang . '/pizza/voting';
        $routeParams = [
            'lang' => $lang,
        ];
        $routeName   = 'pizza-voting';
        $requestUri  = '/' . $lang . '/pizza/voting/' . $pos . '/' . $neg;

        $this->prepareRouter($routeName, $routeParams, $uri);
        $this->preparePizzaRepository($pos, $neg);

        $action = new HandleVotingAction();
        $action->setRouter($this->router->reveal());
        $action->setPizzaRepository(
            $this->pizzaRepository->reveal()
        );

        $serverRequest = new ServerRequest([$requestUri]);
        $serverRequest = $serverRequest->withAttribute('lang', $lang);
        $serverRequest = $serverRequest->withAttribute('pos', $pos);
        $serverRequest = $serverRequest->withAttribute('neg', $neg);

        $serverResponse = new Response();

        /** @var RedirectResponse $response */
        $response = $action($serverRequest, $serverResponse);

        $this->assertTrue($response instanceof RedirectResponse);
        $this->assertEquals([$uri], $response->getHeader('location'));
    }
}
