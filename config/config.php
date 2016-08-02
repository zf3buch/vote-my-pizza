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

$cachedConfigFile = PROJECT_ROOT . '/data/cache/app_config.php';

$pattern = PROJECT_ROOT . '/config/autoload/{{,*.}global,{,*.}'
    . APPLICATION_ENV . ',{,*.}local}.php';

$configManager = new ConfigManager(
    [
        Zend\I18n\ConfigProvider::class,
        Zend\Form\ConfigProvider::class,
        Zend\InputFilter\ConfigProvider::class,
        Zend\Hydrator\ConfigProvider::class,
        Zend\Db\ConfigProvider::class,
        Application\ConfigProvider::class,
        I18n\ConfigProvider::class,
        Pizza\ConfigProvider::class,
        new PhpFileProvider($pattern),
    ],
    $cachedConfigFile
);

return new ArrayObject(
    $configManager->getMergedConfig(), ArrayObject::ARRAY_AS_PROPS
);
