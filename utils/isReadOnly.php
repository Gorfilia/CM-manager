<?php
namespace Croquemonster\Utils;

trait IsReadOnly {
	public function __get($attribute) {
		return $this->$attribute ?? null;
	}

	public function __set($attribute, $value){}
}