<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/vote-my-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace UserTest\Action;

use Prophecy\Prophecy\MethodProphecy;
use stdClass;
use User\Action\HandleLoginAction;
use Zend\Authentication\Adapter\AdapterInterface;
use Zend\Authentication\Adapter\DbTable\AbstractAdapter;
use Zend\Authentication\Adapter\DbTable\Exception\RuntimeException;
use Zend\Authentication\Adapter\ValidatableAdapterInterface;
use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Result;
use Zend\Authentication\Storage\StorageInterface;
use Zend\Diactoros\Response;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Diactoros\ServerRequest;

/**
 * Class HandleLoginActionTest
 *
 * @package UserTest\Action
 */
class HandleLoginActionTest extends AbstractTest
{
    /**
     * @var AdapterInterface|ValidatableAdapterInterface|AbstractAdapter
     */
    protected $authAdapter;

    /**
     * @var StorageInterface
     */
    protected $authStorage;

    /**
     * @var Result
     */
    protected $authResult;

    /**
     * Mock authentication service
     */
    protected function mockAuthService()
    {
        $this->authService = $this->prophesize(
            AuthenticationService::class
        );
    }

    /**
     * Prepare login form
     *
     * @param array $postData
     * @param bool  $isValid
     */
    protected function prepareLoginForm($postData, $isValid = true)
    {
        $this->loginForm->setData($postData)->shouldBeCalled();
        $this->loginForm->isValid()->willReturn($isValid)
            ->shouldBeCalled();
    }

    /**
     * Prepare authentication service
     *
     * @param bool $called
     * @param bool $calledStorage
     * @param null $exception
     */
    protected function prepareAuthService(
        $called = true,
        $calledStorage = true,
        $exception = null
    ) {
        if ($called) {
            $this->authService->getAdapter()
                ->willReturn($this->authAdapter)->shouldBeCalled();
        } else {
            $this->authService->getAdapter()
                ->willReturn($this->authAdapter)->shouldNotBeCalled();
        }

        /** @var MethodProphecy $method */
        $method = $this->authService->authenticate();

        if ($exception) {
            $method->willThrow($exception);
        } else {
            $method->willReturn($this->authResult);
        }

        if ($called) {
            $method->shouldBeCalled();
        } else {
            $method->shouldNotBeCalled();
        }

        if ($calledStorage) {
            $this->authService->getStorage()
                ->willReturn($this->authStorage)->shouldBeCalled();
        } else {
            $this->authService->getStorage()
                ->willReturn($this->authStorage)->shouldNotBeCalled();
        }
    }

    /**
     * Prepare authentication adapter
     *
     * @param  array $postData
     * @param bool   $called
     * @param bool   $calledResult
     */
    protected function prepareAuthAdapter(
        $postData,
        $called = true,
        $calledResult = true
    ) {
        if ($called) {
            $this->authAdapter->setIdentity($postData['email'])
                ->willReturn($this->authAdapter)->shouldBeCalled();
        } else {
            $this->authAdapter->setIdentity($postData['email'])
                ->willReturn($this->authAdapter)->shouldNotBeCalled();
        }

        if ($called) {
            $this->authAdapter->setCredential($postData['password'])
                ->willReturn($this->authAdapter)->shouldBeCalled();
        } else {
            $this->authAdapter->setCredential($postData['password'])
                ->willReturn($this->authAdapter)->shouldNotBeCalled();
        }

        if ($calledResult) {
            $this->authAdapter->getResultRowObject(null, ['password'])
                ->willReturn(new stdClass())->shouldBeCalled();
        } else {
            $this->authAdapter->getResultRowObject(null, ['password'])
                ->willReturn(new stdClass())->shouldNotBeCalled();
        }
    }

    /**
     * Prepare authentication result
     *
     * @param bool $isValid
     * @param bool $called
     * @param null $code
     */
    protected function prepareAuthResult(
        $isValid = true,
        $called = true,
        $code = null
    ) {
        if ($called) {
            $this->authResult->isValid()->willReturn($isValid)
                ->shouldBeCalled();
        } else {
            $this->authResult->isValid()->willReturn($isValid)
                ->shouldNotBeCalled();
        }

        if ($isValid === false) {
            $this->authResult->getCode()->willReturn($code)
                ->shouldBeCalled();
        } else {
            $this->authResult->getCode()->shouldNotBeCalled();
        }
    }

    /**
     * Setup test cases
     */
    public function setUp()
    {
        $this->mockRouter();
        $this->mockLoginForm();
        $this->mockAuthService();

        $this->authAdapter = $this->prophesize(AbstractAdapter::class);
        $this->authStorage = $this->prophesize(StorageInterface::class);
        $this->authResult  = $this->prophesize(Result::class);
    }

    /**
     * Test Response object
     */
    public function testResponseWithValidData()
    {
        $lang        = 'de';
        $uri         = '/' . $lang . '/user/login';
        $routeParams = [
            'lang' => $lang,
        ];
        $routeName   = 'home';
        $postData    = [
            'email'      => 'Email',
            'password'   => 'password',
            'login_user' => 'login_user',
        ];
        $requestUri  = $uri;

        $this->prepareRouter($routeName, $routeParams, $uri);
        $this->prepareLoginForm($postData);
        $this->prepareAuthService();
        $this->prepareAuthAdapter($postData);
        $this->prepareAuthResult();

        $action = new HandleLoginAction();
        $action->setRouter($this->router->reveal());
        $action->setAuthenticationService(
            $this->authService->reveal()
        );
        $action->setLoginForm(
            $this->loginForm->reveal()
        );

        $serverRequest = new ServerRequest([$requestUri]);
        $serverRequest = $serverRequest->withParsedBody($postData);
        $serverRequest = $serverRequest->withAttribute('lang', $lang);

        /** @var RedirectResponse $response */
        $response = $action(
            $serverRequest, new Response()
        );

        $this->assertTrue($response instanceof RedirectResponse);
        $this->assertEquals([$uri], $response->getHeader('location'));
    }

    /**
     * Test Response object
     */
    public function testResponseWithInvalidData()
    {
        $lang        = 'de';
        $uri         = '/' . $lang . '/user/login';
        $routeParams = [
            'lang' => $lang,
        ];
        $routeName   = 'home';
        $postData    = [
            'email'      => 'Email',
            'password'   => 'password',
            'login_user' => 'login_user',
        ];
        $requestUri  = $uri;

        $this->prepareRouter($routeName, $routeParams, $uri, false);
        $this->prepareLoginForm($postData, false);
        $this->prepareAuthService(false, false);
        $this->prepareAuthAdapter($postData, false, false);
        $this->prepareAuthResult(true, false);

        $action = new HandleLoginAction();
        $action->setRouter($this->router->reveal());
        $action->setAuthenticationService(
            $this->authService->reveal()
        );
        $action->setLoginForm(
            $this->loginForm->reveal()
        );

        $serverRequest = new ServerRequest([$requestUri]);
        $serverRequest = $serverRequest->withParsedBody($postData);
        $serverRequest = $serverRequest->withAttribute('lang', $lang);

        $serverResponse = new Response();

        $next = function ($serverRequest, $serverResponse) {
            return md5(
                serialize($serverRequest) . serialize($serverResponse)
            );
        };

        /** @var RedirectResponse $response */
        $response = $action(
            $serverRequest, $serverResponse, $next
        );

        $this->assertEquals(
            $next($serverRequest, $serverResponse), $response
        );
    }

    /**
     * Test Response object
     */
    public function testResponseWithInvalidResultPassword()
    {
        $lang        = 'de';
        $uri         = '/' . $lang . '/user/login';
        $routeParams = [
            'lang' => $lang,
        ];
        $routeName   = 'home';
        $postData    = [
            'email'      => 'Email',
            'password'   => 'password',
            'login_user' => 'login_user',
        ];
        $requestUri  = $uri;
        $authError   = 'user_auth_password_invalid';

        $this->prepareRouter($routeName, $routeParams, $uri, false);
        $this->prepareLoginForm($postData);
        $this->prepareAuthService(true, false);
        $this->prepareAuthAdapter($postData, true, false);
        $this->prepareAuthResult(
            false, true, Result::FAILURE_CREDENTIAL_INVALID
        );

        $action = new HandleLoginAction();
        $action->setRouter($this->router->reveal());
        $action->setAuthenticationService(
            $this->authService->reveal()
        );
        $action->setLoginForm(
            $this->loginForm->reveal()
        );

        $serverRequest = new ServerRequest([$requestUri]);
        $serverRequest = $serverRequest->withParsedBody($postData);
        $serverRequest = $serverRequest->withAttribute('lang', $lang);
        $serverRequest = $serverRequest->withAttribute(
            'auth_error', $authError
        );

        $serverResponse = new Response();

        $next = function ($serverRequest, $serverResponse) {
            return md5(
                serialize($serverRequest) . serialize($serverResponse)
            );
        };

        /** @var RedirectResponse $response */
        $response = $action(
            $serverRequest, $serverResponse, $next
        );

        $this->assertEquals(
            $next($serverRequest, $serverResponse), $response
        );
    }

    /**
     * Test Response object
     */
    public function testResponseWithInvalidResultEmail()
    {
        $lang        = 'de';
        $uri         = '/' . $lang . '/user/login';
        $routeParams = [
            'lang' => $lang,
        ];
        $routeName   = 'home';
        $postData    = [
            'email'      => 'Email',
            'password'   => 'password',
            'login_user' => 'login_user',
        ];
        $requestUri  = $uri;
        $authError   = 'user_auth_email_unknown';

        $this->prepareRouter($routeName, $routeParams, $uri, false);
        $this->prepareLoginForm($postData);
        $this->prepareAuthService(true, false);
        $this->prepareAuthAdapter($postData, true, false);
        $this->prepareAuthResult(
            false, true, Result::FAILURE_IDENTITY_NOT_FOUND
        );

        $action = new HandleLoginAction();
        $action->setRouter($this->router->reveal());
        $action->setAuthenticationService(
            $this->authService->reveal()
        );
        $action->setLoginForm(
            $this->loginForm->reveal()
        );

        $serverRequest = new ServerRequest([$requestUri]);
        $serverRequest = $serverRequest->withParsedBody($postData);
        $serverRequest = $serverRequest->withAttribute('lang', $lang);
        $serverRequest = $serverRequest->withAttribute(
            'auth_error', $authError
        );

        $serverResponse = new Response();

        $next = function ($serverRequest, $serverResponse) {
            return md5(
                serialize($serverRequest) . serialize($serverResponse)
            );
        };

        /** @var RedirectResponse $response */
        $response = $action(
            $serverRequest, $serverResponse, $next
        );

        $this->assertEquals(
            $next($serverRequest, $serverResponse), $response
        );
    }

    /**
     * Test Response object
     */
    public function testResponseWithException()
    {
        $lang        = 'de';
        $uri         = '/' . $lang . '/user/login';
        $routeParams = [
            'lang' => $lang,
        ];
        $routeName   = 'home';
        $postData    = [
            'email'      => 'Email',
            'password'   => 'password',
            'login_user' => 'login_user',
        ];
        $requestUri  = $uri;
        $authError   = 'user_auth_email_unknown';

        $this->prepareRouter($routeName, $routeParams, $uri, false);
        $this->prepareLoginForm($postData);
        $this->prepareAuthService(true, false, RuntimeException::class);
        $this->prepareAuthAdapter($postData, true, false);
        $this->prepareAuthResult(true, false);

        $action = new HandleLoginAction();
        $action->setRouter($this->router->reveal());
        $action->setAuthenticationService(
            $this->authService->reveal()
        );
        $action->setLoginForm(
            $this->loginForm->reveal()
        );

        $serverRequest = new ServerRequest([$requestUri]);
        $serverRequest = $serverRequest->withParsedBody($postData);
        $serverRequest = $serverRequest->withAttribute('lang', $lang);
        $serverRequest = $serverRequest->withAttribute(
            'auth_error', $authError
        );

        $serverResponse = new Response();

        $next = function ($serverRequest, $serverResponse) {
            return md5(
                serialize($serverRequest) . serialize($serverResponse)
            );
        };

        /** @var RedirectResponse $response */
        $response = $action(
            $serverRequest, $serverResponse, $next
        );

        $this->assertEquals(
            $next($serverRequest, $serverResponse), $response
        );
    }
}
