<?php
if (!isset($_SESSION['login']) && !isset($_SESSION['password'])){	
	$_SESSION['login']="";
	$_SESSION['password']="";
}

class Todo extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('artist_model');
		$this->load->helper('url');
		$this->load->library('session');
	}

	public function index(){
		if($this->session->userdata('logged_in')){
		     $session_data = $this->session->userdata('logged_in');
		     $data['login'] = $_SESSION['login'] = $session_data['login'];
		     $data['password'] = $_SESSION['password'] = $session_data['password'];
		}else{
		     //If no session, redirect to login page
		     redirect('login', 'refresh');
		}
		$user=$data['login'];
		$salle=$this->artist_model->get_salles();
		$this->load->view('header',$data);
		$this->load->view('headerdisco');
		$this->load->view('language');      
		$this->load->view('liste_salle');
		$this->load->view('footer');
	}
	

	public function logout(){
	   $this->session->unset_userdata('logged_in');
	   session_destroy();
	   redirect('login', 'refresh');
	}
}
?>
