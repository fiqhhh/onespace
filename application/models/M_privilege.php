<?php 

class M_privilege extends CI_Model {
	
	public function Tampil(){
		
	}
	public function Checking($data){
		return $this->db->get_where('privilege', $data);
	}
	public function Tambah(){
	}
	public function Update(){
		
	}	
	public function Delete(){
		
	}

}