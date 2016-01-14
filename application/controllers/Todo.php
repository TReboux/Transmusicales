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
		$this->load->helper('form');
		$this->load->library('form_validation');
		$data['title'] = 'Liste des salles';
		$this->form_validation->set_rules('title','Enonc&eacute;','required');
		if ($this->form_validation->run() !== FALSE ){
			$this->todo_model->todo_add_task();
		}
		$this->load->view('header',$data);
		$this->load->view('headerdisco');
		$this->load->view('language');      
		

		$salles = array(
			'nom'=>'',
			'tri_salle'=>'',
			'heure_debut'=>-1,
			'heure_fin'=>-1,
			'date'=>'',
			'capacite'=>-1,
			'handicap'=>false
		);


		
		if($this->session->userdata('recherche_salle')['tri_salle'] != ''){
			$salles['tri_salle'] = $this->session->userdata('recherche_salle')['tri_salle'];			
		}


		if($this->input->post('name')){
			$salles['nom'] = $this->input->post('name');
		}
		if($this->input->get_post('capacite')){
			$salles['capacite'] = $this->input->post('capacite');
		}	
		if($this->input->get_post('heure_debut')){
			$salles['heure_debut'] = $this->input->post('heure_debut');
		}
		if($this->input->get_post('heure_fin')){
			$salles['heure_fin'] = $this->input->post('heure_fin');
		}
		if($this->input->get_post('date')){
			$salles['date'] = $this->input->post('date');
		}
		if($this->input->get_post('handicap')){
			$salles['handicap'] = $this->input->post('handicap');
		}

		$this->session->set_userdata('recherche_salle',$salles);
		print_r($this->session->userdata('recherche_salle'));

		$data['horaires'] = array(16,17,18,19,20,21,22,23,0,1);
		$data['capacites'] = array(100,200,300,500,1000);
		$this->load->view('form_salle_recherche',$data);
		
		$data['salles'] = $this->artist_model->get_salles($this->session->userdata('recherche_salle'));
		$this->load->view('liste_salle',$data);
		$this->load->view('footer');
	}

	
	public function trier_salles($item){
		$salles = $this->session->userdata('recherche_salle');
		$salles['tri_salle']=$item;
		$this->session->set_userdata('recherche_salle',$salles);
		$this->input->post('nom',$this->session->userdata('recherche_salle')['nom']);
		redirect('todo','update');
	}
	
    /*
    public function reserver_salle{
        redirect('booking','refresh');
    }*/

	public function logout(){
	   $this->session->unset_userdata('logged_in');
	   session_destroy();
	   redirect('login', 'refresh');
	}
}
?>
