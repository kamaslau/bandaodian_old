<?php
	class Referral_model extends CI_Model
	{
		public $table_name = 'referral';
		
		//初始化模型
		public function __construct()
		{
			$this->load->database();
		}
		
		//根据给定的参数查找相应的记录是否存在
		public function find($user_ip = NULL, $activity_id = NULL, $ad_id = NULL, $poster_id = NULL, $spreader_type = NULL, $spreader_id = NULL)
		{
			$data = array(
				'user_ip' => $user_ip,
				'activity_id' => $activity_id,
				'ad_id' => $ad_id,
				'poster_id' => $poster_id,
				'spreader_type' => $spreader_type,
				'spreader_id' => $spreader_id
			);
			
			$query = $this->db->get_where($this->table_name, $data);
			$result = $query->row_array();
			
			if(empty($result)):
				return false;
			elseif((time()-$result['timestamp_visit']) < 43200)://若符合条件的记录产生于12小时之内则返回该记录referral_id
				return $result['referral_id'];
			else:
				return false;
			endif;
		}
		
		//根据给定的referral_id将对应的time_visit和timestamp_visit更改为现在时间
		public function update_time($referral_id)
		{
			$data = array(
				'time_visit' => date('Y-m-d H:i:s'),
				'timestamp_visit' => time()
			);
			
			$this->db->where('referral_id', $referral_id);
			return $this->db->update($this->table_name, $data);
		}
		
		//根据activity_id查询activity表中是否存在该活动
		public function search_activity($activity_id)
		{
			$data = array(
				'activity_id' => $activity_id
			);
			
			$query = $this->db->get_where('activity', $data);
			return $query->row_array();
		}
		
		//新增访问流水
		public function create($user_ip, $activity_id, $ad_id, $poster_id, $spreader_type, $spreader_id)
		{
			$data = array(
				'activity_id' => $activity_id,
				'ad_id' => $ad_id,
				'poster_id' => $poster_id,
				'spreader_type' => $spreader_type,
				'spreader_id' => $spreader_id,
				'user_ip' => $user_ip,
				'user_agent' => $this->session->userdata('user_agent'),
				'timestamp_visit' => time()
			);
			
			if($this->input->cookie('qdd_user_id')):
				$data['user_id'] = $this->input->cookie('qdd_user_id');
			endif;
			if($this->input->server('HTTP_REFERER')):
				$data['user_referer'] = $this->input->server('HTTP_REFERER');
			endif;
		
			//若成功添加访问流水，则返回该流水ID
			if(!$this->db->insert($this->table_name, $data)):
				return FALSE;
			else:
				return $this->db->insert_id();
			endif;
		}
		
		//根据activity_id获取对应的url（网址）
		public function getUrl($activity_id)
		{
			$data = array(
				'activity_id' => $activity_id
			);
			$this->db->select('url');
			
			$query = $this->db->get_where('activity' , $data);
			$result = $query->row_array();
			return $result['url'];
		}
	}