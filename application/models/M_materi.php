<?php 

class M_materi extends CI_Model {
	
	public function Tampil(){
		$this->db->order_by('dibuat_materi','desc');
		$this->db->join('kelas','materi.id_kelas = kelas.id_kelas');
		$this->db->join('mapel','kelas.id_mapel = mapel.id_mapel');
		
		$this->db->join('guru','kelas.id_guru = guru.id_guru');
		return $this->db->get('materi');
	}
	public function WhereKelas($id){
		$this->db->order_by('dibuat_materi','desc');
		$this->db->join('kelas','materi.id_kelas = kelas.id_kelas');
		$this->db->join('mapel','kelas.id_mapel = mapel.id_mapel');
		
		$this->db->join('guru','kelas.id_guru = guru.id_guru');
		$this->db->where('materi.id_kelas', $id);
		return $this->db->get('materi');
	}
	public function Checking($data){
		return $this->db->get_where('materi', $data);
	}
	public function CheckingAll($data){
		$this->db->order_by('dibuat_materi','desc');
		$this->db->join('kelas','materi.id_kelas = kelas.id_kelas');
		$this->db->join('mapel','kelas.id_mapel = mapel.id_mapel');
		
		$this->db->join('guru','kelas.id_guru = guru.id_guru');
		return $this->db->get_where('materi', $data);
	}
	public function Tambah($tambah){
		return $this->db->insert('materi', $tambah);
	}
	public function Update($id,$data){
		$this->db->where('id_materi', $id);
		return $this->db->update('materi', $data);
	}	
	public function Delete($id){
		$this->db->where('id_materi', $id);
		return $this->db->delete('materi');
	}

}