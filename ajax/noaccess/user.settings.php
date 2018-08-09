<?php
require_once __DIR__ . '/../inc/util/firstload.php';
require_once __DIR__ . '/../inc/util/users.php';
require_once __DIR__ . '/../inc/util/ajax.php';
$userUtil = new user();
$ajax = new ajax();
if (!$userUtil->amiloged()){
	exit();
}

if (!empty($_POST)){
	require_once __DIR__ . '/../inc/util/tools.php';
	require_once __DIR__ . '/../inc/util/database.php';
	require_once __DIR__ . '/../inc/util/arrays.php';

	$toolsutil = new tools();
	$dbutil = new dbManipulate();
	$dbconn = new dbconn();
	$arrtool = new arrayTools();




} else {
	// ERROR: NO POST DATA RECIEVED
	exit();
}
