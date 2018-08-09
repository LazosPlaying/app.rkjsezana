<?php
require_once __DIR__ . '/../inc/util/firstload.php';
require_once __DIR__ . '/../inc/util/user.php';
require_once __DIR__ . '/../inc/util/ajax.php';
$userUtil = new user();
$ajax = new ajax();

if (!empty($_POST) && !$userUtil->amiloged()){
	require_once __DIR__ . '/../inc/util/tool.php';
	require_once __DIR__ . '/../inc/util/database.php';
	require_once __DIR__ . '/../inc/util/array.php';
	require_once __DIR__ . '/../inc/util/email.php';

	$toolsutil = new tools();
	$dbutil = new dbManipulate();
	$dbconn = new dbconn();
	$arrtool = new arrayTools();
	$ipUtil = new getUserIp();
	$mailUtil = new mail();


	if (!empty($_POST['first']) && !empty($_POST['last']) && !empty($_POST['uid']) && !empty($_POST['mail1']) && !empty($_POST['mail2']) && !empty($_POST['pwd1']) && !empty($_POST['pwd2'])){

		$uid = $_POST['uid'];
		$first = $_POST['first'];
		$last = $_POST['last'];
		$mail1 = $_POST['mail1'];
		$mail2 = $_POST['mail2'];
		$pwd1 = $_POST['pwd1'];
		$pwd2 = $_POST['pwd2'];
	    $uid = strtolower($uid);
	    $first = ucfirst($first);
	    $last = ucfirst($last);

		if ( (strlen($first)<1) || (strlen($last)<1) ){
			// DENY: Ime ali priimek sta prekratka
			die ($ajax->arrayToJson(array('error'=>'Ime ali priimek sta prekratka'),400));
		} elseif ( $pwd1 !== $pwd2 ){
			// DENY: Gesli se ne ujemata
			die ($ajax->arrayToJson(array('error'=>'Gesli se ne ujemata'),400));
		} elseif ( (strlen($pwd1)<8) || (strlen($pwd1)>64) ){
			// DENY: Geslo mora biti dolgo med 8 ter 64 znaki
			die ($ajax->arrayToJson(array('error'=>'Geslo mora biti dolgo med 8 ter 64 znaki'),400));
		} elseif ( preg_match("([^a-zA-Z0-9<>,.?!£$%^&*()_+={};:@#~\[\]\-\/\\\|])", $pwd1) ){
			// DENY: Geslo ima nedovoljene znake! Uporabljaj latinico, števke ter simbole kot so ! $ & * # : . ?
			die ($ajax->arrayToJson(array('error'=>'Geslo ima nedovoljene znake! Uporabljaj latinico, števke ter simbole kot so ! $ & * # : . ?'),400));
		} elseif ( $mail1 !== $mail2 ){
			// DENY: Email naslova se ne ujemata
			die ($ajax->arrayToJson(array('error'=>'Email naslova se ne ujemata'),400));
		} elseif ( (!filter_var($mail1, FILTER_VALIDATE_EMAIL)) && (!filter_var($mail2, FILTER_VALIDATE_EMAIL)) ){
			// DENY: Prosimo, vnesite veljaven email naslov
			die ($ajax->arrayToJson(array('error'=>'Prosimo, vnesite veljaven email naslov'),400));
		} elseif ( (strlen($uid)<5) || (strlen($uid)>32) ){
			// DENY: Uporabniško ime mora biti dolgo med 5 in 32 znaki
			die ($ajax->arrayToJson(array('error'=>'Uporabniško ime mora biti dolgo med 5 in 32 znaki'),400));
		} elseif ( preg_match('/(\s)|([^a-zA-Z0-9.])|(\.\.)|(\@)/', $uid) ){
			// DENY: Uporabniško ime vsebuje nedovoljene znake
			die ($ajax->arrayToJson(array('error'=>'Uporabniško ime vsebuje nedovoljene znake'),400));
		} elseif ( false ){

		} elseif ( false ){

		} elseif ( false ){

		} else {

			function userExistsCheck($column, $value, $message){
				global $dbconn;
				$conn = $dbconn->oopmysqli();
				if ( $stmt = $conn->prepare("SELECT * FROM `users` WHERE `$column` = ?") ){
					$stmt->bind_param("s", $value);
					$stmt->execute();
					$stmt->store_result();
					$rownum = $stmt->num_rows;
					if ($rownum > 0){
						// DENY: $message
						die ($ajax->arrayToJson(array('error'=>$message),409));
					}
				} else {
					// Error; prepared statement failed at user.signup.php -> ifIsUser() -> statement->prepare ! Prosimo obvestite administratorja.
					die ($ajax->arrayToJson(array('error'=>'prepared statement failed at user.signup.php -> ifIsUser() -> statement->prepare ! Prosimo obvestite administratorja.'),500));
				}
			}
			userExistsCheck("user_uid", $uid, "To uporabniško ime je že v uporabi");
			userExistsCheck("user_email", $mail1, "Ta email ime je že v uporabi");

			$hashpwd = password_hash($pwd1, PASSWORD_DEFAULT);
			$groupsarr = array(
				'unconfirmed' => array(
					'applied' =>  $nowdatetime
				)
			);

			$email_confirm_token = $toolsutil->rndString(30);
			$emailhtml = '<p>Pozdravljeni! Ta email ste prejeli kot potrdilo o registraciji novega računa "'.$uid.'" na storitvi rkjsezana.app <br><br> Osebni žeton: '.$email_confirm_token.' <br><br> Za potrditev računa sledite <a href="https://rkjsezana.app/session#confirm">povezavi</a> ( https://rkjsezana.app/session#confirm ).';
			$emailarr = array(
				'from' => array(
					'addr' => 'rkjsezana.app@gmail.com',
					'name' => 'rkjsezana.app'
				),
				'to' => array(
					'addr' => $mail1,
					'name' => $first.' '.$last
				),
				'content' => array(
					'title' => 'Potrdilo registracije računa',
					'subject' => 'Potrdilo registracije računa',
					'html' => $emailhtml,
					'nohtml' => strip_tags($emailhtml)
				)
			);

			$groupsarr = $arrtool->arrayToString($groupsarr);
			$temp1 = array(
				'user_uid' => $uid,
				'user_first' => $first,
				'user_last' => $last,
				'user_email' => $mail1,
				'user_last' => $last,
				'user_pwd' => $hashpwd,
				'user_groups' => $groupsarr,
				'user_signup_ip' => $ipUtil->getIpAddress(),
				'is_confirmed_email' => $email_confirm_token
			);
			$dbutil->insert($temp1, 'users');

			$mailstatus = $mailUtil->send($emailarr);
			// SUCCESS: Registracija je bila uspešna
			die ($ajax->arrayToJson(array('message'=>'Registracija je bila uspešna','email'=> $mailstatus),201));

		}
	} else {
		// ERROR: Eno ali več polij je praznih!
		die ($ajax->arrayToJson(array('error'=>'Eno ali več polij je praznih!'),400));
	}


} else {
	// ERROR: NO POST DATA RECIEVED
	die ($ajax->arrayToJson(array('error'=>'No post data recieved!'),400));
}
