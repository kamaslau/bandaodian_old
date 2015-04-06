		<footer id=footer class=container>
			<p>&copy;<?php echo date('Y'); ?>一圣品海鲜舫 - <a title="半岛店" href="tel:+8613668865673">半岛店</a></p>
		</footer>
		<script>
			//百度统计代码
			var _bdhmProtocol = (('https:' == document.location.protocol) ? 'https://' : 'http://');
			document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3Fac364f672d0cfc82c89d0b6103ee892e'%3E%3C/script%3E"));
			
			//隐藏微信底部导航栏
			document.addEventListener('WeixinJSBridgeReady', function onBridgeReady() {
				WeixinJSBridge.call('hideToolbar');
			});
			
			$(function(){
				//在android浏览器中隐藏地址栏
				if (navigator.userAgent.match(/Android/i)){
				    window.scrollTo(0,0); // reset in case prev not scrolled   
				    var nPageH = $(document).height(); 
				    var nViewH = window.outerHeight; 
				    if (nViewH > nPageH) { 
				      nViewH -= 250; 
				      $('body').css('height',nViewH + 'px'); 
				    } 
				    window.scrollTo(0,1); 
				}
				
				//首页翻片效果
				$('.home a.toggle').click(function(){
					$('.home a.toggle').show();
					$(this).hide();
					return false;
				});
				
				//菜单翻片效果
				$('.product li.item').click(function(){
					$('.product li.item img').animate({left:'0'},100);
					$(this).find('img').animate({left:'-320px'},100);
				});
				
				//表格可排序
				$('.sortable').tablesorter();
			});
		</script>
	</body>
<!-- 内容结束 -->
</html>