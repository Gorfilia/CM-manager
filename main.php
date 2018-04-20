<?php
namespace Croquemonster;

use Croquemonster\Model\Contract;
use Croquemonster\Model\GenericObject;
use Croquemonster\Model\Monster;

class Main {

	public function __construct($login, $apiKey) {
		$this->agency = $this->createGenericObject($login, $apiKey, 'agency');

		$this->initContracts($login, $apiKey);

		$xmlMonsters = sprintf(self::$URL['monsters'], $login, $apiKey);
		$this->monsters = $this->collectionFromXML($xmlMonsters, 'Monster');
	}

	public function allPercentageForMission(string $sortParam = null): array {
		$missionByMonster = array();

		if($sortParam != null)
			$this->sortContracts($sortParam);

		foreach($this->contracts as $contract) {
			if((string) $contract->accepted == 'true')
				continue;

			$missionByMonster[$contract->id] = array();
			//TODO prendre en compte le monstre MBL
			foreach($this->monsters as $monster) {
				if(isset($monster->contract))
					continue;
				$missionByMonster[(string)$contract->id][(string)$monster->id] = $monster->percentage($contract);
			}
		}

		return $missionByMonster;
	}
	
	public function __get($attribute) {
		return $this->$attribute ?? null;
	}

	private static $URL = array(
		'agency' => 'http://www.croquemonster.com/api/agency.xml?name=%s;pass=%s',
		'contracts' => 'http://www.croquemonster.com/api/contracts.xml?name=%s;pass=%s',
		'monsters' => 'http://www.croquemonster.com/api/monsters.xml?name=%s;pass=%s',
	);

	private $agency = null;
	private $contracts = null;
	private $monsters = null;

	private function createGenericObject(string $login, string $apiKey, string $type): GenericObject {
		$url = sprintf(self::$URL[$type], $login, $apiKey);
		$xmlObject = new \SimpleXMLElement($url, 0, true);
		$genericObject = new GenericObject($xmlObject->attributes());

		if(isset($genericObject->error)) {
			throw new \Exception($this->error, 1);
		}

		return $genericObject;
	}

	private function collectionFromXML(string $xml, string $type) {
		$class = __NAMESPACE__ . '\\Model\\' . $type;
		$result = array();

		$xmlObject = new \SimpleXMLElement($xml, 0, true);
		$xpathResult = $xmlObject->xpath('//'.lcfirst($type));
		foreach($xpathResult as $resultOfType) {
			$result[(string)$resultOfType['id']] = new $class($resultOfType->attributes());
		}
		return $result;
	}

	private function initContracts($login, $apiKey) {
		$xmlContracts = sprintf(self::$URL['contracts'], $login, $apiKey);
		$this->contracts = $this->collectionFromXML($xmlContracts, 'Contract');

		uasort($this->contracts, function($contract1, $contract2) {
			$result = $contract1->countdown <=> $contract2->countdown;
			if($result  === 0) {
				$result = $contract1->prize <=> $contract2->prize;
			}
			return $result;
		});
	}

	private function sortContracts(string $attribute) {
		$GLOBALS['sortAttribute'] = $attribute;

		uasort($this->contracts, function($contract1, $contract2) {
			global $sortAttribute;
			return $contract1->$sortAttribute <=> $contract2->$sortAttribute;
		});

		unset($GLOBALS['sortAttribute']);
	}
}