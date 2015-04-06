<!doctype html>
<html lang=zh-cn>
	<head>
		<meta charset=utf-8>
		<link rel=dns-prefetch href="http://cdn.key2all.com">
		<link rel=dns-prefetch href="http://images.key2all.com">
		<title><?php echo $title; ?> - 青岛店微官网</title>
		<meta name=description content="一圣品海鲜舫 - 半岛店">
		<meta name=keywords content="一圣品, 一圣品海鲜舫, 半岛店, 半岛店定制版">
		<meta name=version content="revision20150220">
		<meta name=author content="刘亚杰">
		<meta name=copyright content="刘亚杰,青岛森思壮电子商务有限公司">
		<meta name=contact content="lianxi@sensestrong.com, http://weibo.com/sensestrong">
		<meta name=viewport content="width=device-width, user-scalable=0">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<!--[if (lt IE 9) & (!IEMobile)]>
			<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
			<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
		<![endif]-->
		<script src="http://cdn.key2all.com/js/jquery/new.js"></script>
		<script src="http://cdn.key2all.com/js/jquery/jquery.tablesorter.js"></script>
		<link rel=stylesheet media=all href="http://cdn.key2all.com/css/reset.css">
		<link rel=stylesheet media=all href="<?php echo base_url('css/style.css'); ?>">
		
		<link rel="shortcut icon" href="<?php echo base_url('images/icon_32.png'); ?>">
		<link rel="apple-touch-icon" href="<?php echo base_url('images/icon_128.png'); ?>">
		<link rel=canonical href="<?php echo base_url().uri_string(); ?>">
		
		<meta name=format-detection content="telephone=no, address=no, email=no">
		<!-- 苹果设备优化 -->
		<meta name=apple-mobile-web-app-capable content="yes">
		<meta name=apple-mobile-web-app-status-bar-style content="black-translucent">
	</head>
<?php
	//将head内容立即输出，让用户浏览器立即开始请求head中各项资源，提高页面加载速度
	ob_flush();flush();
?>
<!-- 内容开始 -->
	<body class=<?php echo $class; ?>>
<?php if($class != 'home'): ?>
		<header id=header class=container>
			<h1><?php echo $title; ?></h1>
			<a id=home href="<?php if($class == 'product' || $class == 'branch' || $class == 'member' || $class == 'user'){echo base_url();}else{echo base_url('member');} ?>">返回</a>
		</header>
<?php endif; ?>