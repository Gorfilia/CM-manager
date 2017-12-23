<?php

namespace Croquemonster\Model;

interface IGenericObject {
	public function percentage(GenericObject $object): int;
}

class GenericObject implements IGenericObject {
	public function __construct(\SimpleXMLElement $attributes) {
		foreach($attributes as $name => $value) {
			$this->$name = (string) $value;
		}
	}

	public function percentage(GenericObject $object): int {}

	/**
	 * Create array of percentages sort by value desc
	 * @param array $genericObjects is array of GenericObject
	 * @return array
	 **/
	public function sortByPercentage(array $genericObjects): array {
		$result = array();

		foreach($genericObjects as $genericObject) {
			$result[(string)$genericObject->id] = $this->percentageForMission($genericObject);
		}

		uasort($result, function($percentage1, $percentage2) {
			return $percentage1 <=> $percentage2;
		});

		return $result;
	}

	// TODO add miam
	protected function percentageForMission(GenericObject $monster, GenericObject $contract): int {
		$sadism = $this->percentageForCaract($contract->difficulty, $contract->sadism, $monster->sadism);
		$ugliness = $this->percentageForCaract($contract->difficulty, $contract->ugliness, $monster->ugliness);
		$power = $this->percentageForCaract($contract->difficulty, $contract->power, $monster->power);
		$greediness = $this->percentageForCaract($contract->difficulty, $contract->greediness, $monster->greediness);

		return (int) (($sadism * $ugliness * $power * $greediness) * 100);
	}

	private function percentageForCaract($difficulty, $contractAttribute, $monsterAttribute): float {
		$tmp = 100 - (int) $difficulty - 5 * ((int)$contractAttribute - (int)$monsterAttribute);
		return (($tmp > 100) ? 100 : (($tmp < 0) ? 0 : $tmp)) / 100;
	}
}