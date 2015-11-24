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

            Pizza\Action\ShowVotingAction::class =>
                Pizza\Action\ShowVotingFactory::class,
            Pizza\Action\HandleVotingAction::class =>
                Pizza\Action\HandleVotingFactory::class,
            Pizza\Action\HandleRestaurantAction::class =>
                Pizza\Action\HandleRestaurantFactory::class,

            Pizza\Model\Table\PizzaTableInterface::class =>
                Pizza\Model\Table\PizzaTableFactory::class,
            Pizza\Model\Table\RestaurantTableInterface::class =>
                Pizza\Model\Table\RestaurantTableFactory::class,

            Pizza\Model\Service\PizzaServiceInterface::class =>
                Pizza\Model\Service\DbPizzaServiceFactory::class,

            Zend\Expressive\Application::class =>
                Zend\Expressive\Container\ApplicationFactory::class,
        ]
    ]
];
