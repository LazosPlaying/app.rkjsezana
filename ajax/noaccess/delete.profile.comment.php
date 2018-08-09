<?php
require_once __DIR__ . '/../inc/util/firstload.php';
require_once __DIR__ . '/../inc/util/ajax.php';
$ajax = new ajax();

if (!empty($_POST)){

} else {
	// ERROR: NO POST DATA RECIEVED
	exit();
}
