<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/vote-my-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace Pizza\Form;

use Zend\Form\Form;

/**
 * Class RestaurantPriceForm
 *
 * @package Pizza\Form
 */
class RestaurantPriceForm extends Form
{
    /**
     * Add form elements
     *
     * @return void
     */
    public function init()
    {
        $this->add(
            [
                'name'       => 'name',
                'type'       => 'text',
                'options'    => [
                    'label' => 'Name des Restaurants',
                ],
                'attributes' => [
                    'class' => 'form-control',
                ],
            ]
        );

        $this->add(
            [
                'name'       => 'price',
                'type'       => 'text',
                'options'    => [
                    'label' => 'Preis der Pizza',
                ],
                'attributes' => [
                    'class' => 'form-control',
                ],
            ]
        );

        $this->add(
            [
                'name'       => 'save_price',
                'type'       => 'submit',
                'options'    => [
                ],
                'attributes' => [
                    'value' => 'Restaurant Preis speichern',
                ],
            ]
        );
    }

}