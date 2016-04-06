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
use Pizza\Action\HandleVotingAction;
use Pizza\Model\Repository\PizzaRepositoryInterface;
use Prophecy\Prophecy\MethodProphecy;
use Zend\Diactoros\Response;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Diactoros\ServerRequest;
use Zend\Expressive\Router\RouterInterface;

/**
 * Class HandleVotingActionTest
 *
 * @package PizzaTest\Action
 */
class HandleVotingActionTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * @var PizzaRepositoryInterface
     */
    private $pizzaRepository;

    /**
     * Setup test cases
     */
    public function setUp()
    {
        $this->router = $this->prophesize(
            RouterInterface::class
        );

        $this->pizzaRepository = $this->prophesize(
            PizzaRepositoryInterface::class
        );

    }

    /**
     * Test Response object
     */
    public function testResponse()
    {
        $lang = 'de';
        $pos  = 1;
        $neg  = 2;
        $uri  = '/de/pizza/voting';
        $data = [
            'lang' => $lang,
        ];

        /** @var MethodProphecy $generateUriMethod */
        $generateUriMethod = $this->router->generateUri(
            'pizza-voting', $data
        );
        $generateUriMethod->willReturn($uri);
        $generateUriMethod->shouldBeCalled();

        /** @var MethodProphecy $saveMethod */
        $saveMethod = $this->pizzaRepository->saveVoting(
            $pos, $neg
        );
        $saveMethod->shouldBeCalled();

        $action = new HandleVotingAction();
        $action->setRouter($this->router->reveal());
        $action->setPizzaRepository(
            $this->pizzaRepository->reveal()
        );

        $serverRequest = new ServerRequest(['/']);
        $serverRequest = $serverRequest->withAttribute('lang', $lang);
        $serverRequest = $serverRequest->withAttribute('pos', $pos);
        $serverRequest = $serverRequest->withAttribute('neg', $neg);

        /** @var RedirectResponse $response */
        $response = $action(
            $serverRequest, new Response()
        );

        $this->assertTrue($response instanceof RedirectResponse);
        $this->assertEquals([$uri], $response->getHeader('location'));
    }
}
