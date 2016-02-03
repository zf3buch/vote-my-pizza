<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/vote-my-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace I18n\View\Helper;

use Zend\Expressive\Helper\Exception\MissingRouterException;
use Zend\Expressive\Helper\UrlHelper as ExpressiveUrlHelper;
use Zend\Expressive\Router\Exception\RuntimeException;
use Zend\Expressive\Router\RouteResult;

/**
 * Class UrlHelper
 *
 * @package I18n\View\Helper
 */
class UrlHelper extends ExpressiveUrlHelper
{
    /**
     * @var RouteResult
     */
    private $result;

    /**
     * @var string
     */
    private $defaultLang = 'de';

    /**
     * @var string
     */
    private $defaultRoute = 'home';

    /**
     * Inject a route result.
     *
     * When the route result is injected, the helper will use it to seed default
     * parameters if the URL being generated is for the route that was matched.
     *
     * @param RouteResult $result
     */
    public function setRouteResult(RouteResult $result)
    {
        $this->result = $result;

        parent::setRouteResult($result);
    }

    /**
     * Generate a URL based on a given route.
     *
     * @param string $route
     * @param array  $params
     *
     * @return string
     * @throws RuntimeException if no route provided, and no
     *                                    result match present.
     * @throws RuntimeException if no route provided, and result
     *                                    match is a routing failure.
     * @throws MissingRouterException if router cannot generate URI for
     *                                given route.
     */
    public function __invoke($route = null, array $params = [])
    {
        if (!$route && !$this->result) {
            $route = $this->defaultRoute;
        } elseif (!$route && $this->result->isFailure()) {
            $route = $this->defaultRoute;
        }

        $lang = $this->defaultLang;

        if ($this->result) {
            $matchedParams = $this->result->getMatchedParams();

            if (isset($matchedParams['lang'])) {
                $lang = $matchedParams['lang'];
            }
        }

        $params = array_merge(['lang' => $lang], $params);

        return parent::__invoke($route, $params);
    }

}