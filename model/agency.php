<?php
namespace Croquemonster\Model;

class Agency {
	/**
	 * Agency contracts
	 *
	 * @var $contracts Contracts
	 */
	private $contracts;

	/**
	 * Agency fartBox - city name where is fartbox
	 *
	 * @var $fartBox string
	 */
	private $fartBox;

	/**
	 * Agency fartTotal - loading level
	 *
	 * @var $fartTotal int
	 */
	private $fartTotal;

	/**
	 * Agency gold
	 *
	 * @var $gold int
	 */
	private $gold;

	/**
	 * Agency id
	 *
	 * @var $id int
	 */
	private $id;

	/**
	 * Agency monsters
	 *
	 * @var $monsters Monsters
	 */
	private $monsters;

	/**
	 * Agency name
	 *
	 * @var $name string
	 */
	private $name;

	/**
	 * Agency syndicate
	 *
	 * @var $syndicate Syndicate
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