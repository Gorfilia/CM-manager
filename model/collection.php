<?php
namespace Croquemonster\Model;

class Collection implements \ArrayAccess {
	private $collection;

	public function __construct() {
		$this->collection = [];
	}

	public function offsetExists($offset) {
		return isset($this->collection[$offset]);
	}

	public function offsetGet($offset) {
		return $this->offsetExists($offset) ? $this->collection[$offset] : null;
	}

	public function offsetSet($offset, $value) {
		if (is_null($offset)) {
			$this->collection[] = $value;
		} else {
			$this->collection[$offset] = $value;
		}
		return $this;
	}

	public function offsetUnset($offset) {
		unset($this->collection[$offset]);
	}
}