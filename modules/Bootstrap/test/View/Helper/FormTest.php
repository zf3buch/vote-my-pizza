<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/vote-my-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace BootstrapTest\View\Helper;

use Bootstrap\View\Helper\Form;
use PHPUnit_Framework_TestCase;
use Zend\Form\FormInterface;
use Zend\View\Model\ViewModel;
use Zend\View\Renderer\RendererInterface;

/**
 * Class FormTest
 *
 * @package BootstrapTest\View\Helper
 */
class FormTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test form return
     */
    public function testFormReturn()
    {
        $renderedHtml = '<form></form>';

        /** @var RendererInterface $renderer */
        $renderer = $this->prophesize(RendererInterface::class);

        $form = $this->prophesize(FormInterface::class);

        $viewModel = new ViewModel();
        $viewModel->setVariable('form', $form->reveal());
        $viewModel->setTemplate('bootstrap::form');

        $renderer->render($viewModel)->willReturn($renderedHtml)
            ->shouldBeCalled();

        $viewHelper = new Form();
        $viewHelper->setView($renderer->reveal());

        $this->assertEquals($renderedHtml, $viewHelper($form->reveal()));
    }
}
