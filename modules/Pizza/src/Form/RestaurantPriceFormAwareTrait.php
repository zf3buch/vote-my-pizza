<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/vote-my-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace Pizza\Form;

/**
 * Trait RestaurantPriceFormAwareTrait
 *
 * @package Pizza\Form
 */
trait RestaurantPriceFormAwareTrait
{
    /**
     * @var RestaurantPriceForm
     */
    private $restaurantPriceForm;

    /**
     * @param RestaurantPriceForm $restaurantPriceForm
     */
    public function setRestaurantPriceForm(
        RestaurantPriceForm $restaurantPriceForm
    ) {
        $this->restaurantPriceForm = $restaurantPriceForm;
    }
}
