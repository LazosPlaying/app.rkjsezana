<?php

require_once __DIR__ . '/../inc/util/firstload.php';
require_once __DIR__ . '/../inc/util/ajax.php';
require_once __DIR__ . '/../inc/util/database.php';
require_once __DIR__ . '/../inc/util/mail.php';
require_once __DIR__ . '/../inc/util/user.php';
require_once __DIR__ . '/../inc/util/tool.php';
require_once __DIR__ . '/../inc/util/token.php';

$ajaxUtil = new ajax();
$dbutil = new dbManipulate();
$dbConn = new dbconn();
$mailUtil = new mail();
$ipUtil = new getUserIp();
$toolUtil = new tool();
$tokenUtil = new token();

$conn = $dbConn->oopmysqli();
$statusArr = array(

	// 'POST' => $_POST,

	'is_set' => array(
		'first' => false,
		'last' => false,
		'uid' => false,
		'email' => false,
		'pwd1' => false,
		'pwd2' => false
	),
	'is_valid' => array(
		'first' => false,
		'last' => false,
		'uid' => false,
		'email' => false,
		'pwd1' => false,
		'pwd2' => false
	),
	'is_free' => array(
		'uid' => false,
		'email' => false
	),
	'proceed' => array(
		'is_set' => false,
		'is_valid' => false,
		'is_free' => false,
	),
	'is_success' => array(
		'dbinsert_user' => false,
		'dbselect_user' => false,
		'dbinsert_token' => false,
		'email_send' => false
	),
	'messages' => array(),
	'signup' => false,
);
{
		if ( isset($_POST['first']) && !empty($_POST['first']) ){
			$statusArr['is_set']['first'] = true;
			if ( strlen($_POST['first'])>2 && strlen($_POST['first'])<16 ){
				$statusArr['is_valid']['first'] = true;
			} else {
				// 400
				// Priimek ni veljaven
			}
		} else {
			// 400
			// Ime ni bilo podano
		}
		if ( isset($_POST['last']) && !empty($_POST['last']) ){
			$statusArr['is_set']['last'] = true;
			if ( strlen($_POST['last'])>2 && strlen($_POST['first'])<16 ){
				$statusArr['is_valid']['last'] = true;
			} else {
				// 400
				// Priimek ni veljaven
			}
		} else {
			// 400
			// Priimek ni bil podan
		}
		if ( isset($_POST['uid']) && !empty($_POST['uid']) ){
			$statusArr['is_set']['uid'] = true;
			if ( strlen($_POST['uid'])>5 && strlen($_POST['uid'])<32 && !preg_match('/(\s)|([^a-zA-Z0-9.])|(\.\.)|(\@)/', $_POST['uid']) ){
				$statusArr['is_valid']['uid'] = true;
			} else {
				// 400
				// Uporabniško ime ni veljavno
			}
			if ( $stmt = $conn->prepare("SELECT * FROM `users` WHERE `user_uid` = ?;") ){
				$stmt->bind_param("s", $_POST['uid']);
				$stmt->execute();
				$stmt->store_result();
				$rownum = $stmt->num_rows;
				if ($rownum == 0){
					$statusArr['is_free']['uid'] = true;
				} else {
					// 409
					// Username or username already in use
					$statusArr['is_free']['uid'] = false;
				}
			} else {
				// 500
				// Prepared statement failed
				die ($ajaxUtil->arrayToJson(array('error'=>'prepared statement failed at user.signup.php -> uidUsedCheck -> statement->prepare ! Prosimo obvestite administratorja.'),500));
			}
		} else {
			// 400
			// Uporabniško ime ni bilo podano
		}
		if ( isset($_POST['email']) && !empty($_POST['email']) ){
			$statusArr['is_set']['email'] = true;
			if ( ($_POST['email'] === $_POST['email']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) ){
				$statusArr['is_valid']['email'] = true;
			} else {
				// 400
				// Email naslov ni veljaven
			}
			if ( $stmt = $conn->prepare("SELECT * FROM `users` WHERE `user_email` = ?;") ){
				$stmt->bind_param("s", $_POST['email']);
				$stmt->execute();
				$stmt->store_result();
				$rownum = $stmt->num_rows;
				if ($rownum == 0){
					$statusArr['is_free']['email'] = true;
				} else {
					// 409
					// Email or username already in use
					$statusArr['is_free']['email'] = false;
				}
			} else {
				// 500
				// Prepared statement failed
				die ($ajaxUtil->arrayToJson(array('error'=>'prepared statement failed at user.signup.php -> emailUsedCheck -> statement->prepare ! Prosimo obvestite administratorja.'),500));
			}
		} else {
			// 400
			// Email ni bil podano
		}
		if ( isset($_POST['pwd1']) && !empty($_POST['pwd1']) ){
			$statusArr['is_set']['pwd1'] = true;
			if ( ($_POST['pwd1'] === $_POST['pwd2']) && (!strlen($_POST['pwd1'])<8 || !strlen($_POST['pwd1'])>64) && (!preg_match("([^a-zA-Z0-9<>,.?!£$%^&*()_+={};:@#~\[\]\-\/\\\|])", $_POST['pwd1'])) ){
				$statusArr['is_valid']['pwd1'] = true;
			} else {
				// 400
				// Geslo ni veljavno
			}
		} else {
			// 400
			// Geslo1 ni bil podano
		}
		if ( isset($_POST['pwd2']) && !empty($_POST['pwd2']) ){
			$statusArr['is_set']['pwd2'] = true;
			if ( ($_POST['pwd1'] === $_POST['pwd2']) && (!strlen($_POST['pwd2'])<8 || !strlen($_POST['pwd2'])>64) && (!preg_match("([^a-zA-Z0-9<>,.?!£$%^&*()_+={};:@#~\[\]\-\/\\\|])", $_POST['pwd2'])) ){
				$statusArr['is_valid']['pwd2'] = true;
			} else {
				// 400
				// Geslo ni veljavno
			}
		} else {
			// 400
			// Geslo2 ni bil podano
		}
}
{
		if ( !in_array(false, $statusArr['is_set']) ){
			$statusArr['proceed']['is_set'] = true;
		} else {
			// 400
			// Ena od podanih informacij ni bila podana - preglej konzolo
		}
		if ( !in_array(false, $statusArr['is_valid']) ){
			$statusArr['proceed']['is_valid'] = true;
		} else {
			// 400
			// Ena od podanih informacij ni bila podana - preglej konzolo
		}
		if ( !in_array(false, $statusArr['is_free']) ){
			$statusArr['proceed']['is_free'] = true;
		} else {
			// 400
			// Ena od podanih informacij ni bila podana - preglej konzolo
		}
}
{
		if ( !in_array(false, $statusArr['proceed']) ){
			$hashpwd = password_hash($_POST['pwd1'], PASSWORD_DEFAULT);
			$tempArr = array(
				'user_uid' => $_POST['uid'],
				'user_first' => ucfirst($_POST['first']),
				'user_last' => ucfirst($_POST['last']),
				'user_email' => $_POST['email'],
				'user_last' => $_POST['last'],
				'user_pwd' => $hashpwd,
				'user_signup_ip' => $ipUtil->getIpAddress()
			);
			$temp1 = $dbutil->insert($tempArr, 'users');
			if ( $temp1['is_success'] === true ){
				$statusArr['is_success']['dbinsert_user'] = true;
				if ( $stmt = $conn->prepare("SELECT `user_id` FROM `users` WHERE user_uid = ?") ){
					$stmt->bind_param("s", $_POST['uid']);
					$stmt->execute();
					$stmt->store_result();
					if ($stmt->num_rows == 1){
						$statusArr['is_success']['dbselect_user'] = true;
						$stmt->bind_result($u_id);
						$stmt->fetch();

						$temp1 = $tokenUtil->create($u_id,'confirm_email');
						if ( $temp1['is_success'] === true ){
							$statusArr['is_success']['dbinsert_token'] = true;
							$emailhtml = '<p>Pozdravljeni! Ta email ste prejeli kot potrdilo o registraciji novega računa "'.$_POST['uid'].'" na storitvi rkjsezana.app <br><br> Osebni žeton: '.$temp1['token'].' <br><br> Za potrditev računa sledite <a href="https://rkjsezana.app/session/confirm-email?token='.$temp1['token'].'">povezavi</a> ( https://rkjsezana.app/session/confirm-email ).';
							$tempArr = array(
								'from' => array(
									'name' => 'rkjsezana.app',
									'addr' => 'rkjsezana.app@gmail.com'
								),
								'to' => array(
									'addr' => $_POST['email'],
									'name' => $_POST['first'].' '.$_POST['last']
								),
								'content' => array(
									'title' => 'Potrditev email naslova',
									'subject' => 'Potrditev email naslova ob registraciji računa '.$_POST['uid'].' na storitvi rkjsezana.app',
									'html' => $emailhtml,
									'nohtml' => strip_tags($emailhtml)
								)
							);
							$temp1 = $mailUtil->send($tempArr);
							if ($temp1['is_success'] == true) {
									$statusArr['is_success']['email_send'] = true;
									$statusArr['signup'] = true;
							} else {
								// 500
								// Email was not sent
								// Error: $temp1['message']
								$statusArr['messages']['email'] = $temp1['message'];
							}
						} else {
							// 500
							// Token was not inserted into the database
							// Error: $temp1['message']
						}
					} else {
						// 500
						// Something went wrong when querying the newly created user from the database.
					}
				} else {
					// 500
					// Prepared statement failed
					die ($ajaxUtil->arrayToJson(array('error'=>'prepared statement failed at user.signup.php -> ifIsUser() -> statement->prepare ! Prosimo obvestite administratorja.'),500));
				}
			} else {
				// 500
				// User was not inserted into the database
				// Error: $temp1['message']
			}
		} else {
			// 400
			// Nekaj ni bilo v redu - preglej konzolo
		}
}



Header('Content-type: application/json');
echo json_encode($statusArr, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES);
