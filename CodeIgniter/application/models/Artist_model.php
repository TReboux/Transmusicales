<?php
	class Artist_model extends CI_Model {
		public function __construct(){
			$this->load-> database() ;
			$this->load->library('session');
		}

		public function get_salles($options){
			$this->db->select('nom,adresse,capacite,acceshandicap');
   			$this->db->from('salle');

			if($options['nom'] != ''){
				$this->db->like('nom',$options['nom']);
			}
			if($options['capacite'] > -1){
				$this->db->where('capacite',$options['capacite']);
			}
			if($options['heure_debut'] > -1){
				
			}
			if($options['heure_fin'] > -1){
				
			}
			if($options['date'] != ''){
				
			}
			if($options['handicap']){
				$this->db->where('acceshandicap',$options['handicap']);
			}


			if($options['tri_salle'] != ''){
				$this->db->order_by($options['tri_salle']);
			}
			
				$query = $this->db->get();
				return $query->result_array();
			}


		public function trier_salles($item){
			$this->db->select('nom,adresse,capacite,acceshandicap');
   			$this->db->from('salle');
			$this->db->order_by($item);
			$query = $this->db->get();
			return $query->result_array();
		}
	}
?>
