<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/vote-my-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace Pizza\Model\Repository;

/**
 * Trait RestaurantRepositoryAwareTrait
 *
 * @package Pizza\Model\Repository
 */
trait RestaurantRepositoryAwareTrait
{
    /**
     * @var RestaurantRepositoryInterface
     */
    private $restaurantRepository;

    /**
     * @param RestaurantRepositoryInterface $restaurantRepository
     */
    public function setRestaurantRepository(
        RestaurantRepositoryInterface $restaurantRepository
    ) {
        $this->restaurantRepository = $restaurantRepository;
    }
}
