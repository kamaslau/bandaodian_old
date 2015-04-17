<?php
	if(!defined('BASEPATH')) exit('此文件不可被直接访问');

	//大众点评API参数
	define('APPKEY', '54421980');
	define('SECRET', 'cfab13b00c0c4e00923f11e5336f1dfd');

	//设置时区
	date_default_timezone_set('Asia/Shanghai');

	$config['base_url']	= 'http://www.bandaodian.com';

	$config['index_page'] = 'index.php';

	$config['uri_protocol']	= 'AUTO';

	$config['url_suffix'] = '';

	$config['language']	= 'chinese';

	$config['charset'] = 'UTF-8';

	$config['enable_hooks'] = FALSE;

	$config['subclass_prefix'] = 'MY_';

	$config['permitted_uri_chars'] = 'a-z 0-9~%.:_\-';

	$config['allow_get_array']		= TRUE;
	$config['enable_query_strings'] = FALSE;
	$config['controller_trigger']	= 'c';
	$config['function_trigger']		= 'm';
	$config['directory_trigger']	= 'd'; // experimental not currently in use

	$config['log_threshold'] = 0;

	$config['log_path'] = '';

	$config['log_date_format'] = 'Y-m-d H:i:s';

	$config['cache_path'] = '';

	$config['encryption_key'] = 'bandaodian_encryption';

	$config['sess_cookie_name']		= 'ci_session';
	$config['sess_expiration']		= 7200;
	$config['sess_expire_on_close']	= FALSE;
	$config['sess_encrypt_cookie']	= FALSE;
	$config['sess_use_database']	= FALSE;
	$config['sess_table_name']		= 'ci_sessions';
	$config['sess_match_ip']		= FALSE;
	$config['sess_match_useragent']	= TRUE;
	$config['sess_time_to_update']	= 300;

	$config['cookie_prefix']	= 'bdd_';
	$config['cookie_domain']	= '.bandaodian.com';
	$config['cookie_path']		= '/';
	$config['cookie_secure']	= FALSE;

	$config['global_xss_filtering'] = TRUE;

	$config['csrf_protection'] = FALSE;
	$config['csrf_token_name'] = 'csrf_test_name';
	$config['csrf_cookie_name'] = 'csrf_cookie_name';
	$config['csrf_expire'] = 7200;

	$config['compress_output'] = FALSE;

	$config['time_reference'] = 'Asia/Shanghai';

	$config['rewrite_short_tags'] = FALSE;

	$config['proxy_ips'] = '';

/* End of file config.php */
/* Location: ./application/config/config.php */