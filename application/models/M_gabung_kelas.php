<?php 

class M_gabung_kelas extends CI_Model {
	
	public function Tampil(){
		$this->db->order_by('nama_kelas','asc');
		$this->db->join('kelas','gabung_kelas.id_kelas = kelas.id_kelas');
		$this->db->join('mapel','kelas.id_mapel = mapel.id_mapel');
		$this->db->join('guru','kelas.id_guru = guru.id_guru');
		$this->db->join('murid','gabung_kelas.id_murid = murid.id_murid');
		return $this->db->get('gabung_kelas');
	}
	
	public function CheckingAll($id_kelas){
		$this->db->order_by('nama_murid','asc');
		$this->db->join('kelas','gabung_kelas.id_kelas = kelas.id_kelas');
		$this->db->join('mapel','kelas.id_mapel = mapel.id_mapel');
		$this->db->join('guru','kelas.id_guru = guru.id_guru');
		$this->db->join('murid','gabung_kelas.id_murid = murid.id_murid');
		$this->db->where('kelas.id_kelas', $id_kelas);
		return $this->db->get_where('gabung_kelas');
	}

	public function CheckingMurid($id_murid){
		$this->db->order_by('nama_murid','asc');

		$this->db->join('murid','gabung_kelas.id_murid = murid.id_murid');
		$this->db->join('kelas','gabung_kelas.id_kelas = kelas.id_kelas');
		$this->db->join('mapel','kelas.id_mapel = mapel.id_mapel');
		$this->db->join('jurusan','kelas.id_jurusan = jurusan.id_jurusan');

		$this->db->join('guru','kelas.id_guru = guru.id_guru');

		$this->db->where('murid.id_murid', $id_murid);
		return $this->db->get_where('gabung_kelas');
	}

	public function Checking($data){
		return $this->db->get_where('gabung_kelas', $data);
	}
	public function Tambah($tambah){
		return $this->db->insert('gabung_kelas', $tambah);
	}
	public function Update($id,$data){
		$this->db->where('id_gabung_kelas', $id);
		return $this->db->update('gabung_kelas', $data);
	}	
	public function Delete($id){
		$this->db->where('id_gabung_kelas', $id);
		return $this->db->delete('gabung_kelas');
	}
	
	public function DeleteKelas($id){
		$this->db->where('id_kelas', $id);
		return $this->db->delete('gabung_kelas');
	}
	public function DeleteMurid($id){
		$this->db->where('id_murid', $id);
		return $this->db->delete('gabung_kelas');
	}

}