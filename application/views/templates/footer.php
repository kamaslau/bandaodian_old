		</div>
		<footer id=footer>
			<div class=container>
				<p id=copyright>&copy;<?php echo date('Y'); ?> <a title="半岛店 - 精彩近在身边" href="<?php echo base_url(); ?>">半岛店</a> <a title="工业和信息化部网站备案系统" href="http://www.miitbeian.gov.cn/" target=_blank rel=nofollow>鲁ICP备14013078号-2</a> <a href="http://pinggu.zx110.org/review_url_bandaodian.com" target=_blank rel=nofollow><img alt="半岛店网站可信度评估"  src="http://pinggu.zx110.org/images/bs-big.jpg"></a></p>
				<ul id=contact>
					<li>微博 <a title="关注半岛店的新浪微博" href="http://weibo.com/qingdaodian" target=_blank rel=nofollow>@半岛店_精彩近在身边</a></li>
					<li>邮箱 <a title="通过Email联系半岛店" href="mailto:lianxi@qingdaodian.com" target=_blank rel=nofollow>lianxi@qingdaodian.com</a></li>
					<li>QQ <a title="通过QQ联系半岛店" href="http://wpa.qq.com/msgrd?v=3&amp;uin=1807504734&amp;site=半岛店&amp;menu=yes" target=_blank rel=nofollow>1807504734</a></li>
					<li>电话 <a title="通过电话联系半岛店" href="tel:13668865673" target=_blank rel=nofollow>136-6886-5673</a></li>
				</ul>
				<?php //echo '<p>您正在使用'. get_browser(). '浏览器，'. get_os(). '操作系统</p>' ?>
				<?php //echo '<p>来自'.$this->input->server('HTTP_REFERER').'</p>' ?>
				<p id=geoInfo></p>
			</div>
		</footer>
		<a id=totop title="回到半岛店页首" href="#header">回到半岛店页首</a>
	<script>
		//百度统计代码
		var _bdhmProtocol = (('https:' == document.location.protocol) ? 'https://' : 'http://');
		document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3Fac364f672d0cfc82c89d0b6103ee892e'%3E%3C/script%3E"));
	
		//隐藏微信底部导航栏
		document.addEventListener('WeixinJSBridgeReady', function onBridgeReady(){
			WeixinJSBridge.call('hideToolbar');
		});

		$(function(){
			// 回到页首按钮
			$(window).scroll(function()
			{
				if ($(this).scrollTop() > 100)
				{
					$('#totop').fadeIn();
				}
				else
				{
					$('#totop').fadeOut();
				}
			});
			$('#totop').click(function()
			{
				$('body,html').stop(false, false).animate({scrollTop:0}, 800);
				return false;
			});
		});
	</script>
	</body>
</html>