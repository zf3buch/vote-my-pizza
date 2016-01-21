<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/vote-my-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

use Application\I18n\Middleware\CheckLanguage;
use Application\I18n\Middleware\InjectTranslator;
use Zend\Expressive\Container\ApplicationFactory;
use Zend\Expressive\Helper\ServerUrlMiddleware;
use Zend\Expressive\Helper\ServerUrlMiddlewareFactory;
use Zend\Expressive\Helper\UrlHelperMiddleware;
use Zend\Expressive\Helper\UrlHelperMiddlewareFactory;

return [
    'dependencies' => [
        'invokables' => [
            Application\I18n\Middleware\CheckLanguage::class =>
                Application\I18n\Middleware\CheckLanguage::class,
        ],
        'factories' => [
            ServerUrlMiddleware::class =>
                ServerUrlMiddlewareFactory::class,
            UrlHelperMiddleware::class =>
                UrlHelperMiddlewareFactory::class,
        ],
    ],

    'middleware_pipeline' => [
        'always' => [
            'middleware' => [
                ServerUrlMiddleware::class,
                CheckLanguage::class,
            ],
            'priority' => 10000,
        ],

        'routing' => [
            'middleware' => [
                ApplicationFactory::ROUTING_MIDDLEWARE,
                UrlHelperMiddleware::class,
                InjectTranslator::class,
                ApplicationFactory::DISPATCH_MIDDLEWARE,
            ],
            'priority' => 1,
        ],

        'error' => [
            'middleware' => [
                // Add error middleware here.
            ],
            'error'    => true,
            'priority' => -10000,
        ],
    ],
];
