<?php
	class User_model extends CI_Model
	{
		public $table_name = 'user';
	
		//初始化模型
		public function __construct()
		{
			$this->load->database();
		}
	
		public function select($user_id = FALSE)
		{
			if ($user_id === FALSE):
				$query = $this->db->get($this->table_name);
				return $query->result_array();
				
			else:
				$query = $this->db->get_where($this->table_name, array('user_id' => $user_id));
				return $query->row_array();
				
			endif;
		}
	
		//检查是否存在已用该手机号注册过的用户
		public function user_check()
		{
			$data = array(
				'mobile' => $this->input->post('mobile')
			);
			
			$query = $this->db->get_where($this->table_name, $data);
			return $query->row_array();
		}
	
		//根据存在session中的user_id获取用户信息
		public function user_info()
		{
			$data = array(
				'user_id' => $this->session->userdata('user_id')
			);
			
			$query = $this->db->get_where($this->table_name, $data);
			return $query->row_array();
		}
	
		//用户登录 从user表中验证输入的密码与用户名是否匹配,若匹配则登录
		public function user_login()
		{
			$data = array(
				'mobile' => $this->input->post('mobile'),
				'password' => sha1($this->input->post('password'))
			);
			
			$query = $this->db->get_where($this->table_name, $data);
			
			return $query->row_array();
		}
	
		//用户注册  将Email和使用sha1加密后的密码存入user_login表
		public function user_register()
		{
			$data = array(
				'lastname' => $this->input->post('lastname'),
				'gender' => $this->input->post('gender'),
				'dob' => $this->input->post('dob'),
				'mobile' => $this->input->post('mobile'),
				'password' => sha1($this->input->post('password')),
				'time_create' => date('Y-m-d H:i:s'),
				'biz_visited' => '|1|',
				'biz_consumed' => '|',
				'brand_visited' => '|1|',
				'brand_consumed' => '|',
				'branch_visited' => '|',
				'branch_consumed' => '|'
			);
			return $this->db->insert($this->table_name, $data);
		}
	
		//修改资料
		public function update()
		{
			$data = array(
				'lastname' => $this->input->post('lastname'),
				'firstname' => $this->input->post('firstname'),
				'gender' => $this->input->post('gender'),
				'dob' => $this->input->post('dob'),
				'mobile' => $this->input->post('mobile')
			);
			
			$this->db->where('user_id', $this->session->userdata('user_id'));
			return $this->db->update($this->table_name, $data);
		}
	
		//验证密码
		public function password_check()
		{
			$data = array(
				'user_id' => $this->session->userdata('user_id'),
				'password' => sha1($this->input->post('password'))
			);
			
			$query = $this->db->get_where($this->table_name, $data);
			return $query->row_array();
		}
	
		//修改密码
		public function password_change()
		{
			if( $this->input->post('password') == $this->input->post('new_password') ):
				return FALSE;
				
			else:
				$data=array(
					'password' => sha1($this->input->post('new_password'))
				);
		
				$this->db->where('user_id', $this->session->userdata('user_id'));
				
				return $this->db->update($this->table_name, $data);
			endif;
		}
	
		//未完成 //重置密码 将密码重置链接通发送到需要重置的Email，用户点击连接后设置新密码
		public function password_forget()
		{
	
		}
	}