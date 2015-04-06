<?php
	function action($action)
	{
		if($action == 1){return '+';}
		if($action == 2){return '换购 -';}
	}
	
	function type($type)
	{
		if($type == 1){return '注册';}
		if($type == 2){return '签到';}
		if($type == 3){return '消费';}
		if($type == 4){return '退回';}
	}
?>
<div id=content class=container>
	<table summary="积分明细" class=sortable>
		<caption class=hide>积分明细</caption>
		<thead>
			<tr><th>类型</th><th>数额</th><th>时间</th></tr>
		</thead>
		<tbody>
<?php
	foreach ($credits as $credit):
		echo '<tr><td>'.type($credit['type']).action($credit['action']).'</td><td>'.$credit['amount'].'</td><td>'.$credit['time'].'</td></tr>'."\r";
	endforeach;
?>
		</tbody>
	</table>
</div>