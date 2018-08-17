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
			'navbar' => array(
				'element' => 'a',
				'href' => '/',
				'icon' => 'view_quilt',
				'text' => 'Glavna stran',
				'class' => 'red lighten-1'
			),
			'sidebar' => array(
				'element' => 'a',
				'href' => '/',
				'icon' => 'view_quilt',
				'text' => 'Glavna stran',
				'class' => 'red lighten-1'
			)
		),
		array(
			'navbar' => array(
				'element' => 'dropdown',
				'id' => 'navbaralways_dropdown_moreabout',
				'icon' => 'more',
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
			),
			'sidebar' => array(
				'element' => 'dropdown',
				'id' => 'sidebaralways_dropdown_moreabout',
				'icon' => 'more',
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

	if (true) {
		array_push($data['tabs'],
			array(
				'navbar' => array(
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
				'sidebar' => array(
					'element' => 'dropdown',
					'id' => 'sidebarloged_dropdown_admin',
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
				)
			)
		);
	}
	if (true) {
		array_push($data['tabs'],
			array(
				'navbar' => array(
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
				'sidebar' => array(
					'element' => 'dropdown',
					'id' => 'sidebarloged_dropdown_dev',
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
				)
			)
		);
	}

	array_push($data['tabs'],
		array(
			'navbar' => array(
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
			'sidebar' => array(
				'element' => 'dropdown',
				'id' => 'sidebarloged_dropdown_user',
				'icon' => 'face',
				'text' => 'Moj račun',
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
						'href' => '/user/notifications',
						'icon' => 'notifications',
						'text' => 'Obvestila'
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
			)
		)
	);

	if (false) {

		$items = array(
			array(
				'element' => 'a',
				'href' => '#1',
				'icon' => 'sms',
				'text' => 'Notification 1'
			),
			array(
				'element' => 'a',
				'href' => '#2',
				'icon' => 'email',
				'text' => 'Notification 2'
			)
		);

		array_push($data['tabs'],
			array(
				'navbar' => array (
					'element' => 'dropdown',
					'id' => 'navbarloged_dropdown_notifications',
					'icon' => 'notifications',
					'text' => null,
					'class' => 'purple darken-1',
					'items' => $items
				)
				// 'sidebar' => array(
				// 	'element' => 'dropdown',
				// 	'id' => 'sidebarloged_dropdown_notifications',
				// 	'icon' => 'notifications',
				// 	'text' => 'Notifications',
				// 	'class' => 'purple darken-1',
				// 	'items' => $items
				// )
			)
		);
	}


} else if ($userUtil->getSessionStatus() == 'locked') {
	array_push($data['tabs'],
		array(
			'navbar' => array(
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
			),
			'sidebar' => array(
				'element' => 'dropdown',
				'id' => 'sidebarlocked_dropdown_logout',
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
	array_push($data['tabs'],
		array(
			'navbar' => array(
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
			),
			'sidebar' => array(
				'element' => 'dropdown',
				'id' => 'sidebarunloged_dropdown_loginsignup',
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
