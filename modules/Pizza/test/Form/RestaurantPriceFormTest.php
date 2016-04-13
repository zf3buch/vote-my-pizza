<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/vote-my-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace PizzaTest\Form;

use PHPUnit_Framework_TestCase;
use Pizza\Form\RestaurantPriceForm;

/**
 * Class RestaurantPriceFormTest
 *
 * @package PizzaTest\Form
 */
class RestaurantPriceFormTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test if expected elements exits
     */
    public function testElementsExistence()
    {
        $expectedElements = [
            'name'  => [
                'type'  => 'text',
                'name'  => 'name',
                'label' => 'pizza_label_restaurant',
            ],
            'price' => [
                'type'  => 'text',
                'name'  => 'price',
                'label' => 'pizza_label_price',
            ],
            'save_price' => [
                'type'  => 'submit',
                'name'  => 'save_price',
                'label' => null,
            ],
        ];

        $form = new RestaurantPriceForm();
        $form->init();

        foreach ($expectedElements as $elementName => $elementData) {
            $element = $form->get($elementName);

            $this->assertEquals(
                $elementData['type'], $element->getAttribute('type')
            );
            $this->assertEquals(
                $elementData['name'], $element->getAttribute('name')
            );
            $this->assertEquals(
                $elementData['label'], $element->getLabel()
            );
        }
    }

    /**
     * Test element values
     */
    public function testElementsValues()
    {
        $elementValues = [
            'name'  => 'Test Restaurant',
            'price' => '2',
        ];

        $form = new RestaurantPriceForm();
        $form->init();
        $form->setData($elementValues);

        $this->assertEquals(
            $elementValues['name'], $form->get('name')->getValue()
        );
        $this->assertEquals(
            $elementValues['price'], $form->get('price')->getValue()
        );
    }
}
