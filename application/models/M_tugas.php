<?php 

class M_tugas extends CI_Model {
	
	public function Tampil(){
		$this->db->order_by('dibuat_tugas','desc');
		$this->db->join('kelas','tugas.id_kelas = kelas.id_kelas');
		$this->db->join('mapel','kelas.id_mapel = mapel.id_mapel');

		$this->db->join('guru','kelas.id_guru = guru.id_guru');
		return $this->db->get('tugas');
	}
	public function WhereKelas($id){
		$this->db->order_by('dibuat_tugas','desc');
		$this->db->join('kelas','tugas.id_kelas = kelas.id_kelas');
		$this->db->join('mapel','kelas.id_mapel = mapel.id_mapel');

		$this->db->join('guru','kelas.id_guru = guru.id_guru');
		$this->db->where('tugas.id_kelas', $id);
		return $this->db->get('tugas');
	}
	public function Checking($data){
		return $this->db->get_where('tugas', $data);
	}
	public function CheckingAll($data){
		$this->db->join('kelas','tugas.id_kelas = kelas.id_kelas');
		$this->db->join('mapel','kelas.id_mapel = mapel.id_mapel');

		$this->db->join('guru','kelas.id_guru = guru.id_guru');
		return $this->db->get_where('tugas', $data);
	}

	public function Tambah($tambah){
		return $this->db->insert('tugas', $tambah);
	}
	public function Update($id,$data){
		$this->db->where('id_tugas', $id);
		return $this->db->update('tugas', $data);
	}	
	public function Delete($id){
		$this->db->where('id_tugas', $id);
		return $this->db->delete('tugas');
	}

}