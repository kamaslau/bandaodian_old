<?php
	class Category_model extends CI_Model
	{
		public $table_name = 'groupbuy_category';
		
		//初始化模型
		public function __construct()
		{
			$this->load->database();
		}
		
		// 获取所有分类，或根据id获取特定分类
		public function select($id = NULL)
		{
			if($id === 'main'):
				$this->db->select('DISTINCT(name)');
			elseif ($id != NULL):
				$this->db->where('category_id', $id); 
			endif;
			$query = $this->db->get($this->table_name);
			return $query->result_array();
		}
	}