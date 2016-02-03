<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/vote-my-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace Pizza\Action;

use Pizza\Model\Repository\RestaurantRepositoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Expressive\Router\RouterInterface;

/**
 * Class DeleteRestaurantAction
 *
 * @package Pizza\Action
 */
class DeleteRestaurantAction
{
    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * @var RestaurantRepositoryInterface
     */
    private $restaurantRepository;

    /**
     * DeleteRestaurantAction constructor.
     *
     * @param RouterInterface               $router
     * @param RestaurantRepositoryInterface $restaurantRepository
     */
    public function __construct(
        RouterInterface $router,
        RestaurantRepositoryInterface $restaurantRepository
    ) {
        $this->router               = $router;
        $this->restaurantRepository = $restaurantRepository;
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
        $id      = $request->getAttribute('id');
        $priceId = $request->getAttribute('priceId');

        $this->restaurantRepository->deleteRestaurant($priceId);

        $routeParams = [
            'id'   => $id,
            'lang' => $request->getAttribute('lang'),
        ];

        return new RedirectResponse(
            $this->router->generateUri('pizza-show', $routeParams)
        );
    }
}
