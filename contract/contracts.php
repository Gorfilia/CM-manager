<?php
namespace Croquemonster\Contract;

use Croquemonster\Utils\Collection;

class Contracts extends Collection {
	use HasAgency;

	public function offsetSet($offset, $value) {
		if ($value instanceof Contract) {
			return parent::offsetSet($offset, $value);
		}
		return null;
	}
}