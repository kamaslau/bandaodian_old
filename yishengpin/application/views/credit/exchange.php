<div id=content class=container>
	<p>您将使用积分换购<strong>“<?php echo $product_info['name'].$product_info['detail']; ?>”</strong>，每份需要<strong><?php echo $product_info['price_credit']; ?></strong>积分。请确定您目前正在店内就餐，输入您的会员卡密码，并由收银员为您确认：</p>
	<?php
		if(isset($error)){echo $error;}//若有错误提示信息则显示
		echo form_open(base_url('credit/exchange/'.$product_info['product_id']));
	?>
		<fieldset>
			<input name=quantity type=number value="<?php echo set_value('quantity', '1'); ?>" min=1 step=1 pattern="^[0-9]*[1-9][0-9]*$" placeholder="数量" required>
			<?php echo form_error('quantity'); ?>
			<input name=password type=password value="<?php echo set_value('password'); ?>" size=6 pattern="\d{6}" placeholder="登录密码（6位数字）" required>
			<?php echo form_error('password'); ?>
			<input name=seat_id type=text value="<?php echo set_value('seat_id'); ?>" placeholder="桌号" required>
			<?php echo form_error('seat_id'); ?>
		</fieldset>
		<fieldset>
			<input name=manager_id type=number step=1 value="<?php echo set_value('manager_id'); ?>" placeholder="管理员ID" required>
			<?php echo form_error('manager_id'); ?>
			<input name=manager_password type=password value="<?php echo set_value('manager_password'); ?>" size=6 pattern="\d{6}" placeholder="管理员密码" required>
			<?php echo form_error('manager_password'); ?>
		</fieldset>
		<button>确定</button>
	</form>
</div>