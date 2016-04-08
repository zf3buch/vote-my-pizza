<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/vote-my-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace PizzaTest\Model\InputFilter;

use PHPUnit_Framework_TestCase;
use Pizza\Model\InputFilter\RestaurantInputFilter;
use Zend\I18n\Validator\IsFloat;
use Zend\Validator\NotEmpty;
use Zend\Validator\StringLength;

/**
 * Class RestaurantInputFilterTest
 *
 * @package PizzaTest\Model\InputFilter
 */
class RestaurantInputFilterTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test input filter with empty data
     */
    public function testWithEmptyData()
    {
        $inputData        = [];
        $expectedValues   = [
            'name'  => null,
            'price' => null,
        ];
        $expectedMessages = [
            'name'  => [
                NotEmpty::IS_EMPTY => 'pizza_validator_restaurant_notempty',
            ],
            'price' => [
                NotEmpty::IS_EMPTY => 'pizza_validator_price_notempty',
            ],
        ];

        $inputFilter = new RestaurantInputFilter();
        $inputFilter->init();

        $inputFilter->setData($inputData);

        $result = $inputFilter->isValid();

        $this->assertFalse($result);
        $this->assertEquals($expectedValues, $inputFilter->getValues());
        $this->assertEquals(
            $expectedMessages, $inputFilter->getMessages()
        );
    }

    /**
     * Test input filter with empty values
     */
    public function testWithEmptyValues()
    {
        $inputData        = [
            'name'  => null,
            'price' => null,
        ];
        $expectedValues   = [
            'name'  => null,
            'price' => null,
        ];
        $expectedMessages = [
            'name'  => [
                NotEmpty::IS_EMPTY => 'pizza_validator_restaurant_notempty',
            ],
            'price' => [
                NotEmpty::IS_EMPTY => 'pizza_validator_price_notempty',
            ],
        ];

        $inputFilter = new RestaurantInputFilter();
        $inputFilter->init();

        $inputFilter->setData($inputData);

        $result = $inputFilter->isValid();

        $this->assertFalse($result);
        $this->assertEquals($expectedValues, $inputFilter->getValues());
        $this->assertEquals(
            $expectedMessages, $inputFilter->getMessages()
        );
    }

    /**
     * Test input filter with invalid values
     */
    public function testWithInvalidValues()
    {
        $inputData        = [
            'name'  => '2',
            'price' => 'zwei',
        ];
        $expectedValues   = [
            'name'  => '2',
            'price' => 'zwei',
        ];
        $expectedMessages = [
            'name'  => [
                StringLength::TOO_SHORT => 'pizza_validator_restaurant_length',
            ],
            'price' => [
                IsFloat::NOT_FLOAT => 'pizza_validator_price_float',
            ],
        ];

        $inputFilter = new RestaurantInputFilter();
        $inputFilter->init();

        $inputFilter->setData($inputData);

        $result = $inputFilter->isValid();

        $this->assertFalse($result);
        $this->assertEquals($expectedValues, $inputFilter->getValues());
        $this->assertEquals(
            $expectedMessages, $inputFilter->getMessages()
        );
    }

    /**
     * Test input filter with valid values
     */
    public function testWithValidValues()
    {
        $inputData        = [
            'name'  => 'Test',
            'price' => 2,
        ];
        $expectedValues   = [
            'name'  => 'Test',
            'price' => 2,
        ];
        $expectedMessages = [];

        $inputFilter = new RestaurantInputFilter();
        $inputFilter->init();

        $inputFilter->setData($inputData);

        $result = $inputFilter->isValid();

        $this->assertTrue($result);
        $this->assertEquals($expectedValues, $inputFilter->getValues());
        $this->assertEquals(
            $expectedMessages, $inputFilter->getMessages()
        );
    }

    /**
     * Test input filter with filtered values
     */
    public function testWithFilteredValues()
    {
        $inputData        = [
            'name'  => ' Test <b>Name</b> ',
            'price' => '2,99',
        ];
        $expectedValues   = [
            'name'  => 'Test Name',
            'price' => 2.99,
        ];
        $expectedMessages = [];

        $inputFilter = new RestaurantInputFilter();
        $inputFilter->init();

        $inputFilter->setData($inputData);

        $result = $inputFilter->isValid();

        $this->assertTrue($result);
        $this->assertEquals($expectedValues, $inputFilter->getValues());
        $this->assertEquals(
            $expectedMessages, $inputFilter->getMessages()
        );
    }
}
