<?php
if (!isset($_SESSION['username']) && !isset($_SESSION['login']) && !isset($_SESSION['password'])){
	$_SESSION['username']="";	
	$_SESSION['login']="";
	$_SESSION['password']="";
}

class Signin extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('create_user');
	}

	public function index(){
		$this->load->helper('form');
		$this->load->library('form_validation');
		echo validation_errors();
 		echo form_open('createlogin');
		$data['title'] = 'Inscription';
		$this->load->view('header',$data);
		$this->load->view('headerco');
		$data['countries'] = $this->create_user->get_countries();
		$this->load->view('form_signin', $data);
		$this->load->view('footer');
	}
}
?>
