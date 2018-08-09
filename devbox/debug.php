<?php
require_once __DIR__ . '/../inc/util/firstload.php';


$statusData = array();

if ( isset($_SESSION) && !empty($_SESSION) ){
	$statusData['session'] = $_SESSION;
}

if ( isset($_GET) && !empty($_GET) ){
	$statusData['get'] = $_GET;
}

if ( isset($_POST) && !empty($_POST) ){
	$statusData['post'] = $_POST;
}


header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
Header('Content-Type: application/json');
echo json_encode($statusData, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES);
