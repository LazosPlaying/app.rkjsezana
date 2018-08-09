<?php

$data = array(
	'userdata' => array(
		'is_loged' => false,
		'first' => null,
		'last' => null,
		'uid' => null,
		'id' => null,
		'email' => null
	),
	'tabs' => array(
		array(
			'element' => 'a',
			'href' => '/',
			'icon' => 'view_quilt',
			'text' => 'Glavna stran',
			'class' => 'red lighten-1'
		),
		array(
			'element' => 'dropdown',
			'id' => 'navbaralways_dropdown_moreabout',
			'icon' => 'dashboard',
			'text' => 'Več o rodu',
			'class' => 'red lighten-1',
			'items' => array(
				array(
					'element' => 'a',
					'href' => '/vizitka',
					'icon' => 'list_alt',
					'text' => 'Vizitka',
				)
			)
		)
	)
);

if ($userUtil->getSessionStatus() == 'valid'){
	$data['userdata'] = array(
		'is_loged' => true,
		'first' => $_SESSION['u_first'],
		'last' => $_SESSION['u_last'],
		'uid' => $_SESSION['u_uid'],
		'id' => $_SESSION['u_id'],
		'email' => $_SESSION['u_email']
	);
	$data['tabs'] = array_merge($data['tabs'],
		array(
			array(
				'element' => 'dropdown',
				'id' => 'navbarloged_dropdown_admin',
				'icon' => 'dashboard',
				'text' => 'Administracija',
				'class' => 'green darken-2',
				'items' => array(
					array(
						'element' => 'a',
						'href' => '/admin/news',
						'icon' => 'rate_review',
						'text' => 'Objava novic'
					),
					array(
						'element' => 'a',
						'href' => '/admin/users',
						'icon' => 'supervisor_account',
						'text' => 'Uporabniki'
					),
					array(
						'element' => 'a',
						'href' => '/admin/groups',
						'icon' => 'supervised_user_circle',
						'text' => 'Skupine'
					)
				)
			),
			array(
				'element' => 'dropdown',
				'id' => 'navbarloged_dropdown_dev',
				'icon' => 'developer_board',
				'text' => 'Dev',
				'class' => 'green darken-2',
				'items' => array(
					array(
						'element' => 'a',
						'href' => '/dev/updates',
						'icon' => 'update',
						'text' => 'Post updates'
					),
					array(
						'element' => 'a',
						'href' => '/dev/apidocs',
						'icon' => 'http',
						'text' => 'HTTP API'
					),
					array(
						'element' => 'a',
						'href' => '/dev/sysdocs',
						'icon' => 'dns',
						'text' => 'System docs'
					),
					array(
						'element' => 'a',
						'href' => '/dev/utildocs',
						'icon' => 'usb',
						'text' => 'Util docs'
					),
					array(
						'element' => 'a',
						'href' => '/devbox/errors.php',
						'target' => '_blank',
						'icon' => 'error',
						'text' => 'Error log'
					)
				)
			),
			array(
				'element' => 'dropdown',
				'id' => 'navbarloged_dropdown_user',
				'icon' => 'face',
				'text' => $_SESSION['u_first'].' '.$_SESSION['u_last'],
				'class' => 'blue darken-1',
				'items' => array(
					array(
						'element' => 'a',
						'href' => '/user/settings',
						'icon' => 'settings',
						'text' => 'Nastavitve računa'
					),
					array(
						'element' => 'a',
						'href' => '/ajax/account.lock.php',
						'icon' => 'lock',
						'text' => 'Zakleni račun'
					),
					array(
						'element' => 'a',
						'href' => '/ajax/account.logout.php',
						'icon' => 'exit_to_app',
						'text' => 'Odjavi se'
					)
				)
			),
		)
	);
} else if ($userUtil->getSessionStatus() == 'locked') {
	$data['tabs'] = array_merge($data['tabs'],
		array(
			array(
				'element' => 'dropdown',
				'id' => 'navbarlocked_dropdown_logout',
				'icon' => 'face',
				'text' => $_SESSION['u_first'].' '.$_SESSION['u_last'],
				'class' => 'blue darken-1',
				'items' => array(
					array(
						'element' => 'a',
						'href' => '/ajax/account.logout.php',
						'icon' => 'exit_to_app',
						'text' => 'Odjavi račun'
					)
				)
			)
		)
	);
} else if ( ($userUtil->getSessionStatus() == 'nosession') || ($userUtil->getSessionStatus() == 'dead') ){
	$data['tabs'] = array_merge($data['tabs'],
		array(
			array(
				'element' => 'dropdown',
				'id' => 'navbarunloged_dropdown_loginsignup',
				'icon' => 'person',
				'text' => 'Uporabnik',
				'class' => 'blue darken-1',
				'items' => array(
					array(
						'element' => 'a',
						'href' => '/account/login',
						'icon' => 'vpn_key',
						'text' => 'Prijava'
					),
					array(
						'element' => 'a',
						'href' => '/account/signup',
						'icon' => 'person_add',
						'text' => 'Registracija'
					)
				)
			)
		)
	);
} else {
	exit();
}


$statusData['data'] = $data;
