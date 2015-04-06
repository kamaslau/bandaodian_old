<div id=content class=container>
	<?php echo form_open(base_url('user/register')); ?>
		<fieldset>
			<input name=mobile type=tel value="<?php echo set_value('mobile'); ?>" size=11 pattern="\d{11}" placeholder="手机号" required>
			<?php echo form_error('mobile'); ?>
			<input name=password type=number value="<?php echo set_value('password'); ?>" size=6 pattern="\d{6}" placeholder="密码（6位数字）" required>
			<?php echo form_error('password'); ?>
		</fieldset>
		<fieldset>
			<input name=lastname type=text value="<?php echo set_value('lastname'); ?>" placeholder="姓氏" required>
			<?php echo form_error('lastname'); ?>
			<select name=gender>
				<option value="-" <?php echo set_select('gender', '-'); ?>>性别</option>
				<option value=0 <?php echo set_select('gender', 0); ?>>女士</option>
				<option value=1 <?php echo set_select('gender', 1); ?>>先生</option>
			</select>
			<?php echo form_error('gender'); ?>
			<input name=dob type=date value="<?php echo set_value('dob'); ?>" placeholder="生日(例如：1989-07-28)" required>
			<?php echo form_error('dob'); ?>
		</fieldset>
		<button>加入</button>
	</form>
	<p>您已经是会员？请点击此处<a title="会员登录" href="<?php echo base_url('login'); ?>">快速登录</a>！</p>
</div>
<script>
	$(function(){
		$('form').submit(function(){
			var gender = $('select[name=gender]').val();
			if(gender == '-')
			{
				alert('请选择性别以享受相应优惠~');
				return false;
			}
		});
	});
</script>