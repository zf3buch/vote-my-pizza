<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/vote-my-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace Application\I18n;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\I18n\Translator\Translator;
use Zend\I18n\View\Helper\Translate;

/**
 * Class InjectTranslatorMiddleware
 *
 * @package Application\I18n
 */
class InjectTranslatorMiddleware
{
    /**
     * @var Translator
     */
    private $translator;

    /**
     * @var Translate
     */
    private $translateHelper;

    /**
     * InjectTranslatorMiddleware constructor.
     *
     * @param Translator $translator
     * @param Translate  $translateHelper
     */
    public function __construct(
        Translator $translator,
        Translate $translateHelper
    ) {
        $this->translator = $translator;
        $this->translateHelper = $translateHelper;
    }

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface      $response
     * @param callable|null          $next
     *
     * @return RedirectResponse|callable|null
     */
    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        callable $next = null
    ) {
        var_dump($this->translator);
        var_dump($this->translateHelper);

        return $next($request, $response);
    }
}
