<?php
	//解析信息
	$postObj = simplexml_load_string($this->postStr, 'SimpleXMLElement', LIBXML_NOCDATA);//解析收到的用户消息XML对象为PHP对象
	$fromUsername = $postObj->FromUserName;
	$toUsername = $postObj->ToUserName;
	$time = time();
	$type = $postObj->MsgType;//接收到的消息类型

	//分流信息
	//接收文本消息，例如关键词回复等
	if($type == 'text'):
		$message = trim($postObj->Content);
		
		//默认回复类型及回复语
		$msgtype = 'text';
		$content = '呃哦，攻城狮没有教过我这该怎么回答唉[衰]……不如咱换个话题[偷笑]？';
		
		$toHome = array('首页' , '官网' , '微官网' , '微网站' , '1');
		$toMember = array('会员' , '积分' , '签到');
		$toBranch = array('门店' , '地址' , '电话' , '路线' , '营业时间' , '预订' , '订位');
		if(in_array($message , $toHome)):
			$content = '<a title="一圣品海鲜舫微官网" href="http://www.qddian.com/yishengpin/">请点击进入一圣品海鲜舫微官网</a>';
		
		elseif(in_array($message , $toMember)):
			$content = '<a title="一圣品海鲜舫会员中心" href="http://www.qddian.com/yishengpin/member/">请点击进入一圣品海鲜舫会员中心</a>';
		
		elseif(in_array($message , $toBranch)):
			$content = '<a title="一圣品海鲜舫门店信息" href="http://www.qddian.com/yishengpin/branch/">请点击查看一圣品海鲜舫门店信息</a>';

		//如果接受到的信息长度为1且为数字
		elseif( strlen($message) == 1 && is_numeric($message) ):
			//根据用户回复的关键字发送相应内容
			switch ($message)
			{
				case 2:
					$content = '优惠券正在设计中，敬请期待！';
					break;
				case 3:
					$content = '点击进入<a title="一圣品微官网" href="http://www.qddian.com/yishengpin">一圣品微官网</a>~';
					break;
				case 4:
					$content = '点击进入<a title="一圣品官方微博" href="http://weibo.cn/yishengpin">一圣品官方微博</a>~';
					break;
				case 5:
					$content = "延安三路店 http://j.map.baidu.com/rk5_6 \n";
					$content.= '仙霞岭路店 http://j.map.baidu.com/eFD_6';
					break;
				case 6:
					$content = "延安三路店 http://m.dianping.com/shop/6293941/review \n";
					$content.= '仙霞岭路店 http://m.dianping.com/shop/4549530/review';
					break;
				default:
					$content = '呃哦，程序猿没有教过我这该怎么回答唉[衰]……不如咱换个话题[偷笑]？';
			}
		endif;
	endif;
	
	//用户订阅或退订
	if($type == 'event'):
		$event = $postObj->Event;
		//用户订阅
		if($event == 'subscribe'):
			$msgtype = MESSAGE_SUBSCRIBE_TYPE;
			$content = MESSAGE_SUBSCRIBE;

		//用户退订，无法向用户发送任何信息，只可做内部操作
		elseif($event == 'unsubscribe'):
			exit;
		endif;
	endif;

	//地理位置
	if($type == 'location'):
		//解析地理位置
		$weidu = $postObj->Location_X;
		$jingdu = $postObj->Location_Y;
		
		//发送文本消息
		$msgtype = 'text';
		
		$content = '您现在的地理位置是' . $weidu . '（纬度）' . $jingdu . '（经度）,';
		//$routeurl = 'http://api.map.baidu.com/direction?origin='.$weidu.','.$jingdu.'&amp;destination=一圣品海鲜舫延安三路店&amp;mode=driving&amp;region=青岛&amp;output=html&amp;src=yourCompanyName|yourAppName&amp;coord_type=gcj02';//微信获取到的坐标是高德地图的gcj02纠偏坐标
		
		$content .= '<a href="http://www.qddian.com/yishengpin/branch/">查看本地门店</a>';
	endif;