<?php

function autoload($class) {
	// on explose notre variable $class par \
	$parts = preg_split('#\\\#', $class);
	array_shift($parts);

	$path = $base = __DIR__ . DIRECTORY_SEPARATOR . '..';

	foreach($parts as $part) {
		$path .= DIRECTORY_SEPARATOR . lcfirst($part);
	}

	$path .= '.php';

	if(is_file($path)) {
		require_once $path;
	}
}

spl_autoload_register('autoload');

const VIEW_PATH = '.' . DIRECTORY_SEPARATOR . 'view' . DIRECTORY_SEPARATOR;
const TPL_PATH = VIEW_PATH .  'template' . DIRECTORY_SEPARATOR;