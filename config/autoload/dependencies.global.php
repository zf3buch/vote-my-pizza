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

            Application\Model\TableGateway\PizzaTableGatewayInterface::class =>
                Application\Model\TableGateway\PizzaTableGatewayFactory::class,

            Application\Model\Repository\PizzaRepositoryInterface::class =>
                Application\Model\Repository\DbPizzaRepositoryFactory::class,

            Zend\Expressive\Application::class =>
                Zend\Expressive\Container\ApplicationFactory::class,
        ]
    ]
];
