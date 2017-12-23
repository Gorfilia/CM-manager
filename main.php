<?php

namespace Croquemonster;

use Croquemonster\Model\Contract;
use Croquemonster\Model\GenericObject;
use Croquemonster\Model\Mission;
use Croquemonster\Model\Monster;

class Main {
	public function __construct($login, $apiKey) {
		$xmlContracts = 'http://www.croquemonster.com/api/contracts.xml?name='.$login.';pass='.$apiKey;
		$xmlMonsters = 'http://www.croquemonster.com/api/monsters.xml?name='.$login.';pass='.$apiKey;
		$xmlagency = 'http://www.croquemonster.com/api/agency.xml?name='.$login.';pass='.$apiKey;

		$xmlObject = new \SimpleXMLElement($xmlagency, 0, true);
		$this->agency = new GenericObject($xmlObject->attributes());

		$contracts = $this->collectionFromXML($xmlContracts, 'Contract');
		$monsters = $this->collectionFromXML($xmlMonsters, 'Monster');

		$this->mission = new Mission($contracts, $monsters);
	}
	
	public function __get($attribute) {
		return isset($this->$attribute) ? $this->$attribute : null;
	}

	private $agency = null;
	private $mission = null;

	private function collectionFromXML(string $xml, string $type) {
		$class = __NAMESPACE__ . '\\' . $type;
		$result = array();

		$xmlObject = new \SimpleXMLElement($xml, 0, true);
		$xpathResult = $xmlObject->xpath('//'.lcfirst($type));
		foreach($xpathResult as $resultOfType) {
			$result[(string)$resultOfType['id']] = new $class($resultOfType->attributes());
		}
		return $result;
	}
}