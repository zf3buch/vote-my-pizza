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
            Zend\Expressive\Helper\ServerUrlHelper::class =>
                Zend\Expressive\Helper\ServerUrlHelper::class,
        ],

        'factories' => [
            Zend\Expressive\Application::class =>
                Application\Expressive\ApplicationFactory::class,
            Zend\Expressive\Helper\UrlHelper::class =>
                Application\View\Helper\UrlHelperFactory::class,
            Zend\I18n\Translator\Translator::class =>
                Application\I18n\Translator\TranslatorFactory::class,
            Application\I18n\Observer\SetLanguageObserver::class =>
                Application\I18n\Observer\SetLanguageObserverFactory::class,
        ],
    ],

    'translate' => [
        'translation_file_patterns' => [
            [
                'type'         => 'phpArray',
                'base_dir'     => APPLICATION_ROOT . '/language/application',
                'pattern'      => '%s.php',
                'text_domain'  => 'default',
            ],
        ],
    ],
];
