<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/vote-my-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace Pizza\Model\Storage\Db;

use Interop\Container\ContainerInterface;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

/**
 * Class RestaurantDbStorageFactory
 *
 * @package Pizza\Model\Storage\Db
 */
class RestaurantDbStorageFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return RestaurantDbStorage
     */
    public function __invoke(ContainerInterface $container)
    {
        $adapter = $container->get(AdapterInterface::class);

        $resultSet = new ResultSet(ResultSet::TYPE_ARRAY);

        $tableGateway = new TableGateway(
            'restaurant', $adapter, null, $resultSet
        );

        return new RestaurantDbStorage($tableGateway);
    }
}
