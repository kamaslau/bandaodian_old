<div id=content class=container>
<?php
	if(isset($error)){echo $error;}
	echo form_open_multipart(base_url('product/create'));
?>
		<fieldset>
			<label for=name>名称</label>
			<input name=name type=text value="<?php echo set_value('name'); ?>" placeholder="名称" required>
			<?php echo form_error('name'); ?>
			<label for=detail>详情</label>
			<input name=detail type=text value="<?php echo set_value('detail'); ?>" placeholder="详情" required>
			<?php echo form_error('detail'); ?>
			<label for=userfile>产品图片</label>
			<input name=userfile type=file value="<?php echo set_value('userfile'); ?>" placeholder="产品图片">
			<?php echo form_error('userfile'); ?>
		</fieldset>
		<fieldset>
			<label for=price_cash>现金价格</label>
			<input name=price_cash type=number step=0.01 value="<?php echo set_value('price_cash'); ?>" placeholder="现金价格">
			<?php echo form_error('price_cash'); ?>
			<label for=credit_rate>消费兑换积分的倍数</label>
			<input name=credit_rate type=number step=0.1 min=0 value=1 placeholder="消费兑换积分的倍数" required>
			<?php echo form_error('credit_rate'); ?>
			<label for=price_credit>积分价格</label>
			<input name=price_credit type=number step=0.01 value="<?php echo set_value('price_credit'); ?>" placeholder="积分价格">
			<?php echo form_error('price_credit'); ?>
			<label for=credit_group>可以用积分兑换此产品的会员类型</label>
			<select name=credit_group>
				<option value=1 <?php echo set_select('credit_group', '1', TRUE); ?>>所有会员</option>
				<option value=2 <?php echo set_select('credit_group', '2'); ?>>充值会员</option>
			</select>
		</fieldset>
		<button>保存</button>
	</form>
</div>