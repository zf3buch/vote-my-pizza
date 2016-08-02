<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/vote-my-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace PizzaTest\Action;

use Pizza\Action\HandleRestaurantAction;
use Prophecy\Prophecy\MethodProphecy;
use Zend\Diactoros\Response;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Diactoros\ServerRequest;

/**
 * Class HandleRestaurantActionTest
 *
 * @package PizzaTest\Action
 */
class HandleRestaurantActionTest extends AbstractTest
{
    /**
     * Prepare restaurant price form
     *
     * @param array      $setData
     * @param array|bool $getData
     * @param bool       $isValidReturn
     */
    protected function prepareRestaurantPriceForm(
        $setData,
        $getData,
        $isValidReturn = true
    ) {
        $this->restaurantPriceForm->setData($setData)->shouldBeCalled();

        if ($getData) {
            $this->restaurantPriceForm->getData()->willReturn($getData)
                ->shouldBeCalled();
        } else {
            $this->restaurantPriceForm->getData()->shouldNotBeCalled();
        }

        $this->restaurantPriceForm->isValid()
            ->willReturn($isValidReturn)->shouldBeCalled();
    }

    /**
     * Prepare restaurant repository
     *
     * @param string $id
     * @param array  $postData
     * @param bool   $called
     */
    protected function prepareRestaurantRepository(
        $id,
        $postData,
        $called = true
    ) {
        /** @var MethodProphecy $method */
        $method = $this->restaurantRepository->saveRestaurant(
            $id, $postData
        );

        if ($called) {
            $method->shouldBeCalled();
        }
    }

    /**
     * Setup test cases
     */
    public function setUp()
    {
        $this->mockRouter();
        $this->mockRestaurantRepository();
        $this->mockRestaurantPriceForm();
    }

    /**
     * Test Response object
     */
    public function testResponseWithValidData()
    {
        $lang        = 'de';
        $id          = 1;
        $uri         = '/' . $lang . '/pizza/show/' . $id;
        $routeParams = [
            'id'   => $id,
            'lang' => $lang,
        ];
        $routeName   = 'pizza-show';
        $requestUri  = '/';
        $postData    = [
            'name'       => 'Name',
            'price'      => 'price',
            'save_price' => 'save_price',
        ];

        $this->prepareRouter($routeName, $routeParams, $uri);
        $this->prepareRestaurantPriceForm($postData, $postData, true);
        $this->prepareRestaurantRepository($id, $postData);

        $action = new HandleRestaurantAction();
        $action->setRouter($this->router->reveal());
        $action->setRestaurantRepository(
            $this->restaurantRepository->reveal()
        );
        $action->setRestaurantPriceForm(
            $this->restaurantPriceForm->reveal()
        );

        $serverRequest = new ServerRequest([$requestUri]);
        $serverRequest = $serverRequest->withParsedBody($postData);
        $serverRequest = $serverRequest->withAttribute('lang', $lang);
        $serverRequest = $serverRequest->withAttribute('id', $id);

        /** @var RedirectResponse $response */
        $response = $action(
            $serverRequest, new Response()
        );

        $this->assertTrue($response instanceof RedirectResponse);
        $this->assertEquals([$uri], $response->getHeader('location'));
    }

    /**
     * Test Response object
     */
    public function testResponseWithInvalidData()
    {
        $lang        = 'de';
        $id          = 1;
        $uri         = '/' . $lang . '/pizza/show/' . $id;
        $routeParams = [
            'id'   => $id,
            'lang' => $lang,
        ];
        $routeName   = 'pizza-show';
        $postData    = [
            'name'       => 'Name',
            'price'      => 'price',
            'save_price' => 'save_price',
        ];
        $requestUri  = '/' . $lang . '/pizza/restaurant/' . $id;

        $this->prepareRouter($routeName, $routeParams, $uri, false);
        $this->prepareRestaurantPriceForm($postData, false, false);
        $this->prepareRestaurantRepository($id, $postData, false);

        $this->restaurantPriceForm->getData()->shouldNotBeCalled();
        $this->restaurantPriceForm->isValid()->willReturn(false)
            ->shouldBeCalled();

        $action = new HandleRestaurantAction();
        $action->setRouter($this->router->reveal());
        $action->setRestaurantRepository(
            $this->restaurantRepository->reveal()
        );
        $action->setRestaurantPriceForm(
            $this->restaurantPriceForm->reveal()
        );

        $serverRequest = new ServerRequest([$requestUri]);
        $serverRequest = $serverRequest->withParsedBody($postData);
        $serverRequest = $serverRequest->withAttribute('lang', $lang);
        $serverRequest = $serverRequest->withAttribute('id', $id);

        $serverResponse = new Response();

        $next = function ($serverRequest, $serverResponse) {
            return md5(
                serialize($serverRequest) . serialize($serverResponse)
            );
        };

        /** @var RedirectResponse $response */
        $response = $action(
            $serverRequest, $serverResponse, $next
        );

        $this->assertEquals(
            $next($serverRequest, $serverResponse), $response
        );
    }
}
