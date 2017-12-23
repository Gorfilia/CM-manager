<?php

namespace Croquemonster\Model;

use Croquemonster\Model\Contract;
use Croquemonster\Model\Monster;


class Mission {

	public function __construct(array $contracts, array $monsters) {
		$this->contracts = $contracts;
		$this->monsters = $monsters;

		uasort($this->contracts, function($contract1, $contract2) {
			$result = $contract1->countdown <=> $contract2->countdown;
			if($result  === 0) {
				$result = $contract1->prize <=> $contract2->prize;
			}
			return $result;
		});
	}

	public function allPercentageForMission(string $sortParam = null): array {
		$missionByMonster = array();

		if($sortParam != null)
			$this->sortContract($sortParam);

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

	private function sortContract(string $attribute) {
		$GLOBALS['sortAttribute'] = $attribute;

		uasort($this->contracts, function($contract1, $contract2) {
			global $sortAttribute;
			return $contract1->$sortAttribute <=> $contract2->$sortAttribute;
		});
		unset($GLOBALS['sortAttribute']);
	}
}