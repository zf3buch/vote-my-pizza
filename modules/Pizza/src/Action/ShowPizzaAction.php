<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/vote-my-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace Pizza\Action;

use Application\Template\TemplateRendererAwareTrait;
use Pizza\Form\RestaurantPriceFormAwareTrait;
use Pizza\Model\Repository\PizzaRepositoryAwareTrait;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;

/**
 * Class ShowPizzaAction
 *
 * @package Application\Action
 */
class ShowPizzaAction
{
    /**
     * use traits
     */
    use TemplateRendererAwareTrait;
    use PizzaRepositoryAwareTrait;
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

        $pizza = $this->pizzaRepository->getSinglePizza($id);

        $data = [
            'pizza'               => $pizza,
            'restaurantPriceForm' => $this->restaurantPriceForm,
        ];

        return new HtmlResponse(
            $this->template->render('pizza::show', $data)
        );
    }
}
