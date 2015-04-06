<?php
	//设置常量，并载入核心类
	define('TOKEN' , 'ysp');
	define('BIZ' , 'yishengpin');
	define('MESSAGE_SUBSCRIBE_TYPE' , 'news');
	define('MESSAGE_SUBSCRIBE' , '<item>
							<Title><![CDATA[成功关注一圣品海鲜舫]]></Title> 
							<Description><![CDATA[请点击领取会员卡、获取积分、查看一圣品美食菜谱，或为您导航至最近一圣品门店]]></Description>
							<PicUrl><![CDATA[http://qddian.com/yishengpin/images/cover.jpg]]></PicUrl>
							<Url><![CDATA[http://qddian.com/yishengpin/]]></Url>
						</item>');
	require_once('../index.php');