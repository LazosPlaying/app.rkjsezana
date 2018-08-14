<?php
require_once __DIR__ . '/../inc/util/firstload.php';
require_once __DIR__ . '/../inc/util/user.php';
require_once __DIR__ . '/../inc/util/array.php';
require_once __DIR__ . '/../inc/util/database.php';
require_once __DIR__ . '/../inc/util/mail.php';

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
		'referer' => false,
		'session' => false
	),
	'debug' => array(
		'time' => time(),
		'get' => null,
		'post' => null,
		'referer' => null,
		'location' => '/action/user.email.confirm.php',
		'session_status' => null,
		'error' => false
	),
	'data' => null
);

{
	if (isset($_GET) && !empty($_GET)){
		$statusData['isset']['get'] = true;
		$statusData['debug']['get'] = $_GET;
	}

	if (isset($_POST) && !empty($_POST)){
		$statusData['isset']['post'] = true;
		$statusData['debug']['post'] = $_POST;
	}

	if (isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER'])){
		$statusData['isset']['referer'] = true;
		$statusData['debug']['referer'] = $_SERVER['HTTP_REFERER'];
	}
}
{
	if ($userUtil->getSessionStatus() == 'valid'){
		$statusData['isset']['session'] = true;

		

	} else {
		// USER IS NOT LOGED IN
		Header('Location: /login');
		$statusData['isset']['session'] = false;
	}

	$statusData['debug']['session_status'] = $userUtil->getSessionStatus();
}

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
Header('Content-Type: application/json');
echo json_encode($statusData, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES);
