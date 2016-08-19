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
use Zend\Filter\StringTrim;
use Zend\Filter\StripTags;
use Zend\I18n\Filter\NumberFormat;
use Zend\I18n\Validator\IsFloat;
use Zend\InputFilter\InputFilter;
use Zend\Validator\NotEmpty;
use Zend\Validator\StringLength;

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
        $this->add(
            [
                'name'       => 'name',
                'required'   => true,
                'filters'    => [
                    [
                        'name' => StripTags::class,
                    ],
                    [
                        'name' => StringTrim::class,
                    ],
                ],
                'validators' => [
                    [
                        'name'                   => NotEmpty::class,
                        'break_chain_on_failure' => true,
                        'options'                => [
                            'message' => 'pizza_validator_restaurant_notempty',
                        ],
                    ],
                    [
                        'name'    => StringLength::class,
                        'options' => [
                            'min'      => 3,
                            'max'      => 64,
                            'message'  => 'pizza_validator_restaurant_length',
                        ],
                    ],
                ],
            ]
        );

        $this->add(
            [
                'name'       => 'price',
                'required'   => true,
                'filters'    => [
                    [
                        'name' => StripTags::class,
                    ],
                    [
                        'name' => StringTrim::class,
                    ],
                    [
                        'name'    => NumberFormat::class,
                        'options' => [
                            'style' => NumberFormatter::DECIMAL,
                            'type'  => NumberFormatter::TYPE_DOUBLE,
                        ],
                    ],
                ],
                'validators' => [
                    [
                        'name'                   => NotEmpty::class,
                        'break_chain_on_failure' => true,
                        'options'                => [
                            'message' => 'pizza_validator_price_notempty',
                        ],
                    ],
                    [
                        'name'    => IsFloat::class,
                        'options' => [
                            'min'     => 0,
                            'message' => 'pizza_validator_price_float',
                        ],
                    ],
                ],
            ]
        );
    }
}
