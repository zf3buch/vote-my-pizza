<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/vote-my-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace Application\Action;

use Application\Model\Repository\PizzaRepositoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Expressive\Template\TemplateRendererInterface;

/**
 * Class VotingAction
 *
 * @package Application\Action
 */
class VotingAction
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
     * VotingAction constructor.
     *
     * @param TemplateRendererInterface $template
     * @param PizzaRepositoryInterface  $pizzaRepository
     */
    public function __construct(
        TemplateRendererInterface $template,
        PizzaRepositoryInterface $pizzaRepository
    ) {
        $this->template        = $template;
        $this->pizzaRepository = $pizzaRepository;
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
        $posParam = $request->getAttribute('pos');
        $negParam = $request->getAttribute('neg');

        if ($posParam || $negParam) {
            // TODO: add voting counts here
            return new RedirectResponse('/voting');
        }

        $votingPizzas = $this->pizzaRepository->getPizzasForVoting();

        $data = [
            'title'  => 'Welche Pizza gefällt dir besser?',
            'pizzas' => $votingPizzas,
        ];

        return new HtmlResponse(
            $this->template->render('application::voting', $data)
        );
    }
}
