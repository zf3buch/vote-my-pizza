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
use I18n\View\Helper\UrlHelperFactory;
use Interop\Container\ContainerInterface;
use PHPUnit_Framework_TestCase;
use Prophecy\Prophecy\MethodProphecy;
use Zend\Expressive\Router\RouterInterface;

/**
 * Class UrlHelperFactoryTest
 *
 * @package I18nTest\View\Helper
 */
class UrlHelperFactoryTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @var RouterInterface
     */
    protected $router;

    /**
     * Setup test cases
     */
    public function setUp()
    {
        $this->router = $this->prophesize(RouterInterface::class);

        $this->container = $this->prophesize(ContainerInterface::class);

        /** @var MethodProphecy $method */
        $method = $this->container->has(RouterInterface::class);
        $method->willReturn(true);
        $method->shouldBeCalled();

        /** @var MethodProphecy $method */
        $method = $this->container->get(RouterInterface::class);
        $method->willReturn($this->router);
        $method->shouldBeCalled();
    }

    /**
     * Test factory
     */
    public function testFactory()
    {
        $factory = new UrlHelperFactory();

        $this->assertTrue(
            $factory instanceof UrlHelperFactory
        );

        /** @var UrlHelper $viewHelper */
        $viewHelper = $factory($this->container->reveal());

        $this->assertTrue($viewHelper instanceof UrlHelper);

        $this->assertAttributeEquals(
            $this->router->reveal(), 'router', $viewHelper
        );
    }
}
