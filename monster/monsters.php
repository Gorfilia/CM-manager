<?php
namespace Croquemonster\Monster;

use Croquemonster\Utils\Collection;
use Croquemonster\Utils\HasAgency;

class Monsters extends Collection {
	use HasAgency;

	public function offsetSet($offset, $value) {
		if ($value instanceof Monster) {
			return parent::offsetSet($offset, $value);
		}
		return null;
	}
}