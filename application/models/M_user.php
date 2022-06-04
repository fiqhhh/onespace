<?php 

class M_user extends CI_Model {

	public function Checking($data){
		return $this->db->get_where('auth', $data);
	}

	public function TampilGuru($id){
		$this->db->join('guru','auth.id_guru = guru.id_guru');
		$this->db->join('alamat','guru.id_alamat = alamat.id_alamat');
		$this->db->where('auth.id_guru', $id);
		return $this->db->get('auth');
	}

	public function TampilMurid($id){
		$this->db->join('murid','auth.id_murid = murid.id_murid');
		$this->db->join('alamat','murid.id_alamat = alamat.id_alamat');
		$this->db->join('jurusan','murid.id_jurusan = jurusan.id_jurusan');
		$this->db->where('auth.id_murid', $id);
		return $this->db->get('auth');
	}

	public function CheckingMurid($data){
		$this->db->join('murid','auth.id_murid = murid.id_murid');
		$this->db->join('alamat','murid.id_alamat = alamat.id_alamat');
		$this->db->join('jurusan','murid.id_jurusan = jurusan.id_jurusan');
		return $this->db->get_where('auth', ['auth.nisn_murid' => $data]);
	}
	
	public function CheckingOrtu($data){
		$this->db->join('orang_tua','auth.id_orang_tua = orang_tua.id_orang_tua');
		$this->db->join('murid','orang_tua.id_murid = murid.id_murid');
		$this->db->join('alamat','murid.id_alamat = alamat.id_alamat');
		$this->db->join('jurusan','murid.id_jurusan = jurusan.id_jurusan');
		
		return $this->db->get_where('auth', ['auth.nisn_murid' => $data]);
	}	

	public function CheckingGuru($data){
		$this->db->join('guru','auth.id_guru = guru.id_guru');
		$this->db->join('alamat','guru.id_alamat = alamat.id_alamat');
		return $this->db->get_where('auth', ['auth.nip_guru' => $data]);
	}

	public function Tambah($tambah){
		return $this->db->insert('auth', $tambah);
	}

	public function Update($id,$data){
		$this->db->where('id_auth', $id);
		return $this->db->update('auth', $data);
	}

}