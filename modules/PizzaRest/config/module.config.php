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
            PizzaRest\Action\GetIdAction::class        =>
                PizzaRest\Action\GetIdFactory::class,
            PizzaRest\Action\GetListAction::class       =>
                PizzaRest\Action\GetListFactory::class,
            PizzaRest\Action\PostAction::class       =>
                PizzaRest\Action\PostFactory::class,
        ],
    ],

    'routes' => [
        [
            'name'            => 'pizza-rest-get-id',
            'path'            => '/:lang/rest/pizza/:id',
            'middleware'      => PizzaRest\Action\GetIdAction::class,
            'allowed_methods' => ['GET'],
            'options'         => [
                'constraints' => [
                    'id'   => '[1-9][0-9]*',
                    'lang' => '(de|en)',
                ],
            ],
        ],
        [
            'name'            => 'pizza-rest-get-list',
            'path'            => '/:lang/rest/pizza',
            'middleware'      => PizzaRest\Action\GetListAction::class,
            'allowed_methods' => ['GET'],
            'options'         => [
                'constraints' => [
                    'lang' => '(de|en)',
                ],
            ],
        ],
        [
            'name'            => 'pizza-rest-post',
            'path'            => '/:lang/rest/pizza',
            'middleware'      => PizzaRest\Action\PostAction::class,
            'allowed_methods' => ['POST'],
            'options'         => [
                'constraints' => [
                    'lang' => '(de|en)',
                ],
            ],
        ],
    ],
];
