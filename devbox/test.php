<?php

require_once __DIR__ . '/../inc/util/firstload.php';
require_once __DIR__ . '/../inc/html.includes.php';
require_once __DIR__ . '/../inc/util/user.php';

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

	<title>RKJ Sežana</title>
	<meta name="description" content="Domača stran">
	<?php $html->head(); ?>

</head>
<body>
<?php $html->header(); ?>
<div id="loader-wrapper"></div>
<main>
	<?php $html->navbar(); ?>
  	<div class="container">
		<div class="card">
		  	<div class="card-content">
				<div class="row" style="margin-bottom:0;">
					<div class="left col s12 m7 l8 xl9">
						<img src="https://rkjsezana.app/externals/test-img/ales-krivec-26310-unsplash.jpg" alt="test image">
						<img src="https://rkjsezana.app/externals/test-img/federico-lorenzo-barra-564331-unsplash.jpg" alt="test image">
						<img src="https://rkjsezana.app/externals/test-img/jack-cain-365272-unsplash.jpg" alt="test image">
						<img src="https://rkjsezana.app/externals/test-img/jeff-finley-581655-unsplash.jpg" alt="test image">
						<img src="https://rkjsezana.app/externals/test-img/larry-chen-30069-unsplash.jpg" alt="test image">
						<!-- <img src="https://rkjsezana.app/externals/test-img/gamze-bozkaya-593063-unsplash.jpg" alt="test image"> -->
						<!-- <img src="https://rkjsezana.app/externals/test-img/markus-spiske-111889-unsplash.jpg" alt="test image">
						<img src="https://rkjsezana.app/externals/test-img/michael-fruehmann-44182-unsplash.jpg" alt="test image">
						<img src="https://rkjsezana.app/externals/test-img/nathaniel-watson-475205-unsplash.jpg" alt="test image">
						<img src="https://rkjsezana.app/externals/test-img/olivier-miche-264305-unsplash.jpg" alt="test image">
						<img src="https://rkjsezana.app/externals/test-img/paul-mocan-563174-unsplash.jpg" alt="test image">
						<img src="https://rkjsezana.app/externals/test-img/rakesh-nagula-30605-unsplash.jpg" alt="test image">
						<img src="https://rkjsezana.app/externals/test-img/sketch-the-sun-160783-unsplash.jpg" alt="test image">
						<img src="https://rkjsezana.app/externals/test-img/teddy-kelley-89698-unsplash.jpg" alt="test image"> -->
					</div>
					<div class="right col s12 m5 l4 xl3">
						<div class="col s12 hide-on-med-and-down" style="padding:0;">
							<div class="accountbox">
								<div class="accountbox-card">
									<?php
									if ($userUtil->getSessionStatus() == 'valid'){
										echo '
										<div style="text-align: right;">
											<p class="green-text" style="text-align: left;">
												you are loged in :)
											</p>
											<br><a href="/ajax/account.logout.php" class="btn btn-small waves-effect waves-light red">logout here</a>
										</div>';
									} else if ($userUtil->getSessionStatus() == 'dead' || $userUtil->getSessionStatus() == 'nosession'){
										echo '
										<div style="text-align: right;">
											<p class="red-text" style="text-align: left;">
												you are not loged in :(
											</p>
											<br><a href="/account/login" class="btn btn-small waves-effect waves-light green">login here</a>
										</div>';
										} else {
											exit();
										}
									?>
								</div>
							</div>
						</div>
						<div class="col s12" style="padding:0;">
							<div class="updates"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>

<style media="screen">
	.left > img {
		max-width: 100%;
		height: auto;
	}
</style>

<!-- <script src="/externals/js.home-updates.js" charset="utf-8"></script>
<link rel="stylesheet" href="/externals/css.home-updates.css"> -->

<!-- <link rel="stylesheet" href="/externals/css.home-accountbox.css"> -->

<?php $html->footer(); ?>
</body>
<?php $html->foot(); ?>
</html>
