<?php
	if( !defined('BASEPATH')) exit('此文件不可被直接访问');

	class Credit extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
			
			//若未登录，转到登录页
			if($this->session->userdata('logged_in') != TRUE)
			{
				redirect(base_url('login'));
			}
			
			$this->load->model('credit_model');
			$this->load->model('product_model');
			$this->load->model('user_model');
			$this->load->model('manager_model');
		}
	
		//积分明细
		public function index()
		{
			$data['title'] = '积分明细';
			$data['class'] = 'credit';
		
			$data['credits'] = $this->credit_model->get_credit();
		
			$this->load->view('templates/header', $data);
			$this->load->view('credit/index', $data);
			$this->load->view('templates/footer');
		}
	
		//注册送积分（200分）
		public function rookie()
		{
			$data['class'] = 'credit';
		
			//若此前未领过注册送的积分则可领取
			$new_user = $this->credit_model->new_user();
			
			if(empty($new_user)):
				$this->credit_model->change_credit(200, 1, 1);
				$data['title'] = '成功领取';
				$data['content'] = '恭喜您成功领取 “新会员注册积分 × 200”！';
			
				$this->load->view('templates/header',$data);
				$this->load->view('credit/rookie',$data);
				$this->load->view('templates/footer');

			else:
				$data['title'] = '已经领取';
				$data['content'] = '您已经领取过新会员注册积分，谢谢！';
			
				$this->load->view('templates/header', $data);
				$this->load->view('credit/rookie', $data);
				$this->load->view('templates/footer');

			endif;
		}
	
		//签到送积分（1分）
		public function signin()
		{
			$data['class'] = 'credit';
		
			//对比日期判断今日是否已签到
			if($this->credit_model->signin_done() == TRUE):
				$data['title'] = '已经签到';
				$data['content'] = '您今日已经领取过签到积分，明日请继续签到，谢谢！';
			
				$this->load->view('templates/header', $data);
				$this->load->view('credit/signin', $data);
				$this->load->view('templates/footer');
				
			else:
				$this->credit_model->change_credit(1, 1, 2);
			
				$data['title'] = '成功签到';
				$data['content'] = '恭喜您成功领取 “今日签到积分 × 1”！';
			
				$this->load->view('templates/header', $data);
				$this->load->view('credit/signin', $data);
				$this->load->view('templates/footer');
				
			endif;
		}
	
		//消费得积分（1元=1积分，含两位小数）
		public function checkout()
		{
			$data['class'] = 'credit';
			$data['content'] ='';

			$this->form_validation->set_rules('amount', '消费额（折后）', 'trim|required');
			$this->form_validation->set_rules('seat_id', '桌号', 'trim|required');
			//$this->form_validation->set_rules('serial_id', '收银流水号', 'trim|required');
			$this->form_validation->set_rules('manager_id', '管理员ID', 'trim|required|is_natural');
			$this->form_validation->set_rules('manager_password', '管理员密码', 'trim|required|is_natural|exact_length[6]');
			
			//查看是否是内部员工（手机号是否在stuff表中有记录且权限低于系统级管理员）
			if( $this->manager_model->exist_mobile($this->session->userdata('mobile')) ):
				$data['title'] = '无法兑换';
				$data['content'] = '抱歉，店内员工目前无法参与消费换积分活动，详情请咨询店长，谢谢！';
				
				$this->load->view('templates/header', $data);
				$this->load->view('credit/exchange-result', $data);
				$this->load->view('templates/footer');
			endif;

			//收集会员消费额
			$amount = $this->input->post('amount');
			//消费1元兑换1积分
			$amount_credit = $amount;
			//获取账单流水号
			$serial_id = $this->input->post('serial_id');
			//获取会员生日信息
			$dob_month = substr($this->session->userdata('dob'), 5, 2);
			$dob_day = substr($this->session->userdata('dob'), 8);
			$today_month = substr(date('Y-m-d'), 5, 2);
			$today_day = substr(date('Y-m-d'), 8);
			
			//若当前日期与客人生日吻合，则生日当月获得消费额1.5倍积分，当日获得2倍积分
			if( ($dob_month == $today_month) && ($dob_day == $today_day) ):
				$amount_credit = $amount_credit * 2;
				$data['content'] = '恭喜！生日当天您获得双倍消费积分！除此之外，整个生日当月您都可以享受1.5倍消费积分！';
			elseif($dob_month == $today_month):
				$amount_credit = $amount_credit * 1.5;
				$data['content'] = '恭喜！生日当月您次消费可获得1.5倍积分！生日当天您更可享受双倍消费积分！';
			endif;
		
			//若表单验证失败
			if($this->form_validation->run() === FALSE):
				$data['title'] = '消费换积分';

				$this->load->view('templates/header', $data);
				$this->load->view('credit/checkout');
				$this->load->view('templates/footer');
			
			//若操作ID或操作密码不对
			elseif(!$this->manager_model->login()):
				$data['title'] = '兑换失败';
				if(!$this->manager_model->exist()):
					$data['content'] = '管理员ID不存在！';
				else:
					$data['content'] = '操作密码错误！';
				endif;
			
				$this->load->view('templates/header', $data);
				$this->load->view('credit/checkout-result', $data);
				$this->load->view('templates/footer');
			
			//若该流水号已兑换积分
			/*
			elseif($this->credit_model->checkout_done($serial_id)):
				$data['title'] = '兑换失败';
				$data['content'] = '此流水号已兑换积分，谢谢！';
			
				$this->load->view('templates/header',$data);
				$this->load->view('credit/checkout-result',$data);
				$this->load->view('templates/footer');
			*/
			
			//若积分流水处理失败
			elseif( !$this->credit_model->change_credit($amount_credit, 1, 3) ):
				$data['title'] = '兑换失败';
				$data['content'] = $this->credit_model->change_credit($amount_credit, 1, 3);
			
				$this->load->view('templates/header', $data);
				$this->load->view('credit/checkout-result', $data);
				$this->load->view('templates/footer');
			
			//若消费流水处理失败
			elseif( !$this->credit_model->change_summary($amount) ):
			//elseif( !$this->credit_model->change_summary($amount, $serial_id) ):
				$data['title'] = '兑换失败';
				$data['content'] = $this->credit_model->change_summary($amount, $seat_id);
				//$data['content'] = $this->credit_model->change_summary($amount, $serial_id);
			
				$this->load->view('templates/header', $data);
				$this->load->view('credit/checkout-result', $data);
				$this->load->view('templates/footer');
			
			//若全部处理成功
			else:
				$data['title'] = '兑换成功';
				$data['content'] .= '恭喜您的账单'.$serial_id.'成功获得“消费积分×'.$amount_credit.'”！（每消费1元即可获得1积分，生日当月可获1.5倍积分，生日当天可获2倍积分）';
		
				$this->load->view('templates/header', $data);
				$this->load->view('credit/checkout-result', $data);
				$this->load->view('templates/footer');
			endif;
		}
	
		//积分换菜品
		public function exchange($product_id, $price_single)
		/*
		{
			$data['class'] = 'credit';
			$data['title'] = '即将开放';
			$data['content'] = '您好，为给您提供更便利的服务，青岛店微官网正在进行正式发布前的商户内部员工信息采集中，您暂时无法使用积分兑换店内产品；给您带来的不便敬请谅解，谢谢！';
		
			$this->load->view('templates/header',$data);
			$this->load->view('credit/exchange-result',$data);
			$this->load->view('templates/footer');
		}
		*/
		{
			$data['class'] = 'credit';
		
			$this->form_validation->set_rules('quantity', '份数', 'trim|required|is_natural');
			$this->form_validation->set_rules('password', '登录密码（6位数字）', 'trim|required|is_natural|exact_length[6]');
			$this->form_validation->set_rules('seat_id', '桌号', 'trim|required');
			$this->form_validation->set_rules('manager_id', '管理员ID', 'trim|required|is_natural');
			$this->form_validation->set_rules('manager_password', '管理员密码', 'trim|required|is_natural|exact_length[6]');

			//获取产品信息
			$data['product_info'] = $this->product_model->select($product_id);
			
			//获取用户可用的积分
			$user_info = $this->user_model->user_info();
			$credit_available = $user_info['credit'];

			//查看是否是内部员工（手机号是否在stuff表中有记录且权限低于系统级管理员）
			if( $this->manager_model->exist_mobile($this->session->userdata('mobile')) ):
				$data['title'] = '无法兑换';
				$data['content'] = '抱歉，店内员工无法参与积分兑换菜品活动，详情请咨询店长，谢谢！';
				
				$this->load->view('templates/header', $data);
				$this->load->view('credit/exchange-result', $data);
				$this->load->view('templates/footer');
			endif;
			
			//获取产品可用积分兑换的组别并判断用户是否有权兑换
			if($data['product_info']['credit_group'] > $this->session->userdata('group')):
				$data['title'] = '无法兑换';
				$data['content'] = '抱歉，此款产品专供充值会员，请<a title="选择其它产品" href="'.base_url('product').'">选择其它产品</a>，或咨询店内服务员如何成为充值会员，谢谢！';
			
				$this->load->view('templates/header', $data);
				$this->load->view('credit/exchange-result', $data);
				$this->load->view('templates/footer');
			endif;
			
			//从表单获取需兑换的单品积分价格，并初步判断该会员积分余额是否足够兑换至少一份该产品
			if($user_info['credit'] < $price_single):
				$data['title'] = '无法兑换';
				$data['content'] = '很遗憾，您目前的积分不足。您可以通过<a href="'.base_url('rookie').'">领取新会员礼包</a>、<a href="'.base_url('signin').'">每日签到</a>，或<a href="'.base_url('checkout').'">消费获取更多积分</a>。';

				$this->load->view('templates/header', $data);
				$this->load->view('credit/exchange-result', $data);
				$this->load->view('templates/footer');
			endif;
		
			//获取需兑换商品积分价格、订单总积分价格并判断是否可用积分兑换
			$price_credit = $data['product_info']['price_credit'];
			$amount = $price_credit * $this->input->post('quantity');;
			if(!$price_credit):
				$data['title'] = '无法兑换';
				$data['content'] = '抱歉，此款产品暂时不可使用积分兑换，请<a title="选择其它产品" href="'.base_url('product/credit').'">选择其它产品</a>，谢谢！';
			
				$this->load->view('templates/header', $data);
				$this->load->view('credit/exchange-result', $data);
				$this->load->view('templates/footer');
			
			else:
				//获取可用的积分
				$user_info = $this->user_model->user_info();
				$credit_available = $user_info['credit'];
			
				//检查user.credit是否大于等于商品总积分价
				if($amount > $credit_available):
					$data['title'] = '兑换失败';
					$data['content'] = '很遗憾，您目前的积分不足。您可以通过<a href="'.base_url('rookie').'">领取新会员礼包</a>、<a href="'.base_url('signin').'">每日签到</a>，或<a href="'.base_url('checkout').'">消费获取更多积分</a>。';
			
					$this->load->view('templates/header', $data);
					$this->load->view('credit/exchange-result', $data);
					$this->load->view('templates/footer');
			
				//验证表单字段是否填写正确
				elseif($this->form_validation->run() === FALSE):
					$data['title'] = '积分换菜品';
		
					$this->load->view('templates/header', $data);
					$this->load->view('credit/exchange', $data);
					$this->load->view('templates/footer');
			
				//若用户密码输入错误
				elseif(sha1($this->input->post('password')) != $user_info['password']):
					$data['title'] = '密码错误';
					$data['content'] = '密码输入错误；请输入您登录会员卡时使用的6位数字密码！';
					$this->load->view('templates/header', $data);
					$this->load->view('credit/exchange-result', $data);
					$this->load->view('templates/footer');
					
				//若操作ID或操作密码不对
				elseif(!$this->manager_model->login()):
					$data['title'] = '兑换失败';
					if(!$this->manager_model->exist()):
						$data['content'] = '管理员ID不存在或权限不足！';
					else:
						$data['content'] = '操作密码错误！';
					endif;
					$this->load->view('templates/header', $data);
					$this->load->view('credit/exchange-result', $data);
					$this->load->view('templates/footer');

				//新建积分订单，将信息写入order_credit表
				elseif( !$this->credit_model->create_order_credit($product_id, $amount) ):
					$data['title'] = '兑换失败';
					$data['content'] = $this->credit_model->create_order_credit($product_id, $amount);
			
					$this->load->view('templates/header', $data);
					$this->load->view('credit/exchange-result', $data);
					$this->load->view('templates/footer');
			
				//新建积分流水，将信息写入credit表，并调整user.credit
				elseif( !$this->credit_model->change_credit($amount, 2) ):
					$data['title'] = '兑换失败';
					$data['content'] = $this->credit_model->change_credit($amount, 2);
			
					$this->load->view('templates/header', $data);
					$this->load->view('credit/exchange-result', $data);
					$this->load->view('templates/footer');

				//全部处理成功
				else:
					$data['title'] = '兑换成功';
					$data['content'] = '恭喜您成功创建积分兑换订单，请告知服务员您的会员卡号“<strong>No.'.$this->session->userdata('user_id').'</strong>”及桌号“<strong>'.$this->input->post('seat_id').'</strong>”，以便为您兑换<strong>'.$this->input->post('quantity').'</strong>份<strong>'.$data['product_info']['name'].$data['product_info']['detail'].'</strong>！';

					$this->load->view('templates/header', $data);
					$this->load->view('credit/exchange-result', $data);
					$this->load->view('templates/footer');
				endif;
			endif;
		}
	}
	
/* End of file credit.php */
/* Location: ./application/controllers/credit.php */