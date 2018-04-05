<?php
namespace Croquemonster\Model;

use Croquemonster\Model\GenericObject;

class Contract extends GenericObject {
	public function percentage(GenericObject $monster): int {
		return $this->percentageForMission($monster, $this);
	}
}