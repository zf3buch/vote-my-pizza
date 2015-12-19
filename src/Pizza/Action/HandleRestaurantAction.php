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
use Pizza\Model\Repository\PizzaRepositoryInterface;
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
     * @var PizzaRepositoryInterface
     */
    private $pizzaRepository;

    /**
     * @var RestaurantPriceForm
     */
    private $restaurantPriceForm;

    /**
     * HandleRestaurantAction constructor.
     *
     * @param RouterInterface          $router
     * @param PizzaRepositoryInterface $pizzaRepository
     * @param RestaurantPriceForm      $restaurantPriceForm
     */
    public function __construct(
        RouterInterface $router,
        PizzaRepositoryInterface $pizzaRepository,
        RestaurantPriceForm $restaurantPriceForm
    ) {
        $this->router              = $router;
        $this->pizzaRepository     = $pizzaRepository;
        $this->restaurantPriceForm = $restaurantPriceForm;
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
            $this->pizzaRepository->saveRestaurant(
                $id, $this->restaurantPriceForm->getData()
            );

            return new RedirectResponse(
                $this->router->generateUri('pizza-show', ['id' => $id])
            );
        }

        return $next($request, $response);
    }
}
