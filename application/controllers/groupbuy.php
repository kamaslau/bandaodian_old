<?php
	if(!defined('BASEPATH')) exit('此文件不可被直接访问');

	// 搜索团购
	// http://developer.dianping.com/app/api/v1/deal/find_deals
	class Groupbuy extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();

			define('URL', 'http://api.dianping.com/v1/deal/find_deals');
		}

		// 查找团购首页
		public function index()
		{
		    //请求参数
			$params = array(
				'city' => '青岛', //固定城市为青岛
				'is_local' => '1' //只查看本地单
			);
			$sort = $this->input->get('sort', TRUE);
			$page = $this->input->get('page', TRUE);

			$params['sort'] = !empty($sort)? $sort: 1;
			$params['page'] = !empty($page)? $page: 1;

			//循环检查保存入cookie的筛选器
			$options = array('category', 'region', 'keyword', 'latitude', 'longitude');
			for($i=0; $i<count($options); $i++)
			{
				$option = $options[$i];//提取单一筛选器并检查是否已通过cookie定义，若有则纳入待搜索参数
				if(!empty($_COOKIE[$option]))
				{
					$params[$option] = $_COOKIE[$option];
				}
				/*
				if(!empty($this->input->cookie($option)))
				{
					$params[$option] = $this->input->cookie($option);
				}
				*/
			}

			//根据传入的各参数获取远程API数据（大众点评developer.dianping.com）

		    //按照参数名排序
		    ksort($params);
    
		    //连接待加密的字符串
		    $codes = APPKEY;
    
		    //组装GET请求的URL参数
		    $queryString = '';

		    while (list($key, $val) = each($params))
		    {
		        $codes .= ($key . $val);
		        $queryString .= ('&' . $key . '=' . urlencode($val));
		    }
    
		    $codes .= SECRET;
    
		    $sign = strtoupper(sha1($codes));
    
		    $url = URL . '?appkey=' . APPKEY . '&sign=' . $sign . $queryString;
    
		    $curl = curl_init();
    
		    // 设置你要访问的URL
		    curl_setopt($curl, CURLOPT_URL, $url);

		    // 设置cURL 参数，要求结果保存到字符串中还是输出到屏幕上。
		    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		    curl_setopt($curl, CURLOPT_ENCODING, 'UTF-8');
    
		    // 运行cURL，请求API
		    $data = json_decode(curl_exec($curl), true);

		    // 关闭URL请求
		    curl_close($curl);

			if($this->input->is_ajax_request()):
				// 直接返回数据
				echo json_encode($data);
				
			else:
				// 保存数据
				$this->save($data);
				echo '获取团购成功';
			endif;
		}
		
		// 将获取到的数据转存到数据库中
		public function save($data)
		{
			$raw_data = json_encode($data);
			$obj = json_decode($raw_data);
			
			// 清空表中数据
			$this->db->truncate('groupbuy');

			// 写入地区数据
			$deals = $obj->deals;
			for($i = 0; $i < count($deals); $i++)
			{
				$data = array(
	               'deal_id' => $deals[$i]->deal_id,
	               'title' => $deals[$i]->title,
	               'description' => $deals[$i]->description,
				   'list_price' => $deals[$i]->list_price,
				   'current_price' => $deals[$i]->current_price,
				   //'regions' => $deals[$i]->regions,
				   //'categories' => $deals[$i]->categories,
				   'purchase_count' => $deals[$i]->purchase_count,
				   'purchase_deadline' => $deals[$i]->purchase_deadline,
				   'publish_date' => $deals[$i]->publish_date,
				   'image_url' => $deals[$i]->image_url,
				   's_image_url' => $deals[$i]->s_image_url,
				   'deal_url' => $deals[$i]->deal_url,
				   'deal_h5_url' => $deals[$i]->deal_h5_url,
				   'commission_ratio' => $deals[$i]->commission_ratio
				);
				$this->db->insert('groupbuy', $data);
			}
		}
	}
	
/* End of file groupbuy.php */
/* Location: ./application/controllers/groupbuy.php */