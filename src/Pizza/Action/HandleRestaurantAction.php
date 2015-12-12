<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/vote-my-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace Pizza\Action;

use Pizza\Form\RestaurantPriceForm;
use Pizza\Model\Service\PizzaServiceInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Expressive\Router\RouterInterface;

/**
 * Class HandleRestaurantAction
 *
 * @package Pizza\Action
 */
class HandleRestaurantAction
{
    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * @var PizzaServiceInterface
     */
    private $pizzaService;

    /**
     * @var RestaurantPriceForm
     */
    private $restaurantPriceForm;

    /**
     * @var ShowPizzaAction
     */
    private $showPizzaAction;

    /**
     * HandleRestaurantAction constructor.
     *
     * @param RouterInterface       $router
     * @param PizzaServiceInterface $pizzaService
     * @param RestaurantPriceForm   $restaurantPriceForm
     * @param ShowPizzaAction       $showPizzaAction
     */
    public function __construct(
        RouterInterface $router,
        PizzaServiceInterface $pizzaService,
        RestaurantPriceForm $restaurantPriceForm,
        ShowPizzaAction $showPizzaAction
    ) {
        $this->router              = $router;
        $this->pizzaService        = $pizzaService;
        $this->restaurantPriceForm = $restaurantPriceForm;
        $this->showPizzaAction     = $showPizzaAction;
    }

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface      $response
     * @param callable|null          $next
     *
     * @return HtmlResponse
     */
    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        callable $next = null
    ) {
        $id = $request->getAttribute('id');

        $postData = $request->getParsedBody();

        $this->restaurantPriceForm->setData($postData);

        if ($this->restaurantPriceForm->isValid()) {
            $this->pizzaService->saveRestaurant(
                $id, $this->restaurantPriceForm->getData()
            );

            return new RedirectResponse(
                $this->router->generateUri('pizza-show', ['id' => $id])
            );
        }

        $failureAction = $this->showPizzaAction;

        return $failureAction($request, $response, $next);

    }
}
