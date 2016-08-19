<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/vote-my-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace Pizza\Action;

use Pizza\Model\Repository\PizzaRepositoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Template\TemplateRendererInterface;

/**
 * Class ShowIntroAction
 *
 * @package Application\Action
 */
class ShowIntroAction
{
    /**
     * @var TemplateRendererInterface
     */
    private $renderer;

    /**
     * @var PizzaRepositoryInterface
     */
    private $pizzaRepository;

    /**
     * ShowIntroAction constructor.
     *
     * @param TemplateRendererInterface $renderer
     * @param PizzaRepositoryInterface  $pizzaRepository
     */
    public function __construct(
        TemplateRendererInterface $renderer,
        PizzaRepositoryInterface $pizzaRepository
    ) {
        $this->renderer        = $renderer;
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
        $topPizzas  = $this->pizzaRepository->getTopPizzas();
        $flopPizzas = $this->pizzaRepository->getFlopPizzas();

        $data = [
            'welcome'    => 'Willkommen zu Vote My Pizza!',
            'topPizzas'  => $topPizzas,
            'flopPizzas' => $flopPizzas,
        ];

        return new HtmlResponse(
            $this->renderer->render('pizza::intro', $data)
        );
    }
}
