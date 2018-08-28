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
		'par1' => false,
		'par2' => false,
		'par3' => false,
		'get' => false,
		'post' => false,
		'session' => false
	),
	'exists' => array(
		'file' => false
	),
	'debug' => array(
		'time' => time(),
		'get' => null,
		'post' => null,
		'location' => '/api',
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
    $statusData['debug']['get'] = $_GET;

	if (isset($_GET['par1'])&&!empty($_GET['par1'])){
		$statusData['isset']['par1'] = true;
		$statusData['debug']['location'] .= '/'.$_GET['par1'];

		if (isset($_GET['par2'])&&!empty($_GET['par2'])){
			$statusData['isset']['par2'] = true;
			$statusData['debug']['location'] .= '/'.$_GET['par2'];

			if (isset($_GET['par3'])&&!empty($_GET['par3'])){
				$statusData['isset']['par3'] = true;
				$statusData['debug']['location'] .= '/'.$_GET['par3'];

				$path = __DIR__ . '/inc/api/'.$_GET['par1'].'.'.$_GET['par2'].'.'.$_GET['par3'].'.php';
				if (file_exists($path)){
					include_once $path;
					$statusData['exists']['file'] = true;
				} else {
					$statusData['exists']['file'] = false;
					// FILE DOES NOT EXIST
				}

			} else {
				// PARAMETER 3 IS NOT DEFINED
				$path = __DIR__ . '/inc/api/'.$_GET['par1'].'.'.$_GET['par2'].'.php';
				if (file_exists($path)){
					include_once $path;
					$statusData['exists']['file'] = true;
				} else {
					$statusData['exists']['file'] = false;
					// FILE DOES NOT EXIST
				}
			}
		} else {
			// PARAMETER 2 IS NOT DEFINED
		}

	} else {
		// PARAMETER 1 IS NOT DEFINED
	}

} else {
	// NO $_GET DATA PASSED
}

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
Header('Content-Type: application/json');
echo json_encode($statusData, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES);
