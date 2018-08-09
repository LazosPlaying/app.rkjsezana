<?php
require_once '../inc/util/firstload.php';
require_once '../inc/util/users.php';
$userUtil = new user();
if (!$userUtil->amiloged()){
	exit();
}

if (!empty($_POST)){
	if ( isset($_POST['value']) && isset($_POST['submit']) && $_POST['submit']=='commentPost' ){

		require_once '../inc/util/tools.php';
		require_once '../inc/util/database.php';
		require_once '../inc/util/arrays.php';

		$toolsutil = new tools();
		$dbutil = new dbManipulate();
		$dbconn = new dbconn();
		$arrtool = new arrayTools();

		$p_post = $_POST['value'];
		$p_parent = $_POST['parent'];
		$p_length = strlen($p_post);
		$p_formated = nl2br($p_post);

		if ($p_length > 0 && $p_length <= 250){
			$temp2 = $arrtool->arrayToString(array());
			$temp1 = array(
				'parent' => $p_parent,
				'publisher' => $_SESSION['u_id'],
				'value' => $p_formated,
				'reactions' => $temp2,
				'time' => time()
			);
			$dbutil->insert($temp1, 'posts_profile_comments');
			$toolsutil->toast('success', null, 'Komentar uspešno objavljen');
			echo "
			<script>
				$('#commentsModal').modal('hide');
				loadProfilePosts();
			</script>
			";
		} else {
			$toolsutil->toast('warning', null, 'Objava je lahko maksimalno 250 znakov dolga.');
		}

	}
}
