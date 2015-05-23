// 文件名   groupbuy.js
// 文件用途 半岛店团购js代码
// 作者    刘亚杰
// 作者微博 http://weibo.com/liuyajie728
// 版权    个人所有,未经授权禁止使用

$(function(){
	//初始化页面
	getGroupbuy();
	
	//获取用户地理位置
	function getLocation()
	{
		if (navigator.geolocation)
	    {
			navigator.geolocation.getCurrentPosition(showPosition,showError);
	    }
		else
		{
			$('#geoInfo').html('此浏览器不支持地理位置');
		}
	}
	
	function showPosition(position)
	{
		var latitude = position.coords.latitude;//纬度
		var longitude = position.coords.longitude;//经度
		$.cookie('latitude',latitude);$.cookie('longitude',longitude);
	}
	
	function showError(error)
	{
		switch(error.code)
		{
			case error.PERMISSION_DENIED:
				$('#geoInfo').html('用户拒绝提供地理位置');
		  	break;
	  		case error.POSITION_UNAVAILABLE:
				$('#geoInfo').html('无法获取当前位置');
			break;
	  		case error.TIMEOUT:
				$('#geoInfo').html('操作超时');
		  	break;
	  		case error.UNKNOWN_ERROR:
				$('#geoInfo').html('其它原因');
		  	break;
	  	}
	}
	
	// 若cookie中有位置筛选器,显示位置筛选器
	if($.cookie('region') != '')
	{
		$('#groupbuyfilter :contains(' + $.cookie('region') + ')').addClass('active');
	}
	else
	{
		$('#groupbuyfilter .region li:first-child a,#groupbuyfilter .district li:first-child a').addClass('active');
	}
	// 待完成:若cookie中排序筛选器不是默认的1,显示排序筛选器
	$('#groupbuyfilter .category li:first-child a,#groupbuysorter ul li:first-child a').addClass('active');
  
	// 调取团购分类函数
	function getCategory(){
		$.getJSON('category.php', function(data){
			$.each(data.categories, function(i,category){
				$('#groupbuyfilter .category').append(
					'<li><a href=#>' + category.category_name + '</a></li>'
				);
			});
		});
	}
  
  // 调取团购位置
  function getRegion(){
	$.getJSON('region.php', function(data){
		$.each(data.cities[0].districts, function(i,district){
		   //$('#groupbuyfilter .district').append(//输出行政区
		   //		'<li><a href=#>'+district.district_name+'</a></li>'
		   //);
		   var region_group = district.neighborhoods;//获取当前行政区商圈
		   $.each(region_group, function(i, region){//输出商圈
				  $('#groupbuyfilter .region').append(
				  		'<li><a href=#>' + region + '</a></li>'
				  );
			});
		});
	});
  }
  
	// 分类过滤器
	$('#groupbuyfilter .category li a').click(function(){
		var category = $(this).text();
		 $('#groupbuyfilter .category li a.active').removeClass('active');
		 $(this).addClass('active');
		if(category != '全部'){
			$.cookie('category', category);
		 }
		 else
		 {
			$.cookie('category', '');
		 }
		 getGroupbuy();
		 return false;
	});
 
	// 位置和商圈过滤器 重要:位置过滤器和商圈过滤器均写入region cookie,后写入者覆盖先写入者.
	$('#groupbuyfilter .region li a, #groupbuyfilter .district li a').click(function(){
		var region = $(this).text();
		 $('#groupbuyfilter .region li a.active, #groupbuyfilter .district li a.active').removeClass('active');
		 $(this).addClass('active');
		if(region != '全部'){
			$.cookie('region', region);
		 }
		 else
		 {
			$.cookie('region', '');
		 }
		getGroupbuy();
		return false;
	});
  
	// 基本筛选器
	$('#groupbuysorter .basic li a').click(function(){
		var sort = $(this).attr('class');
			//清空地理位置
			$.cookie('latitude', '');
			$.cookie('longitude', '');
			
			switch(sort)
			{
				case 'location':sort=7;getLocation();break;//获取经纬度
				case 'amount':sort=4;break;
				case 'date_recent':sort=5;break;
				case 'price_low':sort=2;break;
				case 'price_high':sort=3;break;
				default:sort=1;
			}
			$('#groupbuysorter .basic li a.active').removeClass('active');
			$(this).addClass('active');
			getGroupbuy(sort);
			return false;
	});
	
	// 搜索团购
	$('#search-header').submit(function(){
		var keyword = $('#search-header input').val();
		$.cookie('keyword', keyword);
		getGroupbuy();
		return false;
	});
	  
	// 调用团购数据主函数
	function getGroupbuy(sort,page){
		//参数默认值
		sort = typeof(sort)=='undefined'?1:sort;
		page = typeof(page)=='undefined'?1:page;
		latitude = typeof($.cookie('latitude'))=='undefined'?'':latitude;
		longitude = typeof($.cookie('longitude'))=='undefined'?'':longitude;
		var params = {'sort':sort, 'page':page, 'latitude':latitude, 'longitude':longitude};

		// 若cookie中有搜索关键词,显示关键词
		if($.cookie('keyword') != '')
		{
			$('#keywordreview').slideDown();
			$('#keywordreview strong').text($.cookie('keyword'));
		}
		
		//函数主体
		$.getJSON('groupbuy', params, function(data){
			$('#loading').slideDown(500);//提示正在载入
			$('#content').html('');//清空团购列表内容  
			$.each(data.deals, function(i,deal){
				if(deal.regions != ''){//判断是否本地单
				   $('#content').append(
						'<li class=item>' +
						'	<div class=mainpic>'+
						'		<a title="' + deal.description + '" href="' + deal.deal_url + '" target=_blank><img alt="' + deal.title + '" src="' + deal.image_url + '"></a>'+
						'	</div>' +
						'	<h2><a title="' + deal.description + '" href="' + deal.deal_url+'" target=_blank>'+deal.title+'</a></h2>' +
						'	<div class=detail>' +
						'		<div class=price><span class=groupprice>¥' + deal.current_price + '</span><br><span class=tagprice>原价 ¥' + deal.list_price + '</span>, <span class=amount>' + deal.purchase_count + '人已购买</span></div>' + 
						'		<a class=go title="' + deal.title + '" href="'+deal.deal_url + '" target=_blank>去看看</a>' + 
						'	</div>' +
						'</li>'
					);
				}//结束判断非本地单
			});
			$('#loading').slideUp(800);//载入提示取消
		});
	}
});