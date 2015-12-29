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
            Application\I18n\Middleware\CheckLanguage::class =>
                Application\I18n\Middleware\CheckLanguage::class,
        ],

        'factories' => [
            Zend\Db\Adapter\AdapterInterface::class =>
                Zend\Db\Adapter\AdapterServiceFactory::class,

            Zend\Session\Config\SessionConfig::class =>
                Zend\Session\Service\SessionConfigFactory::class,

            Zend\I18n\Translator\Translator::class =>
                Application\I18n\Translator\TranslatorFactory::class,

            Application\I18n\Observer\SetLanguageObserver::class =>
                Application\I18n\Observer\SetLanguageObserverFactory::class,

            Application\I18n\Middleware\InjectTranslator::class =>
                Application\I18n\Middleware\InjectTranslatorFactory::class,
        ],
    ],

    'templates' => [
        'layout' => 'layout/default',
        'map'    => [
            'layout/default' => APPLICATION_ROOT . '/templates/layout/default.phtml',
            'error/error'    => APPLICATION_ROOT . '/templates/error/error.phtml',
            'error/404'      => APPLICATION_ROOT . '/templates/error/404.phtml',
        ],
        'paths'  => [
            'layout'      => [APPLICATION_ROOT . '/templates/layout'],
            'error'       => [APPLICATION_ROOT . '/templates/error'],
        ],
    ],

    'translate' => [
        'translation_file_patterns' => [
            [
                'type'        => 'phpArray',
                'base_dir'    => APPLICATION_ROOT . '/language',
                'pattern'     => '%s.php',
                'text_domain' => 'default',
            ],
        ],
    ],

    'session_config' => [
        'save_path'       => realpath(PROJECT_ROOT . '/data/session'),
        'name'            => 'MY_SESSION',
        'cookie_lifetime' => 365 * 24 * 60 * 60,
        'gc_maxlifetime'  => 720,
    ],
];
