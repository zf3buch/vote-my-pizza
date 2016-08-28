<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/vote-my-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace PizzaRest\Action;

use Pizza\Model\Repository\PizzaRepositoryAwareTrait;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\JsonResponse;

/**
 * Class GetIdAction
 *
 * @package PizzaRest\Action
 */
class GetIdAction
{
    /**
     * use traits
     */
    use PizzaRepositoryAwareTrait;

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface      $response
     * @param callable|null          $next
     *
     * @return JsonResponse
     */
    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        callable $next = null
    ) {
        $id = $request->getAttribute('id');

        $pizza = $this->pizzaRepository->getSinglePizza($id);

        if (!$pizza) {
            return new JsonResponse(['error' => 'Pizza not found']);
        }

        return new JsonResponse($pizza);
    }
}
