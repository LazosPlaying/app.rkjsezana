<?php
require_once __DIR__ . '../inc/util/firstload.php';
require_once __DIR__ . '/../inc/util/ajax.php';
$ajax = new ajax();

if (!empty($_POST) && isset($_POST['uid']) && isset($_POST['pwd']) ){
	require_once __DIR__ . '../inc/util/tools.php';
	require_once __DIR__ . '../inc/util/database.php';
	require_once __DIR__ . '../inc/util/arrays.php';

	$toolsutil = new tools();
	$iputil = new getUserIp();
	$dbutil = new dbManipulate();
	$dbconn = new dbconn();
	$arrtool = new arrayTools();


    function replyAndEnd($replyAndEnda = "empty", $replyAndEndb = "empty", $replyAndEndc = "empty", $replyAndEndd = "3s"){
		global $toolsutil;
		if ($replyAndEnda=='empty'||$replyAndEndb=='empty'||$replyAndEndc=='empty'){
			die('<script>alert("Incorrect function call at /ajax/user.login.php -> replyAndEnd ! One or more paremeters are missing! Prosimo obvestite administratorja");</script>');
		} else {
			echo '
			<script>
			setTimeout(function(){$("#loginbtn").prop("disabled", false);}, 750);
			</script>
			';
			$toolsutil->toast($replyAndEnda, $replyAndEndb, $replyAndEndc, $replyAndEndd);
			exit();
		}
    }

	$uid = $_POST['uid'];
	$pwd = $_POST['pwd'];
	$sendTo = $_POST['refer'];

	$loginsarr = array(
		'login_time' => time(),
		'login_ip' => $iputil->getIpAddress(),
		'login_user_id' => null,
		'login_state' => null
	);


	$conn = $dbconn->oopmysqli();
	if ( $stmt = $conn->prepare("SELECT `user_id`, `user_uid`, `user_first`, `user_last`, `user_email`, `user_groups`, `user_pwd` FROM `users` WHERE user_uid = ?") ){

		$stmt->bind_param("s", $uid);
		$stmt->execute();
		$stmt->store_result();
		if ($stmt->num_rows == 1){
			$stmt->bind_result($u_id, $u_uid, $u_first, $u_last, $u_email, $u_groups, $u_pwd);
			$stmt->fetch();
			if ( password_verify($pwd, $u_pwd) ){


				$loginsarr['login_user_id'] = $u_id;
				$loginsarr['login_state'] = 1;
				if ( $dbutil->insert($loginsarr, 'users_logins') ){

					$_SESSION['u_id'] = $u_id;
					$_SESSION['u_uid'] = $u_uid;
					$_SESSION['u_first'] = $u_first;
					$_SESSION['u_last'] = $u_last;
					$_SESSION['u_email'] = $u_email;
					$_SESSION['u_groups'] = $arrtool->stringToArray($u_groups);


					echo '<script>setTimeout(function(){window.location.replace("'.$sendTo.'");}, 1300);</script>';
					replyAndEnd("success",null,"Uspešna prijava", 1300);
				} else {
					replyAndEnd("error",null,"Napaka v sistemu!", 1300);
				}

			} else {
				$loginsarr['login_user_id'] = $u_id;
				$loginsarr['login_state'] = 0;
				$dbutil->insert($loginsarr, 'users_logins');

				replyAndEnd("warning",null,"Podatki se ne ujemajo");
			}
		} else {
			replyAndEnd("warning",null,"Podatki se ne ujemajo");
		}
	} else {
		die('<script>alert("Error; prepared statement failed at user.login.php -> ifIsUser() -> statement->prepare ! Prosimo obvestite administratorja.");</script>');
	}



} else {
		// ERROR: NO POST DATA RECIEVED
	exit();
}
