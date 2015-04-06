<?php
	function user_group($user_group)
	{
		if($user_group == 1){return '会员';}
		if($user_group == 2){return '充值会员';}
	}
?>
<div id=content class=container>
	<div id=user_info>
		<img src="<?php echo base_url('images/cover.jpg'); ?>" alt="我的会员卡">
		<strong><?php echo user_group($user_info['group']); ?> No.<?php echo $user_info['user_id']; ?></strong>
		<ul id=account>
			<li>消费总额 <?php echo $user_info['summary']; ?> 元</li>
			<li>积分余额 <?php echo $user_info['credit']; ?> 个</li>
		</ul>
	</div>
	<ul id=action>
		<?php 
			//若为新注册用户，则可领取新用户注册积分
			if(isset($new))
			{
		?>
		<li><a href="<?php echo base_url('rookie'); ?>">新会员礼包</a></li>
		<?php
			}
			if(!isset($signed))
			{
		?>
		<li><a href="<?php echo base_url('signin'); ?>">签到得积分</a></li>
		<?php }else{ ?>
		<li>今日已签到</li>
		<?php } ?>
		<li><a href="<?php echo base_url('checkout'); ?>">消费换积分</a></li>
		<li><a href="<?php echo base_url('product/credit'); ?>">积分换菜品</a></li>
		<li><a href="<?php echo base_url('credit'); ?>">积分明细</a></li>
		<li><a title="门店信息" href="<?php echo base_url('branch'); ?>">适用门店</a></li>
		<li><a title="修改资料" href="<?php echo base_url('user/edit/'.$user_info['user_id']); ?>">修改资料</a></li>
		<li><a title="修改密码" href="<?php echo base_url('user/password_change/'.$user_info['user_id']); ?>">修改密码</a></li>
		<li><a class=logout title="退出账号" href="<?php echo base_url('logout'); ?>">退出账号</a></li>
	</ul>
</div>