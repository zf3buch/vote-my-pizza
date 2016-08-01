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
            Pizza\Action\ShowPizzaAction::class        =>
                Pizza\Action\ShowPizzaFactory::class,
            Pizza\Action\HandleVotingAction::class     =>
                Pizza\Action\HandleVotingFactory::class,
            Pizza\Action\HandleRestaurantAction::class =>
                Pizza\Action\HandleRestaurantFactory::class,
            Pizza\Action\DeleteRestaurantAction::class =>
                Pizza\Action\DeleteRestaurantFactory::class,
            Pizza\Action\RedirectIntroAction::class =>
                Pizza\Action\RedirectIntroFactory::class,

            Pizza\Model\Storage\PizzaStorageInterface::class =>
                Pizza\Model\Storage\Db\PizzaDbStorageFactory::class,
            Pizza\Model\Storage\RestaurantStorageInterface::class =>
                Pizza\Model\Storage\Db\RestaurantDbStorageFactory::class,

            Pizza\Model\Repository\PizzaRepositoryInterface::class      =>
                Pizza\Model\Repository\PizzaRepositoryFactory::class,
            Pizza\Model\Repository\RestaurantRepositoryInterface::class =>
                Pizza\Model\Repository\RestaurantRepositoryFactory::class,

            Pizza\Model\InputFilter\RestaurantInputFilter::class =>
                Pizza\Model\InputFilter\RestaurantInputFilterFactory::class,

            Pizza\Form\RestaurantPriceForm::class =>
                Pizza\Form\RestaurantPriceFactory::class,
        ],
    ],

    'routes' => [
        [
            'name'            => 'home',
            'path'            => '/:lang',
            'middleware'      => Pizza\Action\ShowIntroAction::class,
            'allowed_methods' => ['GET'],
            'options'         => [
                'constraints' => [
                    'lang' => '(de|en)',
                ],
            ],
        ],
        [
            'name'            => 'pizza-intro',
            'path'            => '/:lang/pizza',
            'middleware'      => Pizza\Action\RedirectIntroAction::class,
            'allowed_methods' => ['GET'],
            'options'         => [
                'constraints' => [
                    'lang' => '(de|en)',
                ],
            ],
        ],
        [
            'name'            => 'pizza-voting',
            'path'            => '/:lang/pizza/voting',
            'middleware'      => Pizza\Action\ShowVotingAction::class,
            'allowed_methods' => ['GET'],
            'options'         => [
                'constraints' => [
                    'lang' => '(de|en)',
                ],
            ],
        ],
        [
            'name'            => 'pizza-show',
            'path'            => '/:lang/pizza/show/:id',
            'middleware'      => Pizza\Action\ShowPizzaAction::class,
            'allowed_methods' => ['GET'],
            'options'         => [
                'constraints' => [
                    'id'   => '[1-9][0-9]*',
                    'lang' => '(de|en)',
                ],
            ],
        ],
        [
            'name'            => 'pizza-handle-voting',
            'path'            => '/:lang/pizza/voting/:pos/:neg',
            'middleware'      => Pizza\Action\HandleVotingAction::class,
            'allowed_methods' => ['GET'],
            'options'         => [
                'constraints' => [
                    'pos'  => '[1-9][0-9]*',
                    'neg'  => '[1-9][0-9]*',
                    'lang' => '(de|en)',
                ],
            ],
        ],
        [
            'name'            => 'pizza-handle-restaurant',
            'path'            => '/:lang/pizza/restaurant/:id',
            'middleware'      => [
                Pizza\Action\HandleRestaurantAction::class,
                Pizza\Action\ShowPizzaAction::class,
            ],
            'allowed_methods' => ['POST'],
            'options'         => [
                'constraints' => [
                    'id'   => '[1-9][0-9]*',
                    'lang' => '(de|en)',
                ],
            ],
        ],
        [
            'name'            => 'pizza-delete-restaurant',
            'path'            => '/:lang/pizza/restaurant/:id/delete/:priceId',
            'middleware'      => Pizza\Action\DeleteRestaurantAction::class,
            'allowed_methods' => ['GET'],
            'options'         => [
                'constraints' => [
                    'id'      => '[1-9][0-9]*',
                    'priceId' => '[1-9][0-9]*',
                    'lang'    => '(de|en)',
                ],
            ],
        ],
    ],

    'templates' => [
        'paths' => [
            'pizza' => [PIZZA_ROOT . '/templates/pizza'],
        ],
    ],

    'translate' => [
        'translation_file_patterns' => [
            [
                'type'         => 'phparray',
                'base_dir'     => PIZZA_ROOT . '/language',
                'pattern'      => '%s.php',
                'text_domain'  => 'default',
            ],
        ],
    ],
];
