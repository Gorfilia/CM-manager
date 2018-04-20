<?php
namespace Croquemonster\Monster;

use Croquemonster\Utils\IsReadOnly;

class Monster {
	use IsReadOnly;

	/**
	 * Monster prime
	 *
	 * @var string $bounty
	 */
	private $bounty;

	/**
	 * Monster control
	 * greediness counter
	 *
	 * @var [type] $control
	 */
	private $control;

	/**
	 * Monster resistance at other monster
	 *
	 * @var int $endurance
	 */
	private $endurance;

	/**
	 * Monster fight value
	 * for battle againts other monster
	 *
	 * @var int $fight
	 */
	private $fight;

	/**
	 * Monster send price
	 *
	 * @var int $firePrize
	 */
	private $firePrize;

	/**
	 * Technical identifiant
	 *
	 * @var int $int
	 */
	private $id;

	/**
	 * Monster greediness
	 *
	 * @var [type] $greediness
	 */
	private $greediness;

	/**
	 * Monster name
	 *
	 * @var string $name
	 */
	private $name;

	/**
	 * Monster power
	 *
	 * @var int $power
	 */
	private $power;

	/**
	 * Monster sadism
	 *
	 * @var int $sadism
	 */
	private $sadism;

	/**
	 * Monstrer ugliness
	 *
	 * @var int $ugliness
	 */
	private $ugliness;


	public function __construct(
		int $id, string $name,
		int $sadism, int $ugliness, int $power, int $greediness,
		int $control, int $fight, int $endurance, int $bounty
		) {
		$this->id         = $id;
		$this->name       = $name;

		$this->sadism     = $sadism;
		$this->ugliness   = $ugliness;
		$this->power      = $power;
		$this->greediness = $greediness;

		$this->control    = $control;
		$this->fight      = $fight;
		$this->endurance  = $endurance;
		$this->bounty     = $bounty;
	}
}