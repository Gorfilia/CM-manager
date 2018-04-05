<?php
namespace Croquemonster\Model;

class Monsters extends Collection {

	public function offsetSet($offset, $value) {
		if ($value instanceof Monster) {
			return parent::offsetSet($offset, $value);
		}
		return null;
	}
}