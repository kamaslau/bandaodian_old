<?php
	if( !defined('BASEPATH')) exit('此文件不可被直接访问');

	class Product extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
		
			$this->load->model('product_model');
		}
	
		/* 产品列表 */
		public function index($product_id = FALSE)
		{
			$data['class'] = 'product';
			if($product_id == FALSE):
				//若未通过url传递需提取产品ID或类型，则全部显示
				$data['title'] = '美食菜单';
				$data['show_recommend'] = TRUE;//显示推荐菜品和所有菜品
			else:
				//若通过url传递'credit'，则仅显示可用积分兑换的产品
				$data['title'] = '可积分菜品';
				$data['show_recommend'] = FALSE;//不显示推荐菜品
			endif;
		
			$data['products'] = $this->product_model->select($product_id);
		
			$this->load->view('templates/header',$data);
			$this->load->view('product/index',$data);
			$this->load->view('templates/footer');
		}
	
		/* 新增产品 */
		public function create()
		{
			if($this->session->userdata('logged_in') != TRUE)
			{
				redirect(base_url('login'));
			}
		
			$data['class'] = 'product';
			$data['title'] = '新增产品';
	
			$this->form_validation->set_rules('name', '名称', 'trim|required');
			$this->form_validation->set_rules('detail', '详情', 'trim|required');
			$this->form_validation->set_rules('userfile', '图片', 'trim');
			$this->form_validation->set_rules('price_cash', '现金价格', 'trim|is_natural');
			$this->form_validation->set_rules('price_credit', '积分价格', 'trim|is_natural');
			$this->form_validation->set_rules('credit_group', '可用积分兑换此产品用户', 'trim|is_natural');
		
			//若表单提交不成功
			if($this->form_validation->run() === FALSE):
				$this->load->view('templates/header',$data);
				$this->load->view('product/create',$data);
				$this->load->view('templates/footer');
			else:
				//尝试上传
				$config['upload_path'] = './uploads/yishengpin/product/';
				$config['allowed_types'] = 'jpg|png';
				$config['max_size'] = '2048';//2m
				$config['max_width']  = '1280';
				$config['max_height']  = '1280';
				$config['overwrite'] = TRUE;
				$this->load->library('upload',$config);
				//若上传不成功
				if(!$this->upload->do_upload()):
				    $data['error'] = $this->upload->display_errors();

					$this->load->view('templates/header',$data);
					$this->load->view('product/create',$data);
					$this->load->view('templates/footer');
				else:
					$data['upload_data'] = $this->upload->data();
					//获取上传的文件路径，与其它表单字段一起写入数据库，并返回刚上传的产品ID
					$image_url = $config['upload_path'].$data['upload_data']['client_name'];
					$item_id = $this->product_model->create($image_url);
					//获取数据记录
					$data['product'] = $this->product_model->select($item_id);
					//若新建成功
					$data['title'] = '新建成功';
		 		
					$this->load->view('templates/header',$data);
					$this->load->view('product/create-success',$data);
					$this->load->view('templates/footer');
				endif;
			endif;
		}
	}

/* End of file product.php */
/* Location: ./application/controllers/product.php */