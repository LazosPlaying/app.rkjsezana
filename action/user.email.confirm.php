<?php
require_once __DIR__ . '/inc/util/firstload.php';
require_once __DIR__ . '/inc/util/user.php';
require_once __DIR__ . '/inc/util/array.php';
require_once __DIR__ . '/inc/util/database.php';
require_once __DIR__ . '/inc/util/mail.php';
$userUtil = new user();
$ipUtil = new getUserIp();
$dbUtil = new dbManipulate();
$connUtil = new dbconn();
$mailUtil = new mail();

$conn = $connUtil->oopmysqli();

$statusData = array(
	'isset' => array(
		'get' => false,
		'post' => false,
		'session' => false
	),
	'debug' => array(
		'time' => time(),
		'get' => null,
		'post' => null,
		'location' => '/action/user.email.confirm.php',
		'session_status' => null,
		'error' => false
	),
	'data' => null
);
{
	if ($userUtil->getSessionStatus() == 'valid'){
		$statusData['isset']['session'] = true;
	} else {
		// USER IS NOT LOGED IN
		$statusData['isset']['session'] = false;
	}

	$statusData['debug']['session_status'] = $userUtil->getSessionStatus();
}
