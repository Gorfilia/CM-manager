<?php
namespace Croquemonster\Agency;

class Agency {
	/**
	 * Agency contracts
	 *
	 * @var Contracts $contracts
	 */
	private $contracts;

	/**
	 * Agency fartBox - city name where is fartbox
	 *
	 * @var string $fartBox
	 */
	private $fartBox;

	/**
	 * Agency fartTotal - loading level
	 *
	 * @var int $fartTotal
	 */
	private $fartTotal;

	/**
	 * Agency gold
	 *
	 * @var int $gold
	 */
	private $gold;

	/**
	 * Agency id
	 *
	 * @var int $id
	 */
	private $id;

	/**
	 * Agency monsters
	 *
	 * @var Monsters $monsters
	 */
	private $monsters;

	/**
	 * Agency name
	 *
	 * @var string $name
	 */
	private $name;

	/**
	 * Agency syndicate
	 *
	 * @var Syndicate $syndicate
	 */
	private $syndicate;

	public function __construct(string $fartBox, int $fartTotal, int $gold, int $id, string $name, string $syndicate) {
		$this->id = $id;
		$this->name = $name;
		$this->syndicate = $syndicate;
		$this->gold = $gold;
		$this->fartBox = $fartBox;
		$this->fartTotal = $fartTotal;
	}

	public function __get($attribute) {
		return isset($this->$attribute) ? ($attribute === 'syndicate' ? $this->getSyndicate() : $this->$attribute) : null;
	}

	private function getContracts() {
		// TODO
	}

	private function getMonsters() {
		// TODO
	}

	private function getSyndicate() {
		$uri = $this->syndicate; // TODO get url ^^
		return __NAMESPACE__ . '\\' . Factory::create($uri, 'Syndicate');
	}
}