<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/vote-my-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace ApplicationTest\Action;

use Application\Action\HomePageAction;
use Zend\Diactoros\Response;
use Zend\Diactoros\ServerRequest;
use Zend\Expressive\Template\TemplateRendererInterface;

/**
 * Class HomePageActionTest
 *
 * @package ApplicationTest\Action
 */
class HomePageActionTest extends \PHPUnit_Framework_TestCase
{
    /** @var TemplateRendererInterface */
    protected $template;

    /**
     * Setup test cases
     */
    public function setUp()
    {
        $this->template = $this->prophesize(
            TemplateRendererInterface::class
        );
    }

    /**
     * Test Response object
     */
    public function testResponse()
    {
        $this->template
            ->render(
                'application::home-page',
                ['welcome' => 'application_heading_welcome']
            )
            ->willReturn('Whatever');

        $homePage = new HomePageAction($this->template->reveal());

        $response = $homePage(
            new ServerRequest(['/']), new Response()
        );

        $this->assertTrue($response instanceof Response);
    }
}
