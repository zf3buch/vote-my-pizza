<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/vote-my-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace Pizza\Form;

use Zend\Form\Element\Submit;
use Zend\Form\Element\Text;
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
        $this->setName('restaurant_price_form');
        $this->setAttribute('class', 'form-horizontal');

        $this->add(
            [
                'name'       => 'name',
                'type'       => Text::class,
                'options'    => [
                    'label'            => 'Name des Restaurants',
                    'label_attributes' => [
                        'class' => 'col-sm-4 control-label',
                    ],
                ],
                'attributes' => [
                    'class' => 'form-control',
                ],
            ]
        );

        $this->add(
            [
                'name'       => 'price',
                'type'       => Text::class,
                'options'    => [
                    'label'            => 'Preis der Pizza',
                    'label_attributes' => [
                        'class' => 'col-sm-4 control-label',
                    ],
                ],
                'attributes' => [
                    'class' => 'form-control',
                ],
            ]
        );

        $this->add(
            [
                'name'       => 'save_price',
                'type'       => Submit::class,
                'attributes' => [
                    'class' => 'btn btn-success',
                    'value' => 'Neuen Restaurant Preis speichern',
                    'id'    => 'save_price',
                ],
            ]
        );
    }

}