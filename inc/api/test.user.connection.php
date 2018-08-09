<?php
$statusData['data'] = array(
	'connected' => true,
	'session' => null,
	'error' => false
);
if ($userUtil->getSessionStatus() == 'valid'){
	$statusData['data']['session'] = 'valid';
} elseif ($userUtil->getSessionStatus() == 'locked') {
	$statusData['data']['session'] = 'locked';
} elseif ( ( $userUtil->getSessionStatus() == 'dead' || $userUtil->getSessionStatus() == 'nosession' ) ) {
	$statusData['data']['session'] = 'dead';
} else {
	$statusData['data']['error'] = true;
}
