<?php
	if(!defined('BASEPATH')) exit('此文件不可被直接访问');

	class Sms extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
		}
		
		//触发短信
		public function index($message)
		{
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); 
			curl_setopt($ch, CURLOPT_HEADER, FALSE);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);     
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, TRUE); 
			curl_setopt($ch, CURLOPT_SSLVERSION , 3);
			curl_setopt($ch, CURLOPT_HTTPAUTH , CURLAUTH_BASIC);
			curl_setopt($ch, CURLOPT_USERPWD  , 'api:key-d0359aad0edf38a18e737a58a17b0918');
			
			curl_setopt($ch, CURLOPT_URL, 'https://sms-api.luosimao.com/v1/send.json');
			curl_setopt($ch, CURLOPT_POST, TRUE);
			$content = array(
				'mobile' => '13698673572'
			);
			curl_setopt($ch, CURLOPT_POSTFIELDS , $content);

			$res = curl_exec( $ch );
			curl_close( $ch );
			var_dump($res);
		}
		
		//查询余额
		public function balance()
		{
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); 
			curl_setopt($ch, CURLOPT_HEADER, FALSE);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);     
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, TRUE); 
			curl_setopt($ch, CURLOPT_SSLVERSION , 3);
			curl_setopt($ch, CURLOPT_HTTPAUTH , CURLAUTH_BASIC);
			curl_setopt($ch, CURLOPT_USERPWD  , 'api:key-d0359aad0edf38a18e737a58a17b0918');
			
			curl_setopt($ch, CURLOPT_URL , "https://sms-api.luosimao.com/v1/status.json");

			$res =  curl_exec( $ch );
			curl_close( $ch );
			var_dump($res);
		}
	}

/* End of file sms.php */
/* Location: ./application/controllers/sms.php */