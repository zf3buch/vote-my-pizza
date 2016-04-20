<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/vote-my-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace User\View\Helper;

use stdClass;
use Interop\Container\ContainerInterface;
use User\Permissions\GuestRole;
use Zend\Authentication\AuthenticationServiceInterface;
use Zend\View\HelperPluginManager;

/**
 * Class IdentityFactory
 *
 * @package User\View\Helper
 */
class IdentityFactory
{
    /**
     * @param ContainerInterface|HelperPluginManager $container
     *
     * @return Identity
     */
    public function __invoke(ContainerInterface $container)
    {
        /** @var AuthenticationServiceInterface $authenticationService */
        $authenticationService = $container->get(
            AuthenticationServiceInterface::class
        );

        if ($authenticationService->hasIdentity()) {
            $identity = $authenticationService->getIdentity();
        } else {
            $identity = new stdClass();
            $identity->role = GuestRole::NAME;
        }

        $viewHelper = new Identity($identity);

        return $viewHelper;
    }
}