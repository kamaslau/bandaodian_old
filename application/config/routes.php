<?php
	if(!defined('BASEPATH')) exit('此文件不可被直接访问');

	$route['sitelang/referral/(:any)'] = 'r/transfer/$1';
	$route['r/generate/(:any)'] = 'r/generate/$1';
	$route['r/(:any)'] = 'r/index/$1';

	$route['groupbuy'] = 'groupbuy/index';
	$route['groupbuy/(:any)'] = 'groupbuy/detail/$1';

	$route['sms'] = 'sms/index';
	$route['sms/(:any)'] = 'sms/index/$1';

	$route['from/(:any)'] = 'from/index/$1';

	$route['default_controller'] = 'index';
	$route['404_override'] = '';

/* End of file routes.php */
/* Location: ./application/config/routes.php */