<?php 

class M_kelas extends CI_Model {
	
	public function Tampil(){
		$this->db->order_by('nama_kelas','asc');
		$this->db->join('jurusan','kelas.id_jurusan = jurusan.id_jurusan');
		$this->db->join('mapel','kelas.id_mapel = mapel.id_mapel');
		$this->db->join('guru','kelas.id_guru = guru.id_guru');
		return $this->db->get('kelas');
	}
	public function Checking($data){
		return $this->db->get_where('kelas', $data);
	}
	public function Tambah($tambah){
		return $this->db->insert('kelas', $tambah);
	}
	public function Update($id,$data){
		$this->db->where('id_kelas', $id);
		return $this->db->update('kelas', $data);
	}	
	public function Delete($id){
		$this->db->where('id_kelas', $id);
		return $this->db->delete('kelas');
	}

	public function CheckingAll($data){
		$this->db->join('jurusan','kelas.id_jurusan = jurusan.id_jurusan');
		$this->db->join('mapel','kelas.id_mapel = mapel.id_mapel');
		$this->db->join('guru','kelas.id_guru = guru.id_guru');
		return $this->db->get_where('kelas', $data);
	}

	public function WhereKelas($id){
		$this->db->join('jurusan','kelas.id_jurusan = jurusan.id_jurusan');
		$this->db->join('mapel','kelas.id_mapel = mapel.id_mapel');
		$this->db->join('guru','kelas.id_guru = guru.id_guru');
		$this->db->where('kelas.id_kelas', $id);
		return $this->db->get('kelas');
	}

	public function WhereGuru($id){
		$this->db->order_by('dibuat_kelas','desc');
		$this->db->join('jurusan','kelas.id_jurusan = jurusan.id_jurusan');
		$this->db->join('mapel','kelas.id_mapel = mapel.id_mapel');
		$this->db->join('guru','kelas.id_guru = guru.id_guru');
		$this->db->where('guru.id_guru', $id);
		return $this->db->get('kelas');
	}

}