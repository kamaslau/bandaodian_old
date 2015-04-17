<?php
	class Region_model extends CI_Model
	{
		public $table_name = 'groupbuy_region';
		
		//初始化模型
		public function __construct()
		{
			$this->load->database();
		}
		
		// 获取所有地区，或根据id获取特定地区
		public function select($id = NULL)
		{
			if ($id === 'main'):
				$this->db->select('DISTINCT(district)');
			elseif ($id != NULL):
				$this->db->where('region_id', $id); 
			endif;
			
			$query = $this->db->get($this->table_name);
			return $query->result_array();
		}
	}