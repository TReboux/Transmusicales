<?php
if (!isset($_SESSION['username']) && !isset($_SESSION['login']) && !isset($_SESSION['password'])){
	$_SESSION['username']="";	
	$_SESSION['login']="";
	$_SESSION['password']="";
}

class Login extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
	}

	public function index(){
		$this->load->helper('form');
		$this->load->library('form_validation');
		echo validation_errors();
 		echo form_open('verifylogin');
		$data['title'] = 'Connexion';
		$this->load->view('header',$data);
		$this->load->view('form_login');
		$this->load->view('footer');
	}
}
?>
