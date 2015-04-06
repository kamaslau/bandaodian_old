<?php 
	if( !defined('BASEPATH')) exit('此文件不可被直接访问');

	class Activity extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
		}
		
		public function qrcode($activity = NULL ,$from = NULL)
		{
			$data['class'] = 'activity';
			
			$index = array(
				'sd' => '圣诞节',
				'yd' => '元旦',
				'lb' => '腊八节',
				'cj' => '春节',
				'qr' => '情人节',
				'yx' => '元宵节',
				'fn' => '妇女节',
				'gy' => '谷雨节（海神节）',
				'qm' => '清明节',
				'ld' => '劳动节',
				'mq' => '母亲节',
				'fq' => '父亲节',
				'dw' => '端午节',
				'js' => '教师节',
				'qx' => '七夕节',
				'zq' => '中秋节',
				'cy' => '重阳节',
				'dq' => '店庆日'
			);
			$output = $index[$activity];
			if(!$output):
				redirect(base_url());
			else:
				$data['title'] = $output.'特别活动';
				
				$this->load->view('templates/header',$data);
				echo '<p>'.$output.'</p>';
				$this->load->view('templates/footer');
			endif;
		}
	}

/* End of file activity.php */
/* Location: ./application/controllers/activity.php */