<?php
	if(!defined('BASEPATH')) exit('此文件不可被直接访问');
	
	class Index extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();

			$this->load->model('category_model');
			$this->load->model('groupbuy_model');
			$this->load->model('region_model');
		}
		
		// 首页
		public function index()
		{
			$data['class'] = 'home';

			$data['categories'] = $this->category_model->select('main');
			$data['sub_categories'] = $this->category_model->select();
			$data['regions'] = $this->region_model->select('main');
			$data['sub_regions'] = $this->region_model->select();
			$data['groupbuy'] = $this->groupbuy_model->select();

			$data['browser'] = $this->getBrowser();
			$data['os'] = $this->getOs();
			
			$this->load->view('templates/header', $data);
			$this->load->view('index', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/footer', $data);
		}
		
		/* 判断浏览器类型及版本 */
		public function getBrowser()
		{
			$user_agent = $this->input->server('HTTP_USER_AGENT');
		    if( preg_match('/Firefox/i', $user_agent) ):
		        preg_match('/Firefox[\ |\/]?([.0-9a-zA-Z]+)/i', $user_agent, $version);
		        $exp = 'Firefox '. $version[1];
			elseif( preg_match('/Maxthon/i', $user_agent) ):
		        preg_match('/Maxthon[\ |\/]?([.0-9a-zA-Z]+)/i', $user_agent, $version);
		        $exp = '傲游 '. $version[1];
			elseif( preg_match('/TaoBrowser/i', $user_agent) ):
		        preg_match('/TaoBrowser[\ |\/]?([.0-9a-zA-Z]+)/i', $user_agent, $version);
		        $exp = '淘宝 '. $version[1];
			elseif( preg_match('/TencentTraveler/i', $user_agent) ):
		        preg_match('/TencentTraveler[\ |\/]?([.0-9a-zA-Z]+)/i', $user_agent, $version);
		        $exp = '腾讯TT '. $version[1];
			elseif( preg_match('/Opera/i', $user_agent) ):
		        preg_match('/Version[\ |\/]?([.0-9a-zA-Z]+)/i', $user_agent, $version);
		        $exp = 'Opera '. $version[1];
			elseif( preg_match('/OPR/i', $user_agent) ):
		        preg_match('/OPR[\ |\/]?([.0-9a-zA-Z]+)/i', $user_agent, $version);
		        $exp = 'Opera '. $version[1];
			elseif( preg_match('/ChromePlus/i', $user_agent) ):
		        preg_match('/ChromePlus[\ |\/]?([.0-9a-zA-Z]+)/i', $user_agent, $version);
		        $exp = '枫树浏览器 '. $version[1];
			elseif( preg_match('/Chrome/i', $user_agent) ):
		        preg_match('/Chrome[\ |\/]?([.0-9a-zA-Z]+)/i', $user_agent, $version);
		        $exp = 'Chrome '. $version[1];
			elseif( preg_match('/Safari/i', $user_agent) ):
		        preg_match('/Version[\ |\/]?([.0-9a-zA-Z]+)/i', $user_agent, $version);
		        $exp = 'Safari '. $version[1];
			elseif( preg_match('/MSIE/i', $user_agent) ):
		        preg_match('/MSIE[\ |\/]?([.0-9a-zA-Z]+)/i', $user_agent, $version);
		        $exp = 'IE '. $version[1];
			else:
		        $exp = '其它浏览器';
			endif;
		    return $exp;
		}
		
		public function getOS()
		{
			$user_agent = $this->input->server('HTTP_USER_AGENT');
		    if( preg_match('/Mac OS/i', $user_agent) ):
		        preg_match('/Mac OS[\ |\/]?([.0-9a-zA-Z]+)/i', $user_agent, $version);
		        $exp = 'MAC OS '. $version[1];
			elseif( preg_match('/Windows/i', $user_agent) ):
				if( preg_match('/Windows NT/i', $user_agent) ):
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
	}
	
/* End of file index.php */
/* Location: ./application/controllers/index.php */