<?php
	class Branch_model extends CI_Model
	{
		public $tablename = 'branch';
		
		//初始化模型
		public function __construct()
		{
			$this->load->database();
		}
	
		//获取所有已开通（status=1）的分店，或根据id获取单独分店
		public function select($branch_id = FALSE)
		{
			if ($branch_id === FALSE):
				$this->db->where('status', 1);
				$query = $this->db->get($this->tablename);
				return $query->result_array();
				
			else:
				$query = $this->db->get_where($this->tablename, array('branch_id' => $branch_id));
				return $query->row_array();
				
			endif;
		}
	}