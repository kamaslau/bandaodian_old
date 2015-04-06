<div id=content class=container>
	<p>您的消费可兑换为一定数额的积分，请由收银员为您填写下列信息：</p>
	<?php
		if(isset($error)){echo $error;}//若有错误提示信息则显示
		echo form_open(base_url('credit/checkout'));
	?>
		<fieldset>
			<input name=amount type=number step=0.01 value="<?php echo set_value('amount'); ?>" placeholder="折后消费额" required>
			<?php echo form_error('amount'); ?>
			<!--
			<input name=serial_id type=text value="<?php echo set_value('serial_id'); ?>" placeholder="收银流水号" required>
			<?php //echo form_error('serial_id'); ?>
			-->
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
<script>
	$(function(){
		$('button').click(function(){
			$(this).text('确认中...').hide();
		});
	});
</script>