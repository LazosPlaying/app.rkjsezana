<?php

require_once __DIR__ . '/../inc/util/firstload.php';
require_once __DIR__ . '/../inc/util/users.php';

$userUtil = new user();
if (!$userUtil->amiloged()){
	die('Please log in');
}

if ( isset($_GET['id']) ){

	$id = $_GET['id'];
	$returning = array();

	require_once __DIR__ . '/../inc/util/tools.php';
	require_once __DIR__ . '/../inc/util/database.php';
	require_once __DIR__ . '/../inc/util/arrays.php';
	require_once __DIR__ . '/../inc/util/users.php';

	$toolsutil = new tools();
	$dbutil = new dbManipulate();
	$dbconn = new dbconn();
	$arrtool = new arrayTools();
	global $userUtil;

	$conn = $dbconn->oopmysqli();
	if ( $stmt = $conn->prepare("SELECT `id`, `profile`, `publisher`, `value`, `reactions`, `time` FROM `posts_profile_posts` WHERE profile = ? ORDER BY `id` DESC;") ){
		$stmt->bind_param("s", $id);
		$stmt->execute();
		$stmt->store_result();
		if ( $stmt->num_rows > 0 ){
			$post = array();
			$stmt->bind_result($post['id'], $post['profile'], $temp2, $post['value'], $temp1, $post['time']);

			while ( $stmt->fetch() ) {
				$post['reactions'] = $arrtool->stringToArray($temp1);
				$x=array(
					'id' => $post['id'],
					'profile' => $post['profile'],
					'value' => $post['value'],
					'reactions' => $post['reactions'],
					'time' => ($post['time'] * 1000)
				);

				$y = $userUtil->userDataById($temp2);
				$x['publisher'] = array(
					'id' => $y['id'],
					'first' => $y['first'],
					'last' => $y['last']
				);
				array_push($returning, $x);
			}


			header("Content-type: application/json; charset=utf-8");
			echo $arrtool->arrayToJson($returning);

		} else {
			echo 'nothing';
		}
	} else {
		die('<script>alert("Error; prepared statement failed at get.profile.posts.php ->  statement->prepare ! Prosimo obvestite administratorja.");</script>');
	}
} else {
	echo 'failed 1';
}
