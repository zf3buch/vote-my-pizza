<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/vote-my-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace Application\I18n\Observer;

use Locale;
use Zend\Expressive\Router\RouteResult;
use Zend\Expressive\Router\RouteResultObserverInterface;
use Zend\I18n\Translator\Translator;

/**
 * Class SetLanguageObserver
 *
 * @package Application\I18n\Observer
 */
class SetLanguageObserver implements RouteResultObserverInterface
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
     * SetLanguageObserver constructor.
     *
     * @param Translator $translator
     */
    public function __construct(Translator $translator)
    {
        $this->translator = $translator;
    }

    /**
     * @param RouteResult $result
     */
    public function update(RouteResult $result)
    {
        if ($result->isFailure()) {
            $lang = $this->default;
        } else {
            $matchedParams = $result->getMatchedParams();

            $lang = $matchedParams['lang'] ?: $this->default;
        }

        $locale = $this->locales[$lang];

        Locale::setDefault($locale);

        $this->translator->setLocale($locale);
    }
}
