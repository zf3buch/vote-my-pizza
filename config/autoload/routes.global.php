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
            Zend\Expressive\Router\RouterInterface::class =>
                Zend\Expressive\Router\ZendRouter::class,
        ],
    ],

    'routes' => [
        [
            'name' => 'home',
            'path' => '/',
            'middleware' => Application\Action\HomePageAction::class,
            'allowed_methods' => ['GET'],
        ],
        [
            'name' => 'show-voting',
            'path' => '/voting',
            'middleware' => Pizza\Action\ShowVotingAction::class,
            'allowed_methods' => ['GET'],
        ],
        [
            'name' => 'handle-voting',
            'path' => '/voting/:pos/:neg',
            'middleware' => Pizza\Action\HandleVotingAction::class,
            'allowed_methods' => ['GET'],
            'options' => [
                'constraints' => [
                    'pos' => '[0-9]+',
                    'neg' => '[0-9]+',
                ],
            ],
        ],
        [
            'name' => 'handle-restaurant',
            'path' => '/restaurant/:id',
            'middleware' => Pizza\Action\HandleRestaurantAction::class,
            'allowed_methods' => ['GET'],
            'options' => [
                'constraints' => [
                    'id' => '[0-9]+',
                ],
            ],
        ],
    ],
];
