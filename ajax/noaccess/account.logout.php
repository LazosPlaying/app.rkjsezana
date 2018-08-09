<?php
require_once __DIR__ . 'inc/util/firstload.php';

session_unset();
session_destroy();

sleep(0.5);
header("Location: /");
exit();

<?php
require_once __DIR__ . '/../inc/util/firstload.php';
require_once __DIR__ . '/../inc/util/ajax.php';
$ajax = new ajax();

if (!empty($_POST)){

} else {
	// ERROR: NO POST DATA RECIEVED
	exit();
}
