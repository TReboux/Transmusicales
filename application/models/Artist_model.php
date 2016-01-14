<?php
	class Artist_model extends CI_Model {
		public function __construct(){
			$this->load-> database() ;
			$this->load->library('session');
		}

		public function get_salles($options){
			//$this->db->select('nom,adresse,capacite,acceshandicap');
   			//$this->db->from('salle');
            
            $query = 'select distinct nom,adresse,capacite,acceshandicap from trans.salle inner join (select * from trans.session';
            
            if($options['date'] != '' || $options['heure_debut'] > -1 || $options['heure_fin'] > -1){
				$query .= ' where';
                
                if($options['date'] != ''){
				    $query .= ' datesession=\''.$options['date'].'\'';
                }
                if($options['heure_debut'] > -1){
				    if($options['date'] != ''){
                        $query .= ' and';
                    }
                    $query .= ' heuredebut>='.$options['heure_debut'];
                }
                if($options['heure_fin'] > -1){
				    if($options['date'] != '' || $options['heure_debut'] > -1){
                        $query .= ' and';
                    }
                    $query .= ' heuredebut<='.$options['heure_fin'];
                }
			}
            
            $query .= ' except (select datesession,heuredebut,salle from trans.session natural join trans.reservation where statut=1 or artiste=\''.$_SESSION['login'].'\')) as salles_dispo on salle.id=salles_dispo.salle';
			
            if ($options['nom'] != '' || $options['capacite'] > -1 || $options['handicap']){
                $query .= ' where';
            
                if($options['nom'] != ''){
                    //$this->db->like('nom',$options['nom']);
                    $query .= ' lower(nom) like lower(\'%'.$options['nom'].'%\')';
                }
                if($options['capacite'] > -1){
                    //$this->db->where('capacite',$options['capacite']);
                    if($options['nom'] != ''){
                        $query .= ' and';
                    }
                    $query .= ' capacite>='.$options['capacite'];
                }

                if($options['handicap']){
                    //$this->db->where('acceshandicap',$options['handicap']);
                    if($options['nom'] != '' || $options['capacite'] > -1){
                        $query .= ' and';
                    }
                    $query .= ' acceshandicap';
                }
            }

			if($options['tri_salle'] != ''){
				//$this->db->order_by($options['tri_salle']);
                $query .= ' order by '.$options['tri_salle'];
			}
			
            //$query = $this->db->get();
            $result = $this->db->query($query);
            return $result->result_array();
        }


		public function trier_salles($item){
			$this->db->select('nom,adresse,capacite,acceshandicap');
   			$this->db->from('salle');
			$this->db->order_by($item);
			$query = $this->db->get();
			return $query->result_array();
		}
        
        public function init_sessions_test(){
            for($salle=1 ; $salle<22 ; $salle++){
                for($mois=5 ; $mois<7 ; $mois++){
                    for($jour=1 ; $jour<31 ; $jour++){
                        for($heure=17 ; $heure<24 ; $heure++){
                            $ligne=array(
                                'datesession'=>'2016-'.$mois.'-'.$jour,
                                'heuredebut'=>$heure,
                                'salle'=>$salle
                            );
                            
                            $this -> db -> select('datesession, heuredebut, salle');
                            $this -> db -> from('session');
                            $this -> db -> where('datesession', $ligne['datesession']);
                            $this -> db -> where('heuredebut', $ligne['heuredebut']);
                            $this -> db -> where('salle', $ligne['salle']);

                            $query = $this -> db -> get();

                            if($query -> num_rows() == 0)
                            {
                                $this->db->insert('session',$ligne);
                            }
                        }
                    }
                }
            }
        }
	}
?>
