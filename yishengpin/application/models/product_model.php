<?php
	class Product_model extends CI_Model
	{
		public $tablename = 'product';
	
		//初始化模型
		public function __construct()
		{
			$this->load->database();
		}
	
		//获取所有上架商品，或根据product_id获取单独商品
		public function select($product_id = FALSE)
		{
			$this->db->where('status', 1);
		
			if ($product_id === FALSE):
				$query = $this->db->get($this->tablename);
				return $query->result_array();
			
			elseif($product_id == 'credit'):
				$this->db->where('price_credit IS NOT NULL');
				$this->db->order_by('price_credit');
				
				$query = $this->db->get($this->tablename);
				
				return $query->result_array();

			else:
				$query = $this->db->get_where($this->tablename, array('product_id' => $product_id));
				return $query->row_array();
				
			endif;
		}
	}