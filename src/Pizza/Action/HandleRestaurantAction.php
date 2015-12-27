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
     * @var RestaurantRepositoryInterface
     */
    private $restaurantRepository;

    /**
     * HandleRestaurantAction constructor.
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
        $id = $request->getAttribute('id');

        $restaurantData = [];

        $this->restaurantRepository->saveRestaurant($id, $restaurantData);

        return new RedirectResponse(
            $this->router->generateUri('pizza-show', ['id' => $id])
        );
    }
}
