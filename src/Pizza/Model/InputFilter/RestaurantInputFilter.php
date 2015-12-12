<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/vote-my-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace Pizza\Model\InputFilter;

use NumberFormatter;
use Zend\InputFilter\InputFilter;

/**
 * Class RestaurantInputFilter
 *
 * @package Pizza\Model\InputFilter
 */
class RestaurantInputFilter extends InputFilter
{
    /**
     * Init input filter
     */
    public function init()
    {
        $this->add([
            'name'       => 'name',
            'required'   => true,
            'filters'    => [
                [
                    'name' => 'StripTags',
                ],
                [
                    'name' => 'StringTrim',
                ],
            ],
            'validators' => [
                [
                    'name'    => 'NotEmpty',
                    'break_chain_on_failure' => true,
                    'options' => [
                        'message'  => 'Bitte Restaurantnamen eingeben!',
                    ],
                ],
                [
                    'name'    => 'StringLength',
                    'options' => [
                        'encoding' => 'UTF-8',
                        'min'      => 3,
                        'max'      => 64,
                        'message'  => 'Nur %min%-%max% Zeichen erlaubt!',
                    ],
                ],
            ],
        ]);

        $this->add([
            'name'       => 'price',
            'required'   => true,
            'filters'    => [
                [
                    'name' => 'StripTags',
                ],
                [
                    'name' => 'StringTrim',
                ],
                [
                    'name'    => 'NumberFormat',
                    'options' => [
                        'style'  => NumberFormatter::DECIMAL,
                        'type'   => NumberFormatter::TYPE_DOUBLE,
                    ],
                ],
            ],
            'validators' => [
                [
                    'name'    => 'NotEmpty',
                    'break_chain_on_failure' => true,
                    'options' => [
                        'message'  => 'Bitte Pizzapreis eingeben!',
                    ],
                ],
                [
                    'name'    => 'IsFloat',
                    'options' => [
                        'min'     => 0,
                        'message' => 'Nur Preisangaben erlaubt!',
                    ],
                ],
            ],
        ]);
    }
}
