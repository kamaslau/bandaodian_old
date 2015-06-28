<?php
	if(!defined('BASEPATH')) exit('此文件不可被直接访问');

	define('BASE_URL', 'http://www.bandaodian.com/');

	//header('Access-Control-Allow-Origin:*'); // 允许跨域
	//大众点评API参数
	define('URL', 'http://api.dianping.com/v1/');
	define('APPKEY', '54421980');
	define('SECRET', 'cfab13b00c0c4e00923f11e5336f1dfd');
	
	// 判断浏览器类型及版本
	/*
	function get_browser()
	{
		$user_agent = $_SERVER['HTTP_USER_AGENT'];
	    if (preg_match('/Firefox/i', $user_agent)):
	        preg_match('/Firefox[\ |\/]?([.0-9a-zA-Z]+)/i', $user_agent, $version);
	        $exp = 'Firefox '. $version[1];
		elseif (preg_match('/Maxthon/i', $user_agent)):
	        preg_match('/Maxthon[\ |\/]?([.0-9a-zA-Z]+)/i', $user_agent, $version);
	        $exp = '傲游 '. $version[1];
		elseif (preg_match('/TaoBrowser/i', $user_agent)):
	        preg_match('/TaoBrowser[\ |\/]?([.0-9a-zA-Z]+)/i', $user_agent, $version);
	        $exp = '淘宝 '. $version[1];
		elseif (preg_match('/TencentTraveler/i', $user_agent)):
	        preg_match('/TencentTraveler[\ |\/]?([.0-9a-zA-Z]+)/i', $user_agent, $version);
	        $exp = '腾讯TT '. $version[1];
		elseif (preg_match('/Opera/i', $user_agent)):
	        preg_match('/Version[\ |\/]?([.0-9a-zA-Z]+)/i', $user_agent, $version);
	        $exp = 'Opera '. $version[1];
		elseif (preg_match('/OPR/i', $user_agent)):
	        preg_match('/OPR[\ |\/]?([.0-9a-zA-Z]+)/i', $user_agent, $version);
	        $exp = 'Opera '. $version[1];
		elseif (preg_match('/ChromePlus/i', $user_agent)):
	        preg_match('/ChromePlus[\ |\/]?([.0-9a-zA-Z]+)/i', $user_agent, $version);
	        $exp = '枫树浏览器 '. $version[1];
		elseif (preg_match('/Chrome/i', $user_agent)):
	        preg_match('/Chrome[\ |\/]?([.0-9a-zA-Z]+)/i', $user_agent, $version);
	        $exp = 'Chrome '. $version[1];
		elseif (preg_match('/Safari/i', $user_agent)):
	        preg_match('/Version[\ |\/]?([.0-9a-zA-Z]+)/i', $user_agent, $version);
	        $exp = 'Safari '. $version[1];
		elseif (preg_match('/MSIE/i', $user_agent)):
	        preg_match('/MSIE[\ |\/]?([.0-9a-zA-Z]+)/i', $user_agent, $version);
	        $exp = 'IE '. $version[1];
		else:
	        $exp = '其它浏览器';
		endif;
	    return $exp;
	}
	*/

	// 判断操作系统类型及版本
	/*
	function get_os()
	{
		$user_agent = $_SERVER['HTTP_USER_AGENT'];
	    if (preg_match('/Mac OS/i', $user_agent)):
	        preg_match('/Mac OS[\ |\/]?([.0-9a-zA-Z]+)/i', $user_agent, $version);
	        $exp = 'MAC OS '. $version[1];
		elseif (preg_match('/Windows/i', $user_agent)):
			if (preg_match('/Windows NT/i', $user_agent)):
				preg_match('/Windows[\ |\/]?([.0-9a-zA-Z]+)/i', $user_agent, $version);
				$exp = 'Windows '. $version[1];
			else:
				$exp = 'Windows其它版本';
			endif;
		else:
	        $exp = '其它';
		endif;
	    return $exp;
	}
	*/

	//设置时区
	date_default_timezone_set('Asia/Shanghai');

	$config['base_url']	= BASE_URL;
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