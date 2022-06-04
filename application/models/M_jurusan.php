<?php 

class M_jurusan extends CI_Model {
	
	public function Tampil(){
		$this->db->order_by('nama_jurusan','asc');
		return $this->db->get('jurusan');
	}
	public function Checking($data){
		return $this->db->get_where('jurusan', $data);
	}
	public function Tambah($tambah){
		return $this->db->insert('jurusan', $tambah);
	}
	public function Update($id,$data){
		$this->db->where('id_jurusan', $id);
		return $this->db->update('jurusan', $data);
	}	
	public function Delete($id){
		$this->db->where('id_jurusan', $id);
		return $this->db->delete('jurusan');
	}

}