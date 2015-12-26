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
use Zend\Authentication\Adapter\DbTable\AbstractAdapter;
use Zend\Authentication\Adapter\DbTable\Exception\RuntimeException;
use Zend\Authentication\Adapter\ValidatableAdapterInterface;
use Zend\Authentication\AuthenticationService;
use Zend\Authentication\AuthenticationServiceInterface;
use Zend\Authentication\Result;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Expressive\Router\RouterInterface;

/**
 * Class HandleLoginAction
 *
 * @package User\Action
 */
class HandleLoginAction
{
    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * @var LoginForm
     */
    private $loginForm;

    /**
     * @var AuthenticationServiceInterface|AuthenticationService
     */
    private $authenticationService;

    /**
     * @var ValidatableAdapterInterface|AbstractAdapter
     */
    private $authenticationAdapter;

    /**
     * HandleLoginAction constructor.
     *
     * @param RouterInterface                $router
     * @param LoginForm                      $loginForm
     * @param AuthenticationServiceInterface $authenticationService
     */
    public function __construct(
        RouterInterface $router,
        LoginForm $loginForm,
        AuthenticationServiceInterface $authenticationService
    ) {
        $this->router    = $router;
        $this->loginForm = $loginForm;

        $this->authenticationService = $authenticationService;
        $this->authenticationAdapter
                                     = $this->authenticationService->getAdapter(
        );
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
        $postData = $request->getParsedBody();

        $this->loginForm->setData($postData);

        if (!$this->loginForm->isValid()) {
            return $next($request, $response);
        }

        $this->authenticationAdapter->setIdentity($postData['email']);
        $this->authenticationAdapter->setCredential($postData['password']);

        try {
            $result = $this->authenticationService->authenticate();
        } catch (RuntimeException $e) {
            return $next($request, $response);
        }

        if (!$result->isValid()) {
            switch ($result->getCode()) {
                case Result::FAILURE_CREDENTIAL_INVALID:
                    $request = $request->withAttribute(
                        'auth_error',
                        'user_authentication_password_invalid'
                    );
                    break;

                case Result::FAILURE_IDENTITY_NOT_FOUND:
                    $request = $request->withAttribute(
                        'auth_error',
                        'user_authentication_email_unknown'
                    );
                    break;

                default:
                    var_dump($result);
                    exit;
            }

            return $next($request, $response);
        }

        $this->authenticationService->getStorage()->write(
            $this->authenticationAdapter->getResultRowObject(
                null, ['password']
            )
        );

        $routeParams = [
            'lang' => $request->getAttribute('lang'),
        ];

        return new RedirectResponse(
            $this->router->generateUri('home', $routeParams)
        );
    }
}
