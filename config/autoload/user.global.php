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
            User\Action\ShowLoginAction::class   =>
                User\Action\ShowLoginFactory::class,
//            User\Action\HandleLoginAction::class =>
//                User\Action\HandleLoginFactory::class,

            User\Model\InputFilter\LoginInputFilter::class =>
                User\Model\InputFilter\LoginInputFilterFactory::class,

            User\Form\LoginForm::class =>
                User\Form\LoginFormFactory::class,
        ],
    ],

    'routes' => [
        [
            'name'            => 'user-login',
            'path'            => '/:lang/user',
            'middleware'      => User\Action\ShowLoginAction::class,
            'allowed_methods' => ['GET'],
            'options'         => [
                'constraints' => [
                    'lang' => '(de|en)',
                ],
            ],
        ],
        [
            'name'            => 'user-handle-login',
            'path'            => '/:lang/user/login',
            'middleware'      => User\Action\HandleLoginAction::class,
            'allowed_methods' => ['POST'],
            'options'         => [
                'constraints' => [
                    'lang' => '(de|en)',
                ],
            ],
        ],
    ],

    'templates' => [
        'paths' => [
            'user' => ['templates/user'],
        ],
    ],

    'translate' => [
        'translation_file_patterns' => [
            [
                'type'        => 'phpArray',
                'base_dir'    => APPLICATION_ROOT . '/language/user',
                'pattern'     => '%s.php',
                'text_domain' => 'default',
            ],
        ],
    ],
];
