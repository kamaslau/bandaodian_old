<?php
	if( !defined('BASEPATH')) exit('此文件不可被直接访问');

	class Branch extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
			
			//$this->load->model('branch_model');
		}
	
		/* 全部门店列表 */
		public function index()
		{
			$data['title'] = '门店信息';
			$data['class'] = 'branch';
		
			//目前是直接载入写入视图文件的门店/分公司信息，以后使用数据库抓取
			//$data['branch'] = $this->branch_model->select();
		
			$this->load->view('templates/header', $data);
			$this->load->view('branch', $data);
			$this->load->view('templates/footer');
		}
	}
	
/* End of file branch.php */
/* Location: ./application/controllers/branch.php */