<?php 

class M_ortu extends CI_Model {
	
	public function Tampil(){
		$this->db->order_by('nama_murid','asc');
		$this->db->join('murid','orang_tua.id_murid = murid.id_murid');
		$this->db->join('alamat','murid.id_alamat = alamat.id_alamat');
		return $this->db->get('orang_tua');
	}

	public function CheckingAll($nisn_anak){
		$this->db->order_by('nama_murid','asc');
		$this->db->join('murid','orang_tua.id_murid = murid.id_murid');
		$this->db->join('alamat','murid.id_alamat = alamat.id_alamat');
		return $this->db->get_where('orang_tua', ['nisn_murid' => $nisn_anak]);
	}

	public function CheckingMurid($id_murid){
		$this->db->order_by('nama_murid','asc');
		$this->db->join('murid','orang_tua.id_murid = murid.id_murid');
		$this->db->join('alamat','murid.id_alamat = alamat.id_alamat');
		$this->db->where('orang_tua.id_murid', $id_murid);
		return $this->db->get('orang_tua');
	}
	public function Checking($data){
		return $this->db->get_where('orang_tua', $data);
	}
	public function Tambah($tambah){
		return $this->db->insert('orang_tua', $tambah);
	}
	public function Update($id,$data){
		$this->db->where('id_orang_tua', $id);
		return $this->db->update('orang_tua', $data);
	}	
	public function Delete($id){
		$this->db->where('id_orang_tua', $id);
		return $this->db->delete('orang_tua');
	}

}