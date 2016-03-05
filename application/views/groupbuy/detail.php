<div id=content>
	<h1>[<?php echo $content['title'] ?>]<?php echo $content['description'] ?></h1>
	<figure>
		<img alt="<?php echo $content['description'] ?>" src="<?php echo $content['image_url'] ?>">
	</figure>
	<span>￥<?php echo $content['current_price'] ?></span>
	<span><?php echo round($content['current_price']/$content['list_price'],2)*10 ?>折</span>
	<span>原价 ￥<?php echo $content['list_price'] ?></span>
	<span>已售<strong><?php echo $content['purchase_count'] ?></strong>份</span>
	<a title="<?php echo $content['description'] ?>" href="<?php echo $content['deal_url'] ?>" target=_blank>立即抢购</a>
	<pre><?php echo $content['details'] ?></pre>
</div>
<?php var_dump($content) ?>