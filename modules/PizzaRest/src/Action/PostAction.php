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
 * Class PostAction
 *
 * @package PizzaRest\Action
 */
class PostAction
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
        $postData = $request->getParsedBody();

        $posParam = $postData['pos'];
        $negParam = $postData['neg'];

        $this->pizzaRepository->saveVoting($posParam, $negParam);

        return new JsonResponse(['success' => 'Voting was saved']);
    }
}
