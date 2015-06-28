<?php
	if(!defined('BASEPATH')) exit('此文件不可被直接访问');

	/**
	* Index Class
	*
	* @author Kamas 'Iceberg' Lau <kamaslau@outlook.com>
	* @copyright SenseStrong <www.sensestrong.com>
	*/
	class Index extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();

			$this->load->model('category_model');
			$this->load->model('groupbuy_model');
			$this->load->model('region_model');
		}

		// 首页
		public function index()
		{
			$data['class'] = 'home';

			$data['categories'] = $this->category_model->select('main');
			$data['sub_categories'] = $this->category_model->select();
			$data['regions'] = $this->region_model->select('main');
			$data['sub_regions'] = $this->region_model->select();
			$data['groupbuy'] = $this->groupbuy_model->select();
			
			$this->load->view('templates/header', $data);
			$this->load->view('index', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/footer', $data);
		}
	}
	
/* End of file index.php */
/* Location: ./application/controllers/index.php */