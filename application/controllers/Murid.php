<?php

class Murid extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('nisn_murid') == "") {
			redirect('home');
		}
		$this->load->model('m_user');
		$this->load->model('m_tugas');
		$this->load->model('m_komentar');
		$this->load->model('m_murid');
		$this->load->model('m_soal');
		$this->load->model('m_guru');
		$this->load->model('m_hasil_tugas');
		$this->load->model('m_hasil_latihan');
		$this->load->model('m_alamat');
		$this->load->model('m_lampiran');
		$this->load->model('m_materi');
		$this->load->model('m_kelas');
		$this->load->model('m_latihan');
		$this->load->model('m_absen');
		$this->load->model('m_gabung_kelas');
	}
	public function index()
	{
		$data['title'] = "Dashboard - One Space";

		$data_murid = $this->session->userdata('nisn_murid');
		$data['murid'] = $this->m_user->CheckingMurid($data_murid)->row_array();

		$data['kelas'] = $this->m_gabung_kelas->CheckingMurid($data['murid']['id_murid'])->result();
		$data['absen_hari_ini'] = $this->m_absen->MuridMasukHariIni($data['murid']['id_murid'])->row_array();

		$this->load->view('user/murid/templates/header', $data);
		$this->load->view('user/murid/dashboard', $data);
		$this->load->view('user/murid/templates/footer');
	}
	public function gabung_kelas()
	{
		$this->_gabungProses();
	}
	private function _gabungProses()
	{
		$data_murid = $this->session->userdata('nisn_murid');
		$data['murid'] = $this->m_user->CheckingMurid($data_murid)->row_array();

		$token_kelas = $this->input->post('token_kelas');
		$id_murid = $data['murid']['id_murid'];

		$kelas = $this->m_kelas->Checking(['token_kelas' => $token_kelas])->row_array();

		if($kelas == null){
			$this->session->set_flashdata('message', '<div class="alert bg-red-200 px-6 py-4 mx-2 mb-5 rounded-md flex items-center mx-auto w-full"><svg viewBox="0 0 24 24" class="text-red-600 w-5 h-5 sm:w-5 sm:h-5 mr-3"><path fill="currentColor" d="M11.983,0a12.206,12.206,0,0,0-8.51,3.653A11.8,11.8,0,0,0,0,12.207,11.779,11.779,0,0,0,11.8,24h.214A12.111,12.111,0,0,0,24,11.791h0A11.766,11.766,0,0,0,11.983,0ZM10.5,16.542a1.476,1.476,0,0,1,1.449-1.53h.027a1.527,1.527,0,0,1,1.523,1.47,1.475,1.475,0,0,1-1.449,1.53h-.027A1.529,1.529,0,0,1,10.5,16.542ZM11,12.5v-6a1,1,0,0,1,2,0v6a1,1,0,1,1-2,0Z"></path></svg><span class="text-red-800"> Kode yang anda masukan salah! </span></div>');
			redirect('murid/');
		}else{

			$tambah = [
				'id_kelas' => $kelas['id_kelas'],
				'id_murid' => $id_murid
			];

			$checking = $this->m_gabung_kelas->Checking($tambah)->num_rows();

			if ($checking > 0) {
				$this->session->set_flashdata('message', '<div class="alert bg-yellow-100 px-6 py-4 mx-2 mb-5 rounded-md flex items-center mx-auto w-full"><svg viewBox="0 0 24 24" class="text-yellow-600 w-5 h-5 sm:w-5 sm:h-5 mr-3"><path fill="currentColor" d="M23.119,20,13.772,2.15h0a2,2,0,0,0-3.543,0L.881,20a2,2,0,0,0,1.772,2.928H21.347A2,2,0,0,0,23.119,20ZM11,8.423a1,1,0,0,1,2,0v6a1,1,0,1,1-2,0Zm1.05,11.51h-.028a1.528,1.528,0,0,1-1.522-1.47,1.476,1.476,0,0,1,1.448-1.53h.028A1.527,1.527,0,0,1,13.5,18.4,1.475,1.475,0,0,1,12.05,19.933Z"></path></svg><span class="text-yellow-800"> Anda sudah masuk kelas!</span></div>');
			} elseif($data['murid']['id_jurusan'] != $kelas['id_jurusan']){
				$this->session->set_flashdata('message', '<div class="alert bg-yellow-100 px-6 py-4 mx-2 mb-5 rounded-md flex items-center mx-auto w-full"><svg viewBox="0 0 24 24" class="text-yellow-600 w-5 h-5 sm:w-5 sm:h-5 mr-3"><path fill="currentColor" d="M23.119,20,13.772,2.15h0a2,2,0,0,0-3.543,0L.881,20a2,2,0,0,0,1.772,2.928H21.347A2,2,0,0,0,23.119,20ZM11,8.423a1,1,0,0,1,2,0v6a1,1,0,1,1-2,0Zm1.05,11.51h-.028a1.528,1.528,0,0,1-1.522-1.47,1.476,1.476,0,0,1,1.448-1.53h.028A1.527,1.527,0,0,1,13.5,18.4,1.475,1.475,0,0,1,12.05,19.933Z"></path></svg><span class="text-yellow-800"> Tidak bisa masuk kelas, berbeda jurusan!</span></div>');
			} elseif ($this->m_gabung_kelas->Tambah($tambah)) {
				$this->session->set_flashdata('message', '<div class="alert bg-green-200 px-6 py-4 mx-2 mb-5 rounded-md flex items-center mx-auto w-full"><svg viewBox="0 0 24 24" class="text-green-600 w-5 h-5 sm:w-5 sm:h-5 mr-3" ><path fill="currentColor" d="M12,0A12,12,0,1,0,24,12,12.014,12.014,0,0,0,12,0Zm6.927,8.2-6.845,9.289a1.011,1.011,0,0,1-1.43.188L5.764,13.769a1,1,0,1,1,1.25-1.562l4.076,3.261,6.227-8.451A1,1,0,1,1,18.927,8.2Z"></path></svg><span class="text-green-800">Berhasil masuk kelas!</span></div>');
			}
			redirect('murid/');
		}
	}

	// Absen Mapel

	public function absen_masuk_mapel($id)
	{
		$data['title'] = "Absen Mapel - One Space";

		$data_murid = $this->session->userdata('nisn_murid');
		$data['murid'] = $this->m_user->CheckingMurid($data_murid)->row_array();

		$where = ['id_kelas' => $id];
		$data['kelas'] = $this->m_kelas->CheckingAll($where)->row_array();

		$this->load->view('user/murid/templates/header', $data);
		$this->load->view('user/murid/absen/absen_mapel');
		$this->load->view('user/murid/templates/footer');
	}

	public function absen_masuk_mapel_proses()
	{
		$data_murid = $this->session->userdata('nisn_murid');
		$data['murid'] = $this->m_user->CheckingMurid($data_murid)->row_array();

		$id_kelas = $this->input->post('id_kelas');
		$id_murid = $this->input->post('id_murid');
		$nisn_murid = $this->input->post('nisn_murid');

		$data['kelas'] = $this->m_kelas->WhereKelas($id_kelas)->row_array();

		$tambah = [
			'id_kelas' => $id_kelas,
			'id_murid' => $id_murid,
			'nisn_murid' => $nisn_murid,
			'tgl_masuk_mapel' => date('Y-m-d'),
			'waktu_masuk_mapel' => time(),
			'status_absen' => 1
		];

		$data_check = ['id_kelas' => $id_kelas, 'id_murid' => $id_murid, 'tgl_masuk_mapel' => date('Y-m-d')];
		$checking = $this->m_absen->CheckingAbsenMapel($data_check)->num_rows();
		// var_dump($checking) or die;

		if ($nisn_murid != $data['murid']['nisn_murid']) {
			$this->session->set_flashdata('message', '<div class="alert bg-red-200 px-6 py-4 mt-5 mx-2 mb-5 rounded-md flex items-center mx-auto w-full"><svg viewBox="0 0 24 24" class="text-red-600 w-5 h-5 sm:w-5 sm:h-5 mr-3"><path fill="currentColor" d="M11.983,0a12.206,12.206,0,0,0-8.51,3.653A11.8,11.8,0,0,0,0,12.207,11.779,11.779,0,0,0,11.8,24h.214A12.111,12.111,0,0,0,24,11.791h0A11.766,11.766,0,0,0,11.983,0ZM10.5,16.542a1.476,1.476,0,0,1,1.449-1.53h.027a1.527,1.527,0,0,1,1.523,1.47,1.475,1.475,0,0,1-1.449,1.53h-.027A1.529,1.529,0,0,1,10.5,16.542ZM11,12.5v-6a1,1,0,0,1,2,0v6a1,1,0,1,1-2,0Z"></path></svg><span class="text-red-800"> Barcode anda salah! </span></div>');
		} elseif ($checking > 0) {
			$this->session->set_flashdata('message', '<div class="alert bg-blue-200 px-6 py-4 mt-5 mx-2 mb-5 rounded-md flex items-center mx-auto w-full"><svg viewBox="0 0 24 24" class="text-blue-600 w-5 h-5 sm:w-5 sm:h-5 mr-3"><path fill="currentColor" d="M12,0A12,12,0,1,0,24,12,12.013,12.013,0,0,0,12,0Zm.25,5a1.5,1.5,0,1,1-1.5,1.5A1.5,1.5,0,0,1,12.25,5ZM14.5,18.5h-4a1,1,0,0,1,0-2h.75a.25.25,0,0,0,.25-.25v-4.5a.25.25,0,0,0-.25-.25H10.5a1,1,0,0,1,0-2h1a2,2,0,0,1,2,2v4.75a.25.25,0,0,0,.25.25h.75a1,1,0,1,1,0,2Z"></path></svg><span class="text-blue-800">Anda sudah absen di mata pelajaran ' . $data['kelas']['nama_mapel'] . '</span></div>');
		} elseif ($this->m_absen->TambahAbsenMapel($tambah)) {
			$this->session->set_flashdata('message', '<div class="alert bg-green-200 px-6 py-4 mt-5 mx-2 mb-5 rounded-md flex items-center mx-auto w-full"><svg viewBox="0 0 24 24" class="text-green-600 w-5 h-5 sm:w-5 sm:h-5 mr-3" ><path fill="currentColor" d="M12,0A12,12,0,1,0,24,12,12.014,12.014,0,0,0,12,0Zm6.927,8.2-6.845,9.289a1.011,1.011,0,0,1-1.43.188L5.764,13.769a1,1,0,1,1,1.25-1.562l4.076,3.261,6.227-8.451A1,1,0,1,1,18.927,8.2Z"></path></svg><span class="text-green-800">Absen mata pelajaran ' . $data['kelas']['nama_mapel'] . ' berhasil!</span></div>');
		}
		redirect('murid/kelas/' . $id_kelas);
	}

	// Absen Harian
	public function absen_murid_masuk()
	{
		$data['title'] = "Absen Harian - One Space";
		
		$data_murid = $this->session->userdata('nisn_murid');
		$data['murid'] = $this->m_user->CheckingMurid($data_murid)->row_array();
		
		$this->load->view('user/murid/templates/header', $data);
		$this->load->view('user/murid/absen/absen_masuk'); 
		$this->load->view('user/murid/templates/footer');
	}
	public function absen_murid_masuk_proses()
	{
		$data_murid = $this->session->userdata('nisn_murid');
		$data['murid'] = $this->m_user->CheckingMurid($data_murid)->row_array();

		$nisn_murid = $this->input->post('nisn_murid');
		$id_murid = $this->input->post('id_murid');
		$lokasi_berada = $this->input->post('lokasi_berada');

		$tambah = [
			'nisn_murid' => $nisn_murid,
			'lokasi_berada' => $lokasi_berada,
			'id_murid'		=> $id_murid,
			'tgl_absen_masuk' => date('Y-m-d'),
			'wkt_absen_masuk' => time(),
			'tgl_absen_keluar' => null,
			'wkt_absen_keluar' => null,
			'status_absen' => 1
		];

		$data_check = ['id_murid' => $id_murid, 'tgl_absen_masuk' => date('Y-m-d')];
		$checking = $this->m_absen->CheckingAbsenMasuk($data_check)->num_rows();
		// var_dump($checking) or die;
		
		if($lokasi_berada == null){
			$this->session->set_flashdata('message', '<div class="alert bg-yellow-100 px-6 py-4 mx-2 mb-5 rounded-md flex items-center mx-auto w-full"><svg viewBox="0 0 24 24" class="text-yellow-600 w-5 h-5 sm:w-5 sm:h-5 mr-3"><path fill="currentColor" d="M23.119,20,13.772,2.15h0a2,2,0,0,0-3.543,0L.881,20a2,2,0,0,0,1.772,2.928H21.347A2,2,0,0,0,23.119,20ZM11,8.423a1,1,0,0,1,2,0v6a1,1,0,1,1-2,0Zm1.05,11.51h-.028a1.528,1.528,0,0,1-1.522-1.47,1.476,1.476,0,0,1,1.448-1.53h.028A1.527,1.527,0,0,1,13.5,18.4,1.475,1.475,0,0,1,12.05,19.933Z"></path></svg><span class="text-yellow-800"> Tidak bisa absen, aktifkan lokasi anda!</span></div>');
		}elseif ($nisn_murid != $data['murid']['nisn_murid']) {
			$this->session->set_flashdata('message', '<div class="alert bg-red-200 px-6 py-4 mx-2 mb-5 rounded-md flex items-center mx-auto w-full"><svg viewBox="0 0 24 24" class="text-red-600 w-5 h-5 sm:w-5 sm:h-5 mr-3"><path fill="currentColor" d="M11.983,0a12.206,12.206,0,0,0-8.51,3.653A11.8,11.8,0,0,0,0,12.207,11.779,11.779,0,0,0,11.8,24h.214A12.111,12.111,0,0,0,24,11.791h0A11.766,11.766,0,0,0,11.983,0ZM10.5,16.542a1.476,1.476,0,0,1,1.449-1.53h.027a1.527,1.527,0,0,1,1.523,1.47,1.475,1.475,0,0,1-1.449,1.53h-.027A1.529,1.529,0,0,1,10.5,16.542ZM11,12.5v-6a1,1,0,0,1,2,0v6a1,1,0,1,1-2,0Z"></path></svg><span class="text-red-800"> Barcode anda salah! </span></div>');
		} elseif ($checking > 0) {
			$this->session->set_flashdata('message', '<div class="alert bg-blue-200 px-6 py-4 mx-2 mb-5 rounded-md flex items-center mx-auto w-full"><svg viewBox="0 0 24 24" class="text-blue-600 w-5 h-5 sm:w-5 sm:h-5 mr-3"><path fill="currentColor" d="M12,0A12,12,0,1,0,24,12,12.013,12.013,0,0,0,12,0Zm.25,5a1.5,1.5,0,1,1-1.5,1.5A1.5,1.5,0,0,1,12.25,5ZM14.5,18.5h-4a1,1,0,0,1,0-2h.75a.25.25,0,0,0,.25-.25v-4.5a.25.25,0,0,0-.25-.25H10.5a1,1,0,0,1,0-2h1a2,2,0,0,1,2,2v4.75a.25.25,0,0,0,.25.25h.75a1,1,0,1,1,0,2Z"></path></svg><span class="text-blue-800">Anda hari ini sudah absen</span></div>');
		} elseif ($this->m_absen->TambahAbsenMasuk($tambah)) {
			$this->session->set_flashdata('message', '<div class="alert bg-green-200 px-6 py-4 mx-2 mb-5 rounded-md flex items-center mx-auto w-full"><svg viewBox="0 0 24 24" class="text-green-600 w-5 h-5 sm:w-5 sm:h-5 mr-3" ><path fill="currentColor" d="M12,0A12,12,0,1,0,24,12,12.014,12.014,0,0,0,12,0Zm6.927,8.2-6.845,9.289a1.011,1.011,0,0,1-1.43.188L5.764,13.769a1,1,0,1,1,1.25-1.562l4.076,3.261,6.227-8.451A1,1,0,1,1,18.927,8.2Z"></path></svg><span class="text-green-800">Absen hari ini berhasil!</span></div>');
		}
		redirect('murid/');
	}
	public function absen_keluar_masuk($id)
	{
		$where = ['id_absen_masuk' => $id];

		$data['absen_masuk'] = $this->m_absen->CheckingAbsenMasuk($where)->row_array();

		$data_absen = [
			'id_murid' => $data['absen_masuk']['id_murid'],
			'nisn_murid' => $data['absen_masuk']['nisn_murid'],
			'tgl_absen_masuk' => $data['absen_masuk']['tgl_absen_masuk'],
			'wkt_absen_masuk' => $data['absen_masuk']['wkt_absen_masuk'],
			'tgl_absen_keluar' => date('Y-m-d'),
			'wkt_absen_keluar' => time(),
			'status_absen' => 2
		];

		$this->m_absen->UpdateAbsenMasuk($id, $data_absen);
		$this->session->set_flashdata('message', '<div class="alert bg-green-200 px-6 py-4 mx-2 mb-5 rounded-md flex items-center mx-auto w-full"><svg viewBox="0 0 24 24" class="text-green-600 w-5 h-5 sm:w-5 sm:h-5 mr-3" ><path fill="currentColor" d="M12,0A12,12,0,1,0,24,12,12.014,12.014,0,0,0,12,0Zm6.927,8.2-6.845,9.289a1.011,1.011,0,0,1-1.43.188L5.764,13.769a1,1,0,1,1,1.25-1.562l4.076,3.261,6.227-8.451A1,1,0,1,1,18.927,8.2Z"></path></svg><span class="text-green-800">Absen keluar hari ini berhasil!</span></div>');
		redirect('murid/');
	}

	public function kelas($id)
	{
		$data['title'] = "Kelas - One Space";

		$data_murid = $this->session->userdata('nisn_murid');
		$data['murid'] = $this->m_user->CheckingMurid($data_murid)->row_array();

		$where = ['id_kelas' => $id];
		$data['kelas'] = $this->m_kelas->CheckingAll($where)->row_array();

		// Tampil Gambar Guru
		$data['tampil_guru'] = $this->m_user->TampilGuru($data['kelas']['id_guru'])->row_array();
		$data['detail_absen'] = $this->m_absen->TampilDetailAbsenMapel($id, $data['murid']['id_murid'])->result();
		$data['absen_hari_ini'] = $this->m_absen->MapelHariIni($data['murid']['id_murid'], $id)->row_array();

		$this->load->view('user/murid/templates/header', $data);
		$this->load->view('user/murid/kelas/kelas');
		$this->load->view('user/murid/templates/footer');
	}

	public function materi($id)
	{
		$data_murid = $this->session->userdata('nisn_murid');
		$data['murid'] = $this->m_user->CheckingMurid($data_murid)->row_array();

		$where = ['id_materi' => $id];
		$data['materi'] = $this->m_materi->CheckingAll($where)->row_array();

		$data['title'] = $data['materi']['nama_materi'] . " - Materi";

		$this->load->view('user/murid/templates/header', $data);
		$this->load->view('user/murid/kelas/materi');
		$this->load->view('user/murid/templates/footer');
	}

	public function tugas($id)
	{
		$data_murid = $this->session->userdata('nisn_murid');
		$data['murid'] = $this->m_user->CheckingMurid($data_murid)->row_array();

		$where = ['id_tugas' => $id];
		$data['tugas'] = $this->m_tugas->CheckingAll($where)->row_array();

		$data['title'] = $data['tugas']['nama_tugas'] . " - Tugas";

		$this->load->view('user/murid/templates/header', $data);
		$this->load->view('user/murid/kelas/tugas');
		$this->load->view('user/murid/templates/footer');
	}
	public function hapus_tugas($id)
	{
		$data = ['id_hasil_tugas' => $id];

		$hasil_tugas = $this->m_hasil_tugas->Checking($data)->row_array();

		$lampiran = $this->m_lampiran->WhereHasil($id)->result();

		if ($this->m_lampiran->DeleteHasil($id)){
			foreach($lampiran as $key){ unlink('./assets/admin/lampiran/'.$key->nama_lampiran); }
			$this->m_hasil_tugas->Delete($id);
			$this->session->set_flashdata('message', '<div class="alert bg-green-200 px-6 py-4 mx-2 mb-5 rounded-md flex items-center mx-auto w-full"><svg viewBox="0 0 24 24" class="text-green-600 w-5 h-5 sm:w-5 sm:h-5 mr-3" ><path fill="currentColor" d="M12,0A12,12,0,1,0,24,12,12.014,12.014,0,0,0,12,0Zm6.927,8.2-6.845,9.289a1.011,1.011,0,0,1-1.43.188L5.764,13.769a1,1,0,1,1,1.25-1.562l4.076,3.261,6.227-8.451A1,1,0,1,1,18.927,8.2Z"></path></svg><span class="text-green-800">Tugas berhasil dihapus, harap dikerjakan!</span></div>');
		}
		redirect('murid/tugas/' . $hasil_tugas['id_tugas']);
	}

	public function latihan($id)
	{
		$data_murid = $this->session->userdata('nisn_murid');
		$data['murid'] = $this->m_user->CheckingMurid($data_murid)->row_array();

		$where = ['id_latihan' => $id];
		$data['latihan'] = $this->m_latihan->CheckingAll($where)->row_array();

		$data['jumlah_soal'] = $this->m_soal->Checking($where)->num_rows();

		$data['title'] = $data['latihan']['nama_latihan'] . " - Latihan";

		$this->load->view('user/murid/templates/header', $data);
		$this->load->view('user/murid/kelas/latihan');
		$this->load->view('user/murid/templates/footer');
	}
	public function proses_latihan($id)
	{
		$data_murid = $this->session->userdata('nisn_murid');
		$data['murid'] = $this->m_user->CheckingMurid($data_murid)->row_array();

		$where = ['id_latihan' => $id];
		$data['latihan'] = $this->m_latihan->CheckingAll($where)->row_array();

		$data['title'] = $data['latihan']['nama_latihan'] . " - Latihan";

		$where_soal = ['id_latihan' => $data['latihan']['id_latihan']];
		$data['bank_soal_row'] = $this->m_soal->Checking($where_soal)->row_array();
		$data['bank_soal_result'] = $this->m_soal->Checking($where_soal)->result();
		$data['bank_soal_num'] = $this->m_soal->Checking($where_soal)->num_rows();

		$this->load->view('user/murid/templates/header', $data);
		$this->load->view('user/murid/kelas/proses_latihan');
		$this->load->view('user/murid/templates/footer');
	}
	public function submit_latihan()
	{
		$this->_submitLatihan();
	}
	private function _submitLatihan()
	{
		$id_latihan = $this->input->post('id_latihan');
		$id_murid = $this->input->post('id_murid');
		$point_bobot = $this->input->post('point_bobot');

		$where = ['id_latihan' => $id_latihan];
		$data['latihan'] = $this->m_latihan->Checking($where)->row_array();

		$where_soal = ['id_latihan' => $data['latihan']['id_latihan']];
		$result = $this->m_soal->Checking($where_soal)->result();
		$num_rows = $this->m_soal->Checking($where_soal)->num_rows();

		$tambah = [];

		foreach ($result as $key) {

			$jawaban = $this->input->post("jawaban" . "_" . $key->id_soal);

			$point_hasil = $data['latihan']['point_latihan'] / $num_rows;

			if ($data['latihan']['tipe_latihan'] == 1) {
				if ($key->kunci_jawaban != $jawaban) {
					$point_hasil = 0;
				} else {
					$point_hasil;
				}
			} else if ($data['latihan']['point_latihan'] == 2) {
				$point_hasil;
			}

			array_push($tambah, [
				'id_latihan' => $id_latihan,
				'id_soal' => $key->id_soal,
				'id_murid' => $id_murid,
				'jawaban' => $jawaban,
				'point_hasil' => $point_hasil,
				'point_bobot' => $point_bobot,
				'tgl_selesai' => date('Y-m-d H:i:s')
			]);
		}
		$checking = $this->m_hasil_latihan->CheckingSubmit($id_murid, $id_latihan)->num_rows();

		if ($checking > 0) {
			$this->session->set_flashdata('message', '<div class="alert bg-yellow-100 px-6 py-4 mx-2 mb-5 rounded-md flex items-center mx-auto w-full"><svg viewBox="0 0 24 24" class="text-yellow-600 w-5 h-5 sm:w-5 sm:h-5 mr-3"><path fill="currentColor" d="M23.119,20,13.772,2.15h0a2,2,0,0,0-3.543,0L.881,20a2,2,0,0,0,1.772,2.928H21.347A2,2,0,0,0,23.119,20ZM11,8.423a1,1,0,0,1,2,0v6a1,1,0,1,1-2,0Zm1.05,11.51h-.028a1.528,1.528,0,0,1-1.522-1.47,1.476,1.476,0,0,1,1.448-1.53h.028A1.527,1.527,0,0,1,13.5,18.4,1.475,1.475,0,0,1,12.05,19.933Z"></path></svg><span class="text-yellow-800"> Anda sudah mengisi ujian!</span></div>');
			redirect('murid/latihan/' . $id_latihan);
		} elseif ($this->m_hasil_latihan->TambahBatch($tambah)) {
			$this->session->set_flashdata('message', '<div class="alert bg-green-200 px-6 py-4 mx-2 mb-5 rounded-md flex items-center mx-auto w-full"><svg viewBox="0 0 24 24" class="text-green-600 w-5 h-5 sm:w-5 sm:h-5 mr-3" ><path fill="currentColor" d="M12,0A12,12,0,1,0,24,12,12.014,12.014,0,0,0,12,0Zm6.927,8.2-6.845,9.289a1.011,1.011,0,0,1-1.43.188L5.764,13.769a1,1,0,1,1,1.25-1.562l4.076,3.261,6.227-8.451A1,1,0,1,1,18.927,8.2Z"></path></svg><span class="text-green-800">Latihan berhasil dikerjakan!</span></div>');
			redirect('murid/latihan/' . $id_latihan);
		}
	}
	
	public function kirim_tugas()
	{
		$id_tugas = $this->input->post('id_tugas');
		$id_murid = $this->input->post('id_murid');

		$tambah_hasil = [
			'id_tugas' => $id_tugas,
			'id_murid' => $id_murid,
			'dikumpulkan_tugas' => date('Y-m-d H:i:s'),
			'diupdate_hasil' => date('Y-m-d H:i:s')
		];

		$data_check = ['id_murid' => $id_murid];
		$checking = $this->m_hasil_tugas->Checking($data_check)->row_array();

		if($checking > 0){
			$this->session->set_flashdata('message', '<div class="alert bg-yellow-100 px-6 py-4 mx-2 mb-5 rounded-md flex items-center mx-auto w-full"><svg viewBox="0 0 24 24" class="text-yellow-600 w-5 h-5 sm:w-5 sm:h-5 mr-3"><path fill="currentColor" d="M23.119,20,13.772,2.15h0a2,2,0,0,0-3.543,0L.881,20a2,2,0,0,0,1.772,2.928H21.347A2,2,0,0,0,23.119,20ZM11,8.423a1,1,0,0,1,2,0v6a1,1,0,1,1-2,0Zm1.05,11.51h-.028a1.528,1.528,0,0,1-1.522-1.47,1.476,1.476,0,0,1,1.448-1.53h.028A1.527,1.527,0,0,1,13.5,18.4,1.475,1.475,0,0,1,12.05,19.933Z"></path></svg><span class="text-yellow-800"> Anda sudah mengirim tugas!</span></div>');
		}elseif($this->m_hasil_tugas->Tambah($tambah_hasil)){

			$lampiran = count($_FILES['lampiran']['name']);

			for ($i = 0; $i < $lampiran; $i++) :

				$_FILES['file']['name'] = $_FILES['lampiran']['name'][$i];
				$_FILES['file']['type'] = $_FILES['lampiran']['type'][$i];
				$_FILES['file']['tmp_name'] = $_FILES['lampiran']['tmp_name'][$i];
				$_FILES['file']['size'] = $_FILES['lampiran']['size'][$i];

				$config['upload_path'] = './assets/admin/lampiran/';
				$config['allowed_types'] = 'png|jpg|jpeg|pdf|docx|pptx|xlsx';
				$config['max_size']	= '200000';
				$config['encrypt_name']	= TRUE;

				$this->load->library('upload', $config);
				$this->upload->initialize($config);

				if ($this->upload->do_upload('file')) {

					$fileData = $this->upload->data();

					$tambah[$i]['id_hasil_tugas'] = $this->db->insert_id();
					$tambah[$i]['nama_lampiran'] = $fileData['file_name'];

					$this->session->set_flashdata('message', '<div class="alert bg-green-200 px-6 py-4 mx-2 mb-5 rounded-md flex items-center mx-auto w-full"><svg viewBox="0 0 24 24" class="text-green-600 w-5 h-5 sm:w-5 sm:h-5 mr-3" ><path fill="currentColor" d="M12,0A12,12,0,1,0,24,12,12.014,12.014,0,0,0,12,0Zm6.927,8.2-6.845,9.289a1.011,1.011,0,0,1-1.43.188L5.764,13.769a1,1,0,1,1,1.25-1.562l4.076,3.261,6.227-8.451A1,1,0,1,1,18.927,8.2Z"></path></svg><span class="text-green-800">Tugas berhasil dikerjakan!</span></div>');
				}
			endfor;
			$this->m_lampiran->Tambah($tambah);
		}
		redirect('murid/tugas/' . $id_tugas);
	}
	
	public function kirim_komentar()
	{
		$id_kelas = $this->input->post('id_kelas');
		$id_materi = $this->input->post('id_materi');
		$id_tugas = $this->input->post('id_tugas');
		$id_latihan = $this->input->post('id_latihan');
		$id_murid = $this->input->post('id_murid');
		$isi_komentar = $this->input->post('isi_komentar');

		$tambah = [
			'id_materi' => $id_materi,
			'id_tugas' => $id_tugas,
			'id_latihan' => $id_latihan,
			'id_murid' => $id_murid,
			'isi_komentar' => $isi_komentar,
			'dibuat_komentar' => date('Y-m-d H:i:s')
		];

		$this->m_komentar->Tambah($tambah);
		redirect('murid/kelas/' . $id_kelas);
	}

	public function profile()
	{
		$data['title'] = "Profile - One Space";

		$data_murid = $this->session->userdata('nisn_murid');
		$data['murid'] = $this->m_user->CheckingMurid($data_murid)->row_array();

		$this->load->view('user/murid/templates/header', $data);
		$this->load->view('user/murid/profile/profile');
		$this->load->view('user/murid/templates/footer');
	}

	public function edit_profile($id)
	{
		$this->form_validation->set_rules('nama_murid', 'Nama Lengkap', 'required|trim');

		if ($this->form_validation->run() == FALSE) {
			$data['title'] = "Profile - One Space";

			$data_murid = $this->session->userdata('nisn_murid');
			$data['murid'] = $this->m_user->CheckingMurid($data_murid)->row_array();

			$where = ['id_murid' => $id];

			$data['edit_murid'] = $this->m_murid->CheckingAll($where)->row_array();

			$this->load->view('user/murid/templates/header', $data);
			$this->load->view('user/murid/profile/edit_profile');
			$this->load->view('user/murid/templates/footer');
		} else {

			// Murid
			$id_murid = $this->input->post('id_murid');
			$nama_murid = $this->input->post('nama_murid');
			$email_murid = $this->input->post('email_murid');
			$gender_murid = $this->input->post('gender_murid');
			$nisn_murid = $this->input->post('nisn_murid');
			$nis_murid = $this->input->post('nis_murid');
			$telepon_murid = $this->input->post('telepon_murid');
			$tempat_lahir_murid = $this->input->post('tempat_lahir_murid');
			$tanggal_lahir_murid = $this->input->post('tanggal_lahir_murid');
			$kelas_murid = $this->input->post('kelas_murid');
			$jurusan_murid = $this->input->post('jurusan_murid');
			$dibuat_murid = $this->input->post('dibuat_murid');

			// Alamat
			$id_alamat = $this->input->post('id_alamat');
			$alamat = $this->input->post('alamat');
			$kecamatan = $this->input->post('kecamatan');
			$kelurahan = $this->input->post('kelurahan');
			$kota = $this->input->post('kota');
			$provinsi = $this->input->post('provinsi');
			$kode_pos = $this->input->post('kode_pos');

			// Pengguna
			$id_auth = $this->input->post('id_auth');
			$old_foto_pengguna = $this->input->post('old_foto_pengguna');
			$tanggal_dibuat = $this->input->post('tanggal_dibuat');

			$config['upload_path']   = './assets/img/foto_pengguna/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['max_size'] = '20000';
			$config['overwrite'] = TRUE;

			$this->upload->initialize($config);

			if (!$this->upload->do_upload('foto_pengguna')) {

				$data_auth = [
					'foto_pengguna' => $old_foto_pengguna,
					'tanggal_dibuat' => $tanggal_dibuat
				];

				$data_murid = [
					'id_alamat' => $id_alamat,
					'nama_murid' => $nama_murid,
					'email_murid' => $email_murid,
					'nisn_murid' => $nisn_murid,
					'nis_murid' => $nis_murid,
					'kelas_murid' => $kelas_murid,
					'jurusan_murid' => $jurusan_murid,
					'tempat_lahir_murid' => $tempat_lahir_murid,
					'tanggal_lahir_murid' => $tanggal_lahir_murid,
					'gender_murid' => $gender_murid,
					'telepon_murid' => $telepon_murid,
					'dibuat_murid' => $dibuat_murid,
					'diupdate_murid' => date('Y-m-d H:i:s')
				];

				$data_alamat = [
					'alamat' => $alamat,
					'kecamatan' => $kecamatan,
					'kelurahan' => $kelurahan,
					'kota' => $kota,
					'provinsi' => $provinsi,
					'kode_pos' => $kode_pos
				];

				$this->m_murid->Update($id_murid, $data_murid);
				$this->m_alamat->Update($id_alamat, $data_alamat);
				$this->m_user->Update($id_auth, $data_auth);

				$this->session->set_flashdata('message', '<div class="alert bg-green-200 px-6 py-4 mt-5 mx-2 mb-5 rounded-md flex items-center mx-auto w-full"><svg viewBox="0 0 24 24" class="text-green-600 w-5 h-5 sm:w-5 sm:h-5 mr-3" ><path fill="currentColor" d="M12,0A12,12,0,1,0,24,12,12.014,12.014,0,0,0,12,0Zm6.927,8.2-6.845,9.289a1.011,1.011,0,0,1-1.43.188L5.764,13.769a1,1,0,1,1,1.25-1.562l4.076,3.261,6.227-8.451A1,1,0,1,1,18.927,8.2Z"></path></svg><span class="text-green-800">Profile berhasil diubah!</span></div>');
				redirect('murid/profile');
			} else {

				$data_auth = [
					'foto_pengguna' => $this->upload->data('file_name'),
					'tanggal_dibuat' => $tanggal_dibuat
				];

				$data_murid = [
					'id_alamat' => $id_alamat,
					'nama_murid' => $nama_murid,
					'email_murid' => $email_murid,
					'nisn_murid' => $nisn_murid,
					'nis_murid' => $nis_murid,
					'kelas_murid' => $kelas_murid,
					'jurusan_murid' => $jurusan_murid,
					'tempat_lahir_murid' => $tempat_lahir_murid,
					'tanggal_lahir_murid' => $tanggal_lahir_murid,
					'gender_murid' => $gender_murid,
					'telepon_murid' => $telepon_murid,
					'dibuat_murid' => $dibuat_murid,
					'diupdate_murid' => date('Y-m-d H:i:s')
				];

				$data_alamat = [
					'alamat' => $alamat,
					'kecamatan' => $kecamatan,
					'kelurahan' => $kelurahan,
					'kota' => $kota,
					'provinsi' => $provinsi,
					'kode_pos' => $kode_pos
				];

				$old_foto = $old_foto_pengguna;


				if ($old_foto != "default.jpg") {
					unlink(FCPATH . 'assets/img/foto_pengguna/' . $old_foto);
				}


				$this->m_murid->Update($id_murid, $data_murid);
				$this->m_alamat->Update($id_alamat, $data_alamat);
				$this->m_user->Update($id_auth, $data_auth);

				$this->session->set_flashdata('message', '<div class="alert bg-green-200 px-6 py-4 mt-5 mx-2 mb-5 rounded-md flex items-center mx-auto w-full"><svg viewBox="0 0 24 24" class="text-green-600 w-5 h-5 sm:w-5 sm:h-5 mr-3" ><path fill="currentColor" d="M12,0A12,12,0,1,0,24,12,12.014,12.014,0,0,0,12,0Zm6.927,8.2-6.845,9.289a1.011,1.011,0,0,1-1.43.188L5.764,13.769a1,1,0,1,1,1.25-1.562l4.076,3.261,6.227-8.451A1,1,0,1,1,18.927,8.2Z"></path></svg><span class="text-green-800">Profile berhasil diubah!</span></div>');
				redirect('murid/profile');
			}
		}
	}
	public function logout()
	{
		$this->session->sess_destroy();
		redirect('home/masuk');
	}
}
