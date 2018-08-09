<?php

exit();		// REMOVE THIS LINE IN PRODUCTION

require_once __DIR__ . '/inc/util/firstload.php';
require_once __DIR__ . '/inc/html.includes.php';

$html = new includes();

?>
<!DOCTYPE html>
<html>
<head>

	<title>RKJ Sežana - template</title>
	<?php $html->head(); ?>

</head>
<body>
<?php $html->header(); ?>
<main>
	<?php $html->navbar(); ?>
  	<div class="container">

	</div>
</main>
<?php $html->footer(); ?>
</body>
<?php $html->foot(); ?>
</html>
