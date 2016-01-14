<?php
class Createlogin extends CI_Controller {
 
function __construct()
{
   parent::__construct();
   $this->load->model('createUser','',TRUE);
   $this->load->model('user','',TRUE);
   $this->load->helper('url');
}
 
function index()
{
   //This method will have the credentials validation
   $this->load->library('form_validation');
 
   $this->form_validation->set_rules('login', 'Identifiant', 'required|callback_check_database');
   $this->form_validation->set_rules('username', 'Nom utilisateur', 'required');
   $this->form_validation->set_rules('password', 'Mot de passe', 'required');
 
   if($this->form_validation->run() == FALSE)
   {
     //Field validation failed.  User redirected to login page
		$this->load->view('header');
		$this->load->view('headerco');
		$this->load->view('form_signin');
		$this->load->view('footer');
   }
   else
   {
		//Go to private area
		$result=$this->createUser->signin();
     
		redirect('todo', 'refresh');
		return false;
	}

}


function check_database($password)
{
   //Field validation succeeded.  Validate against database
   $username = $this->input->post('username');
   $login = $this->input->post('login');
 
   //query the database
   $result=$this->createUser->signin();
 
   if($result)
   {
	 $res=$this->user->login($login, $password);
     $this->load->library('session');
     $sess_array = array();
     foreach($res as $row)
     {
       $sess_array = array(
         'username' => $row->name,
         'login' => $row->login,
         'password' => $row->pass
       );
       $this->session->set_userdata('logged_in', $sess_array);
     }
     return TRUE;
   }
   else
   {
     $this->form_validation->set_message('check_database', 'Identifiant déjà utilisé');
     return false;
   }
}
}
?>
