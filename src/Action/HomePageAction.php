<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @package    Application
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/vote-my-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace App\Action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

/**
 * Class HomePageAction
 *
 * @package App\Action
 */
class HomePageAction
{
    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * @var TemplateRendererInterface
     */
    private $template;

    /**
     * HomePageAction constructor.
     *
     * @param RouterInterface                $router
     * @param TemplateRendererInterface|null $template
     */
    public function __construct(
        RouterInterface $router, TemplateRendererInterface $template = null
    ) {
        $this->router = $router;
        $this->template = $template;
    }

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface      $response
     * @param callable|null          $next
     *
     * @return HtmlResponse
     */
    public function __invoke(
        ServerRequestInterface $request, ResponseInterface $response,
        callable $next = null
    ) {
        $data = [];

        return new HtmlResponse(
            $this->template->render('app::home-page', $data)
        );
    }
}
