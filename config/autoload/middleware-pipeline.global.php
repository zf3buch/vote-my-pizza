<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/vote-my-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */


return [
    'dependencies' => [
        'invokables' => [
            Application\I18n\CheckLanguageMiddleware::class =>
                Application\I18n\CheckLanguageMiddleware::class,
        ],
        'factories'  => [
            Zend\Expressive\Helper\ServerUrlMiddleware::class  =>
                Zend\Expressive\Helper\ServerUrlMiddlewareFactory::class,
            Zend\Expressive\Helper\UrlHelperMiddleware::class  =>
                Zend\Expressive\Helper\UrlHelperMiddlewareFactory::class,
            Application\I18n\InjectTranslatorMiddleware::class =>
                Application\I18n\InjectTranslatorMiddlewareFactory::class,
        ],
    ],

    'middleware_pipeline' => [
        'pre_routing' => [
            [
                'middleware' => [
                    Application\I18n\CheckLanguageMiddleware::class,
                    Zend\Expressive\Helper\ServerUrlMiddleware::class,
                    Zend\Expressive\Helper\UrlHelperMiddleware::class,
                    Application\I18n\InjectTranslatorMiddleware::class,
                ],
            ],
        ],

        'post_routing' => [
        ],
    ],
];
