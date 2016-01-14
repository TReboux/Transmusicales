<?php
	class Create_user extends CI_Model
	{
		public function __construct(){
			$this->load->database();
		}
		
		public function get_countries (){
			$this->db->select('nom,id');
   			$this->db->from('pays');
			$query = $this->db->get();
			return $query->result_array() ;
		}
		
		public function signin()
		{
			$login=$this->input->post('login');
			$this -> db -> select('*');
			$this -> db -> from('_user');
			$this -> db -> where('login', $login);
			
			$query = $this -> db -> get();
			
			if ($query->num_rows() > 0)
			{
			   return false;
			}else{
				$data = array(
				'name'=>$this->input->post('username'),
				'login'=>$this->input->post('login'),
				'pass'=>$this->input->post('password')
				);
				$this->db->insert('user', $data);
				return true;
			}
		}
	}
?>
