<?php

require_once __DIR__ . '/inc/util/firstload.php';
require_once __DIR__ . '/inc/html.includes.php';
require_once __DIR__ . '/inc/util/user.php';

$html = new includes();
$userUtil = new user();

setcookie('loginrefer', '/', time() + 300, "/");

if ($userUtil->getSessionStatus() == 'valid'){
	// User is loged in and not locked
} else if ($userUtil->getSessionStatus() == 'locked') {
	Header('Location: /session/locked');
	exit();
} else if ($userUtil->getSessionStatus() == 'dead'){
	// User is not loged in
} else if ($userUtil->getSessionStatus() == 'nosession'){
	// User does not have a valid session set
} else {
	exit();
}

?>
<!DOCTYPE html>
<html>
<head>

	<title>Objave - RKJ Sežana</title>
	<meta name="description" content="Objave stran">
	<?php $html->head(); ?>

</head>
<body>
<?php $html->header(); ?>
<div id="loader-wrapper"></div>
<main>
	<?php $html->navbar(); ?>
  	<div class="container">

		<?php

			{
				if (isset($_GET['id'])&&!empty($_GET['id'])){
					include_once __DIR__ . '/inc/pages/article-index.php';
				} else {
					echo '<script>window.location.replace("/");</script>';
				}
			}

		?>

	</div>
</main>
<?php $html->footer(); ?>
</body>
<?php $html->foot(); ?>
</html>
