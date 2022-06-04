<?php

class M_guru extends CI_Model
{

	public function Tampil()
	{
		$this->db->order_by('nama_guru', 'asc');
		$this->db->join('alamat', 'guru.id_alamat = alamat.id_alamat');
		return $this->db->get('guru');
	}
	public function CheckingAll($data)
	{
		$this->db->join('alamat', 'guru.id_alamat = alamat.id_alamat');
		return $this->db->get_where('guru', $data);
	}
	public function Checking($data)
	{
		return $this->db->get_where('guru', $data);
	}
	public function Tambah($tambah)
	{
		return $this->db->insert('guru', $tambah);
	}
	public function Update($id, $data)
	{
		$this->db->where('id_guru', $id);
		return $this->db->update('guru', $data);
	}
	public function Delete($id)
	{
		$this->db->where('id_guru', $id);
		return $this->db->delete('guru');
	}
}
