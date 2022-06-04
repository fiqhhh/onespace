<?php 

class M_komentar extends CI_Model {
    
    public function TampilMateriAdmin()
	{
		$this->db->order_by('dibuat_komentar','desc');

		$this->db->join('murid','komentar.id_murid = murid.id_murid');
		$this->db->join('alamat','murid.id_alamat = alamat.id_alamat');
		
		$this->db->join('materi','komentar.id_materi = materi.id_materi');
		$this->db->join('kelas','materi.id_kelas = kelas.id_kelas');
		$this->db->join('mapel','kelas.id_mapel = mapel.id_mapel');
		
		$this->db->join('guru','kelas.id_guru = guru.id_guru');

		return $this->db->get('komentar');
	}
	public function TampilTugasAdmin()
	{
		$this->db->order_by('dibuat_komentar','desc');

		$this->db->join('murid','komentar.id_murid = murid.id_murid');
		$this->db->join('alamat','murid.id_alamat = alamat.id_alamat');
		
		$this->db->join('tugas','komentar.id_tugas = tugas.id_tugas');
		$this->db->join('kelas','tugas.id_kelas = kelas.id_kelas');
		$this->db->join('guru','kelas.id_guru = guru.id_guru');

		return $this->db->get('komentar');
	}

	// Materi
	public function TampilMateri($id){
		$this->db->order_by('dibuat_komentar','desc');

		$this->db->join('murid','komentar.id_murid = murid.id_murid');
		$this->db->join('alamat','murid.id_alamat = alamat.id_alamat');
		
		$this->db->join('materi','komentar.id_materi = materi.id_materi');
		$this->db->join('kelas','materi.id_kelas = kelas.id_kelas');
		$this->db->join('mapel','kelas.id_mapel = mapel.id_mapel');
		
		$this->db->join('guru','kelas.id_guru = guru.id_guru');
		
		$this->db->where('materi.id_materi',$id);

		return $this->db->get('komentar');
	}

	public function TampilPenggunaMateri($id){
		$this->db->limit(1);
		$this->db->order_by('dibuat_komentar','desc');
		
		$this->db->join('murid','komentar.id_murid = murid.id_murid');
		$this->db->join('alamat','murid.id_alamat = alamat.id_alamat');
		
		$this->db->join('materi','komentar.id_materi = materi.id_materi');
		$this->db->join('kelas','materi.id_kelas = kelas.id_kelas');
		$this->db->join('mapel','kelas.id_mapel = mapel.id_mapel');
		
		$this->db->join('guru','kelas.id_guru = guru.id_guru');

		$this->db->where('materi.id_materi',$id);

		return $this->db->get('komentar');
	}
	
	// Tugas
	public function TampilTugas($id){
		$this->db->order_by('dibuat_komentar','desc');
		
		$this->db->join('murid','komentar.id_murid = murid.id_murid');
		$this->db->join('alamat','murid.id_alamat = alamat.id_alamat');
		
		$this->db->join('tugas','komentar.id_tugas = tugas.id_tugas');
		$this->db->join('kelas','tugas.id_kelas = kelas.id_kelas');
		$this->db->join('guru','kelas.id_guru = guru.id_guru');

		$this->db->where('tugas.id_tugas',$id);

		return $this->db->get('komentar');
	}
	public function TampilPenggunaTugas($id){
		$this->db->limit(1);
		$this->db->order_by('dibuat_komentar','desc');

		$this->db->join('murid','komentar.id_murid = murid.id_murid');
		$this->db->join('alamat','murid.id_alamat = alamat.id_alamat');
		
		$this->db->join('tugas','komentar.id_tugas = tugas.id_tugas');
		$this->db->join('kelas','tugas.id_kelas = kelas.id_kelas');
		$this->db->join('guru','kelas.id_guru = guru.id_guru');

		$this->db->where('tugas.id_tugas',$id);

		return $this->db->get('komentar');
	}

	// Latihan
	public function TampilLatihan($id){
		$this->db->order_by('dibuat_komentar','desc');
		
		$this->db->join('murid','komentar.id_murid = murid.id_murid');
		$this->db->join('alamat','murid.id_alamat = alamat.id_alamat');
		
		$this->db->join('latihan','komentar.id_latihan = latihan.id_latihan');
		$this->db->join('kelas','latihan.id_kelas = kelas.id_kelas');
		$this->db->join('guru','kelas.id_guru = guru.id_guru');

		$this->db->where('latihan.id_latihan', $id);
		return $this->db->get('komentar');
	}
	public function TampilPenggunaLatihan($id){
		$this->db->limit(1);
		$this->db->order_by('dibuat_komentar','desc');

		$this->db->join('murid','komentar.id_murid = murid.id_murid');
		$this->db->join('alamat','murid.id_alamat = alamat.id_alamat');
		
		$this->db->join('latihan','komentar.id_latihan = latihan.id_latihan');
		$this->db->join('kelas','latihan.id_kelas = kelas.id_kelas');
		$this->db->join('guru','kelas.id_guru = guru.id_guru');

		$this->db->where('latihan.id_latihan', $id);
		return $this->db->get('komentar');
	}

	public function Checking($data){
		return $this->db->get_where('komentar', $data);
	}

	public function CheckingAll($data){
		$this->db->join('murid','komentar.id_murid = murid.id_murid');
		$this->db->join('alamat','murid.id_alamat = alamat.id_alamat');
		
		$this->db->join('materi','komentar.id_materi = materi.id_materi');
		$this->db->join('kelas','materi.id_kelas = kelas.id_kelas');
		$this->db->join('mapel','kelas.id_mapel = mapel.id_mapel');
		
		$this->db->join('guru','kelas.id_guru = guru.id_guru');
		return $this->db->get_where('komentar', $data);
	}

	public function Tambah($tambah){
		return $this->db->insert('komentar', $tambah);
	}
	public function Update($id,$data){
		$this->db->where('id_komentar', $id);
		return $this->db->update('komentar', $data);
	}	
	public function Delete($id){
		$this->db->where('id_komentar', $id);
		return $this->db->delete('komentar');
	}

}