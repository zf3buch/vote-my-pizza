<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/vote-my-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

return [
    'routes' => [
        [
            'name' => 'home',
            'path' => '/',
            'middleware' => Pizza\Action\HomePageAction::class,
            'allowed_methods' => ['GET'],
        ],
        [
            'name'            => 'show-voting',
            'path'            => '/voting',
            'middleware'      => Pizza\Action\ShowVotingAction::class,
            'allowed_methods' => ['GET'],
        ],
        [
            'name'            => 'handle-voting',
            'path'            => '/voting/:pos/:neg',
            'middleware'      => Pizza\Action\HandleVotingAction::class,
            'allowed_methods' => ['GET'],
            'options'         => [
                'constraints' => [
                    'pos' => '[0-9]+',
                    'neg' => '[0-9]+',
                ],
            ],
        ],
        [
            'name'            => 'handle-restaurant',
            'path'            => '/restaurant/:id',
            'middleware'      => Pizza\Action\HandleRestaurantAction::class,
            'allowed_methods' => ['GET'],
            'options'         => [
                'constraints' => [
                    'id' => '[0-9]+',
                ],
            ],
        ],
    ],

    'dependencies' => [
        'factories' => [
            Pizza\Action\HomePageAction::class         =>
                Pizza\Action\HomePageFactory::class,
            Pizza\Action\ShowVotingAction::class       =>
                Pizza\Action\ShowVotingFactory::class,
            Pizza\Action\HandleVotingAction::class     =>
                Pizza\Action\HandleVotingFactory::class,
            Pizza\Action\HandleRestaurantAction::class =>
                Pizza\Action\HandleRestaurantFactory::class,

            Pizza\Model\Table\PizzaTableInterface::class =>
                Pizza\Model\Table\PizzaTableFactory::class,
            Pizza\Model\Table\RestaurantTableInterface::class =>
                Pizza\Model\Table\RestaurantTableFactory::class,

            Pizza\Model\Service\PizzaServiceInterface::class =>
                Pizza\Model\Service\DbPizzaServiceFactory::class,
        ]
    ],

    'templates' => [
        'paths' => [
            'pizza' => ['modules/Pizza/templates'],
        ]
    ]
];
