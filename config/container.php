<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/vote-my-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

use Zend\ServiceManager\Config;
use Zend\ServiceManager\ServiceManager;

$config = require APPLICATION_ROOT . '/config/config.php';

$container = new ServiceManager(new Config($config['dependencies']));
$container->setService('config', $config);

return $container;
