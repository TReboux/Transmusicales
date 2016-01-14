<?php
	class Create_user extends CI_Model
	{
		public function __construct(){
			$this->load->database();
		}
		
		public function get_countries(){
			$this->db->select('nom,id');
   			$this->db->from('pays');
			$query = $this->db->get();
			return $query->result_array() ;
		}
        
        public function get_years(){
            $tab = array();
            for($i=2016;$i>1950;$i--){
                $tab[] = $i;   
            }            
            return $tab;
        }
		
		public function signin()
		{
			$name=$this->input->post('name');
			$this -> db -> select('*');
			$this -> db -> from('artiste');
			$this -> db -> where('nom', $name);
			
			$query = $this -> db -> get();
			
			if ($query->num_rows() > 0)
			{
			   return false;
			}else{
				$data = array(
				'login'=>$this->input->post('mail'),
				'password'=>$this->input->post('password'),
				'valide'=>'t'
				);
				$this->db->insert('compte', $data);
				
				$data = array(
				'login'=>$this->input->post('mail'),
				'nom'=>$this->input->post('name'),
				'mail'=>$this->input->post('mail'),
				'genre'=>$this->input->post('genre'),
				'siteweb'=>$this->input->post('website'),
				'debut'=>$this->input->post('debut'),
				);
				$this->db->insert('artiste', $data);
				
				$name=$this->input->post('parente');
				$this->db->select('id');
				$this->db->from('parent');
				$this->db->where('nom',$name);
				
				$queryp=$this->db->get();
				
				if ($queryp->num_rows == 0){
					$data = array(
					'nom'=>$this->input->post('parente'),
					);
					$this->db->insert('parent',$data);
				}
				
				$name=$this->input->post('parente');
				$this->db->select('id');
				$this->db->from('parent');
				$this->db->where('nom',$name);
				$queryp=$this->db->get();
				
				foreach ($queryp->result() as $row)
				{
					$parent=$row->id;
				}
				
				$data=array(
				'parent'=>$parent,
				'artiste'=>$this->input->post('mail')
				);
				$this->db->insert('parente',$data);
				
				
				return true;
			}
		}
	}
?>
