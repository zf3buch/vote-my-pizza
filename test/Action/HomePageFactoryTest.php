<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @package    Application
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/vote-my-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace AppTest\Action;

use App\Action\HomePageAction;
use App\Action\HomePageFactory;
use Interop\Container\ContainerInterface;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class HomePageFactoryTest extends \PHPUnit_Framework_TestCase
{
    /** @var ContainerInterface */
    protected $container;

    public function setUp()
    {
        $this->container = $this->prophesize(ContainerInterface::class);
        $router = $this->prophesize(RouterInterface::class);

        $this->container->get(RouterInterface::class)->willReturn($router);
    }

    public function testFactoryWithoutTemplate()
    {
        $factory = new HomePageFactory();
        $this->container->has(TemplateRendererInterface::class)->willReturn(false);

        $this->assertTrue($factory instanceof HomePageFactory);

        $homePage = $factory($this->container->reveal());

        $this->assertTrue($homePage instanceof HomePageAction);
    }

    public function testFactoryWithTemplate()
    {
        $factory = new HomePageFactory();
        $this->container->has(TemplateRendererInterface::class)->willReturn(true);
        $this->container
            ->get(TemplateRendererInterface::class)
            ->willReturn($this->prophesize(TemplateRendererInterface::class));

        $this->assertTrue($factory instanceof HomePageFactory);

        $homePage = $factory($this->container->reveal());

        $this->assertTrue($homePage instanceof HomePageAction);
    }
}
