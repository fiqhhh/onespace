<?php 

class M_hasil_latihan extends CI_Model {
	
	public function Tampil(){
		$this->db->order_by('tgl_selesai','desc');

		$this->db->join('murid','hasil_latihan.id_murid = murid.id_murid');
		$this->db->join('alamat','murid.id_alamat = alamat.id_alamat');

		$this->db->join('bank_soal','hasil_latihan.id_soal = bank_soal.id_soal');

		$this->db->join('latihan','bank_soal.id_latihan = latihan.id_latihan');	
		$this->db->join('kelas','latihan.id_kelas = kelas.id_kelas');
		$this->db->join('mapel','kelas.id_mapel = mapel.id_mapel');

		$this->db->join('guru','kelas.id_guru = guru.id_guru');

		return $this->db->get('hasil_latihan');
	}

	public function NumMengerjakan($id_latihan){

		$this->db->group_by('hasil_latihan.id_latihan', $id_latihan);
		$this->db->where('hasil_latihan.id_latihan', $id_latihan);
		return $this->db->get('hasil_latihan');		

	}

	public function Checking($data){
		return $this->db->get_where('hasil_latihan', $data);
	}
	public function CheckingLatihan($id_latihan)
	{
		$this->db->join('murid','hasil_latihan.id_murid = murid.id_murid');

		$this->db->join('bank_soal','hasil_latihan.id_soal = bank_soal.id_soal');

		$this->db->join('latihan','bank_soal.id_latihan = latihan.id_latihan');	
		$this->db->join('kelas','latihan.id_kelas = kelas.id_kelas');
		$this->db->join('mapel','kelas.id_mapel = mapel.id_mapel');

		$this->db->join('guru','kelas.id_guru = guru.id_guru');

		return $this->db->get_where('hasil_latihan', ['hasil_latihan.id_latihan' => $id_latihan]);
	}
	public function CheckingLatihanMurid($id_latihan, $id_murid)
	{
		$this->db->join('murid','hasil_latihan.id_murid = murid.id_murid');

		$this->db->join('bank_soal','hasil_latihan.id_soal = bank_soal.id_soal');

		$this->db->join('latihan','bank_soal.id_latihan = latihan.id_latihan');	
		$this->db->join('kelas','latihan.id_kelas = kelas.id_kelas');
		$this->db->join('mapel','kelas.id_mapel = mapel.id_mapel');

		$this->db->join('guru','kelas.id_guru = guru.id_guru');

		$this->db->where('hasil_latihan.id_latihan' , $id_latihan);
		$this->db->where('hasil_latihan.id_murid' , $id_murid);

		return $this->db->get('hasil_latihan');

	}
	public function GroupLatihan($id_latihan){
		$this->db->group_by('hasil_latihan.id_latihan', $id_latihan);

		$this->db->join('murid','hasil_latihan.id_murid = murid.id_murid');

		$this->db->join('bank_soal','hasil_latihan.id_soal = bank_soal.id_soal');

		$this->db->join('latihan','bank_soal.id_latihan = latihan.id_latihan');	
		$this->db->join('kelas','latihan.id_kelas = kelas.id_kelas');
		$this->db->join('mapel','kelas.id_mapel = mapel.id_mapel');

		$this->db->join('guru','kelas.id_guru = guru.id_guru');
		
		return $this->db->get('hasil_latihan');		
	}
	public function WhereLatihan($id_latihan){
		$this->db->join('murid','hasil_latihan.id_murid = murid.id_murid');

		$this->db->join('bank_soal','hasil_latihan.id_soal = bank_soal.id_soal');

		$this->db->join('latihan','bank_soal.id_latihan = latihan.id_latihan');	
		$this->db->join('kelas','latihan.id_kelas = kelas.id_kelas');
		$this->db->join('mapel','kelas.id_mapel = mapel.id_mapel');

		$this->db->join('guru','kelas.id_guru = guru.id_guru');

		$this->db->where('hasil_latihan.id_latihan', $id_latihan);
		return $this->db->get('hasil_latihan');		
	}
	
	// Murid
	public function CheckingMurid($id_murid){
		$this->db->group_by('hasil_latihan.id_murid', $id_murid);

		$this->db->join('murid','hasil_latihan.id_murid = murid.id_murid');

		$this->db->join('bank_soal','hasil_latihan.id_soal = bank_soal.id_soal');

		$this->db->join('latihan','bank_soal.id_latihan = latihan.id_latihan');	
		$this->db->join('kelas','latihan.id_kelas = kelas.id_kelas');
		$this->db->join('mapel','kelas.id_mapel = mapel.id_mapel');

		$this->db->join('guru','kelas.id_guru = guru.id_guru');
		
		return $this->db->get('hasil_latihan', ['hasil_latihan.id_murid' => $id_murid]);
	}

	public function CheckingSubmit($id_murid,$id_latihan){
		$this->db->group_by('hasil_latihan.id_murid', $id_murid);

		$this->db->join('murid','hasil_latihan.id_murid = murid.id_murid');

		$this->db->join('bank_soal','hasil_latihan.id_soal = bank_soal.id_soal');

		$this->db->join('latihan','bank_soal.id_latihan = latihan.id_latihan');	
		$this->db->join('kelas','latihan.id_kelas = kelas.id_kelas');
		$this->db->join('mapel','kelas.id_mapel = mapel.id_mapel');

		$this->db->join('guru','kelas.id_guru = guru.id_guru');
		
		$this->db->where('hasil_latihan.id_murid', $id_murid );	
		$this->db->where('hasil_latihan.id_latihan', $id_latihan );
		
		return $this->db->get('hasil_latihan');
	}
	public function GroupMurid($id_murid){
		$this->db->group_by('hasil_latihan.id_murid', $id_murid);

		$this->db->join('murid','hasil_latihan.id_murid = murid.id_murid');

		$this->db->join('bank_soal','hasil_latihan.id_soal = bank_soal.id_soal');

		$this->db->join('latihan','bank_soal.id_latihan = latihan.id_latihan');	
		$this->db->join('kelas','latihan.id_kelas = kelas.id_kelas');
		$this->db->join('mapel','kelas.id_mapel = mapel.id_mapel');

		$this->db->join('guru','kelas.id_guru = guru.id_guru');
		
		return $this->db->get('hasil_latihan');
	}
	public function WhereMurid($id_murid, $id_latihan)
	{
		$this->db->order_by('tgl_selesai','desc');
		$this->db->group_by('hasil_latihan.id_murid', $id_murid);

		$this->db->join('murid','hasil_latihan.id_murid = murid.id_murid');

		$this->db->join('bank_soal','hasil_latihan.id_soal = bank_soal.id_soal');

		$this->db->join('latihan','bank_soal.id_latihan = latihan.id_latihan');	
		$this->db->join('kelas','latihan.id_kelas = kelas.id_kelas');
		$this->db->join('mapel','kelas.id_mapel = mapel.id_mapel');

		$this->db->join('guru','kelas.id_guru = guru.id_guru');
		
		$this->db->where('hasil_latihan.id_latihan', $id_latihan);
		return $this->db->get('hasil_latihan');
	}
	public function HasilMurid($id_murid, $id_latihan)
	{
		$this->db->join('murid','hasil_latihan.id_murid = murid.id_murid');

		$this->db->join('bank_soal','hasil_latihan.id_soal = bank_soal.id_soal');

		$this->db->join('latihan','bank_soal.id_latihan = latihan.id_latihan');	
		$this->db->join('kelas','latihan.id_kelas = kelas.id_kelas');
		$this->db->join('mapel','kelas.id_mapel = mapel.id_mapel');

		$this->db->join('guru','kelas.id_guru = guru.id_guru');
		
		$this->db->where('hasil_latihan.id_murid', $id_murid);
		$this->db->where('hasil_latihan.id_latihan', $id_latihan);
		return $this->db->get('hasil_latihan');
	}
	public function NilaiMurid($id_murid, $id_latihan)
	{
		$this->db->select_sum('point_hasil');
		$this->db->where('id_murid', $id_murid);
		$this->db->where('id_latihan', $id_latihan);
		return $this->db->get('hasil_latihan');
	}

	// Default
	public function Tambah($tambah){
		return $this->db->insert('hasil_latihan', $tambah);
	}
	public function TambahBatch($tambah){
		return $this->db->insert_batch('hasil_latihan', $tambah);
	}
	public function Update($id,$data){
		$this->db->where('id_hasil_latihan', $id);
		return $this->db->update('hasil_latihan', $data);
	}	
	public function Delete($id){
		$this->db->where('id_latihan', $id);
		return $this->db->delete('hasil_latihan');
	}

}