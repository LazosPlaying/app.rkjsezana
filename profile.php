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
	Header('Location: /session/login');
	exit();
} else if ($userUtil->getSessionStatus() == 'nosession'){
	Header('Location: /session/login');
	exit();
} else {
	exit();
}

?>
<!DOCTYPE html>
<html>
<head>

	<title>Profil <?php echo $_GET['par1']; ?> - RKJ Sežana</title>
	<meta name="description" content="Profili - preglej profile drugih oseb">
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
				if (isset($_GET['par1'])&&!empty($_GET['par1'])){
					echo '<script>document.title="Profili - '.$_GET['par1'].' - RKJ Sežana";</script>';
					$path = __DIR__ . '/inc/pages/profile-'.$_GET['par1'].'.php';
					if (file_exists($path)){
						include_once $path;
					} else {
						include_once __DIR__ . '/inc/pages/error.php';
					}
				} else {
					include_once __DIR__ . '/inc/pages/error.php';
				}
			}

		?>

	</div>
</main>

<?php $html->footer(); ?>
</body>
<?php $html->foot(); ?>
</html>
