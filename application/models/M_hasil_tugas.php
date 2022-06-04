<?php 

class M_hasil_tugas extends CI_Model {
	
	public function Tampil(){
		$this->db->order_by('dikumpulkan_tugas','desc');

		$this->db->join('murid','hasil_tugas.id_murid = murid.id_murid');
		$this->db->join('alamat','murid.id_alamat = alamat.id_alamat');
		
		$this->db->join('tugas','hasil_tugas.id_tugas = tugas.id_tugas');
		$this->db->join('kelas','tugas.id_kelas = kelas.id_kelas');
		$this->db->join('mapel','kelas.id_mapel = mapel.id_mapel');
		$this->db->join('guru','kelas.id_guru = guru.id_guru');
		
		return $this->db->get('hasil_tugas');
	}

	public function WhereHasilTugas($id_murid, $id_kelas){
		$this->db->order_by('dikumpulkan_tugas','desc');

		$this->db->join('murid','hasil_tugas.id_murid = murid.id_murid');
		$this->db->join('alamat','murid.id_alamat = alamat.id_alamat');
		
		$this->db->join('tugas','hasil_tugas.id_tugas = tugas.id_tugas');
		$this->db->join('kelas','tugas.id_kelas = kelas.id_kelas');
		$this->db->join('guru','kelas.id_guru = guru.id_guru');

		$this->db->where('hasil_tugas.id_murid', $id_murid);
		$this->db->where('kelas.id_kelas', $id_kelas);
		
		return $this->db->get('hasil_tugas');
	}

	public function CheckingAll($id_tugas){
		$this->db->order_by('dikumpulkan_tugas','desc');
		$this->db->join('murid','hasil_tugas.id_murid = murid.id_murid');
		$this->db->join('alamat','murid.id_alamat = alamat.id_alamat');
		
		$this->db->join('tugas','hasil_tugas.id_tugas = tugas.id_tugas');
		$this->db->join('kelas','tugas.id_kelas = kelas.id_kelas');
		$this->db->join('jurusan','kelas.id_kelas = jurusan.id_jurusan');
		$this->db->join('guru','kelas.id_guru = guru.id_guru');

		$this->db->where('hasil_tugas.id_tugas', $id_tugas);
		return $this->db->get_where('hasil_tugas');
	}
	public function CheckingAllMurid($id_tugas,$id_murid){
		$this->db->order_by('dikumpulkan_tugas','desc');
		$this->db->join('murid','hasil_tugas.id_murid = murid.id_murid');
		$this->db->join('alamat','murid.id_alamat = alamat.id_alamat');
		
		$this->db->join('tugas','hasil_tugas.id_tugas = tugas.id_tugas');
		$this->db->join('kelas','tugas.id_kelas = kelas.id_kelas');
		$this->db->join('jurusan','kelas.id_kelas = jurusan.id_jurusan');
		$this->db->join('guru','kelas.id_guru = guru.id_guru');

		$this->db->where('hasil_tugas.id_tugas', $id_tugas);
		$this->db->where('hasil_tugas.id_murid', $id_murid);
		return $this->db->get_where('hasil_tugas');
	}

	public function Checking($data){
		return $this->db->get_where('hasil_tugas', $data);
	}
	public function Tambah($tambah){
		return $this->db->insert('hasil_tugas', $tambah);
	}
	public function Update($id,$data){
		$this->db->where('id_hasil_tugas', $id);
		return $this->db->update('hasil_tugas', $data);
	}	
	public function Delete($id){
		$this->db->where('id_hasil_tugas', $id);
		return $this->db->delete('hasil_tugas');
	}

	public function DeleteTugas($id_tugas){
		$this->db->where('id_tugas', $id_tugas);
		return $this->db->delete('hasil_tugas');
	}

}