<?php

require_once __DIR__ . '/../inc/util/firstload.php';
require_once __DIR__ . '/../inc/util/ajax.php';
require_once __DIR__ . '/../inc/util/database.php';
require_once __DIR__ . '/../inc/util/mail.php';
require_once __DIR__ . '/../inc/util/user.php';
require_once __DIR__ . '/../inc/util/tool.php';

$ajaxUtil = new ajax();
$dbutil = new dbManipulate();
$dbConn = new dbconn();
$mailUtil = new mail();
$ipUtil = new getUserIp();
$toolUtil = new tool();

$conn = $dbConn->oopmysqli();

$statusArr = array(

	// 'POST' => $_POST,

	'is_set' => array(
		'uid' => false,
		'pwd' => false
	),
	'is_correct' => array(
		'credentials' => false
	),
	'proceed' => array(
		'is_set' => true
	),
	'is_success' => array(
		'dbselect_user' => false,
		'dbinsert_loginlog' => false
	),
	'login' => false,
	'redirect' => '/',
	'is_activesession' => false
);

if ( !isset($_SESSION['u_id']) ){
	{
			if ( isset($_POST['uid']) && !empty($_POST['uid']) ){
				$statusArr['is_set']['uid'] = true;
			} else {
				// 400
				// Geslo ni bilo podano
			}
			if ( isset($_POST['pwd']) && !empty($_POST['pwd']) ){
				$statusArr['is_set']['pwd'] = true;
			} else {
				// 400
				// Uporabniško ime ni bilo podano
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
				$uid = $_POST['uid'];
				$pwd = $_POST['pwd'];

				$actionArr = array(
					'action_name' => 'user_login',
					'action_time' => time(),
					'action_user_id' => null,
					'action_user_ip' => $ipUtil->getIpAddress(),
					'action_is_success' => null
				);
				if ( $stmt = $conn->prepare("SELECT `user_id`, `user_uid`, `user_first`, `user_last`, `user_email`, `user_groups`, `user_pwd` FROM `users` WHERE user_uid = ?") ){

					$stmt->bind_param("s", $uid);
					$stmt->execute();
					$stmt->store_result();
					if ($stmt->num_rows == 1){
						$statusArr['is_success']['dbselect_user'] = true;
						$stmt->bind_result($u_id, $u_uid, $u_first, $u_last, $u_email, $u_groups, $u_pwd);
						$stmt->fetch();
						if ( password_verify($pwd, $u_pwd) ){


							$actionArr['action_user_id'] = $u_id;
							$actionArr['action_is_success'] = 1;
							$temp1 = $dbutil->insert($actionArr, 'users_actions');
							if ( $temp1['is_success'] ){
								$statusArr['is_success']['dbinsert_loginlog'] = true;

								$_SESSION['u_id'] = $u_id;
								$_SESSION['u_uid'] = $u_uid;
								$_SESSION['u_first'] = $u_first;
								$_SESSION['u_last'] = $u_last;
								$_SESSION['u_email'] = $u_email;
								$_SESSION['u_groups'] = json_decode($u_groups);


								$statusArr['is_correct']['credentials'] = true;
								$statusArr['login'] = true;
							} else {
								// 500
								// Prepared statement failed
								die ($ajaxUtil->arrayToJson(array('error'=>'prepared statement failed at user.login.php -> ifIsUser() -> statement->prepare ! Prosimo obvestite administratorja.', 'errorValue'=> $temp1['message']),500));
							}

						} else {
							$actionArr['action_user_id'] = $u_id;
							$actionArr['action_is_success'] = 0;

							$temp1 = $dbutil->insert($actionArr, 'users_actions');
							if ( !$temp1['is_success'] ){
								// 500
								// Prepared statement failed
								die ($ajaxUtil->arrayToJson(array('error'=>'prepared statement failed at user.login.php -> ifIsUser() -> statement->prepare ! Prosimo obvestite administratorja.', 'errorValue'=> $temp1['message']),500));
							}

							$statusArr['is_correct']['credentials'] = false;
						}
					} else {
						$statusArr['is_correct']['credentials'] = false;
					}
				} else {
					// 500
					// Prepared statement failed
					die ($ajaxUtil->arrayToJson(array('error'=>'prepared statement failed at user.login.php -> ifIsUser() -> statement->prepare ! Prosimo obvestite administratorja.'),500));
				}
				$stmt->close();
			}
	}
} else {
	// 400
	// Uporabnik ima že aktivno sejo
	$statusArr['is_activesession'] = true;
}

Header('Content-type: application/json');
echo json_encode($statusArr, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES);
