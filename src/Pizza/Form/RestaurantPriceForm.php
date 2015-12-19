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
        $this->setName('restaurant_price_form');
        $this->setAttribute('class', 'form-horizontal');

        $this->add(
            [
                'name'       => 'name',
                'type'       => 'text',
                'options'    => [
                    'label'            => 'pizza_label_restaurant',
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
                'type'       => 'text',
                'options'    => [
                    'label'            => 'pizza_label_price',
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
                'type'       => 'submit',
                'attributes' => [
                    'class' => 'btn btn-success',
                    'value' => 'pizza_action_new_price',
                    'id'    => 'save_price',
                ],
            ]
        );
    }

}