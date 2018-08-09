<?php

require_once __DIR__ . '/../inc/util/firstload.php';
require_once __DIR__ . '/../inc/util/ajax.php';
require_once __DIR__ . '/../inc/util/database.php';
require_once __DIR__ . '/../inc/util/mail.php';
require_once __DIR__ . '/../inc/util/user.php';

$ajaxUtil = new ajax();
$dbutil = new dbManipulate();
$dbConn = new dbconn();
$mailUtil = new mail();
$ipUtil = new getUserIp();

$conn = $dbConn->oopmysqli();

$statusArr = array(

	// 'POST' => $_POST,

	'is_set' => array(
		'id' => false,
		'pwd' => false
	),
	'is_correct' => array(
		'pwd' => false
	),
	'proceed' => array(
		'is_set' => true
	),
	'is_success' => array(
		'dbselect_user' => false,
		'dbinsert_loginlog' => false
	),
	'unlock' => false,
	'redirect' => '/',
	'is_active_and_locked' => false
);

if (
	( isset($_SESSION['u_id']) && !empty($_SESSION['u_id']) ) &&
	( isset($_SESSION['locked']) && !empty($_SESSION['locked']) &&
	( $_SESSION['locked'] == true || $_SESSION['locked'] == 'true' || $_SESSION['locked'] == 'TRUE' ))
){
	$statusArr['is_active_and_locked'] = true;
	{
			if ( isset($_SESSION['u_id']) && !empty($_SESSION['u_id']) ){
				$statusArr['is_set']['id'] = true;
			} else {
				// 400
				// ID ni podan v seji
			}
			if ( isset($_POST['pwd']) && !empty($_POST['pwd']) ){
				$statusArr['is_set']['pwd'] = true;
			} else {
				// 400
				// Geslo ime ni bilo podano
			}
			if ( isset($_POST['refer']) && !empty($_POST['refer']) ){
				$statusArr['redirect'] = $_POST['refer'];
			} else {
				// 200
				// Lokacija za preusmerjenje ni bila podana
			}
	}
	{
			if ( !in_array(false, $statusArr['is_set']) ){
				$statusArr['proceed']['is_set'] = true;
			} else {
				// 400
				// Ena od podanih informacij ni bila podana - preglej konzolo
			}
	}
	{
			if ( $statusArr['proceed']['is_set'] === true ){
				$id = $_SESSION['u_id'];
				$pwd = $_POST['pwd'];

				$loginsarr = array(
					'login_time' => time(),
					'login_ip' => $ipUtil->getIpAddress(),
					'login_user_id' => null,
					'login_state' => null
				);
				if ( $stmt = $conn->prepare("SELECT `user_pwd` FROM `users` WHERE user_id = ?") ){

					$stmt->bind_param("s", $id);
					$stmt->execute();
					$stmt->store_result();
					if ($stmt->num_rows == 1){
						$statusArr['is_success']['dbselect_user'] = true;
						$stmt->bind_result($u_pwd);
						$stmt->fetch();
						if ( password_verify($pwd, $u_pwd) ){


							$loginsarr['login_user_id'] = $id;
							$loginsarr['login_state'] = 1;
							if ( $dbutil->insert($loginsarr, 'users_logins') ){
								$statusArr['is_success']['dbinsert_loginlog'] = true;
								$statusArr['is_correct']['pwd'] = true;
								$statusArr['unlock'] = true;

								$_SESSION['locked'] = false;
							} else {
								// 500
								// Prepared statement failed
								die ($ajaxUtil->arrayToJson(array('error'=>'prepared statement failed at user.unlock.php -> ifIsUser() -> statement->prepare ! Prosimo obvestite administratorja.'),500));
							}

						} else {
							$loginsarr['login_user_id'] = $u_id;
							$loginsarr['login_state'] = 0;
							$dbutil->insert($loginsarr, 'users_logins');

							$statusArr['is_correct']['pwd'] = false;
							$_SESSION['locked'] = true;
						}
					} else {
						$statusArr['is_correct']['pwd'] = false;
						$_SESSION['locked'] = true;
					}
				} else {
					// 500
					// Prepared statement failed
					die ($ajaxUtil->arrayToJson(array('error'=>'prepared statement failed at user.unlock.php -> ifIsUser() -> statement->prepare ! Prosimo obvestite administratorja.'),500));
				}
			}
	}
} else {
	// 400
	// Uporabnik ima že aktivno sejo
	$statusArr['is_active_and_locked'] = false;
}

Header('Content-type: application/json');
echo json_encode($statusArr, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES);
