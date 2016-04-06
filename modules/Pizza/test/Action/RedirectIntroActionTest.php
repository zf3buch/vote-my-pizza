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
use Pizza\Action\RedirectIntroAction;
use Prophecy\Prophecy\MethodProphecy;
use Zend\Diactoros\Response;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Diactoros\ServerRequest;
use Zend\Expressive\Router\RouterInterface;

/**
 * Class RedirectIntroActionTest
 *
 * @package PizzaTest\Action
 */
class RedirectIntroActionTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * Setup test cases
     */
    public function setUp()
    {
        $this->router = $this->prophesize(
            RouterInterface::class
        );
    }

    /**
     * Test Response object
     */
    public function testResponse()
    {
        $lang = 'de';
        $uri  = '/de';
        $data = [
            'lang' => $lang,
        ];

        /** @var MethodProphecy $generateUriMethod */
        $generateUriMethod = $this->router->generateUri('home', $data);
        $generateUriMethod->willReturn($uri);
        $generateUriMethod->shouldBeCalled();

        $action = new RedirectIntroAction();
        $action->setRouter($this->router->reveal());

        $serverRequest = new ServerRequest(['/']);
        $serverRequest = $serverRequest->withAttribute('lang', $lang);

        /** @var RedirectResponse $response */
        $response = $action(
            $serverRequest, new Response()
        );

        $this->assertTrue($response instanceof RedirectResponse);
        $this->assertEquals([$uri], $response->getHeader('location'));
    }
}
