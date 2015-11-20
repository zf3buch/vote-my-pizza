<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/vote-my-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace Application\Action;

use Application\Model\Service\PizzaServiceInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Template\TemplateRendererInterface;

/**
 * Class ShowVotingAction
 *
 * @package Application\Action
 */
class ShowVotingAction
{
    /**
     * @var TemplateRendererInterface
     */
    private $template;

    /**
     * @var PizzaServiceInterface
     */
    private $pizzaService;

    /**
     * ShowVotingAction constructor.
     *
     * @param TemplateRendererInterface $template
     * @param PizzaServiceInterface  $pizzaService
     */
    public function __construct(
        TemplateRendererInterface $template,
        PizzaServiceInterface $pizzaService
    ) {
        $this->template        = $template;
        $this->pizzaService = $pizzaService;
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
        $votingPizzas = $this->pizzaService->getPizzasForVoting();

        $data = [
            'title'  => 'Welche Pizza gefällt dir besser?',
            'pizzas' => $votingPizzas,
        ];

        return new HtmlResponse(
            $this->template->render('application::show-voting', $data)
        );
    }
}
