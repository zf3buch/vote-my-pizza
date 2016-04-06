<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/vote-my-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

use Zend\ServiceManager\ServiceManager;

$config = require PROJECT_ROOT . '/config/config.php';

$container = new ServiceManager($config['dependencies']);
$container->setService('config', $config);

return $container;
