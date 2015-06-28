<?php
	if(!defined('BASEPATH')) exit('此文件不可被直接访问');

	/**
	* Groupbuy Class
	*
	* @author Kamas 'Iceberg' Lau <kamaslau@outlook.com>
	* @copyright SenseStrong <www.sensestrong.com>
	*/
	class Groupbuy extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
		}

		// 团购详情
		public function detail($groupbuy_id = NULL)
		{
			$params['deal_id'] = $groupbuy_id;
			//根据传入的各参数获取远程API数据（大众点评developer.dianping.com）
		    //按照参数名排序
		    ksort($params);

		    //连接待加密的字符串
		    $codes = APPKEY;

		    //组装GET请求的URL参数
		    $queryString = '';
		    while (list($key, $val) = each($params))
			{
		        $codes .= ($key. $val);
		        $queryString .= ('&'. $key. '='. urlencode($val));
			}
    
		    $codes .= SECRET;
		    $sign = strtoupper(sha1($codes));
			$url = URL. 'deal/get_single_deal'. '?appkey='. APPKEY. '&sign='. $sign. $queryString; // 团购详情
		    $result = $this->curl->go($url, $params, 'array', 'get');
			
			$data['title'] = $result['deals'][0]['title']. $result['deals'][0]['description']. '团购详情';
			$data['class'] = 'groupbuy detail';
			$data['content'] = $result['deals'][0];
			
			$this->load->view('templates/header', $data);
			$this->load->view('groupbuy/detail', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/footer', $data);
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
			$latitude = $this->input->get('latitude', TRUE);
			$longitude = $this->input->get('longitude', TRUE);

			$params['sort'] = !empty($sort)? $sort: 1;
			$params['page'] = !empty($page)? $page: 1;
			!empty($latitude)? $params['latitude'] = $latitude: NULL;
			!empty($longitude)? $params['longitude'] = $longitude: NULL;

			//循环检查保存入cookie的筛选器
			$options = array('category', 'region', 'keyword');
			for ($i=0; $i<count($options); $i++)
			{
				$option = $options[$i];//提取单一筛选器并检查是否已通过cookie定义，若有则纳入待搜索参数
				if (!empty($_COOKIE[$option])):
					$params[$option] = $_COOKIE[$option];
				endif;
				/*
				if(!empty($this->input->cookie($option))):
					$params[$option] = $this->input->cookie($option);
				endif;
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
		        $codes .= ($key. $val);
		        $queryString .= ('&'. $key. '='. urlencode($val));
			}
    
		    $codes .= SECRET;
		    $sign = strtoupper(sha1($codes));
		    $url = URL. 'deal/find_deals'. '?appkey='. APPKEY. '&sign='. $sign. $queryString; // 团购详情
			$result = $this->curl->go($url, $params, 'array', 'get');

			echo json_encode($result);
			/*
			if($this->input->is_ajax_request()):
				// 直接返回数据
				echo json_encode($result);
				
			else:
				// 保存数据
				$this->save($result);
				echo '获取团购成功';
			endif;
			*/
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