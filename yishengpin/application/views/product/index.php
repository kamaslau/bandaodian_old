<!--
	<nav id=naver class=container>
		<ul>
			<li><a href="" title="">凉菜</a></li>
			<li><a href="" title="">热菜</a></li>
			<li><a href="" title="">面食</a></li>
		</ul>
	</nav>
-->
<div id=content class=container>
<?php
	if($show_recommend == TRUE):
?>
	<ul id=recommend>
		<li class=item id=product_133>
			<h2>清蒸本地扇贝</h2>
			<p>本地红皮扇贝</p>
			<img src="http://images.key2all.com/product/133.jpg" alt="清蒸本地扇贝">
		</li>
		<li class=item id=product_110>
			<h2>红岛小蛤蜊</h2>
			<p>红岛薄皮小蛤蜊</p>
			<a href="<?php echo base_url('exchange/110/20000'); ?>"><span>充值会员</span>20000.00积分</a>
			<img src="http://images.key2all.com/product/110.jpg" alt="红岛小蛤蜊">
		</li>
		<li class=item id=product_121>
			<h2>有机茼蒿炖刀鱼</h2>
			<p>本地鲜刀鱼、有机茼蒿</p>
			<img src="http://images.key2all.com/product/121.jpg" alt="有机茼蒿炖刀鱼">
		</li>
		<li class=item id=product_134>
			<h2>清炸黄河刀鱼</h2>
			<p>黄河口春刀鱼</p>
			<img src="http://images.key2all.com/product/134.jpg" alt="清炸黄河刀鱼">
		</li>
		<li class=item id=product_130>
			<h2>野生鲜鱼面</h2>
			<p>鸡蛋手擀面、野生鲜鱼</p>
			<img src="http://images.key2all.com/product/130.jpg" alt="野生鲜鱼面">
		</li>
		<li class=item id=product_128>
			<h2>家宴油条配青岛老甜沫</h2>
			<p>菠菜叶、红小豆、黄油、牛奶、特制面粉、有机小米面</p>
			<img src="http://images.key2all.com/product/128.jpg" alt="家宴油条配青岛老甜沫">
		</li>
		<li class=item id=product_132>
			<h2>清蒸野生小海蛎</h2>
			<p>本地野生小海蛎</p>
			<img src="http://images.key2all.com/product/132.jpg" alt="清蒸野生小海蛎">
		</li>
		<li class=item id=product_57>
			<h2>崂山菇炖鸡</h2>
			<p>宽粉、崂山菇、小公鸡</p>
			<img src="http://images.key2all.com/product/57.jpg" alt="崂山菇炖鸡">
		</li>
		<li class=item id=product_119>
			<h2>深海杂鱼汤</h2>
			<p>本地鲜活小杂鱼</p>
			<img src="http://images.key2all.com/product/119.jpg" alt="深海杂鱼汤">
		</li>
		<li class=item id=product_120>
			<h2>蒜泥蛤蜊肉</h2>
			<p>红岛薄皮蛤蜊</p>
			<img src="http://images.key2all.com/product/120.jpg" alt="蒜泥蛤蜊肉">
		</li>
		<li class=item id=product_122>
			<h2>微波金钩海米</h2>
			<p>崂山金钩海米</p>
			<img src="http://images.key2all.com/product/122.jpg" alt="微波金钩海米">
		</li>
		<li class=item id=product_117>
			<h2>农家老豆腐</h2>
			<p>崂山海水老豆腐、高汤</p>
			<a href="<?php echo base_url('exchange/117/10000'); ?>"><span>充值会员</span>10000.00积分</a>
			<img src="http://images.key2all.com/product/117.jpg" alt="农家老豆腐">
		</li>
			<li class=item id=product_118>
			<h2>青岛凉粉</h2>
			<p>青岛石花菜凉粉</p>
			<img src="http://images.key2all.com/product/118.jpg" alt="青岛凉粉">
		</li>
		<li class=item id=product_127>
			<h2>腌汁海瓜子</h2>
			<p>海瓜子</p>
			<img src="http://images.key2all.com/product/127.jpg" alt="腌汁海瓜子">
		</li>
		<li class=item id=product_108>
			<h2>海鲜舫熬鱼</h2>
			<p>本地杂鱼、多种小海鲜</p>
			<img src="http://images.key2all.com/product/108.jpg" alt="海鲜舫熬鱼">
		</li>
		<li class=item id=product_109>
			<h2>韭菜合饼</h2>
			<p>面粉、韭菜、虾皮</p>
			<img src="http://images.key2all.com/product/109.jpg" alt="韭菜合饼">
		</li>
		<li class=item id=product_112>
			<h2>黄花鱼丸汤</h2>
			<p>本地野生黄花鱼</p>
			<img src="http://images.key2all.com/product/112.jpg" alt="黄花鱼丸汤">
		</li>
		<li class=item id=product_114>
			<h2>金钩海米拌黄瓜</h2>
			<p>崂山金钩海米、崂山有机黄瓜</p>
			<img src="http://images.key2all.com/product/114.jpg" alt="金钩海米拌黄瓜">
		</li>
		<li class=item id=product_111>
			<h2>黄瓜拌大海螺</h2>
			<p>红岛大海螺、崂山有机黄瓜</p>
			<img src="http://images.key2all.com/product/111.jpg" alt="黄瓜拌大海螺">
		</li>
		<li class=item id=product_103>
			<h2>葱姜炒蛎虾</h2>
			<p>葱姜、沙子口活蛎虾</p>
			<img src="http://images.key2all.com/product/103.jpg" alt="葱姜炒蛎虾">
		</li>
		<li class=item id=product_100>
			<h2>煎蒸小黄花</h2>
			<p>小黄花鱼</p>
			<img src="http://images.key2all.com/product/100.jpg" alt="煎蒸小黄花">
		</li>
		<li class=item id=product_101>
			<h2>白菜烩比管鱼</h2>
			<p>胶州大白菜、沙子口鲜比管鱼</p>
			<img src="http://images.key2all.com/product/101.jpg" alt="白菜烩比管鱼">
		</li>
		<li class=item id=product_95>
			<h2>劈柴肉冻</h2>
			<p>猪头肉</p>
			<img src="http://images.key2all.com/product/95.jpg" alt="劈柴肉冻">
		</li>
		<li class=item id=product_92>
			<h2>海米拌马家沟芹菜</h2>
			<p>海米、马家沟芹菜</p>
			<img src="http://images.key2all.com/product/92.jpg" alt="海米拌马家沟芹菜">
		</li>
		<li class=item id=product_89>
			<h2>松花蛋拌苦肠</h2>
			<p>黄瓜、苦肠、松花蛋</p>
			<img src="http://images.key2all.com/product/89.jpg" alt="松花蛋拌苦肠">
		</li>
		<li class=item id=product_7>
		    <h2>老滋味锅贴</h2>
		    <p>虾仁肉、大葱肉、素三鲜</p>
			<a href="<?php echo base_url('exchange/7/20000'); ?>"><span>充值会员</span>20000.00积分</a>
			<img src="http://images.key2all.com/product/7.jpg" alt="老滋味锅贴">
		</li>
		<li class=item id=product_6>
			<h2>葱油饼</h2>
			<p>葱花油、面粉</p>
			<img src="http://images.key2all.com/product/6.jpg" alt="葱油饼">
		</li>
		<li class=item id=product_3>
			<h2>地瓜面包子</h2>
			<p>地瓜面、刀切肉、萝卜缨</p>
			<img src="http://images.key2all.com/product/3.jpg" alt="地瓜面包子">
		</li>
		<li class=item id=product_5>
			<h2>农家乐</h2>
			<p>板栗、本地芋头、花生、小土豆、玉米</p>
			<img src="http://images.key2all.com/product/5.jpg" alt="农家乐">
		</li>
		<li class=item id=product_123>
			<h2>香煎舌头鱼</h2>
			<p>本地舌头鱼</p>
			<img src="http://images.key2all.com/product/123.jpg" alt="香煎舌头鱼">
		</li>
	</ul>
<?php endif; ?>
	<ul id=all>
	<?php foreach ($products as $product_item): ?>
		<li class=item id=product_<?php echo $product_item['product_id'] ?>>
		    <h2><?php echo $product_item['name'] ?></h2>
		    <p><?php echo $product_item['detail'] ?></p>
			<?php if(isset($product_item['price_credit'])){ ?>
			<a href="<?php echo base_url('exchange/').'/'.$product_item['product_id'].'/'.$product_item['price_credit']; ?>"><?php echo $product_item['credit_group'] == '2' ? '<span>充值会员</span>' : '<span>会员</span>'; ?><?php echo $product_item['price_credit']; ?>积分</a>
			<?php } ?>
			<img src="http://images.key2all.com/product/<?php echo $product_item['image']; ?>" alt="<?php echo $product_item['name'] ?>">
		</li>
	<?php endforeach ?>
	</ul>
</div>