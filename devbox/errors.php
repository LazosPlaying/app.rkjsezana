<?php
$path = '/var/log/nginx/app.rkjsezana.error.log';
$data = fopen($path, 'r');
$pageText = fread($data, 25000);

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
echo nl2br($pageText);
