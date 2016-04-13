<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/vote-my-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace I18nTest\Action;

use I18n\Middleware\LocalizationFactory;
use I18n\Middleware\LocalizationMiddleware;
use Interop\Container\ContainerInterface;
use PHPUnit_Framework_TestCase;
use Prophecy\Prophecy\MethodProphecy;
use Zend\Diactoros\Response;
use Zend\I18n\Translator\Translator;
use Zend\View\HelperPluginManager;

/**
 * Class LocalizationFactoryTest
 *
 * @package I18nTest\Action
 */
class LocalizationFactoryTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @var Translator
     */
    protected $translator;

    /**
     * Setup test cases
     */
    public function setUp()
    {
        $this->container = $this->prophesize(ContainerInterface::class);

        $this->translator = $this->prophesize(Translator::class);
    }

    /**
     * Test translator injection
     */
    public function testTranslatorInjection()
    {
        /** @var MethodProphecy $method */
        $method = $this->container->get(Translator::class);
        $method->willReturn($this->translator);
        $method->shouldBeCalled();

        $factory = new LocalizationFactory();

        $this->assertTrue($factory instanceof LocalizationFactory);

        /** @var LocalizationMiddleware $action */
        $action = $factory($this->container->reveal());

        $this->assertTrue($action instanceof LocalizationMiddleware);
    }
}
