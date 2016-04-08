<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/vote-my-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace PizzaTest\Action;

use Pizza\Action\DeleteRestaurantAction;
use Prophecy\Prophecy\MethodProphecy;
use Zend\Diactoros\Response;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Diactoros\ServerRequest;

/**
 * Class DeleteRestaurantActionTest
 *
 * @package PizzaTest\Action
 */
class DeleteRestaurantActionTest extends AbstractTest
{
    /**
     * Prepare restaurant repository
     *
     * @param $priceId
     */
    protected function prepareRestaurantRepository($priceId)
    {
        /** @var MethodProphecy $deleteMethod */
        $deleteMethod = $this->restaurantRepository->deleteRestaurant(
            $priceId
        );
        $deleteMethod->shouldBeCalled();
    }

    /**
     * Setup test cases
     */
    public function setUp()
    {
        $this->mockRouter();
        $this->mockRestaurantRepository();
    }

    /**
     * Test Response object
     */
    public function testResponse()
    {
        $lang        = 'de';
        $id          = 1;
        $priceId     = 2;
        $uri         = '/' . $lang . '/pizza/show/' . $id;
        $routeParams = [
            'id'   => $id,
            'lang' => $lang,
        ];
        $routeName   = 'pizza-show';
        $requestUri  = '/' . $lang . '/pizza/restaurant/' . $id
            . '/delete/' . $priceId;

        $this->prepareRouter($routeName, $routeParams, $uri);
        $this->prepareRestaurantRepository($priceId);

        $action = new DeleteRestaurantAction();
        $action->setRouter($this->router->reveal());
        $action->setRestaurantRepository(
            $this->restaurantRepository->reveal()
        );

        $serverRequest = new ServerRequest([$requestUri]);
        $serverRequest = $serverRequest->withAttribute('lang', $lang);
        $serverRequest = $serverRequest->withAttribute('id', $id);
        $serverRequest = $serverRequest->withAttribute(
            'priceId', $priceId
        );

        $serverResponse = new Response();

        /** @var RedirectResponse $response */
        $response = $action($serverRequest, $serverResponse);

        $this->assertTrue($response instanceof RedirectResponse);
        $this->assertEquals([$uri], $response->getHeader('location'));
    }
}
