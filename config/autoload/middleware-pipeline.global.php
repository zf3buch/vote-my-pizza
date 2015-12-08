<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/vote-my-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

return [
    'dependencies'        => [
        'factories' => [
            Zend\Expressive\Helper\ServerUrlMiddleware::class =>
                Zend\Expressive\Helper\ServerUrlMiddlewareFactory::class,
        ],
    ],
    'middleware_pipeline' => [
        'pre_routing' => [
            [
                'middleware' =>
                    Zend\Expressive\Helper\ServerUrlMiddleware::class
            ],
        ],

        'post_routing' => [
        ],
    ],
];
