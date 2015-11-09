<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @package    Application
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/vote-my-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

return [
    'dependencies' => [
        'factories' => [
            App\Action\HomePageAction::class =>
                App\Action\HomePageFactory::class,
            Zend\Expressive\Application::class =>
                Zend\Expressive\Container\ApplicationFactory::class,
        ]
    ]
];
