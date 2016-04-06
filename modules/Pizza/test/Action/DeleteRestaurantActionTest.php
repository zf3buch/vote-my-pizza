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
use Pizza\Action\DeleteRestaurantAction;
use Pizza\Model\Repository\RestaurantRepositoryInterface;
use Prophecy\Prophecy\MethodProphecy;
use Zend\Diactoros\Response;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Diactoros\ServerRequest;
use Zend\Expressive\Router\RouterInterface;

/**
 * Class DeleteRestaurantActionTest
 *
 * @package PizzaTest\Action
 */
class DeleteRestaurantActionTest extends PHPUnit_Framework_TestCase
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
    }

    /**
     * Test Response object
     */
    public function testResponse()
    {
        $lang    = 'de';
        $id      = 1;
        $priceId = 2;
        $uri     = '/de/pizza/show/' . $id;
        $data    = [
            'id'   => $id,
            'lang' => $lang,
        ];

        /** @var MethodProphecy $generateUriMethod */
        $generateUriMethod = $this->router->generateUri(
            'pizza-show', $data
        );
        $generateUriMethod->willReturn($uri);
        $generateUriMethod->shouldBeCalled();

        /** @var MethodProphecy $deleteMethod */
        $deleteMethod = $this->restaurantRepository->deleteRestaurant(
            $priceId
        );
        $deleteMethod->shouldBeCalled();

        $action = new DeleteRestaurantAction();
        $action->setRouter($this->router->reveal());
        $action->setRestaurantRepository(
            $this->restaurantRepository->reveal()
        );

        $serverRequest = new ServerRequest(['/']);
        $serverRequest = $serverRequest->withAttribute('lang', $lang);
        $serverRequest = $serverRequest->withAttribute('id', $id);
        $serverRequest = $serverRequest->withAttribute(
            'priceId', $priceId
        );

        /** @var RedirectResponse $response */
        $response = $action(
            $serverRequest, new Response()
        );

        $this->assertTrue($response instanceof RedirectResponse);
        $this->assertEquals([$uri], $response->getHeader('location'));
    }
}
