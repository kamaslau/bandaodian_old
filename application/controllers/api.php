<?php
	if(!defined('BASEPATH')) exit('此文件不可被直接访问');

	class Api extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
		}

		//单点登录接口,返回用户cookie,默认返回用户id,设置type参数为“mobile”则返回用户手机号
		public function sso($type = 'id', $api_id = NULL, $api_key = NULL)
		{
			//获取*.qddian.com下的相关cookie值
			$content = $this->input->cookie($this->config->item('cookie_prefix').'user_'.$type);
			
			if(isset($content)):
				//若有，则返回到请求来源
				//echo $content;
				$result = array($type => $content);
				header("Content-type:application/json;charset=utf-8");
				echo json_encode($result);
				
			else:
				//若无，则返回空值
				echo FALSE;

			endif;
		}

	}