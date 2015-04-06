<div id=content class=container>
<?php
	if(isset($error)){echo $error;}//若有错误提示信息则显示
	echo form_open(base_url('user/login'));
?>
		<fieldset>
			<input name=mobile type=tel value="<?php echo $this->input->post('mobile') ? set_value('mobile') : $this->input->cookie($this->config->item('cookie_prefix').'user_mobile'); ?>" size=11 pattern="\d{11}" placeholder="手机号" required>
			<?php echo form_error('mobile'); ?>
			<input name=password type=password <?php if($this->input->cookie($this->config->item('cookie_prefix').'user_mobile')){echo 'autofocus ';} ?>size=6 pattern="\d{6}" placeholder="密码（6位数字）" required>
			<?php echo form_error('password'); ?>
		</fieldset>
		<button>登录</button>
		<p>您还不是会员？点击此处<a title="会员注册" href="<?php echo base_url('register'); ?>">免费加入</a>！</p>
	</form>
	<?php //echo $this->input->server('HTTP_REFERER'); ?>
</div>