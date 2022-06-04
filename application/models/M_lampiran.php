<?php

class M_lampiran extends CI_Model
{
	
	// Tugas
	public function WhereTugas($id){
		$this->db->where('id_tugas', $id);
		return $this->db->get('lampiran');
	}
	public function DeleteTugas($id_tugas){
		$this->db->where('id_tugas', $id_tugas);
		return $this->db->delete('lampiran');
	}
	
	// Materi
	public function WhereMateri($id){
		$this->db->where('id_materi', $id);
		return $this->db->get('lampiran');
	}
	public function DeleteMateri($id_materi){
		$this->db->where('id_materi', $id_materi);
		return $this->db->delete('lampiran');
	}

	// Hasil Tugas
	public function WhereHasil($id){
		$this->db->where('id_hasil_tugas', $id);
		return $this->db->get('lampiran');
	}
	public function DeleteHasil($id_hasil_tugas){
		$this->db->where('id_hasil_tugas', $id_hasil_tugas);
		return $this->db->delete('lampiran');
	}

	// Default
	public function Checking($data){
		return $this->db->get_where('lampiran', $data);
	}
	public function Tambah($tambah = []){
		return $this->db->insert_batch('lampiran', $tambah);
	}
	public function Update($id, $data) {
		$this->db->where('id_lampiran', $id);
		return $this->db->update('lampiran', $data);
	}

}
