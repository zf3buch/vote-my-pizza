<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/vote-my-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace User\Action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use User\Form\LoginForm;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Template\TemplateRendererInterface;

/**
 * Class ShowLoginAction
 *
 * @package User\Action
 */
class ShowLoginAction
{
    /**
     * @var TemplateRendererInterface
     */
    private $template;

    /**
     * @var LoginForm
     */
    private $loginForm;

    /**
     * ShowLoginAction constructor.
     *
     * @param TemplateRendererInterface $template
     * @param LoginForm                 $loginForm
     */
    public function __construct(
        TemplateRendererInterface $template,
        LoginForm $loginForm
    ) {
        $this->template  = $template;
        $this->loginForm = $loginForm;
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
        $data = [
            'loginForm' => $this->loginForm,
        ];

        return new HtmlResponse(
            $this->template->render('user::login', $data)
        );
    }
}
