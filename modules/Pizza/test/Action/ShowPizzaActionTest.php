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
use Pizza\Action\ShowPizzaAction;
use Pizza\Form\RestaurantPriceForm;
use Pizza\Model\Repository\PizzaRepositoryInterface;
use Prophecy\Prophecy\MethodProphecy;
use Zend\Diactoros\Response;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\ServerRequest;
use Zend\Expressive\Template\TemplateRendererInterface;

/**
 * Class ShowPizzaActionTest
 *
 * @package PizzaTest\Action
 */
class ShowPizzaActionTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var TemplateRendererInterface
     */
    private $template;

    /**
     * @var PizzaRepositoryInterface
     */
    private $pizzaRepository;

    /**
     * @var RestaurantPriceForm
     */
    private $restaurantPriceForm;

    /**
     * Setup test cases
     */
    public function setUp()
    {
        $this->template = $this->prophesize(
            TemplateRendererInterface::class
        );

        $this->pizzaRepository = $this->prophesize(
            PizzaRepositoryInterface::class
        );

        $this->restaurantPriceForm = $this->prophesize(
            RestaurantPriceForm::class
        );
    }

    /**
     * Test Response object
     */
    public function testResponse()
    {
        $id    = '1';
        $pizza = [$id => 'Pizza A'];
        $data  = [
            'pizza'               => $pizza,
            'restaurantPriceForm' => $this->restaurantPriceForm,
        ];

        /** @var MethodProphecy $renderMethod */
        $renderMethod = $this->template->render('pizza::show', $data);
        $renderMethod->willReturn('Whatever');

        /** @var MethodProphecy $getSinglePizza */
        $getSinglePizza = $this->pizzaRepository->getSinglePizza($id);
        $getSinglePizza->willReturn($pizza);

        $action = new ShowPizzaAction();
        $action->setTemplateRenderer($this->template->reveal());
        $action->setPizzaRepository($this->pizzaRepository->reveal());
        $action->setRestaurantPriceForm(
            $this->restaurantPriceForm->reveal()
        );

        $serverRequest = new ServerRequest(['/de/pizza/show/' . $id]);
        $serverRequest = $serverRequest->withAttribute('id', $id);

        $response = $action(
            $serverRequest, new Response()
        );

        $this->assertTrue($response instanceof HtmlResponse);
    }
}
