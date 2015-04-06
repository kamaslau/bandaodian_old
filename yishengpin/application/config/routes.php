<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* Product */
$route['product/credit'] = 'product/index/credit';
$route['product'] = 'product/index';
$route['create'] = 'product/create';

/* Credit */
$route['rookie'] = 'credit/rookie';
$route['signin'] = 'credit/signin';
$route['checkout'] = 'credit/checkout';
$route['exchange/(:any)']='credit/exchange/$1';
$route['exchange'] = 'credit/exchange';

/* Member */
$route['level'] = 'member/level';

/* User */
$route['login/(:any)']='user/login/$1';
$route['login']='user/login';
$route['register/(:any)']='user/register/$1';
$route['register']='user/register';
$route['logout']='user/logout';

$route['default_controller'] = 'home';
$route['404_override'] = '';

/* End of file routes.php */
/* Location: ./application/config/routes.php */