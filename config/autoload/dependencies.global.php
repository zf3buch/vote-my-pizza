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
            Application\Action\ShowVotingAction::class =>
                Application\Action\ShowVotingFactory::class,
            Application\Action\HandleVotingAction::class =>
                Application\Action\HandleVotingFactory::class,
            Application\Action\HandleRestaurantAction::class =>
                Application\Action\HandleRestaurantFactory::class,

            Application\Model\Service\PizzaServiceInterface::class =>
                Application\Model\Service\StaticPizzaServiceFactory::class,

            Zend\Expressive\Application::class =>
                Zend\Expressive\Container\ApplicationFactory::class,
        ]
    ]
];
