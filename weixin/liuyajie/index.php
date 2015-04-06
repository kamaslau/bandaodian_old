<?php
	//设置常量，并载入核心类
	define('TOKEN' , 'lyj');
	define('BIZ' , 'liuyajie');
	define('MESSAGE_SUBSCRIBE_TYPE' , 'text');
	$content = "成功关注“刘亚杰Kamas”\n敬请期待最新电子商务资讯，以及大数据精准营销心得！\n\n";
	$content.= "liuyajie@qingdaodian.com\n";
	$content.= "http://weibo.com/liuyajie";
	define('MESSAGE_SUBSCRIBE' , $content);
	require_once('../index.php');