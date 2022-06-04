<?php 

class M_latihan extends CI_Model {
	
	public function Tampil(){
		$this->db->order_by('dibuat_latihan','desc');
		$this->db->join('kelas','latihan.id_kelas = kelas.id_kelas');
		$this->db->join('mapel','kelas.id_mapel = mapel.id_mapel');
		
		$this->db->join('guru','kelas.id_guru = guru.id_guru');
		return $this->db->get('latihan');
	}

	public function WhereKelas($id){
		$this->db->order_by('dibuat_latihan','desc');
		$this->db->join('kelas','latihan.id_kelas = kelas.id_kelas');
		$this->db->join('mapel','kelas.id_mapel = mapel.id_mapel');
		
		$this->db->join('guru','kelas.id_guru = guru.id_guru');
		$this->db->where('latihan.id_kelas',$id);
		return $this->db->get('latihan');
	}

	public function Checking($data){
		return $this->db->get_where('latihan', $data);
	}
	public function CheckingAll($data){
		$this->db->join('kelas','latihan.id_kelas = kelas.id_kelas');
		$this->db->join('mapel','kelas.id_mapel = mapel.id_mapel');
		
		$this->db->join('guru','kelas.id_guru = guru.id_guru');
		return $this->db->get_where('latihan', $data);
	}
	public function Tambah($tambah){
		return $this->db->insert('latihan', $tambah);
	}
	public function Update($id,$data){
		$this->db->where('id_latihan', $id);
		return $this->db->update('latihan', $data);
	}	
	public function Delete($id){
		$this->db->where('id_latihan', $id);
		return $this->db->delete('latihan');
	}

}