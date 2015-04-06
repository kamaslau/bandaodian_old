<?php
	class Groupbuy_model extends CI_Model
	{
		public $table_name = 'groupbuy';
		
		//初始化模型
		public function __construct()
		{
			$this->load->database();
		}
		
		//获取所有会员，或根据id获取特定会员
		public function select($groupbuy_id = FALSE)
		{
			$data = array();

			if ($groupbuy_id === FALSE):
				$this->db->order_by('commission_ratio desc');
				$query = $this->db->get_where($this->table_name, $data);
				return $query->result_array();

			else:
				$data['groupbuy_id'] = $groupbuy_id;
				$query = $this->db->get_where($this->table_name, $data);
				return $query->row_array();
				
			endif;
		}
		
		/*
		//新增会员，并返回插入后的行ID
		public function create()
		{
			// 以下为备用语句，以供参考
			$data = array(
				'' => '',
				'' => $this->input->post(''),
				'' => $this->session->userdata(''),
				'time_create' => date('Y-m-d H:i:s'),
				'operator_id' => $this->session->userdata('manager_id')
			);
			if(TRUE){$data[''] = $this->input->post('');}

			return $this->db->insert($this->table_name, $data);
			if($this->db->insert($this->table_name, $data)):
				return $this->db->insert_id();
			endif;
		}
		
		//删除会员（标记为已删除状态）
		public function delete($user_id)
		{
			$data = array(
				'' => '0',
				'operator_id' => $this->session->userdata('manager_id')
			);
			
			$this->db->where('user_id', $user_id);
			return $this->db->update($this->table_name, $data);
		}
		
		//编辑会员
		public function edit($user_id)
		{
		    $data = array(
				'' => '',
				'' => $this->input->post(''),
				'' => $this->session->userdata(''),
				'operator_id' => $this->session->userdata('manager_id')
		    );
			
			$this->db->where('user_id', $user_id);
			return $this->db->update($this->table_name, $data);
		}
		*/
	}