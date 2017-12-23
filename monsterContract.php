<?php
namespace Croquemonster;

use Croquemonster\Main;

session_start();

require_once '.' . DIRECTORY_SEPARATOR . 'include' . DIRECTORY_SEPARATOR . 'autoloader.php';


if(isset($_POST['login']) && isset($_POST['apiKey'])) {

	$_SESSION['login'] = $_POST['login'];
	$_SESSION['apiKey'] = $_POST['apiKey'];

}

if(isset($_SESSION['login']) && isset($_SESSION['apiKey'])) {

	$main = new Main($_SESSION['login'], $_SESSION['apiKey']);
	// $main = new Main('Gorfilia', 'IuUkviRH2NNwksJS1g3b');
	$fact = $main->mission;
	$contractsMonsters = $fact->allPercentageForMission();

	if(empty($contractsMonsters)) {
		$require = TPL_PATH . 'mission-not-found.html';
	} else {
		$require = TPL_PATH . 'missions.tpl.php';
	}

} else {

	$require = TPL_PATH . 'login-form.html';

}
// print_r($_SERVER);
$base = $_SERVER['HTTP_HOST'] . substr($_SERVER['REQUEST_URI'], 0, (strrpos($_SERVER['REQUEST_URI'], '/') - strlen($_SERVER['REQUEST_URI'])));
$css = '.'. DIRECTORY_SEPARATOR . 'view' . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR .'style.css';
// echo $base;

require_once TPL_PATH . 'layout.tpl.php';

?>
 