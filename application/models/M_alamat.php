<?php 

class M_alamat extends CI_Model {
	
	public function Tampil(){
		$this->db->order_by('id_alamat','asc');
		return $this->db->get('alamat');
	}
	public function Checking($data){
		return $this->db->get_where('alamat',$data);
	}
	public function Tambah($tambah){
		return $this->db->insert('alamat',$tambah);
	}
	public function Update($id,$data){
		$this->db->where('id_alamat',$id);
		return $this->db->update('alamat',$data);
	}
	public function Delete($id){
		$this->db->where('id_alamat',$id);
		return $this->db->delete('alamat');
	}

}