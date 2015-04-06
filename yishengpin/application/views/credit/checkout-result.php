<div id=content class=container>
	<p><?php echo $content; ?></p>
	<ul id=action>
		<li><a href="<?php echo base_url('checkout'); ?>">重试</a></li>
		<li><a href="<?php echo base_url('product/credit'); ?>">用积分换菜品</a></li>
		<li><a href="<?php echo base_url('member'); ?>">我的会员卡</a></li>
		<li><a href="<?php echo base_url('credit'); ?>">积分明细</a></li>
		<li><a title="门店信息" href="<?php echo base_url('branch'); ?>">适用门店</a></li>
	</ul>
</div>