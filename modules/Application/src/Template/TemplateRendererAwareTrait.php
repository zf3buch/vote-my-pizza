<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/vote-my-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace Application\Template;

use Zend\Expressive\Template\TemplateRendererInterface;

/**
 * Trait TemplateRendererAwareTrait
 *
 * @package Application\Template
 */
trait TemplateRendererAwareTrait
{
    /**
     * @var TemplateRendererInterface
     */
    private $template;

    /**
     * @param TemplateRendererInterface $template
     */
    public function setTemplateRenderer(
        TemplateRendererInterface $template
    ) {
        $this->template = $template;
    }
}
