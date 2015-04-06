<?php
	//主类
	class wechat
	{	
		protected $postStr;
		
		public function __construct()
		{
			//验证信息来自微信
			if(!$this->checkSignature()):
				echo '仅用于微信公众平台开发';
				exit;
			endif;
			
			//验证开发者身份
			if($_GET['echostr']):
				$this->valid();
				exit;
			endif;
			
			//接收用户发来的各类型信息
			$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
			
			//验证收到的消息不为空
			if (!empty($postStr)):
				$this->postStr=$postStr;
			else:
				echo '接收到的消息为空';
				exit;
			endif;
		}

		//检查签名
		private function checkSignature()
		{
			$signature = $_GET['signature'];
			$timestamp = $_GET['timestamp'];
			$nonce = $_GET['nonce'];
			$token = TOKEN;//常量在子目录index文件中设置
			
			$tmpArr = array($token, $timestamp, $nonce);
			//sort($tmpArr);
			sort($tmpArr, SORT_STRING);
			$tmpStr = implode($tmpArr);
			$tmpStr = sha1($tmpStr);
			
			if($tmpStr == $signature):
				return true;
			else:
				return false;
			endif;
		}
		
		//验证开发者身份
		private function valid()
		{
			$echoStr = $_GET['echostr'];
			//验证签名，可选项
			if($this->checkSignature()):
				echo $echoStr;
				exit;
			endif;
		}
		
		//处理并回复信息
		public function process()
		{
			//解析并分流信息
			require_once('prepare.php');
			
			//载入回复模板
			require_once('template.php');
			
			//回复信息
			require_once('reply.php');
		}
	}
	
	//设置TOKEN常量（需与后台一致）
	$wechatObj = new wechat();
	
	//常规逻辑
	$wechatObj->process();