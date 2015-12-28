<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/vote-my-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

use Application\ApplicationConfig;

return [
    'dependencies' => [
        'invokables' => [
            Application\I18n\Middleware\CheckLanguage::class =>
                Application\I18n\Middleware\CheckLanguage::class,
        ],

        'factories' => [
            Zend\Session\Config\SessionConfig::class =>
                Zend\Session\Service\SessionConfigFactory::class,

            Zend\I18n\Translator\Translator::class =>
                Application\I18n\Translator\TranslatorFactory::class,

            Application\Action\HomePageAction::class =>
                Application\Action\HomePageFactory::class,

            Application\I18n\Observer\SetLanguageObserver::class =>
                Application\I18n\Observer\SetLanguageObserverFactory::class,

            Application\I18n\Middleware\InjectTranslator::class =>
                Application\I18n\Middleware\InjectTranslatorFactory::class,
        ],
    ],

    'routes' => [
        [
            'name'            => 'home',
            'path'            => '/:lang',
            'middleware'      => Application\Action\HomePageAction::class,
            'allowed_methods' => ['GET'],
            'options'         => [
                'constraints' => [
                    'lang' => '(de|en)',
                ],
            ],
        ],
    ],

    'templates' => [
        'layout' => 'layout/default',
        'map'    => [
            'layout/default' => ApplicationConfig::ROOT . '/templates/layout/default.phtml',
            'error/error'    => ApplicationConfig::ROOT . '/templates/error/error.phtml',
            'error/404'      => ApplicationConfig::ROOT . '/templates/error/404.phtml',
        ],
        'paths'  => [
            'application' => [ApplicationConfig::ROOT . '/templates/application'],
            'layout'      => [ApplicationConfig::ROOT . '/templates/layout'],
            'error'       => [ApplicationConfig::ROOT . '/templates/error'],
        ],
    ],

    'translate' => [
        'translation_file_patterns' => [
            [
                'type'        => 'phpArray',
                'base_dir'    => ApplicationConfig::ROOT . '/language',
                'pattern'     => '%s.php',
                'text_domain' => 'default',
            ],
        ],
    ],

    'session_config' => [
        'save_path'       => realpath(APPLICATION_ROOT . '/data/session'),
        'name'            => 'MY_SESSION',
        'cookie_lifetime' => 365 * 24 * 60 * 60,
        'gc_maxlifetime'  => 720,
    ],
];
