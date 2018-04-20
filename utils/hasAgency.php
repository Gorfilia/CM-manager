<?php
namespace Croquemonster\Utils;

trait HasAgency {
	private $agency;
	private $id;

	public function __construct(string $agency, int $id) {
		$this->agency = $agency;
		$this->id     = $id;
	}

	public function __get($attribute) {
		return isset($this->$attribute) ? ($attribute === 'agency' ? $this->getAgency() : $this->$attribute) : null;
	}

	private function getAgency() {
		$uri = $this->agency; // TODO get url ^^
		return __NAMESPACE__ . '\\' . Factory::create($uri, 'Agency');
	}
}