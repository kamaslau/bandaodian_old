<?php
	if(!defined('BASEPATH')) exit('此文件不可被直接访问');

	class From extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
		}

		//管理后台首页
		//来源方式$method 1:qrcode 2:link default:1
		//来源载体$place 1:bizcard 2:wechat 3:weibo default:1
		//信息内容$activity 若$place==1,则为名片所属人（1刘亚杰2张燕3韩真）
		public function index($method = 1, $place = 1, $activity = NULL)
		{	
			$method = ($method == 1) ? 2 : 1 ;
			
			//将推广人原ID转换为思特朗管理人ID
			if($activity == 2):
				$activity = 98;
				
			elseif($activity = 3):
				$activity = 99;
				
			endif;
			
			$referral_url = 'http://bandaodian.com/sitelang/referral/' . $method . '/2' . '/2' . '/2' . '/1' . '/'.$activity;
			redirect($referral_url);
		}
	}

/* End of file from.php */
/* Location: ./application/controllers/from.php */