<?php
	if(!defined('BASEPATH')) exit('此文件不可被直接访问');
	
	// 获取支持团购搜索的最新分类列表
	// http://developer.dianping.com/app/api/v1/metadata/get_categories_with_deals
	class Category extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();

			define('URL', 'http://api.dianping.com/v1/metadata/get_categories_with_deals');
		}
		
		// 首页
		public function index()
		{
		    //请求参数
			$params = array();
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
			
			// 将获取到的数据转存到数据库中
			$raw_data = json_encode($data);
			$obj = json_decode($raw_data);
			
			// 清空表中数据
			$this->db->truncate('groupbuy_category');

			// 写入分类和子分类数据
			$categories = $obj->categories;
			for($i = 0; $i < count($categories); $i++)
			{
				for($j = 0; $j < count($categories[$i]->subcategories); $j++)
				{
					$data = array(
		               'name' => $categories[$i]->category_name,
		               'sub_name' => $categories[$i]->subcategories[$j]
					);
					$this->db->insert('groupbuy_category', $data);
				}
			}
			
			echo '获取分类成功';
		}
	}
	
/* End of file category.php */
/* Location: ./application/controllers/category.php */