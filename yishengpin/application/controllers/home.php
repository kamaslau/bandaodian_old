<?php
	if( !defined('BASEPATH')) exit('此文件不可被直接访问');

	class Home extends CI_Controller
	{
		public function index()
		{
			$data['title'] = '一圣品海鲜舫';
			$data['class'] = 'home';
			$this->load->view('templates/header', $data);
			$this->load->view('home');
			$this->load->view('templates/footer');
		}
	}
	
/* End of file home.php */
/* Location: ./application/controllers/home.php */