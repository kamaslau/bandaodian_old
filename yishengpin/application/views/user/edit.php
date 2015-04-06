<div id=content class=container>
	<p>您只能修改1次生日和性别信息，保存修改结果时请仔细检查。</p>
	<?php
		echo form_open(base_url('user/edit/'.$user['user_id']));
	?>
		<fieldset>
			<input name=mobile type=tel value="<?php echo $user['mobile']; ?>" size=11 pattern="\d{11}" placeholder="手机号" required>
			<?php echo form_error('mobile'); ?>
		</fieldset>
		<fieldset>
			<input name=lastname type=text value="<?php echo $user['lastname']; ?>" placeholder="姓" required>
			<?php echo form_error('lastname'); ?>
			<input name=firstname type=text value="<?php echo $user['firstname']; ?>" placeholder="名">
			<?php echo form_error('firstname'); ?>
			<select name=gender>
				<option value="-" <?php echo set_select('gender', '-'); ?>>性别</option>
				<option value=0 <?php echo set_select('gender', 0); ?>>女士</option>
				<option value=1 <?php echo set_select('gender', 1); ?>>先生</option>
			</select>
			<?php echo form_error('gender'); ?>
			<label for=dob>生日（YYYY-MM-DD）</label>
			<input name=dob type=date value="<?php echo $user['dob']; ?>" placeholder="生日" required>
			<?php echo form_error('dob'); ?>
		</fieldset>
		<button>保存</button>
	</form>
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