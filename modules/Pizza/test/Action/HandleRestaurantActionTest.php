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
use Pizza\Action\HandleRestaurantAction;
use Pizza\Form\RestaurantPriceForm;
use Pizza\Model\Repository\RestaurantRepositoryInterface;
use Prophecy\Prophecy\MethodProphecy;
use Zend\Diactoros\Response;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Diactoros\ServerRequest;
use Zend\Expressive\Router\RouterInterface;

/**
 * Class HandleRestaurantActionTest
 *
 * @package PizzaTest\Action
 */
class HandleRestaurantActionTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * @var RestaurantRepositoryInterface
     */
    private $restaurantRepository;

    /**
     * @var RestaurantPriceForm
     */
    private $restaurantPriceForm;

    /**
     * Setup test cases
     */
    public function setUp()
    {
        $this->router = $this->prophesize(
            RouterInterface::class
        );

        $this->restaurantRepository = $this->prophesize(
            RestaurantRepositoryInterface::class
        );

        $this->restaurantPriceForm = $this->prophesize(
            RestaurantPriceForm::class
        );
    }

    /**
     * Test Response object
     */
    public function testResponseWithValidData()
    {
        $lang     = 'de';
        $id       = 1;
        $uri      = '/de/pizza/show/' . $id;
        $data     = [
            'id'   => $id,
            'lang' => $lang,
        ];
        $postData = [
            'name'       => 'Name',
            'price'      => 'price',
            'save_price' => 'save_price',
        ];

        /** @var MethodProphecy $generateUriMethod */
        $generateUriMethod = $this->router->generateUri(
            'pizza-show', $data
        );
        $generateUriMethod->willReturn($uri);
        $generateUriMethod->shouldBeCalled();

        /** @var MethodProphecy $setDataMethod */
        $setDataMethod = $this->restaurantPriceForm->setData($postData);
        $setDataMethod->shouldBeCalled();

        /** @var MethodProphecy $getDataMethod */
        $getDataMethod = $this->restaurantPriceForm->getData();
        $getDataMethod->willReturn($postData);
        $getDataMethod->shouldBeCalled();

        /** @var MethodProphecy $isValidMethod */
        $isValidMethod = $this->restaurantPriceForm->isValid();
        $isValidMethod->willReturn(true);
        $isValidMethod->shouldBeCalled();

        /** @var MethodProphecy $saveMethod */
        $saveMethod = $this->restaurantRepository->saveRestaurant(
            $id, $postData
        );
        $saveMethod->shouldBeCalled();

        $action = new HandleRestaurantAction();
        $action->setRouter($this->router->reveal());
        $action->setRestaurantRepository(
            $this->restaurantRepository->reveal()
        );
        $action->setRestaurantPriceForm(
            $this->restaurantPriceForm->reveal()
        );

        $serverRequest = new ServerRequest(['/']);
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
        $lang     = 'de';
        $id       = 1;
        $uri      = '/de/pizza/show/' . $id;
        $data     = [
            'id'   => $id,
            'lang' => $lang,
        ];
        $postData = [
            'name'       => 'Name',
            'price'      => 'price',
            'save_price' => 'save_price',
        ];

        /** @var MethodProphecy $generateUriMethod */
        $generateUriMethod = $this->router->generateUri(
            'pizza-show', $data
        );
        $generateUriMethod->willReturn($uri);
        $generateUriMethod->shouldNotBeCalled();

        /** @var MethodProphecy $setDataMethod */
        $setDataMethod = $this->restaurantPriceForm->setData($postData);
        $setDataMethod->shouldBeCalled();

        /** @var MethodProphecy $getDataMethod */
        $getDataMethod = $this->restaurantPriceForm->getData();
        $getDataMethod->shouldNotBeCalled();

        /** @var MethodProphecy $isValidMethod */
        $isValidMethod = $this->restaurantPriceForm->isValid();
        $isValidMethod->willReturn(false);
        $isValidMethod->shouldBeCalled();

        /** @var MethodProphecy $saveMethod */
        $saveMethod = $this->restaurantRepository->saveRestaurant(
            $id, $postData
        );
        $saveMethod->shouldNotBeCalled();

        $action = new HandleRestaurantAction();
        $action->setRouter($this->router->reveal());
        $action->setRestaurantRepository(
            $this->restaurantRepository->reveal()
        );
        $action->setRestaurantPriceForm(
            $this->restaurantPriceForm->reveal()
        );

        $serverRequest = new ServerRequest(['/']);
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
