<?php
	class Category_model extends CI_Model
	{
		public $table_name = 'groupbuy_category';
		
		//初始化模型
		public function __construct()
		{
			$this->load->database();
		}
		
		//获取所有分类，或根据id获取特定分类
		public function select($class = FALSE)
		{
			if($class == 'main'):
				$this->db->distinct('name');
			endif;
			$query = $this->db->get($this->table_name);
			return $query->result_array();
		}
	}