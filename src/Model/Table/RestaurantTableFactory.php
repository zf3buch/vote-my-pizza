<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/vote-my-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace Application\Model\Table;

use Interop\Container\ContainerInterface;
use Zend\Db\Adapter\AdapterInterface;

/**
 * Class RestaurantTableFactory
 *
 * @package Application\Model\Table
 */
class RestaurantTableFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return RestaurantTable
     */
    public function __invoke(ContainerInterface $container)
    {
        $adapter = $container->get(AdapterInterface::class);

        return new RestaurantTable($adapter);
    }
}