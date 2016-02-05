<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/vote-my-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace User\View\Helper;

use Interop\Container\ContainerInterface;
use User\Permissions\GuestRole;
use User\Permissions\Rbac;
use Zend\Authentication\AuthenticationServiceInterface;
use Zend\View\HelperPluginManager;

/**
 * Class AllowedFactory
 *
 * @package User\View\Helper
 */
class AllowedFactory
{
    /**
     * @param ContainerInterface|HelperPluginManager $viewHelperManager
     *
     * @return Allowed
     */
    public function __invoke(ContainerInterface $viewHelperManager)
    {
        $diContainer = $viewHelperManager->getServiceLocator();

        /** @var AuthenticationServiceInterface $authenticationService */
        $authenticationService = $diContainer->get(
            AuthenticationServiceInterface::class
        );

        if ($authenticationService->hasIdentity()) {
            $role = $authenticationService->getIdentity()->role;
        } else {
            $role = GuestRole::NAME;
        }

        /** @var Rbac $rbac */
        $rbac = $diContainer->get(Rbac::class);

        $viewHelper = new Allowed($role, $rbac);

        return $viewHelper;
    }
}