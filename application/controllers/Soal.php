<?php 

class Soal extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_soal');
	}

	public function update_soal()
	{
		$id_soal = $this->input->post('id_soal');

		$id_latihan = $this->input->post('id_latihan');
		$soal = $this->input->post('soal');
		$tipe_soal = $this->input->post('tipe_soal');
		$kunci_jawaban = $this->input->post('kunci_jawaban');
		$pilihan_a = $this->input->post('pilihan_a');
		$pilihan_b = $this->input->post('pilihan_b');
		$pilihan_c = $this->input->post('pilihan_c');
		$pilihan_d = $this->input->post('pilihan_d');
		$pilihan_e = $this->input->post('pilihan_e');
		$dibuat_soal = $this->input->post('dibuat_soal');

		if($pilihan_a == "") $pilihan_a = null;
		if($pilihan_b == "") $pilihan_b = null;
		if($pilihan_c == "") $pilihan_c = null;
		if($pilihan_d == "") $pilihan_d = null;
		if($pilihan_e == "") $pilihan_e = null;

		if($tipe_soal == "Essay"){
			$pilihan_a = null;
			$pilihan_b = null;
			$pilihan_d = null;
			$pilihan_e = null;
			$kunci_jawaban = null;
		}

		$data_soal = [
			'id_latihan' => $id_latihan,
			'soal' => $soal,
			'tipe_soal' => $tipe_soal,
			'kunci_jawaban' => $kunci_jawaban,
			'pilihan_a' => $pilihan_a,
			'pilihan_b' => $pilihan_b,
			'pilihan_c' => $pilihan_c,
			'pilihan_d' => $pilihan_d,
			'pilihan_e' => $pilihan_e,
			'dibuat_soal' => $dibuat_soal
		];
		
		$this->m_soal->Update($id_soal, $data_soal);
		$this->flasher->setFlash('Data berhasil diubah!','check-circle','success');
		redirect('admin/bank_soal');
	}

	public function delete_soal($id)
	{
		$data =['id_soal' => $id];

		if($this->m_soal->Delete($id)){
			$this->flasher->setFlash('Data berhasil dihapus!','check-circle','success');
		}else{
			$this->flasher->setFlash('Data gagal dihapus!','close-circle','success');
		}
		redirect('admin/bank_soal');
	}

}

?>