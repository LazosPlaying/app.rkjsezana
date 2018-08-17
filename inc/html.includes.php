<?php

class includes{
	public function head(){
		echo '

		<meta charset="utf-8">
		<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<link rel="apple-touch-icon" href="https://rkjsezana.app/src/2018-08-12/favicon4.ico">
		<link rel="icon" href="https://rkjsezana.app/src/2018-08-12/favicon4.ico">

		<!-- META FOR SHARING -->
		<meta property="og:site_name" content="rkjsezana.app">
		<meta property="og:title" content="rkjsezana.app - Spletna aplikacija za RKJ Sežana">
		<meta property="og:description" content="RKJSEZANA.APP je spletna aplikacija namenjena vodstvu, članom ter staršem članov RKJ Sežana za uspešno in hitro medsebojno obveščanje.">
		<meta property="og:image" content="https://rkjsezana.app/src/2018-08-12/rkj-logo-medium-transparent.png">
		<meta property="og:url" content="https://rkjsezana.app">
		<meta property="og:type" content="website" />
		<meta property="og:locale" content="sl_SI" />
		<meta property="og:locale:alternate" content="en_GB" />

		<!-- MAIN CSS LIBRARIES -->
		<link type="text/css" rel="stylesheet" href="https://static.aljaxus.eu/lib/materializecss/materializecss-v1.0.0-beta/css/materialize.min.css"  media="screen,projection"/>

		<!-- MAIN JAVASCRIPT LIBRARIES -->
		<script type="text/javascript" src="https://static.aljaxus.eu/lib/jquery/jquery-3.3.1/jquery.min.js"></script>
		<script type="text/javascript" src="https://static.aljaxus.eu/lib/materializecss/materializecss-v1.0.0-beta/js/materialize.min.js"></script>



		';

		echo '<script>';
		foreach (glob(__DIR__ . '/global/*.js') as $filename){include_once $filename;}
		echo '</script>';
		echo '<style>';
		foreach (glob(__DIR__ . '/global/*.css') as $filename){include_once $filename;}
		echo '</style>';
	}
	public function foot(){
		foreach (glob(__DIR__ . '/global/html.modal-*.php') as $filename){include_once $filename;}
		echo '
		<!-- FONT LIBRARIES -->
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Tillana" rel="stylesheet">

		<!-- PLUGINS -->
		<script defer src="https://use.fontawesome.com/releases/v5.0.13/js/all.js" integrity="sha384-xymdQtn1n3lH2wcu0qhcdaOpQwyoarkgLVxC/wZ5q7h9gHtxICrpcaSUfygqZGOe" crossorigin="anonymous"></script>
		<script src="https://static.aljaxus.eu/lib/js-cookie/js-cookie-v2.2.0.js"></script>
		<script src="https://static.aljaxus.eu/lib/jquery-prettydate/prettydate.js"></script>
		<script src="https://static.aljaxus.eu/lib/pushjs.org/pushjs-2018-08-13/push.min.js"></script>

		<script src="https://static.aljaxus.eu/lib/jquery-highlightjs/highlightjs-2018-06-08/highlight.pack.js"></script>
		<link href="https://static.aljaxus.eu/lib/jquery-highlightjs/highlightjs-2018-06-08/styles/atom-one-dark.css" rel="stylesheet">
		';
		$this->googleAnalytics();

	}
	public function header(){
		require_once __DIR__ . '/global/html.header.php';
	}
	public function navbar(){
		require_once __DIR__ . '/global/html.navbar.php';
	}
	public function footer(){
		require_once __DIR__ . '/global/html.footer.php';
	}
	private function googleAnalytics(){
		// echo '
		// <!-- Global site tag (gtag.js) - Google Analytics -->
		// <script async src="https://www.googletagmanager.com/gtag/js?id=UA-119143726-1"></script>
		// <script>
		//   window.dataLayer = window.dataLayer || [];
		//   function gtag(){dataLayer.push(arguments);}
		//   gtag("js", new Date());
		//   gtag("config", "UA-119143726-1");
		// </script>
		// ';
	}
}

?>
