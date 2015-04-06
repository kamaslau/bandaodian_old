<?php
	class Referral_model extends CI_Model
	{
		public $tablename = 'referral';
		
		//初始化模型
		public function __construct()
		{
			$this->load->database();
		}
		
		//修改或补充推广流水
		public function update($referral_id, $item_name, $item_value)
		{
			$data = array(
				$item_name => $item_value
			);
			
			$this->db->where('referral_id', $referral_id);
			
			return $this->db->update($this->tablename, $data);
		}
	}