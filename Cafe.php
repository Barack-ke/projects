<?php
defined('BASEPATH') OR('No direct script access allowed');
Class Cafe extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('Cafemodel');
	}
	public function index(){
		$condition = array('status' => 0);
		$cafes= $this->Cafemodel->getcafelist($condition);
		$data['cafes'] = $cafes;

		$this->load->view('includes/header');
		$this->load->view('includes/sidebar');
		$this->load->view('includes/nav');
		$this->load->view('cafe/index', $data);
		$this->load->view('includes/footer');
	}
	
	public function clearcafe(){
		$id = $this->uri->segment('3');
		$id = strtr($id, array('.' => '+', '-' => '=', '~' => '/'));
        $id = $this->encryption->decrypt($id);

		$condition=array('studentId'=>$id);
		$data=array('status'=>1);
		$this->Cafemodel->update($data, $condition);
		redirect(base_url().'cafe/index');

	}
}