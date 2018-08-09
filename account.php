<?php

require_once __DIR__ . '/inc/util/firstload.php';
require_once __DIR__ . '/inc/html.includes.php';
require_once __DIR__ . '/inc/util/user.php';

$html = new includes();
$userUtil = new user();

if (isset($_GET['par1'])&&!empty($_GET['par1'])){
	if ($_GET['par1']=='locked'){
		if ($userUtil->getSessionStatus() === 'valid'){
			Header('Location: /');
			exit();
		} else if ($userUtil->getSessionStatus() === 'locked') {
			// User is locked
		} else if ($userUtil->getSessionStatus() === 'dead'){
			Header('Location: /account/login');
			exit();
		} else if ($userUtil->getSessionStatus() === 'nosession'){
			Header('Location: /account/login');
			exit();
		} else {
			exit();
		}
	} else if ($_GET['par1']=='confirm-email'){
		if ($userUtil->getSessionStatus() === 'valid'){
			// User is loged in
		} else if ($userUtil->getSessionStatus() === 'locked') {
			// User is locked
			Header('Location: /account/locked');
			exit();
		} else if ($userUtil->getSessionStatus() === 'dead'){
			// user is not loged in
		} else if ($userUtil->getSessionStatus() === 'nosession'){
			// User has no session set
		} else {
			exit();
		}
	} else if ($_GET['par1']=='not-accepted'){
		if ($userUtil->getSessionStatus() === 'valid'){
			// User is loged in
			Header('Location: /');
			exit();
		} else if ($userUtil->getSessionStatus() === 'locked') {
			// User is locked
			Header('Location: /account/locked');
			exit();
		} else if ($userUtil->getSessionStatus() === 'dead'){
			// user is not loged in
			Header('Location: /account/login');
			exit();
		} else if ($userUtil->getSessionStatus() === 'nosession'){
			// User has no session set
			Header('Location: /account/login');
			exit();
		} else if ($userUtil->getSessionStatus() === 'notaccepted'){
			// User has no session set
			Header('Location: /account/not-accepted');
			exit();
		} else {
			exit();
		}
	} else {
		if ($userUtil->getSessionStatus() === 'valid'){
			Header('Location: /');
			exit();
		} else if ($userUtil->getSessionStatus() === 'locked') {
			Header('Location: /account/locked');
			exit();
		} else if ($userUtil->getSessionStatus() === 'dead'){
			// User is not loged in
		} else if ($userUtil->getSessionStatus() === 'nosession'){
			// User does not have a session set
		} else {
			exit();
		}
	}
} else {
	Header('Location: /account/login');
	exit();
}
?>
<!DOCTYPE html>
<html>
<head>

	<title>Prijava / Registracija - RKJ Sežana</title>
	<meta name="description" content="Prijava / Registracija - Prijava v račun, Registracija novega računa">
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
					echo '<script>document.title="Prijava / Registracija - '.$_GET['par1'].' - RKJ Sežana";</script>';
					$path = __DIR__ . '/inc/pages/account-'.$_GET['par1'].'.php';
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
