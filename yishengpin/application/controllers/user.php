<?php
	if( !defined('BASEPATH')) exit('此文件不可被直接访问');

	class User extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
			
			$this->load->model('user_model');
			$this->load->model('referral_model');
		}

		//用户注册
		public function register()
		{
			//若已登录，则直接转到会员页
			if($this->session->userdata('logged_in') === TRUE)
			{
				redirect(base_url('member'));
			}
			
			//向闪出session记录来源网址以备登录成功时跳转
			if($this->input->server('HTTP_REFERER')):
				$this->session->set_flashdata('referer', $this->input->server('HTTP_REFERER'));
			elseif($this->session->flashdata('referer')):
				$this->session->keep_flashdata('referer');
			endif;
			
			$data['title'] = '注册';
			$data['class'] = 'user';
		
			$this->form_validation->set_rules('lastname', '姓氏', 'trim|required');
			$this->form_validation->set_rules('gender', '性别', 'trim|required');
			$this->form_validation->set_rules('dob', '生日', 'trim|required');
			$this->form_validation->set_rules('mobile', '手机号', 'trim|required|is_natural|exact_length[11]|is_unique[user.mobile]');
			$this->form_validation->set_rules('password', '密码', 'trim|required|is_natural|exact_length[6]');
		
			if($this->form_validation->run() === FALSE):
				$this->load->view('templates/header', $data);
				$this->load->view('user/register');
				$this->load->view('templates/footer');

			else:
				if($this->user_model->user_register()):
					$data['user'] = $this->user_model->user_login();
					//若存在referral_id，则将用户ID存入referral表相应行
					if( $this->input->cookie($this->config->item('cookie_prefix').'referral_id') ):
						$this->referral_model->update($this->input->cookie($this->config->item('cookie_prefix').'referral_id') , 'user_id' , $data['user']['user_id'] );
					endif;
					//将用户信息写入session、cookie并转到首页
					$user_data = array(
						'user_id' => $data['user']['user_id'],
						'group' => $data['user']['group'],
						'lastname' => $data['user']['lastname'],
						'gender' => $data['user']['gender'],
						'dob' => $data['user']['dob'],
						'mobile' => $data['user']['mobile'],
						'logged_in' => TRUE
					);
					$this->session->set_userdata($user_data);
					//将用户ID和手机号写入cookie并保存1年
					$this->input->set_cookie('user_mobile', $data['user']['mobile'], 60*60*24*365, '.qddian.com');
					$this->input->set_cookie('user_id', $data['user']['user_id'], 60*60*24*365, '.qddian.com');
					if($this->session->flashdata('referer') && $this->session->flashdata('referer') != base_url()):
						redirect($this->session->flashdata('referer'));
					else:
						redirect(base_url('member'));
					endif;
				endif;
			endif;
		}

		//用户登录
		public function login()
		{
			//若已登录，则直接转到会员页
			if($this->session->userdata('logged_in') === TRUE)
			{
				redirect(base_url('member'));
			}
			
			//向闪出session记录来源网址以备登录成功时跳转
			if($this->input->server('HTTP_REFERER')):
				$this->session->set_flashdata('referer' , $this->input->server('HTTP_REFERER'));
			elseif($this->session->flashdata('referer')):
				$this->session->keep_flashdata('referer');
			endif;

			$data['title'] = '登录';
			$data['class'] = 'user';
		
			$this->form_validation->set_rules('mobile', '手机号', 'trim|required|is_natural|exact_length[11]');
			$this->form_validation->set_rules('password', '密码', 'trim|required|is_natural|exact_length[6]');

			if($this->form_validation->run() === FALSE):
				$this->load->view('templates/header', $data);
				$this->load->view('user/login');
				$this->load->view('templates/footer');
			
			else:
				//成功登录
				if($this->user_model->user_login()):
					//获取用户信息
					$data['user'] = $this->user_model->user_login();
					//若存在referral_id，则将用户ID存入referral表相应行
					if( $this->input->cookie($this->config->item('cookie_prefix').'referral_id') ):
						$this->referral_model->update($this->input->cookie($this->config->item('cookie_prefix').'referral_id') , 'user_id' , $data['user']['user_id'] );
					endif;
					//将用户信息写入session并转到首页
					$user_data = array(
						'user_id' => $data['user']['user_id'],
						'group' => $data['user']['group'],
						'lastname'	=> $data['user']['lastname'],
						'gender'	=> $data['user']['gender'],
						'dob'	=> $data['user']['dob'],
						'mobile'	=> $data['user']['mobile'],
						'logged_in' => TRUE
					);
					$this->session->set_userdata($user_data);
					//将用户ID及手机号写入cookie并保存1年
					$this->input->set_cookie('user_mobile', $data['user']['mobile'], 60*60*24*365, '.qddian.com');
					$this->input->set_cookie('user_id', $data['user']['user_id'], 60*60*24*365, '.qddian.com');
					if($this->session->flashdata('referer') && $this->session->flashdata('referer') != base_url()):
						redirect($this->session->flashdata('referer'));
					else:
						redirect(base_url('member'));
					endif;
			
				//若用户不存在
				elseif(!$this->user_model->user_check()):
					$data['error'] = '<p>这个手机号没有被注册</p>';
					$this->load->view('templates/header', $data);
					$this->load->view('user/login', $data);
					$this->load->view('templates/footer');
				
				//若密码错误
				else:
					$data['error'] = '<p>密码错误</p>';
					$this->load->view('templates/header', $data);
					$this->load->view('user/login', $data);
					$this->load->view('templates/footer');
				
				endif;
			endif;
		}

		//用户退出
		public function logout()
		{
			//删除cookie中referral_id（待完成）
			/*
			if( $this->input->cookie($this->config->item('cookie_prefix').'referral_id') ):
				$this->input->set_cookie($this->config->item('cookie_prefix').'referral_id'), '', time()-1, '.qddian.com');
			endif;
			*/
			
			//清空目前session
			$this->session->sess_destroy();
			
			//转到首页
			redirect(base_url());
		}
	
		//修改资料
		public function edit($user_id)
		{
			//若未登录，转到登录页
			if($this->session->userdata('logged_in') != TRUE):
				redirect(base_url('login'));
			endif;

			$data['class'] = 'user';
			$data['title'] = '修改资料';
		
			$this->form_validation->set_rules('lastname', '姓', 'trim|required');
			$this->form_validation->set_rules('firstname', '名', 'trim');
			$this->form_validation->set_rules('gender', '性别', 'trim|required');
			$this->form_validation->set_rules('dob', '生日', 'trim|required');
			$this->form_validation->set_rules('mobile', '手机号', 'trim|required|is_natural|exact_length[11]');

			//若表单验证失败
			if($this->form_validation->run() === FALSE):
				$data['user'] = $this->user_model->select($user_id);
				$this->load->view('templates/header', $data);
				$this->load->view('user/edit', $data);
				$this->load->view('templates/footer');

			//若保存成功
			else:
				if($this->user_model->update()):
					$data['content'] = '您的资料修改成功！';
					$this->load->view('templates/header', $data);
					$this->load->view('user/result', $data);
					$this->load->view('templates/footer');
				endif;
			endif;
		}
		
		//修改密码
		public function password_change($user_id)
		{
			//若未登录，转到登录页
			if($this->session->userdata('logged_in') != TRUE):
				redirect(base_url('login'));
			endif;

			$data['class'] = 'user';
			$data['title'] = '修改密码';
			
			$this->form_validation->set_rules('password', '目前密码', 'trim|required|is_natural|exact_length[6]');
			$this->form_validation->set_rules('new_password', '新密码', 'trim|required|is_natural|exact_length[6]');
			
			//若表单验证失败
			if($this->form_validation->run() === FALSE):
				$this->load->view('templates/header', $data);
				$this->load->view('user/password_change', $data);
				$this->load->view('templates/footer');

			//检查密码是否正确
			elseif(!$this->user_model->password_check()):
				$data['error'] = '您的密码错误，请确认目前密码正确性并重试。';
				$this->load->view('templates/header', $data);
				$this->load->view('user/password_change', $data);
				$this->load->view('templates/footer');
			
			//若用户填写的新密码和旧密码一样
			elseif(!$this->user_model->password_change()):
				$data['error'] = '新密码不能和原密码相同，请重试。';
				$this->load->view('templates/header', $data);
				$this->load->view('user/password_change', $data);
				$this->load->view('templates/footer');
				
			else:
				$data['content'] = '密码修改成功，您可以<a href="'.base_url('member').'">返回会员中心</a>。';
				$this->load->view('templates/header', $data);
				$this->load->view('user/result', $data);
				$this->load->view('templates/footer');

			endif;
		}

	}

/* End of file user.php */
/* Location: ./application/controllers/user.php */