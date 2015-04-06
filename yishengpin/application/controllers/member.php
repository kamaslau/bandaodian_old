<?php
	if( !defined('BASEPATH')) exit('此文件不可被直接访问');

	class Member extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
		
			$this->load->model('user_model');
			$this->load->model('credit_model');
		}
	
		public function index()
		{
			//若未登录，转到登录页
			if($this->session->userdata('logged_in') != TRUE)
			{
				redirect(base_url('login'));
			}
		
			$data['class'] = 'member';
			$data['title'] = '我的会员卡';
		
			$data['lastname'] = $this->session->userdata('lastname');
			$data['gender'] = $this->session->userdata('gender');
			$data['dob'] = $this->session->userdata('dob');
			$data['mobile'] = $this->session->userdata('mobile');
		
			//获取用户信息，以待抽取总消费额及总积分
			$data['user_info'] = $this->user_model->user_info();
		
			//判断是否曾经领取过新会员积分
			$new_user = $this->credit_model->new_user();
			if(empty($new_user)):
				$data['new'] = TRUE;
			endif;
		
			//判断今日是否已领取过签到积分
			if($this->credit_model->signin_done()):
				$data['signed'] = TRUE;
			endif;
		
			$this->load->view('templates/header', $data);
			$this->load->view('member/index', $data);
			$this->load->view('templates/footer');
		}
	
		public function level()
		{
			$data['title'] = '会员等级说明';
			$data['class'] = 'member';
		
			$this->load->view('templates/header', $data);
			$this->load->view('member/level', $data);
			$this->load->view('templates/footer');
		}
	}
	
/* End of file member.php */
/* Location: ./application/controllers/member.php */