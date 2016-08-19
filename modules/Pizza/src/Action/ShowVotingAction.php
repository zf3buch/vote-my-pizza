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
use Pizza\Model\Repository\PizzaRepositoryAwareTrait;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;

/**
 * Class ShowVotingAction
 *
 * @package Pizza\Action
 */
class ShowVotingAction
{
    /**
     * use traits
     */
    use TemplateRendererAwareTrait;
    use PizzaRepositoryAwareTrait;

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
        $votingPizzas = $this->pizzaRepository->getPizzasForVoting();

        $data = [
            'title'  => 'pizza_heading_voting',
            'pizzas' => $votingPizzas,
        ];

        return new HtmlResponse(
            $this->renderer->render('pizza::voting', $data)
        );
    }
}
