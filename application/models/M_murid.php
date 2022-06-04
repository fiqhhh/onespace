<?php

class M_murid extends CI_Model
{

	public function Tampil()
	{
		$this->db->order_by('kelas_murid', 'asc');
		$this->db->order_by('nama_murid', 'asc');
		$this->db->join('alamat', 'murid.id_alamat = alamat.id_alamat');
		$this->db->join('jurusan', 'murid.id_jurusan = jurusan.id_jurusan');
		return $this->db->get('murid');
	}
	public function CheckingAll($data)
	{
		$this->db->join('alamat', 'murid.id_alamat = alamat.id_alamat');
		$this->db->join('jurusan', 'murid.id_jurusan = jurusan.id_jurusan');
		return $this->db->get_where('murid', $data);
	}
	public function Checking($data)
	{
		return $this->db->get_where('murid', $data);
	}
	public function Tambah($tambah)
	{
		return $this->db->insert('murid', $tambah);
	}
	public function Update($id, $data)
	{
		$this->db->where('id_murid', $id);
		return $this->db->update('murid', $data);
	}
	public function Delete($id)
	{
		$this->db->where('id_murid', $id);
		return $this->db->delete('murid');
	}
}
