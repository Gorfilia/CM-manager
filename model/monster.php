<?php


namespace Croquemonster\Model;

use Croquemonster\Model\GenericObject;

class Monster extends GenericObject {
	public function percentage(GenericObject $contract): int {
		return $this->percentageForMission($this, $contract);
	}
}