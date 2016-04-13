<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/vote-my-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace I18nTest\Action;

use I18n\Middleware\LocalizationMiddleware;
use Locale;
use PHPUnit_Framework_TestCase;
use Prophecy\Prophecy\MethodProphecy;
use Zend\Diactoros\Response;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Diactoros\ServerRequest;
use Zend\Expressive\Router\RouteResult;
use Zend\I18n\Translator\Translator;

/**
 * Class LocalizationMiddlewareTest
 *
 * @package I18nTest\Action
 */
class LocalizationMiddlewareTest extends PHPUnit_Framework_TestCase
{
    /**
     * Setup test cases
     */
    public function setUp()
    {
    }

    /**
     * Test with no RouteResult object
     */
    public function testWithNoRouteResult()
    {
        $expectedLocale = 'de_DE';

        /** @var Translator $translator */
        $translator = $this->prophesize(Translator::class);

        /** @var MethodProphecy $method */
        $method = $translator->setLocale($expectedLocale);
        $method->shouldBeCalled();

        $middleware = new LocalizationMiddleware(
            $translator->reveal()
        );

        $serverRequest = new ServerRequest();

        $serverResponse = new Response();

        $next = function ($serverRequest, $serverResponse) {
            return md5(
                serialize($serverRequest) . serialize($serverResponse)
            );
        };

        /** @var RedirectResponse $response */
        $response = $middleware($serverRequest, $serverResponse, $next);

        $this->assertEquals(
            $next($serverRequest, $serverResponse), $response
        );

        $this->assertEquals($expectedLocale, Locale::getDefault());
    }

    /**
     * Test with failed RouteResult object
     */
    public function testWithFailedRouteResult()
    {
        $expectedLocale = 'de_DE';

        /** @var Translator $translator */
        $translator = $this->prophesize(Translator::class);

        /** @var MethodProphecy $method */
        $method = $translator->setLocale($expectedLocale);
        $method->shouldBeCalled();

        $middleware = new LocalizationMiddleware(
            $translator->reveal()
        );

        $routeResult = RouteResult::fromRouteFailure();

        $serverRequest = new ServerRequest();
        $serverRequest = $serverRequest->withAttribute(
            RouteResult::class,
            $routeResult
        );

        $serverResponse = new Response();

        $next = function ($serverRequest, $serverResponse) {
            return md5(
                serialize($serverRequest) . serialize($serverResponse)
            );
        };

        /** @var RedirectResponse $response */
        $response = $middleware($serverRequest, $serverResponse, $next);

        $this->assertEquals(
            $next($serverRequest, $serverResponse), $response
        );

        $this->assertEquals($expectedLocale, Locale::getDefault());
    }

    /**
     * Test with successful RouteResult object
     */
    public function testWithSuccessfulRouteResultGerman()
    {
        $expectedLocale = 'de_DE';

        /** @var Translator $translator */
        $translator = $this->prophesize(Translator::class);

        /** @var MethodProphecy $method */
        $method = $translator->setLocale($expectedLocale);
        $method->shouldBeCalled();

        $middleware = new LocalizationMiddleware(
            $translator->reveal()
        );

        $routeResult = RouteResult::fromRouteMatch(
            'name',
            'function',
            [
                'lang' => 'de',
            ]
        );

        $serverRequest = new ServerRequest();
        $serverRequest = $serverRequest->withAttribute(
            RouteResult::class,
            $routeResult
        );

        $serverResponse = new Response();

        $next = function ($serverRequest, $serverResponse) {
            return md5(
                serialize($serverRequest) . serialize($serverResponse)
            );
        };

        /** @var RedirectResponse $response */
        $response = $middleware($serverRequest, $serverResponse, $next);

        $this->assertEquals(
            $next($serverRequest, $serverResponse), $response
        );

        $this->assertEquals($expectedLocale, Locale::getDefault());
    }

    /**
     * Test with successful RouteResult object
     */
    public function testWithSuccessfulRouteResultEnglish()
    {
        $expectedLocale = 'en_US';

        /** @var Translator $translator */
        $translator = $this->prophesize(Translator::class);

        /** @var MethodProphecy $method */
        $method = $translator->setLocale($expectedLocale);
        $method->shouldBeCalled();

        $middleware = new LocalizationMiddleware(
            $translator->reveal()
        );

        $routeResult = RouteResult::fromRouteMatch(
            'name',
            'function',
            [
                'lang' => 'en',
            ]
        );

        $serverRequest = new ServerRequest();
        $serverRequest = $serverRequest->withAttribute(
            RouteResult::class,
            $routeResult
        );

        $serverResponse = new Response();

        $next = function ($serverRequest, $serverResponse) {
            return md5(
                serialize($serverRequest) . serialize($serverResponse)
            );
        };

        /** @var RedirectResponse $response */
        $response = $middleware($serverRequest, $serverResponse, $next);

        $this->assertEquals(
            $next($serverRequest, $serverResponse), $response
        );

        $this->assertEquals($expectedLocale, Locale::getDefault());
    }
}
