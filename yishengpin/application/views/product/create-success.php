<div id=content class=container>
	<ul id=created>
		<li>品名 <?php echo $product['name']; ?></li>
		<li>成分 <?php echo $product['detail']; ?></li>
		<li><img alt="<?php echo $product['name']; ?>" src="<?php echo base_url($product['image']); ?>"></li>
	</ul>
	<a title="增加产品" href="<?php echo base_url('create'); ?>">再新建一个产品</a>
	<a title="查看全部产品" href="<?php echo base_url('product'); ?>">查看全部产品</a>
</div>