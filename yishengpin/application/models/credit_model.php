<?php
	class Credit_model extends CI_Model
	{
		public $table_name = 'credit';
		
		//初始化模型
		public function __construct()
		{
			$this->load->database();
		}
	
		//获取所有积分记录，或根据credit_id获取单独积分流水
		public function select($credit_id = FALSE)
		{
			if ($credit_id === FALSE):
				$query = $this->db->get($this->table_name);
				return $query->result_array();
				
			else:
				$query = $this->db->get_where($this->table_name, array('credit_id' => $credit_id));
				return $query->row_array();
				
			endif;
		}
	
		//判断是否曾经领取过新用户注册积分
		public function new_user()
		{
			$data = array(
				'user_id' => $this->session->userdata('user_id'),
				'type' => '1'
			);
			
			$query = $this->db->get_where($this->table_name, $data);
			
			return $query->result_array();
		}
	
		//检验今日是否已经签到
		public function signin_done()
		{
			//获取当前用户最后一次签到日期
			//检查当前用户今日是否已经签到
			$data = array(
				'user_id' => $this->session->userdata('user_id'),
				'type' => '2',
				'year(time_create)' => date('Y'),
				'month(time_create)' => date('m'),
				'day(time_create)' => date('d')
			);
			
			$query = $this->db->get_where($this->table_name, $data);
			
			if(!$query->row_array()):
				return FALSE;
				
			else:
				return TRUE;
				
			endif;
		}
			
		//检查某流水号消费是否已被兑换成积分
		public function checkout_done($serial_id)
		{
			$data = array(
				'user_id' => $this->session->userdata('user_id'),
				'serial_id' => $serial_id
			);
			
			$query = $this->db->get_where('summary', $data);
			
			if(!$query->row_array()):
				return FALSE;
				
			else:
				return TRUE;
				
			endif;
		}
		
		//获取给定用户的积分流水记录
		public function get_credit()
		{
			//最近的积分流水最先显示
			$this->db->order_by('time_create', 'desc');
			
			$data = array(
				'user_id' => $this->session->userdata('user_id')
			);
			
			$query = $this->db->get_where($this->table_name, $data);
			
			return $query->result_array();
		}
	
		//新增积分流水，并调整user.credit
		public function change_credit($amount, $action = 1, $type = NULL, $note = NULL, $expire = NULL)
		{		
			$data = array(
				'user_id' => $this->session->userdata('user_id'),
				'amount' => $amount,
				'action' => $action,
				'type' => $type,
				//'note' => $note,
				'time_create' => date('Y-m-d H:i:s'),
				'expire' => $expire
			);
		
			if(isset($note)):
				$data['note'] = $note;
			endif;
		
			//若为消费换取积分，或积分兑换产品，则记录操作员工ID和座号，并根据员工ID获取门店/分公司ID待写入消费流水、积分流水，及会员信息表（待完成）
			if($type == 3 || $action == 2):
				//$data['serial_id'] = $this->input->post('serial_id');
				$data['seat_id'] = $this->input->post('seat_id');
				$data['stuff_id'] = $this->input->post('manager_id');
				
				$manager_data = $this->manager_model->select($this->input->post('manager_id'));
				$data['biz_id'] = $manager_data['biz_id'];
				$data['brand_id'] = $manager_data['brand_id'];
				$data['branch_id'] = $manager_data['branch_id'];
			endif;
		
			//若成功添加积分流水，则调整user.credit
			if(!$this->db->insert($this->table_name, $data)):
				return FALSE;
				
			else:
				//根据流水类型（获取/消费）决定mysql操作符号
				$action = ($action == 1) ? '+' : '-';
				$input = 'credit'. $action . $amount;
				
				//调整user.credit
				$this->db->set('credit', $input, FALSE);
				/*
				if($type == 3 || $action == 2):
					$this->db->set('biz_visited', "concat(biz_visited, ".$manager_data['branch_id'].", '|')", FALSE);
					$this->db->set('biz_consumed', "concat(biz_consumed, ".$manager_data['branch_id'].", '|')", FALSE);
					$this->db->set('brand_visited', "concat(brand_visited, ".$manager_data['branch_id'].", '|')", FALSE);
					$this->db->set('brand_consumed', "concat(brand_consumed, ".$manager_data['branch_id'].", '|')", FALSE);
					$this->db->set('branch_visited', "concat(branch_visited, ".$manager_data['branch_id'].", '|')", FALSE);
					$this->db->set('branch_consumed', "concat(branch_consumed, ".$manager_data['branch_id'].", '|')", FALSE);
				endif;
				*/
				$this->db->where('user_id', $this->session->userdata('user_id'));
				return $this->db->update('user');
				
			endif;
		}
	
		//新增消费流水，并调整user.summary
		public function change_summary($amount, $from_id = NULL)
		//public function change_summary($amount, $serial_id, $from_id = NULL)
		{
			$data = array(
				'user_id' => $this->session->userdata('user_id'),
				'amount' => $amount,
				'seat_id' => $this->input->post('seat_id'),
				'stuff_id' => $this->input->post('manager_id'),
				'time_create' => date('Y-m-d H:i:s')
				//'serial_id' => $serial_id
			);

			$manager_data = $this->manager_model->select($this->input->post('manager_id'));
			$data['biz_id'] = $manager_data['biz_id'];
			$data['brand_id'] = $manager_data['brand_id'];
			$data['branch_id'] = $manager_data['branch_id'];
		
			//若成功添加积分流水，则调整user.summary
			if(!$this->db->insert('summary', $data)):
				return '消费流水添加失败';
				
			else:
				$input = 'summary +'.$amount;
				$this->db->set('summary', $input, FALSE);
				$this->db->where('user_id', $this->session->userdata('user_id'));
				return $this->db->update('user');
				
			endif;
		}
	
		//新增订单（积分支付）
		public function create_order_credit($product_id, $amount)
		{
			$data = array(
				'seat_id' => $this->input->post('seat_id'),
				'stuff_id' => $this->input->post('manager_id'),
				'user_id' => $this->session->userdata('user_id'),
				'product_id' => $product_id,
				'quantity' => $this->input->post('quantity'),
				'total' => $amount,
				'time_create' => date('Y-m-d H:i:s')
			);

			if(!$this->db->insert('order_credit', $data)):
				return FALSE;
				
			else:
				return TRUE;
				
			endif;
		}
	}