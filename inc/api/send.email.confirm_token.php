<?php

$statusData['data'] = array(
	'is' => array(
		'token' => null,
		'user' => null,
		'confirmed' => null,
		'sent' => false,
		'allowed' => null
	),
	'messages' => array(

	)
);
$temp1 = 'confirm_email';
$temp2 = $_SESSION['u_id'];

if ($statusData['isset']['session']){
	$statusData['data']['allowed'] = true;

	{
		$conn = $connUtil->oopmysqli();
		if ( $stmt = $conn->prepare("SELECT `token_id`, `token_user_id`, `token_token`, `token_type`, `token_expiration` FROM `users_tokens` WHERE token_user_id=? AND token_type=?") ){
			$stmt->bind_param("ss", $temp2, $temp1);
			$stmt->execute();
			$stmt->store_result();
			if ($stmt->num_rows == 1){
				$statusData['data']['is']['token'] = true;
				$stmt->bind_result($token_id, $token_user_id, $token_token, $token_type, $token_expiration);
				$stmt->fetch();

				if ( ($token_user_id==$temp2)&&($token_type==$temp1) ){
					$statusData['data']['is']['token'] = true;
					$usr = array();
					if ( $stmt = $conn->prepare("SELECT `user_id`, `user_uid`, `user_first`, `user_last`, `user_email` FROM `users` WHERE user_id = ?") ){
						$stmt->bind_param("s", $token_user_id);
						$stmt->execute();
						$stmt->store_result();
						if ($stmt->num_rows == 1){
							$stmt->bind_result($usr['id'], $usr['uid'], $usr['first'], $usr['last'], $usr['email']);
							$stmt->fetch();
							$statusData['data']['is']['user'] = true;
							$statusData['data']['messages']['user'] = 'User exists';
							$usr['proceed'] = true;
						} else {
							// User does not exist
							$statusData['data']['is']['user'] = false;
							$statusData['data']['messages']['user'] = 'User does not exist';
							$usr['proceed'] = false;
						}
					} else {
						// 500
						// Prepared statement 2 failed
						// Error: Prepared statement failed at /api/send/confirm_token > $conn->prepare();
						$statusData['data']['is']['user'] = null;
						$statusData['data']['messages']['user'] = 'Prepared statement failed.';
						$usr['proceed'] = false;
					}

					if ($usr['proceed']){
						$emailhtml = '<p>Pozdravljeni '.$usr['uid'].'! Ta email ste prejeli za potrditev računa na storitvi rkjsezana.app <br><br> Osebni žeton: '.$token_token.' <br><br> Za potrditev računa sledite <a href="https://rkjsezana.app/user/confirmation?token='.$token_token.'">povezavi</a> ( https://rkjsezana.app/user/confirmation ). Ko je stran popolnoma naložena vpišite vaš žeton v vpisno polje (če še ni sam vpisan) ter kliknite na gumb z besedilom "AKTIVACIJA".';
						$tempArr = array(
							'from' => array(
								'name' => 'rkjsezana.app',
								'addr' => 'rkjsezana.app@gmail.com'
							),
							'to' => array(
								'addr' => $usr['email'],
								'name' => $usr['first'].' '.$usr['last']
							),
							'content' => array(
								'title' => 'Potrditev email naslova',
								'subject' => 'Potrditev email naslova za račun '.$_POST['uid'].' na storitvi rkjsezana.app',
								'html' => $emailhtml,
								'nohtml' => strip_tags($emailhtml)
							)
						);
						$temp1 = $mailUtil->send($tempArr);
						if ($temp1['is_success'] == true) {
							$statusData['data']['is']['sent'] = true;
						} else {
							// 500
							// Email was not sent
							// Error: $temp1['message']
							$statusData['data']['is']['sent'] = false;
							$statusData['data']['messages']['email'] = $temp1['message'];
						}
					} else {
						// $usr['proceed'] === false
						$statusData['data']['messages']['proceed'] = '$usr[\'proceed\'] === false';
					}
				} else {
					$statusData['data']['is']['token'] = false;
				}
			} else {
				$statusData['data']['is']['token'] = false;
			}
		} else {
			// 500
			// Prepared statement 1 failed
			// Error: Prepared statement failed at /api/send/confirm_token > $conn->prepare();
		}
	}

} else {
	$statusData['data']['allowed'] = false;
}
