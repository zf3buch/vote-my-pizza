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
            Application\Action\HomePageAction::class =>
                Application\Action\HomePageFactory::class,
            Application\Action\VotingAction::class =>
                Application\Action\VotingFactory::class,
            Application\Action\CommentAction::class =>
                Application\Action\CommentFactory::class,
            Application\Model\Repository\PizzaRepository::class =>
                Application\Model\Repository\PizzaRepositoryFactory::class,
            Zend\Expressive\Application::class =>
                Zend\Expressive\Container\ApplicationFactory::class,
        ]
    ]
];
