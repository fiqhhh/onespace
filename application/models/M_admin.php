<?php 

class M_admin extends CI_Model {
	
	public function Tampil(){
		$this->db->order_by('role_name');
		$this->db->join('privilege','admin.id_privilege = privilege.id_privilege');
		return $this->db->get('admin');
	}
	public function Privilege(){		
		return $this->db->get('privilege');
	}
	public function Checking($data){
		return $this->db->get_where('admin', $data);
	}
	public function Tambah($tambah){
		return $this->db->insert('admin', $tambah);
	}
	public function Update(){
		
	}	
	public function Delete(){
		
	}

}