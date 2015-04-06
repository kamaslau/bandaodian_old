<div id=content class=container>
	<?php
		if(isset($error)){echo $error;}//若有错误提示信息则显示
		echo form_open( base_url('user/password_change/' . $this->session->userdata('user_id')) );
	?>
		<fieldset>
			<input name=password type=password value="<?php echo set_value('password'); ?>" size=6 pattern="\d{6}" placeholder="目前密码" required>
			<?php echo form_error('password'); ?>
			<input name=new_password type=number value="<?php echo set_value('new_password'); ?>" size=6 pattern="\d{6}" placeholder="新密码" required>
			<?php echo form_error('new_password'); ?>
		</fieldset>
		<button>确定</button>
	</form>
</div>