<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/vote-my-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace User\Action;

use Application\Router\RouterAwareTrait;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use User\Authentication\AuthenticationServiceAwareTrait;
use User\Form\LoginFormAwareTrait;
use Zend\Authentication\Adapter\DbTable\AbstractAdapter;
use Zend\Authentication\Adapter\DbTable\Exception\RuntimeException;
use Zend\Authentication\Adapter\ValidatableAdapterInterface;
use Zend\Authentication\Result;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\RedirectResponse;

/**
 * Class HandleLoginAction
 *
 * @package User\Action
 */
class HandleLoginAction
{
    /**
     * use traits
     */
    use AuthenticationServiceAwareTrait;
    use RouterAwareTrait;
    use LoginFormAwareTrait;

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

        /* @var ValidatableAdapterInterface|AbstractAdapter $authAdapter */
        $authAdapter = $this->authenticationService->getAdapter();
        $authAdapter->setIdentity($postData['email']);
        $authAdapter->setCredential($postData['password']);

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
                        'user_auth_password_invalid'
                    );
                    break;

                case Result::FAILURE_IDENTITY_NOT_FOUND:
                    $request = $request->withAttribute(
                        'auth_error',
                        'user_auth_email_unknown'
                    );
                    break;
            }

            return $next($request, $response);
        }

        $this->authenticationService->getStorage()->write(
            $authAdapter->getResultRowObject(null, ['password'])
        );

        $routeParams = ['lang' => $request->getAttribute('lang'),];

        return new RedirectResponse(
            $this->router->generateUri('home', $routeParams)
        );
    }
}
