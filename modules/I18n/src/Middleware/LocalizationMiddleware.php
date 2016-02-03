<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/vote-my-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace I18n\Middleware;

use Locale;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Expressive\Router\RouteResult;
use Zend\I18n\Translator\Translator;

/**
 * Class LocalizationMiddleware
 *
 * @package I18n\Middleware
 */
class LocalizationMiddleware
{
    /**
     * @var Translator
     */
    private $translator;

    /**
     * @var string
     */
    private $default = 'de';

    /**
     * @var array
     */
    private $locales = [
        'de' => 'de_DE',
        'en' => 'en_US',
    ];

    /**
     * LocalizationMiddleware constructor.
     *
     * @param Translator $translator
     */
    public function __construct(Translator $translator)
    {
        $this->translator = $translator;
    }

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface      $response
     * @param callable|null          $next
     *
     * @return callable|null
     */
    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        callable $next = null
    ) {
        $result = $request->getAttribute(RouteResult::class, false);

        if ($result === false || $result->isFailure()) {
            $lang = $this->default;
        } else {
            $matchedParams = $result->getMatchedParams();

            $lang = $matchedParams['lang'] ?: $this->default;
        }

        $locale = $this->locales[$lang];

        Locale::setDefault($locale);

        $this->translator->setLocale($locale);

        return $next($request, $response);
    }
}
