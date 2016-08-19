<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/vote-my-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace User\Model\InputFilter;

use Zend\Filter\StringTrim;
use Zend\InputFilter\InputFilter;
use Zend\Validator\EmailAddress;
use Zend\Validator\NotEmpty;
use Zend\Validator\StringLength;

/**
 * Class RegisterInputFilter
 *
 * @package User\Model\InputFilter
 */
class RegisterInputFilter extends InputFilter
{
    /**
     * Init input filter
     */
    public function init()
    {
        $this->add(
            [
                'name'       => 'email',
                'required'   => true,
                'filters'    => [
                    [
                        'name' => StringTrim::class,
                    ],
                ],
                'validators' => [
                    [
                        'name'                   => NotEmpty::class,
                        'break_chain_on_failure' => true,
                        'options'                => [
                            'message' => 'user_validator_email_notempty',
                        ],
                    ],
                    [
                        'name'    => EmailAddress::class,
                        'options' => [
                            'message' => 'user_validator_email_format',
                        ],
                    ],
                ],
            ]
        );

        $this->add(
            [
                'name'       => 'password',
                'required'   => true,
                'filters'    => [],
                'validators' => [
                    [
                        'name'                   => NotEmpty::class,
                        'break_chain_on_failure' => true,
                        'options'                => [
                            'message' => 'user_validator_password_notempty',
                        ],
                    ],
                    [
                        'name'    => StringLength::class,
                        'options' => [
                            'encoding' => 'UTF-8',
                            'min'      => 6,
                            'max'      => 64,
                            'message'  => 'user_validator_password_length',
                        ],
                    ],
                ],
            ]
        );

        $this->add(
            [
                'name'       => 'first_name',
                'required'   => true,
                'filters'    => [
                    [
                        'name' => StringTrim::class,
                    ],
                ],
                'validators' => [
                    [
                        'name'                   => NotEmpty::class,
                        'break_chain_on_failure' => true,
                        'options'                => [
                            'message' => 'user_validator_first_name_notempty',
                        ],
                    ],
                    [
                        'name'    => StringLength::class,
                        'options' => [
                            'encoding' => 'UTF-8',
                            'min'      => 2,
                            'max'      => 64,
                            'message' => 'user_validator_first_name_length',
                        ],
                    ],
                ],
            ]
        );

        $this->add(
            [
                'name'       => 'last_name',
                'required'   => true,
                'filters'    => [
                    [
                        'name' => StringTrim::class,
                    ],
                ],
                'validators' => [
                    [
                        'name'                   => NotEmpty::class,
                        'break_chain_on_failure' => true,
                        'options'                => [
                            'message' => 'user_validator_last_name_notempty',
                        ],
                    ],
                    [
                        'name'    => StringLength::class,
                        'options' => [
                            'encoding' => 'UTF-8',
                            'min'      => 2,
                            'max'      => 64,
                            'message' => 'user_validator_last_name_length',
                        ],
                    ],
                ],
            ]
        );
    }
}
