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
        'factories' => [
            Pizza\Action\ShowIntroAction::class        =>
                Pizza\Action\ShowIntroFactory::class,
            Pizza\Action\ShowVotingAction::class       =>
                Pizza\Action\ShowVotingFactory::class,
            Pizza\Action\HandleVotingAction::class     =>
                Pizza\Action\HandleVotingFactory::class,
            Pizza\Action\HandleRestaurantAction::class =>
                Pizza\Action\HandleRestaurantFactory::class,

            Pizza\Model\Service\PizzaServiceInterface::class =>
                Pizza\Model\Service\StaticPizzaServiceFactory::class,
        ]
    ],

    'routes' => [
        [
            'name'            => 'pizza-intro',
            'path'            => '/pizza',
            'middleware'      => Pizza\Action\ShowIntroAction::class,
            'allowed_methods' => ['GET'],
        ],
        [
            'name'            => 'pizza-voting',
            'path'            => '/pizza/voting',
            'middleware'      => Pizza\Action\ShowVotingAction::class,
            'allowed_methods' => ['GET'],
        ],
        [
            'name'            => 'pizza-handle-voting',
            'path'            => '/pizza/voting/:pos/:neg',
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
            'name'            => 'pizza-handle-restaurant',
            'path'            => '/pizza/restaurant/:id',
            'middleware'      => Pizza\Action\HandleRestaurantAction::class,
            'allowed_methods' => ['GET'],
            'options'         => [
                'constraints' => [
                    'id' => '[0-9]+',
                ],
            ],
        ],
    ],

    'templates' => [
        'paths' => [
            'pizza' => ['templates/pizza'],
        ]
    ]
];
