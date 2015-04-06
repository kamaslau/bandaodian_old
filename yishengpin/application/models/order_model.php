<?php
	class Order_model extends CI_Model
	{	
		//初始化模型
		public function __construct()
		{
			$this->load->database();
		}
	
		//获取所有订单，或根据order_id获取单独订单，默认为积分兑换订单
		public function select($order_id = FALSE, $order_type = 'credit')
		{
			if ($order_id === FALSE):
				$query = $this->db->get('order_'.$order_type);
				return $query->result_array();
				
			else:
				$query = $this->db->get_where('order_'.$order_type, array('order_id' => $order_id));
				return $query->row_array();
				
			endif;
		}
		
		//确认订单
		public function confirm($order_id, $order_type = 'credit')
		{
			//将status字段调整为2（已确认），并记录操作时间
			$data = array(
				'status' => '2',
				'time_confirm' => date('Y-m-d H:i:s')
			);
						
			$this->db->where('order_id', $order_id);
			return $this->db->update('order_'.$order_type, $data);
		}
		
		//取消订单
		public function delete($order_id, $order_type = 'credit')
		{
			//将status字段调整为3（已取消），并记录操作时间
			$data = array(
				'status' => '3',
				'time_cancel' => date('Y-m-d H:i:s')
			);
						
			$this->db->where('order_id', $order_id);
			return $this->db->update('order_'.$order_type, $data);
		}
		
		//未完成//更新订单
		public function update($order_id, $order_type = 'credit')
		{
			
		    $data = array(
				
		    );
			
			$this->db->where('order_id', $order_id);
			return $this->db->update('order_'.$order_type, $data);
		}
	}