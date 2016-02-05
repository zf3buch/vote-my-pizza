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
 * Trait PizzaRepositoryAwareTrait
 *
 * @package Pizza\Model\Repository
 */
trait PizzaRepositoryAwareTrait
{
    /**
     * @var PizzaRepositoryInterface
     */
    private $pizzaRepository;

    /**
     * @param PizzaRepositoryInterface $pizzaRepository
     */
    public function setPizzaRepository(
        PizzaRepositoryInterface $pizzaRepository
    ) {
        $this->pizzaRepository = $pizzaRepository;
    }
}
