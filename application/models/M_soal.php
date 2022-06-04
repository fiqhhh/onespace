<?php 

class M_soal extends CI_Model {
	
	public function Tampil(){
		$this->db->order_by('id_soal','asc');
		$this->db->join('latihan','bank_soal.id_latihan = latihan.id_latihan');
		$this->db->join('kelas','latihan.id_kelas = kelas.id_kelas');
		$this->db->join('guru','kelas.id_guru = guru.id_guru');
		return $this->db->get('bank_soal');
	}	
	public function Checking($data){
		return $this->db->get_where('bank_soal', $data);
	}
	public function Tambah($tambah){
		return $this->db->insert('bank_soal', $tambah);
	}
	public function Update($id,$data){
		$this->db->where('id_soal', $id);
		return $this->db->update('bank_soal', $data);
	}	
	public function Delete($id){
		$this->db->where('id_soal', $id);
		return $this->db->delete('bank_soal');
	}

	public function DeleteLatihan($id){
		$this->db->where('id_latihan', $id);
		return $this->db->delete('bank_soal');
	}

}