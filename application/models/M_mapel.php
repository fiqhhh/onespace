<?php 

class M_mapel extends CI_Model {
	
	public function Tampil(){
		$this->db->order_by('nama_mapel','asc');
		return $this->db->get('mapel');
	}
	public function Checking($data){
		return $this->db->get_where('mapel', $data);
	}
	public function Tambah($tambah){
		return $this->db->insert('mapel', $tambah);
	}
	public function Update($id,$data){
		$this->db->where('id_mapel', $id);
		return $this->db->update('mapel', $data);
	}	
	public function Delete($id){
		$this->db->where('id_mapel', $id);
		return $this->db->delete('mapel');
	}

}