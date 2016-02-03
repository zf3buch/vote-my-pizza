<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/vote-my-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

use Zend\Expressive\ConfigManager\ConfigManager;
use Zend\Expressive\ConfigManager\PhpFileProvider;
use Zend\Stdlib\ArrayUtils;

$cachedConfigFile = PROJECT_ROOT . '/data/cache/app_config.php';

$pattern = '{{,*.}global,{,*.}' . APPLICATION_ENV . ',{,*.}local}.php';

$configManager = new ConfigManager(
    [
        Application\ApplicationConfig::class,
        Pizza\PizzaConfig::class,
        new PhpFileProvider(PROJECT_ROOT . '/config/autoload/' . $pattern),
    ],
    $cachedConfigFile
);

return new ArrayObject(
    $configManager->getMergedConfig(), ArrayObject::ARRAY_AS_PROPS
);
