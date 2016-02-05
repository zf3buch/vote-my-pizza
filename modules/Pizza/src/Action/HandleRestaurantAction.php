<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/vote-my-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace Pizza\Action;

use Application\Router\RouterAwareTrait;
use Pizza\Form\RestaurantPriceFormAwareTrait;
use Pizza\Model\Repository\RestaurantRepositoryAwareTrait;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\RedirectResponse;

/**
 * Class HandleRestaurantAction
 *
 * @package Pizza\Action
 */
class HandleRestaurantAction
{
    /**
     * use traits
     */
    use RouterAwareTrait;
    use RestaurantRepositoryAwareTrait;
    use RestaurantPriceFormAwareTrait;

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
            $this->restaurantRepository->saveRestaurant(
                $id, $this->restaurantPriceForm->getData()
            );

            $routeParams = [
                'id'   => $id,
                'lang' => $request->getAttribute('lang'),
            ];

            return new RedirectResponse(
                $this->router->generateUri('pizza-show', $routeParams)
            );
        }

        return $next($request, $response);
    }
}
