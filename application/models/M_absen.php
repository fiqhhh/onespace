<?php

class M_absen extends CI_Model {

	// Absen Mapel
	public function AbsenMasukMurid() 
	{
		$this->db->order_by('wkt_absen_masuk', 'desc');
		$this->db->join('murid', 'absen_masuk.id_murid = murid.id_murid');
		$this->db->join('jurusan','murid.id_jurusan = jurusan.id_jurusan');
		return $this->db->get('absen_masuk');
	}
	public function AbsenMasukGuru()
	{
		$this->db->order_by('wkt_absen_masuk', 'desc');
		$this->db->join('guru','absen_masuk.id_guru = guru.id_guru');
		return $this->db->get('absen_masuk');
	}
	public function AbsenMasukMuridHariIni() {
		$this->db->join('murid', 'absen_masuk.id_murid = murid.id_murid');
		$this->db->join('jurusan','murid.id_jurusan = jurusan.id_jurusan');
		$this->db->where('date_format(tgl_absen_masuk,"%Y-%m-%d")',date('Y-m-d'));
		return $this->db->get('absen_masuk');
	}

	public function AbsenMasukGuruHariIni() {
		$this->db->join('guru', 'absen_masuk.id_guru = guru.id_guru');
		$this->db->where('date_format(tgl_absen_masuk,"%Y-%m-%d")',date('Y-m-d'));
		return $this->db->get('absen_masuk');
	}
	
	public function MuridMasukHariIni($id) {
		$this->db->join('murid', 'absen_masuk.id_murid = murid.id_murid');
		$this->db->join('jurusan','murid.id_jurusan = jurusan.id_jurusan');
		$this->db->where('date_format(tgl_absen_masuk,"%Y-%m-%d")',date('Y-m-d'));
		$this->db->where('absen_masuk.id_murid', $id);
		return $this->db->get('absen_masuk');
	}

	public function GuruMasukHariIni($id) {
		$this->db->join('guru', 'absen_masuk.id_guru = guru.id_guru');
		$this->db->where('date_format(tgl_absen_masuk,"%Y-%m-%d")',date('Y-m-d'));
		$this->db->where('absen_masuk.id_guru', $id);
		return $this->db->get('absen_masuk');
	}


	public function TampilNgabsenMapel() 
	{
		$this->db->order_by('waktu_masuk_mapel', 'desc');
		$this->db->join('murid', 'absen_mapel.id_murid = murid.id_murid');
		$this->db->join('jurusan','murid.id_jurusan = jurusan.id_jurusan');
		$this->db->join('kelas','absen_mapel.id_kelas = kelas.id_kelas');
		return $this->db->get('absen_mapel');
	}
	public function TampilAbsenMapel($id)
	{
		$this->db->order_by('waktu_masuk_mapel', 'desc');
		$this->db->where('absen_mapel.id_murid', $id);
		$this->db->where('absen_mapel.status_absen', 1);
		return $this->db->get('absen_mapel');
	}

	public function MapelHariIni($id, $id_kelas){
		$this->db->join('murid', 'absen_mapel.id_murid = murid.id_murid');
		$this->db->join('jurusan','murid.id_jurusan = jurusan.id_jurusan');
		$this->db->where('date_format(tgl_masuk_mapel,"%Y-%m-%d")',date('Y-m-d'));
		$this->db->where('absen_mapel.id_murid', $id);
		$this->db->where('absen_mapel.id_kelas', $id_kelas);
		return $this->db->get('absen_mapel');
	}
	public function MapelHariIniGuru($id_kelas){
		$this->db->join('murid', 'absen_mapel.id_murid = murid.id_murid');
		$this->db->join('jurusan','murid.id_jurusan = jurusan.id_jurusan');
		$this->db->where('date_format(tgl_masuk_mapel,"%Y-%m-%d")',date('Y-m-d'));
		$this->db->where('absen_mapel.id_kelas', $id_kelas);
		return $this->db->get('absen_mapel');
	}

	public function TampilDetailAbsenMapel($id_kelas, $id_murid)
	{
		$this->db->order_by('waktu_masuk_mapel', 'desc');
		$this->db->join('kelas', 'absen_mapel.id_kelas = kelas.id_kelas');
		$this->db->join('jurusan', 'kelas.id_jurusan = jurusan.id_jurusan');
		$this->db->join('murid', 'absen_mapel.id_murid = murid.id_murid');
		$this->db->join('guru', 'kelas.id_guru = guru.id_guru');
		$this->db->where('absen_mapel.id_kelas', $id_kelas);
		$this->db->where('absen_mapel.id_murid', $id_murid);
		return $this->db->get('absen_mapel');
	}
	public function DetailMapelOrtu($id_murid)
	{
		$this->db->order_by('waktu_masuk_mapel', 'desc');
		$this->db->join('kelas', 'absen_mapel.id_kelas = kelas.id_kelas');
		$this->db->join('jurusan', 'kelas.id_jurusan = jurusan.id_jurusan');
		$this->db->join('murid', 'absen_mapel.id_murid = murid.id_murid');
		$this->db->join('guru', 'kelas.id_guru = guru.id_guru');
		$this->db->where('absen_mapel.id_murid', $id_murid);
		return $this->db->get('absen_mapel');
	}
	public function DetailMapelOrtuTgl($id_murid, $tgl)
	{
		$this->db->order_by('waktu_masuk_mapel', 'desc');
		$this->db->join('kelas', 'absen_mapel.id_kelas = kelas.id_kelas');
		$this->db->join('jurusan', 'kelas.id_jurusan = jurusan.id_jurusan');
		$this->db->join('murid', 'absen_mapel.id_murid = murid.id_murid');
		$this->db->join('guru', 'kelas.id_guru = guru.id_guru');
		$this->db->where('absen_mapel.id_murid', $id_murid);
		$this->db->where('absen_mapel.tgl_masuk_mapel', $tgl);
		return $this->db->get('absen_mapel');
	}

	public function TampilDetailMapelGuru($id_kelas) {
		$this->db->order_by('waktu_masuk_mapel', 'desc');
		$this->db->join('kelas', 'absen_mapel.id_kelas = kelas.id_kelas');
		$this->db->join('jurusan', 'kelas.id_jurusan = jurusan.id_jurusan');
		$this->db->join('murid', 'absen_mapel.id_murid = murid.id_murid');
		$this->db->join('guru', 'kelas.id_guru = guru.id_guru');
		$this->db->where('absen_mapel.id_kelas', $id_kelas);
		return $this->db->get('absen_mapel');
	}
	public function TampilDetailMapelTgl($id_kelas, $tgl)
	{
		$this->db->order_by('nama_murid', 'asc');
		$this->db->join('kelas', 'absen_mapel.id_kelas = kelas.id_kelas');
		$this->db->join('jurusan', 'kelas.id_jurusan = jurusan.id_jurusan');
		$this->db->join('murid', 'absen_mapel.id_murid = murid.id_murid');
		$this->db->join('guru', 'kelas.id_guru = guru.id_guru');
		$this->db->where('absen_mapel.id_kelas', $id_kelas);
		$this->db->where('absen_mapel.tgl_masuk_mapel', $tgl);
		return $this->db->get('absen_mapel');
	}
	public function CheckingAbsenMasuk($data)
	{
		return $this->db->get_where('absen_masuk', $data);
	}
	public function TambahAbsenMapel($tambah)
	{
		return $this->db->insert('absen_mapel', $tambah);
	}
	public function UpdateAbsenMapel($id, $data)
	{
		$this->db->where('id_absen_mapel', $id);
		return $this->db->update('absen_mapel', $data);
	}
	public function TampilAbsenMasukOrtu($id) {
		$this->db->order_by('wkt_absen_masuk', 'desc');
		$this->db->where('absen_masuk.id_murid', $id);
		return $this->db->get('absen_masuk');
	}
	public function AbsenMasukOrtuTgl($id){
		$this->db->order_by('wkt_absen_masuk', 'desc');
		$this->db->where('absen_masuk.id_murid', $id);
		$this->db->where('date_format(tgl_absen_masuk,"%Y-%m-%d")',date('Y-m-d'));
		return $this->db->get('absen_masuk');
	}
	public function TampilAbsenMasuk($id)
	{
		$this->db->order_by('wkt_absen_masuk', 'desc');
		$this->db->where('absen_masuk.id_murid', $id);
		$this->db->where('absen_masuk.status_absen', 1);
		return $this->db->get('absen_masuk');
	}
	public function TampilGuruMasuk($id)
	{
		$this->db->order_by('wkt_absen_masuk', 'desc');
		$this->db->where('absen_masuk.id_guru', $id);
		$this->db->where('absen_masuk.status_absen', 1);
		return $this->db->get('absen_masuk');
	}
	public function CheckingAbsenMapel($data)
	{
		return $this->db->get_where('absen_mapel', $data);
	}
	public function TambahAbsenMasuk($tambah)
	{
		return $this->db->insert('absen_masuk', $tambah);
	}
	public function UpdateAbsenMasuk($id, $data)
	{
		$this->db->where('id_absen_masuk', $id);
		return $this->db->update('absen_masuk', $data);
	}
}
