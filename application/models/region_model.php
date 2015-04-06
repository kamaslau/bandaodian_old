<?php
	class Region_model extends CI_Model
	{
		public $table_name = 'groupbuy_region';
		
		//初始化模型
		public function __construct()
		{
			$this->load->database();
		}
		
		//获取所有会员，或根据id获取特定会员
		public function select($class = FALSE)
		{
			if($class == 'main'):
				$this->db->distinct('district');
			endif;
			$query = $this->db->get($this->table_name);
			return $query->result_array();
		}
	}