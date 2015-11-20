<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/vote-my-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace Application\Model\TableGateway;

use Interop\Container\ContainerInterface;
use Zend\Db\Adapter\AdapterInterface;

/**
 * Class PizzaTableGatewayFactory
 *
 * @package Application\Model\TableGateway
 */
class PizzaTableGatewayFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return PizzaTableGateway
     */
    public function __invoke(ContainerInterface $container)
    {
        $adapter = $container->get(AdapterInterface::class);

        return new PizzaTableGateway($adapter);
    }
}