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

            Zend\Expressive\Router\RouterInterface::class =>
                Zend\Expressive\Router\ZendRouter::class,

            Zend\Session\Config\SessionConfig::class =>
                Zend\Session\Service\SessionConfigFactory::class,

            Application\I18n\Middleware\CheckLanguage::class =>
                Application\I18n\Middleware\CheckLanguage::class,
        ],

        'factories' => [
            Zend\Expressive\Application::class =>
                Application\Expressive\ApplicationFactory::class,
            Zend\Expressive\Helper\UrlHelper::class =>
                Application\View\Helper\UrlHelperFactory::class,
            Zend\Expressive\Helper\ServerUrlMiddleware::class  =>
                Zend\Expressive\Helper\ServerUrlMiddlewareFactory::class,
            Zend\Expressive\Helper\UrlHelperMiddleware::class  =>
                Zend\Expressive\Helper\UrlHelperMiddlewareFactory::class,

            'Zend\Expressive\FinalHandler' =>
                Zend\Expressive\Container\TemplatedErrorHandlerFactory::class,

            Zend\Expressive\Template\TemplateRendererInterface::class =>
                Zend\Expressive\ZendView\ZendViewRendererFactory::class,

            Zend\View\HelperPluginManager::class =>
                Application\View\HelperPluginManagerFactory::class,

            Zend\I18n\Translator\Translator::class =>
                Application\I18n\Translator\TranslatorFactory::class,

            Application\I18n\Observer\SetLanguageObserver::class =>
                Application\I18n\Observer\SetLanguageObserverFactory::class,

            Application\I18n\Middleware\InjectTranslator::class =>
                Application\I18n\Middleware\InjectTranslatorFactory::class,
            User\Authorization\AuthorizationMiddleware::class =>
                User\Authorization\AuthorizationMiddlewareFactory::class,
        ],
    ],
];
