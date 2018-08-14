<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

$path = '/var/log/nginx/app.rkjsezana.error.log';

if (isset($_POST['delete'])){
	file_put_contents($path, '');
}

$data = fopen($path, 'r');
$pageText = fread($data, 25000);
fclose($data);

echo '<form action="" method="POST"><button submit="delete">Refresh</button></form>';
echo '<form action="" method="POST"><button submit="delete" name="delete">Delete data</button></form>';
if (isset($_POST)&&!empty($_POST)){echo json_encode($_POST, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES); echo '<br><br>';}

echo nl2br($pageText);
