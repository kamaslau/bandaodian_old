	<ul class=container>
		<li class=item id=branch1>
			<img class=cover src="<?php echo base_url('images/branch/1/cover.jpg'); ?>" alt="延安三路店门头">
			<ul class=album>
				<li><img src="<?php echo base_url('images/branch/1/1.jpg'); ?>" alt="延安三路店用餐环境"></li>
				<li><img src="<?php echo base_url('images/branch/1/2.jpg'); ?>" alt="延安三路店用餐环境"></li>
				<li><img src="<?php echo base_url('images/branch/1/3.jpg'); ?>" alt="延安三路店用餐环境"></li>
				<li><img src="<?php echo base_url('images/branch/1/4.jpg'); ?>" alt="延安三路店用餐环境"></li>
			</ul>
			<div class=info>
				<h2>延安三路店</h2>
				<ul class=contact>
					<li>0900-2300</li>
					<li>0532-83875066</li>
					<li><address>市南区延安三路212号<br>（孚德鞋厂院内）</address></li>
				</ul>
			</div>
			<ul class=action>
				<li><a class=gps href="http://j.map.baidu.com/dS-gp">地址导航</a></li>
				<li><a class=tel href="tel:+8653283875066">电话联系</a><li>
			</ul>
		</li>
		<li class=item id=branch2>
			<img class=cover src="<?php echo base_url('images/branch/2/cover.jpg'); ?>" alt="仙霞岭路店门头">
			<ul class=album>
				<li><img src="<?php echo base_url('images/branch/2/1.jpg'); ?>" alt="仙霞岭路店用餐环境"></li>
				<li><img src="<?php echo base_url('images/branch/2/2.jpg'); ?>" alt="仙霞岭路店用餐环境"></li>
				<li><img src="<?php echo base_url('images/branch/2/3.jpg'); ?>" alt="仙霞岭路店用餐环境"></li>
				<li><img src="<?php echo base_url('images/branch/2/4.jpg'); ?>" alt="仙霞岭路店用餐环境"></li>
			</ul>
			<div class=info>
				<h2>仙霞岭路店</h2>
				<ul class=contact>
					<li>0900-2300</li>
					<li>0532-88891919</li>
					<li><address>崂山区仙霞岭路16号金领世家<br>（崂山区政府西门对面）</address></li>
				</ul>
			</div>
			<ul class=action>
				<li><a class=gps href="http://j.map.baidu.com/eFD_6">地址导航</a></li>
				<li><a class=tel href="tel:+8653288891919">电话联系</a><li>
			</ul>
		</li>
	</ul>
	<script>
	$(function(){
		getLocation();
		//地理位置定位及导航链接创建
		function getLocation()
		{
			if (navigator.geolocation)
		    {
				navigator.geolocation.getCurrentPosition(showPosition,showError);
		    }
			else
			{
				alert('您的浏览器不支持地理位置定位');
			}
		}

		function showPosition(position)
		{
			var latitude = position.coords.latitude;//纬度
			var longitude = position.coords.longitude;//经度
			$.cookie('latitude',latitude);$.cookie('longitude',longitude);
			//alert('维度：'+latitude+'经度：'+longitude);
			$('#branch1 .action .gps').attr('href','http://api.map.baidu.com/direction?origin='+latitude+','+longitude+'&destination=一圣品海鲜舫延安三路店&mode=driving&region=青岛&output=html&src=yourCompanyName|yourAppName&coord_type=wgs84');
			$('#branch2 .action .gps').attr('href','http://api.map.baidu.com/direction?origin='+latitude+','+longitude+'&destination=一圣品海鲜舫仙霞岭路店&mode=driving&region=青岛&output=html&src=yourCompanyName|yourAppName&coord_type=wgs84');
			//一般包含GPS芯片或者北斗芯片的手持设备获取的经纬度为wgs84坐标系统，百度默认bd09坐标系统
		}

		function showError(error)
		{
			switch(error.code)
			{
				case error.PERMISSION_DENIED:
					alert('为提供相应服务，请允许我们获取您的地理位置');
			  	break;
		  		case error.POSITION_UNAVAILABLE:
					alert('由于网络信号质量问题，我们暂时无法获取您的位置，请稍后重试');
				break;
		  		case error.TIMEOUT:
					alert('由于网络信号质量问题，操作超时，请稍后重试');
			  	break;
		  		case error.UNKNOWN_ERROR:
					alert('其它原因');
			  	break;
		  	}
		}
	});
	</script>