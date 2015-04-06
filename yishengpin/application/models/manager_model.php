<?php
	class Manager_model extends CI_Model
	{
		public $table_name = 'stuff';
		
		//初始化模型
		public function __construct()
		{
			$this->load->database();
		}
	
		//获取所有员工，或根据id获取单独员工
		public function select($manager_id = FALSE)
		{
			if ($manager_id === FALSE):
				$query = $this->db->get($this->table_name);
				return $query->result_array();
				
			else:
				$query = $this->db->get_where($this->table_name, array('stuff_id' => $manager_id));
				return $query->row_array();
				
			endif;
		}
		
		//检查是否存在已用该手机号注册过的员工
		public function exist_mobile($mobile)
		{
			$data = array(
				'mobile' => $mobile,
				'level <' => 8
			);
			
			$query = $this->db->get_where($this->table_name, $data);
			return $query->row_array();
		}
		
		//检查是否存在该员工号员工,且该员工具有收银员及以上等级授权
		public function exist()
		{
			$data = array(
				'stuff_id' => $this->input->post('manager_id'),
				'level >' => 2
			);
			
			$query = $this->db->get_where($this->table_name, $data);
			return $query->row_array();
		}
	
		//员工登录 从manager表中验证输入的密码与用户名是否匹配,若匹配则登录
		public function login()
		{
			$data = array(
				'stuff_id' => $this->input->post('manager_id'),
				'password' => sha1($this->input->post('manager_password'))
			);
			
			$query = $this->db->get_where($this->table_name, $data);
			return $query->row_array();
		}
	}