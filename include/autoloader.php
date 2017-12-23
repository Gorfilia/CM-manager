<?php

function __autoload($class) {

	// on explose notre variable $class par \
	$parts = preg_split('#\\\#', $class);

	// on extrait le premier element 
	array_shift($parts);
	$path = __DIR__ . DIRECTORY_SEPARATOR . '..';

	foreach($parts as $part) {
		$path .= DIRECTORY_SEPARATOR . lcfirst($part);
	}

	$path .= '.php';

	if(is_file($path)) {
		require_once $path;
	}
}

const VIEW_PATH = '.' . DIRECTORY_SEPARATOR . 'view' . DIRECTORY_SEPARATOR;
const TPL_PATH = VIEW_PATH .  'template' . DIRECTORY_SEPARATOR;