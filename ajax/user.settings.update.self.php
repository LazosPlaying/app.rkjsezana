<?php
require_once __DIR__ . '/../inc/util/firstload.php';
require_once __DIR__ . '/../inc/util/user.php';
require_once __DIR__ . '/../inc/util/array.php';
require_once __DIR__ . '/../inc/util/database.php';
require_once __DIR__ . '/../inc/util/mail.php';
$userUtil = new user();
$dbUtil = new dbManipulate();
$connUtil = new dbconn();
$mailUtil = new mail();

$conn = $connUtil->oopmysqli();

$statusData = array(
	'isset' => array(
		'get' => null,
		'post' => null,
		'session' => null
	),
	'debug' => array(
		'time' => time(),
		'location' => '/ajax/user.settings.update.self.php',
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
if (isset($_GET) && !empty($_GET)){
    $statusData['isset']['get'] = true;

	if (isset($_POST['post']) && !empty($_POST['post'])){
	    $statusData['isset']['post'] = true;



	} else {
		// NO $_POST DATA PASSED
	}

} else {
	// NO $_GET DATA PASSED
}

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
Header('Content-Type: application/json');
echo json_encode($statusData, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES);
