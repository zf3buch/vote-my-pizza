<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/vote-my-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace I18nTest\View\Helper;

use I18n\View\Helper\UrlHelper;
use PHPUnit_Framework_TestCase;
use Prophecy\Prophecy\MethodProphecy;
use Zend\Expressive\Router\RouteResult;
use Zend\Expressive\Router\RouterInterface;

/**
 * Class UrlHelperTest
 *
 * @package I18nTest\View\Helper
 */
class UrlHelperTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test with no route and no route result
     */
    public function testNoRouteNoResult()
    {
        $expectedUrl = '/';

        $routeName   = 'home';
        $routeParams = [
            'lang' => 'de',
        ];

        /** @var RouterInterface $router */
        $router = $this->prophesize(RouterInterface::class);
        $router->generateUri($routeName, $routeParams)
            ->willReturn($expectedUrl)->shouldBeCalled();

        $viewHelper = new UrlHelper($router->reveal());

        $this->assertEquals($expectedUrl, $viewHelper());
    }

    /**
     * Test with no route and no failed result
     */
    public function testNoRouteFailedResult()
    {
        $expectedUrl = '/';

        $routeName   = 'home';
        $routeParams = [
            'lang' => 'de',
        ];

        /** @var RouterInterface $router */
        $router = $this->prophesize(RouterInterface::class);
        $router->generateUri($routeName, $routeParams)
            ->willReturn($expectedUrl)->shouldBeCalled();

        $routeResult = RouteResult::fromRouteFailure();

        $viewHelper = new UrlHelper($router->reveal());
        $viewHelper->setRouteResult($routeResult);

        $this->assertEquals($expectedUrl, $viewHelper());
    }

    /**
     * Test with route and no route result
     */
    public function testWithRouteNoResult()
    {
        $expectedUrl = '/';

        $routeName   = 'some-route';
        $routeParams = [
            'lang' => 'de',
        ];

        /** @var RouterInterface $router */
        $router = $this->prophesize(RouterInterface::class);
        $router->generateUri($routeName, $routeParams)
            ->willReturn($expectedUrl)->shouldBeCalled();

        $viewHelper = new UrlHelper($router->reveal());

        $this->assertEquals($expectedUrl, $viewHelper($routeName));
    }

    /**
     * Test with route and matched route result
     */
    public function testWithRouteMatchedResult()
    {
        $expectedUrl = '/';

        $routeName   = 'some-route';
        $routeParams = [
            'lang' => 'en',
        ];

        /** @var RouterInterface $router */
        $router = $this->prophesize(RouterInterface::class);
        $router->generateUri($routeName, $routeParams)
            ->willReturn($expectedUrl)->shouldBeCalled();

        $routeResult = RouteResult::fromRouteMatch(
            $routeName,
            'function',
            $routeParams
        );

        $viewHelper = new UrlHelper($router->reveal());
        $viewHelper->setRouteResult($routeResult);

        $this->assertEquals($expectedUrl, $viewHelper($routeName));
    }

    /**
     * Test with route and matched route result
     */
    public function testWithRouteMatchedResultAndParams()
    {
        $expectedUrl = '/';

        $routeName    = 'some-route';
        $passedParams = [
            'controller' => 'some-controller',
        ];
        $usedParams   = [
            'controller' => 'some-controller',
            'lang'       => 'de',
        ];

        /** @var RouterInterface $router */
        $router = $this->prophesize(RouterInterface::class);
        $router->generateUri($routeName, $usedParams)
            ->willReturn($expectedUrl)->shouldBeCalled();

        $routeResult = RouteResult::fromRouteMatch(
            $routeName,
            'function',
            $passedParams
        );

        $viewHelper = new UrlHelper($router->reveal());
        $viewHelper->setRouteResult($routeResult);

        $this->assertEquals(
            $expectedUrl, $viewHelper($routeName, $passedParams)
        );
    }

}
