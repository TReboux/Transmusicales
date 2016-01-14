<?php
class Createlogin extends CI_Controller {
 
function __construct()
{
   parent::__construct();
   $this->load->model('create_user','',TRUE);
   $this->load->model('user','',TRUE);
   $this->load->helper('url');
}
 
function index()
{
   //This method will have the credentials validation
   $this->load->library('form_validation');
 
   $this->form_validation->set_rules('name', "Nom de l'artiste", 'required|callback_check_database');
   $this->form_validation->set_rules('mail', 'Mail', 'required');
   $this->form_validation->set_rules('password', 'Mot de passe', 'required');
   $this->form_validation->set_rules('country', 'Pays', 'required');
   $this->form_validation->set_rules('debut', 'Date de début', 'required');
   $this->form_validation->set_rules('nbformation', 'Nombre de membres', 'required');
   $this->form_validation->set_rules('genre', 'Genre musical', 'required');
   $this->form_validation->set_rules('parente', 'Parenté', 'required');
   $this->form_validation->set_rules('website', 'Site Web', 'required');
 
   if($this->form_validation->run() == FALSE)
   {
     //Field validation failed.  User redirected to login page
		$this->load->view('header');
		$data['countries'] = $this->create_user->get_countries();
        $data['years'] = $this->create_user->get_years();
		$this->load->view('form_signin', $data);
		$this->load->view('footer');
   }
   else
   {
		//Go to private area
		$result=$this->create_user->signin();
     
		redirect('todo', 'refresh');
		return false;
	}

}


function check_database($password)
{
   //Field validation succeeded.  Validate against database
   $login = $this->input->post('mail');
   $password = $this->input->post('password');
 
   //query the database
   $result=$this->create_user->signin();
 
   if($result)
   {
	 $res=$this->user->login($login, $password);
     $this->load->library('session');
     $sess_array = array();
     foreach($res as $row)
     {
       $sess_array = array(
         'login' => $row->login,
         'password' => $row->password
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
