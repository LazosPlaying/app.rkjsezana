<?php
require_once __DIR__ . '/../inc/util/firstload.php';

$_SESSION['locked'] = true;

header("Location: /session/locked");
exit();
