<?php
require_once __DIR__ . '/../inc/util/firstload.php';
require_once __DIR__ . '/../inc/util/users.php';
$userUtil = new user();
if (!$userUtil->amiloged()){
	exit();
}

if (!empty($_POST) || !empty($_GET)){
	if (isset($_POST['id']) || isset($_GET['id'])){

		require_once __DIR__ . '/../inc/util/tools.php';
		require_once __DIR__ . '/../inc/util/database.php';
		require_once __DIR__ . '/../inc/util/arrays.php';

		$toolsutil = new tools();
		$dbutil = new dbManipulate();
		$dbconn = new dbconn();
		$arrtool = new arrayTools();

		function defaultImage($status="noimage"){
			global $toolsutil;
			$defaultImg = __DIR__ . '/../uploads/profilepics/default_'.$status.'.jpg';
			$toolsutil->outputJpg($defaultImg);
		}

		$id;

		if (isset($_POST['id'])){
			$id=$_POST['id'];
		} elseif (isset($_GET['id'])){
			$id=$_GET['id'];
		} else {
			die('<script>alert("Error; data validation failed user.login.php -> isset() -> not POST or GET ! Prosimo obvestite administratorja.");</script>');
		}

		$conn = $dbconn->oopmysqli();
		if ( $stmt = $conn->prepare("SELECT `user_id` FROM `users` WHERE user_id = ?") ){

			$stmt->bind_param("s", $id);
			$stmt->execute();
			$stmt->store_result();
			if ($stmt->num_rows == 1){
				$stmt->bind_result($u_id);
				$stmt->fetch();

				$imagePath = __DIR__ . '/../uploads/profilepics/'.$u_id.'.jpg';
				if (file_exists($imagePath)){
					$toolsutil->outputJpg($imagePath);
				} else {
					defaultImage('noimage');
				}

			} else {
				defaultImage('nouser');
			}
		} else {
			die('<script>alert("Error; prepared statement failed at user.login.php -> ifIsUser() -> statement->prepare ! Prosimo obvestite administratorja.");</script>');
		}

	}
}
?>
