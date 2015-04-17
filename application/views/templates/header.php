<?php
	if(isset($_GET['referral_id'])):
		//若有referral_id,则记录5分钟
		$this->input->set_cookie('referral_id', $_GET['referral_id'], 60*5);
	endif;
?>
<!doctype html>
<html lang=zh-cn>
	<head>
		<meta charset=utf-8>
		<link rel=dns-prefetch href="http://cdn.key2all.com">
		<link rel=dns-prefetch href="http://images.key2all.com">
		<title><?php echo ($class != 'home')?$title.' | 半岛店 - 精彩近在身边':'半岛店 - 精彩近在身边'; ?></title>
		<meta name=description content="<?php if(isset($title)){echo $title;} ?>半岛店是一个本地生活平台，为你精挑细选青岛商家的会员福利、优惠券、团购信息等优惠活动，以及本地淘宝/天猫卖家店铺的优质精品。">
		<meta name=keywords content="<?php if(isset($title)){echo $title;} ?>青岛团购,青岛团购网,青岛零食,青岛超市,青岛网上超市,青岛商城,青岛网上商城,青岛购物,青岛网上购物,青岛优惠,青岛打折,青岛淘宝,青岛天猫,青岛实体店,青岛淘宝实体店,青岛淘宝店铺,青岛店铺">
		<meta name=version content="revision20150418">
		<meta name=author content="刘亚杰">
		<meta name=copyright content="刘亚杰,森思壮SenseStrong">
		<meta name=contact content="lianxi@sensestrong.com, http://weibo.com/sensestrong">
		<meta name=viewport content="width=device-width">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<!--[if (lt IE 9) & (!IEMobile)]>
			<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
			<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
		<![endif]-->
		<script src="http://cdn.key2all.com/js/jquery/new.js"></script>
		<script src="http://cdn.key2all.com/js/jquery/jquery.cookie.js"></script>
		<!--<script src="http://cdn.key2all.com/js/jquery/jquery.validate.js"></script>
		<script src="http://cdn.key2all.com/js/jquery/jquery.uploadify.js"></script>-->
		<script src="<?php echo base_url('js/groupbuy.js'); ?>"></script>
		<link rel=stylesheet media=all href="http://cdn.key2all.com/css/reset.css">
		<link rel=stylesheet media=all href="<?php echo base_url('css/style.css'); ?>">
		
		<link rel="shortcut icon" href="<?php echo base_url('images/icon_32.png'); ?>">
		<link rel="apple-touch-icon" href="<?php echo base_url('images/icon_120.png'); ?>">
		
		<link rel=canonical href="<?php echo base_url().uri_string(); ?>">
		
		<meta name=format-detection content="telephone=no,address=no,email=no">

		<!-- 苹果设备优化 -->
		<meta name=apple-mobile-web-app-capable content="yes">
		<meta name=apple-mobile-web-app-status-bar-style content="black-translucent">
	</head>
<?php
	//将head内容立即输出，让用户浏览器立即开始请求head中各项资源，提高页面加载速度
	ob_flush();flush();
?>
<!-- 内容开始 -->
<body class="groupbuy <?php echo $class; ?>">
	<header id=header>
		<div id=brand class=container>
			<h1><a id=logo title="半岛店 - 精彩近在身边" href="<?php echo base_url(); ?>">半岛店 - 精彩近在身边</a></h1>
			<form id=search-header class=inline action="<?php echo base_url(); ?>" method=get>
				<ul id=search-type>
					<li>团购</li>
				</ul>
				<fieldset>
					<input name=keyword type=search placeholder="可搜索商户名、类别、位置等" autocomplete required>
				</fieldset>
				<button>搜索</button>
			</form>
		</div>
	</header>
	
	<div id=maincontainer class=container>