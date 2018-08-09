<?php
require_once __DIR__ . '/../inc/util/firstload.php';
require_once __DIR__ . '/../inc/util/ajax.php';
$ajax = new ajax();

$arr = array();
function test2add($a,$b){global $arr ;if(isset($b) && !empty($b)){$arr[$a]=$b;}}

test2add('get',$_GET);
test2add('post',$_POST);
test2add('session',$_SESSION);
test2add('files',$_FILES);
test2add('server',$_SERVER);
test2add('cookie',$_COOKIE);
test2add('server',$_SERVER);
test2add('request',$_REQUEST);

echo $ajax->array2Json($arr);
