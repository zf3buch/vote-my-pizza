<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/vote-my-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace Application\Action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Template\TemplateRendererInterface;

/**
 * Class CommentAction
 *
 * @package Application\Action
 */
class CommentAction
{
    /**
     * @var TemplateRendererInterface
     */
    private $template;

    /**
     * CommentAction constructor.
     *
     * @param TemplateRendererInterface $template
     */
    public function __construct(
        TemplateRendererInterface $template = null
    ) {
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
        $data = [
            'title' => 'Was möchtest du zu dieser Pizza sagen?'
        ];

        return new HtmlResponse(
            $this->template->render('application::comment', $data)
        );
    }
}
