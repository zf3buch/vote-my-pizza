<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/vote-my-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */


return [
    'middleware_pipeline' => [
        'pre_routing' => [
            [
                'middleware' => [
                    Application\I18n\Middleware\CheckLanguage::class,
                    Zend\Expressive\Helper\ServerUrlMiddleware::class,
                    Zend\Expressive\Helper\UrlHelperMiddleware::class,
                    Application\I18n\Middleware\InjectTranslator::class,
                    User\Authorization\AuthorizationMiddleware::class,
                ],
            ],
        ],

        'post_routing' => [
        ],
    ],
];
