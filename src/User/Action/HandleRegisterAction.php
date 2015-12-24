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
use User\Form\RegisterForm;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Expressive\Router\RouterInterface;

/**
 * Class HandleRegisterAction
 *
 * @package User\Action
 */
class HandleRegisterAction
{
    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * @var RegisterForm
     */
    private $loginFormForm;

    /**
     * HandleRegisterAction constructor.
     *
     * @param RouterInterface $router
     * @param RegisterForm    $loginFormForm
     */
    public function __construct(
        RouterInterface $router,
        RegisterForm $loginFormForm
    ) {
        $this->router        = $router;
        $this->loginFormForm = $loginFormForm;
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
        $routeParams = [
            'lang' => $request->getAttribute('lang'),
        ];

        return new RedirectResponse(
            $this->router->generateUri('home', $routeParams)
        );
    }
}
