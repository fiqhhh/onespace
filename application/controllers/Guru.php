<?php

class Guru extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('nip_guru') == "") {
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
		$this->load->model('m_jurusan');
		$this->load->model('m_mapel');
		$this->load->model('m_absen');
		$this->load->model('m_gabung_kelas');
	}
	public function index()
	{
		$data['title'] = "Selamat Datang di One Space - One Space";

		$data_guru = $this->session->userdata('nip_guru');
		$data['guru'] = $this->m_user->CheckingGuru($data_guru)->row_array();

		$data['kelas'] = $this->m_kelas->WhereGuru($data['guru']['id_guru'])->result();
		$data['absen_hari_ini'] = $this->m_absen->GuruMasukHariIni($data['guru']['id_guru'])->row_array();

		$this->load->view('user/guru/templates/header', $data);
		$this->load->view('user/guru/dashboard');
		$this->load->view('user/guru/templates/footer');
	}

	public function absen_guru_masuk()
	{
		$data['title'] = "Absen Harian - One Space";
		
		$data_guru = $this->session->userdata('nip_guru');
		$data['guru'] = $this->m_user->CheckingGuru($data_guru)->row_array();

		$this->load->view('user/guru/templates/header', $data);
		$this->load->view('user/guru/absen/absen_masuk');
		$this->load->view('user/guru/templates/footer');
	}
	public function absen_guru_masuk_proses()
	{
		$data_guru = $this->session->userdata('nip_guru');
		$data['guru'] = $this->m_user->CheckingGuru($data_guru)->row_array();

		$nip_guru = $this->input->post('nip_guru');
		$id_guru = $this->input->post('id_guru');
		$lokasi_berada = $this->input->post('lokasi_berada');

		$tambah = [
			'nip_guru' => $nip_guru,
			'lokasi_berada' => $lokasi_berada,
			'id_guru'		=> $id_guru,
			'tgl_absen_masuk' => date('Y-m-d H:i:s'),
			'wkt_absen_masuk' => time(),
			'tgl_absen_keluar' => null,
			'wkt_absen_keluar' => null,
			'status_absen' => 1
		];

		$data_check = ['id_guru' => $id_guru, 'tgl_absen_masuk' => date('Y-m-d')];
		$checking = $this->m_absen->CheckingAbsenMasuk($data_check)->num_rows();
		// var_dump($checking) or die;
		if($lokasi_berada == null){
			$this->session->set_flashdata('message', '<div class="alert bg-yellow-100 px-6 py-4 mx-2 mb-5 rounded-md flex items-center mx-auto w-full"><svg viewBox="0 0 24 24" class="text-yellow-600 w-5 h-5 sm:w-5 sm:h-5 mr-3"><path fill="currentColor" d="M23.119,20,13.772,2.15h0a2,2,0,0,0-3.543,0L.881,20a2,2,0,0,0,1.772,2.928H21.347A2,2,0,0,0,23.119,20ZM11,8.423a1,1,0,0,1,2,0v6a1,1,0,1,1-2,0Zm1.05,11.51h-.028a1.528,1.528,0,0,1-1.522-1.47,1.476,1.476,0,0,1,1.448-1.53h.028A1.527,1.527,0,0,1,13.5,18.4,1.475,1.475,0,0,1,12.05,19.933Z"></path></svg><span class="text-yellow-800"> Tidak bisa absen, aktifkan lokasi anda!</span></div>');
		}elseif ($nip_guru != $data['guru']['nip_guru']) {
			$this->session->set_flashdata('message', '<div class="alert bg-red-200 px-6 py-4 mx-2 mb-5 rounded-md flex items-center mx-auto w-full"><svg viewBox="0 0 24 24" class="text-red-600 w-5 h-5 sm:w-5 sm:h-5 mr-3"><path fill="currentColor" d="M11.983,0a12.206,12.206,0,0,0-8.51,3.653A11.8,11.8,0,0,0,0,12.207,11.779,11.779,0,0,0,11.8,24h.214A12.111,12.111,0,0,0,24,11.791h0A11.766,11.766,0,0,0,11.983,0ZM10.5,16.542a1.476,1.476,0,0,1,1.449-1.53h.027a1.527,1.527,0,0,1,1.523,1.47,1.475,1.475,0,0,1-1.449,1.53h-.027A1.529,1.529,0,0,1,10.5,16.542ZM11,12.5v-6a1,1,0,0,1,2,0v6a1,1,0,1,1-2,0Z"></path></svg><span class="text-red-800"> Barcode anda salah!. </span></div>');
		} elseif ($checking > 0) {
			$this->session->set_flashdata('message', '<div class="alert bg-blue-200 px-6 py-4 mx-2 mb-5 rounded-md flex items-center mx-auto w-full"><svg viewBox="0 0 24 24" class="text-blue-600 w-5 h-5 sm:w-5 sm:h-5 mr-3"><path fill="currentColor" d="M12,0A12,12,0,1,0,24,12,12.013,12.013,0,0,0,12,0Zm.25,5a1.5,1.5,0,1,1-1.5,1.5A1.5,1.5,0,0,1,12.25,5ZM14.5,18.5h-4a1,1,0,0,1,0-2h.75a.25.25,0,0,0,.25-.25v-4.5a.25.25,0,0,0-.25-.25H10.5a1,1,0,0,1,0-2h1a2,2,0,0,1,2,2v4.75a.25.25,0,0,0,.25.25h.75a1,1,0,1,1,0,2Z"></path></svg><span class="text-blue-800">Anda hari ini sudah absen</span></div>');
		} elseif ($this->m_absen->TambahAbsenMasuk($tambah)) {
			$this->session->set_flashdata('message', '<div class="alert bg-green-200 px-6 py-4 mx-2 mb-5 rounded-md flex items-center mx-auto w-full"><svg viewBox="0 0 24 24" class="text-green-600 w-5 h-5 sm:w-5 sm:h-5 mr-3" ><path fill="currentColor" d="M12,0A12,12,0,1,0,24,12,12.014,12.014,0,0,0,12,0Zm6.927,8.2-6.845,9.289a1.011,1.011,0,0,1-1.43.188L5.764,13.769a1,1,0,1,1,1.25-1.562l4.076,3.261,6.227-8.451A1,1,0,1,1,18.927,8.2Z"></path></svg><span class="text-green-800">Absen hari ini berhasil!</span></div>');
		}
		redirect('guru/');
	}
	public function absen_guru_keluar($id)
	{
		$where = ['id_absen_masuk' => $id];

		$data['absen_masuk'] = $this->m_absen->CheckingAbsenMasuk($where)->row_array();

		$data_absen = [
			'id_guru' => $data['absen_masuk']['id_guru'],
			'nisn_murid' => $data['absen_masuk']['nisn_murid'],
			'tgl_absen_masuk' => $data['absen_masuk']['tgl_absen_masuk'],
			'wkt_absen_masuk' => $data['absen_masuk']['wkt_absen_masuk'],
			'tgl_absen_keluar' => date('Y-m-d'),
			'wkt_absen_keluar' => time(),
			'status_absen' => 2
		];

		$this->m_absen->UpdateAbsenMasuk($id, $data_absen);
		$this->session->set_flashdata('message', '<div class="alert bg-green-200 px-6 py-4 mx-2 mb-5 rounded-md flex items-center mx-auto w-full"><svg viewBox="0 0 24 24" class="text-green-600 w-5 h-5 sm:w-5 sm:h-5 mr-3" ><path fill="currentColor" d="M12,0A12,12,0,1,0,24,12,12.014,12.014,0,0,0,12,0Zm6.927,8.2-6.845,9.289a1.011,1.011,0,0,1-1.43.188L5.764,13.769a1,1,0,1,1,1.25-1.562l4.076,3.261,6.227-8.451A1,1,0,1,1,18.927,8.2Z"></path></svg><span class="text-green-800">Absen keluar hari ini berhasil!</span></div>');
		redirect('guru/');
	}
	public function profile()
	{
		$data['title'] = "Profile - One Space";

		$data_guru = $this->session->userdata('nip_guru');
		$data['guru'] = $this->m_user->CheckingGuru($data_guru)->row_array();

		$this->load->view('user/guru/templates/header', $data);
		$this->load->view('user/guru/profile/profile');
		$this->load->view('user/guru/templates/footer');
	}
	public function edit_profile($id)
	{
		$this->form_validation->set_rules('nama_guru', 'Nama Guru', 'required|trim');

		if ($this->form_validation->run() == FALSE) {
			$data['title'] = "Profile - One Space";

			$data_guru = $this->session->userdata('nip_guru');
			$data['guru'] = $this->m_user->CheckingGuru($data_guru)->row_array();

			$where = ['id_guru' => $id];

			$data['edit_guru'] = $this->m_guru->CheckingAll($where)->row_array();

			$this->load->view('user/guru/templates/header', $data);
			$this->load->view('user/guru/profile/edit_profile');
			$this->load->view('user/guru/templates/footer');
		} else {

			$id_guru = $this->input->post('id_guru');
			$nama_guru = $this->input->post('nama_guru');
			$nip_guru = $this->input->post('nip_guru');
			$email_guru = $this->input->post('email_guru');
			$gender_guru = $this->input->post('gender_guru');
			$tempat_lahir_guru = $this->input->post('tempat_lahir_guru');
			$tanggal_lahir_guru = $this->input->post('tanggal_lahir_guru');
			$telepon_guru = $this->input->post('telepon_guru');
			$gelar_guru = $this->input->post('gelar_guru');
			$dibuat_guru = $this->input->post('dibuat_guru');

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

				$data_guru = [
					'id_alamat' => $id_alamat,
					'nama_guru' => $nama_guru,
					'nip_guru' => $nip_guru,
					'email_guru' => $email_guru,
					'tempat_lahir_guru' => $tempat_lahir_guru,
					'tanggal_lahir_guru' => date('Y-m-d', strtotime($tanggal_lahir_guru)),
					'gender_guru' => $gender_guru,
					'telepon_guru' => $telepon_guru,
					'gelar_guru' => $gelar_guru,
					'dibuat_guru' => $dibuat_guru,
					'diupdate_guru' => date('Y-m-d H:i:s')
				];

				$data_alamat = [
					'alamat' => $alamat,
					'kecamatan' => $kecamatan,
					'kelurahan' => $kelurahan,
					'kota' => $kota,
					'provinsi' => $provinsi,
					'kode_pos' => $kode_pos
				];

				$this->m_guru->Update($id_guru, $data_guru);
				$this->m_alamat->Update($id_alamat, $data_alamat);
				$this->m_user->Update($id_auth, $data_auth);

				$this->session->set_flashdata('message', '<div class="alert bg-green-200 px-6 py-4 mt-5 mx-2 mb-5 rounded-md flex items-center mx-auto w-full"><svg viewBox="0 0 24 24" class="text-green-600 w-5 h-5 sm:w-5 sm:h-5 mr-3" ><path fill="currentColor" d="M12,0A12,12,0,1,0,24,12,12.014,12.014,0,0,0,12,0Zm6.927,8.2-6.845,9.289a1.011,1.011,0,0,1-1.43.188L5.764,13.769a1,1,0,1,1,1.25-1.562l4.076,3.261,6.227-8.451A1,1,0,1,1,18.927,8.2Z"></path></svg><span class="text-green-800">Profile berhasil diubah!</span></div>');
				redirect('guru/profile');
			} else {

				$data_auth = [
					'foto_pengguna' => $this->upload->data('file_name'),
					'tanggal_dibuat' => $tanggal_dibuat
				];

				$data_guru = [
					'id_alamat' => $id_alamat,
					'nama_guru' => $nama_guru,
					'nip_guru' => $nip_guru,
					'email_guru' => $email_guru,
					'tempat_lahir_guru' => $tempat_lahir_guru,
					'tanggal_lahir_guru' => date('Y-m-d', strtotime($tanggal_lahir_guru)),
					'gender_guru' => $gender_guru,
					'telepon_guru' => $telepon_guru,
					'gelar_guru' => $gelar_guru,
					'dibuat_guru' => $dibuat_guru,
					'diupdate_guru' => date('Y-m-d H:i:s')
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

				$this->m_guru->Update($id_guru, $data_guru);
				$this->m_alamat->Update($id_alamat, $data_alamat);
				$this->m_user->Update($id_auth, $data_auth);

				$this->session->set_flashdata('message', '<div class="alert bg-green-200 px-6 py-4 mt-5 mx-2 mb-5 rounded-md flex items-center mx-auto w-full"><svg viewBox="0 0 24 24" class="text-green-600 w-5 h-5 sm:w-5 sm:h-5 mr-3" ><path fill="currentColor" d="M12,0A12,12,0,1,0,24,12,12.014,12.014,0,0,0,12,0Zm6.927,8.2-6.845,9.289a1.011,1.011,0,0,1-1.43.188L5.764,13.769a1,1,0,1,1,1.25-1.562l4.076,3.261,6.227-8.451A1,1,0,1,1,18.927,8.2Z"></path></svg><span class="text-green-800">Profile berhasil diubah!</span></div>');
				redirect('guru/profile');
			}
		}
	}

	public function tambah_kelas()
	{
		$data['title'] = "Tambah Kelas - One Space";

		$data_guru = $this->session->userdata('nip_guru');
		$data['guru'] = $this->m_user->CheckingGuru($data_guru)->row_array();
		
		$data['jurusan'] = $this->m_jurusan->Tampil()->result();
		$data['mapel'] = $this->m_mapel->Tampil()->result();

		$this->load->view('user/guru/templates/header', $data);
		$this->load->view('user/guru/kelas/tambah_kelas');
		$this->load->view('user/guru/templates/footer');
	}
	public function tambah_kelas_proses()
	{
		$this->_tambahKelas();
	}
	private function _tambahKelas()
	{
		$id_guru = $this->input->post('id_guru');
		$id_mapel = $this->input->post('id_mapel');
		$id_jurusan = $this->input->post('id_jurusan');
		$nama_kelas = $this->input->post('nama_kelas');
		$tahun_pembelajaran = $this->input->post('tahun_pembelajaran');
		$token_kelas = strtoupper(random_string('alnum', 7));

		$tambah = [
			'id_guru' => $id_guru,
			'id_jurusan' => $id_jurusan,
			'id_mapel' => $id_mapel,
			'nama_kelas' => $nama_kelas,
			'tahun_pembelajaran' => $tahun_pembelajaran,
			'token_kelas' => $token_kelas,
			'dibuat_kelas' => date('Y-m-d H:i:s'),
			'diupdate_kelas' => date('Y-m-d H:i:s')
		];

		$data_check = ['id_guru' => $id_guru, 'nama_kelas' => $nama_kelas, 'id_jurusan' => $id_jurusan, 'tahun_pembelajaran' => $tahun_pembelajaran];
		$checking = $this->m_kelas->Checking($data_check)->num_rows();

		if ($checking > 0) {
			$this->session->set_flashdata('message', '<div class="alert bg-yellow-100 px-6 py-4 mx-2 mb-5 rounded-md flex items-center mx-auto w-full"><svg viewBox="0 0 24 24" class="text-yellow-600 w-5 h-5 sm:w-5 sm:h-5 mr-3"><path fill="currentColor" d="M23.119,20,13.772,2.15h0a2,2,0,0,0-3.543,0L.881,20a2,2,0,0,0,1.772,2.928H21.347A2,2,0,0,0,23.119,20ZM11,8.423a1,1,0,0,1,2,0v6a1,1,0,1,1-2,0Zm1.05,11.51h-.028a1.528,1.528,0,0,1-1.522-1.47,1.476,1.476,0,0,1,1.448-1.53h.028A1.527,1.527,0,0,1,13.5,18.4,1.475,1.475,0,0,1,12.05,19.933Z"></path></svg><span class="text-yellow-800"> Data sudah ada, coba yang lain!.</span></div>');
		} elseif ($this->m_kelas->Tambah($tambah)) {
			$this->session->set_flashdata('message', '<div class="alert bg-green-200 px-6 py-4 mx-2 mb-5 rounded-md flex items-center mx-auto w-full"><svg viewBox="0 0 24 24" class="text-green-600 w-5 h-5 sm:w-5 sm:h-5 mr-3" ><path fill="currentColor" d="M12,0A12,12,0,1,0,24,12,12.014,12.014,0,0,0,12,0Zm6.927,8.2-6.845,9.289a1.011,1.011,0,0,1-1.43.188L5.764,13.769a1,1,0,1,1,1.25-1.562l4.076,3.261,6.227-8.451A1,1,0,1,1,18.927,8.2Z"></path></svg><span class="text-green-800">Kelas berhasil ditambahkan!</span></div>');
		}
		redirect('guru/');
	}

	public function kelas($id)
	{
		$data['title'] = "Kelas - One Space";

		$data_guru = $this->session->userdata('nip_guru');
		$data['guru'] = $this->m_user->CheckingGuru($data_guru)->row_array();

		$where = ['id_kelas' => $id];
		$data['kelas'] = $this->m_kelas->CheckingAll($where)->row_array();

		// Tampil Gambar Guru
		$data['tampil_guru'] = $this->m_user->TampilGuru($data['kelas']['id_guru'])->row_array();

		$this->load->view('user/guru/templates/header', $data);
		$this->load->view('user/guru/kelas/kelas');
		$this->load->view('user/guru/templates/footer');
	}

	public function tambah_materi($id)
	{
		$data['title'] = "Tambah Materi - One Space";

		$data_guru = $this->session->userdata('nip_guru');
		$data['guru'] = $this->m_user->CheckingGuru($data_guru)->row_array();
		
		$where = ['id_kelas' => $id];
		$data['kelas'] = $this->m_kelas->CheckingAll($where)->row_array();

		$this->load->view('user/guru/templates/header', $data);
		$this->load->view('user/guru/kelas/tambah_materi');
		$this->load->view('user/guru/templates/footer');
	}
	public function tambah_materi_proses()
	{
		$this->_tambahMateri();
	}
	private function _tambahMateri()
	{
		$id_kelas = $this->input->post('id_kelas');
		$nama_materi = $this->input->post('nama_materi');
		$deksripsi_materi = $this->input->post('deksripsi_materi');

		$tambah_materi = [
			'id_kelas' => $id_kelas,
			'nama_materi' => $nama_materi,
			'deksripsi_materi' => "<p>".$deksripsi_materi."</p>",
			'dibuat_materi' => date('Y-m-d H:i:s'),
			'diupdate_materi' => date('Y-m-d H:i:s')
		];

		if ($this->m_materi->Tambah($tambah_materi)) {

			$lampiran = count($_FILES['lampiran']['name']);

			for ($i = 0; $i < $lampiran; $i++) :

				$_FILES['file']['name'] = $_FILES['lampiran']['name'][$i];
				$_FILES['file']['type'] = $_FILES['lampiran']['type'][$i];
				$_FILES['file']['tmp_name'] = $_FILES['lampiran']['tmp_name'][$i];
				$_FILES['file']['size'] = $_FILES['lampiran']['size'][$i];

				$config['upload_path'] = './assets/admin/lampiran/';
				$config['allowed_types'] = 'png|jpg|jpeg|pdf|docx|pptx|xlsx';
				$config['max_size']	= '200000';
				$config['encrypt_name'] = TRUE;

				$this->upload->initialize($config);

				if ($this->upload->do_upload('file')) {

					$fileData = $this->upload->data();

					$tambah[$i]['id_materi'] = $this->db->insert_id();
					$tambah[$i]['nama_lampiran'] = $fileData['file_name'];

					$this->session->set_flashdata('message', '<div class="alert bg-green-200 px-6 py-4 mx-2 rounded-md flex items-center mx-auto w-full"><svg viewBox="0 0 24 24" class="text-green-600 w-5 h-5 sm:w-5 sm:h-5 mr-3" ><path fill="currentColor" d="M12,0A12,12,0,1,0,24,12,12.014,12.014,0,0,0,12,0Zm6.927,8.2-6.845,9.289a1.011,1.011,0,0,1-1.43.188L5.764,13.769a1,1,0,1,1,1.25-1.562l4.076,3.261,6.227-8.451A1,1,0,1,1,18.927,8.2Z"></path></svg><span class="text-green-800">Materi berhasil ditambahkan!</span></div>');
				}
				$this->m_lampiran->Tambah($tambah);
			endfor;

		} else {
			$this->session->set_flashdata('message', '<div class="alert bg-red-200 px-6 py-4 mx-2 rounded-md flex items-center mx-auto w-full"><svg viewBox="0 0 24 24" class="text-red-600 w-5 h-5 sm:w-5 sm:h-5 mr-3"><path fill="currentColor" d="M11.983,0a12.206,12.206,0,0,0-8.51,3.653A11.8,11.8,0,0,0,0,12.207,11.779,11.779,0,0,0,11.8,24h.214A12.111,12.111,0,0,0,24,11.791h0A11.766,11.766,0,0,0,11.983,0ZM10.5,16.542a1.476,1.476,0,0,1,1.449-1.53h.027a1.527,1.527,0,0,1,1.523,1.47,1.475,1.475,0,0,1-1.449,1.53h-.027A1.529,1.529,0,0,1,10.5,16.542ZM11,12.5v-6a1,1,0,0,1,2,0v6a1,1,0,1,1-2,0Z"></path></svg><span class="text-red-800"> Data gagal ditambahkan!. </span></div>');
		}
		redirect('guru/kelas/' . $id_kelas);
	}
	public function edit_materi($id)
	{
		$data['title'] = "Edit Materi - One Space";

		$data_guru = $this->session->userdata('nip_guru');
		$data['guru'] = $this->m_user->CheckingGuru($data_guru)->row_array();
		
		$where = ['id_materi' => $id];
		$data['materi'] = $this->m_materi->CheckingAll($where)->row_array();

		$this->load->view('user/guru/templates/header', $data);
		$this->load->view('user/guru/kelas/edit_materi');
		$this->load->view('user/guru/templates/footer');
	}
	public function edit_materi_proses()
	{
		$this->_editMateri();
	}
	private function _editMateri()
	{
		$id_materi = $this->input->post('id_materi');
        $id_kelas = $this->input->post('id_kelas');
        $nama_materi = $this->input->post('nama_materi');
        $deksripsi_materi = $this->input->post('deksripsi_materi');
        $dibuat_materi = $this->input->post('dibuat_materi');

        $where_lampiran = ['id_materi' => $id_materi];
        $result = $this->m_lampiran->Checking($where_lampiran)->result();

        $lampiran = count($_FILES['lampiran']['name']);

        for ($i = 0; $i < $lampiran; $i++) :

            $_FILES['file']['name'] = $_FILES['lampiran']['name'][$i];
            $_FILES['file']['type'] = $_FILES['lampiran']['type'][$i];
            $_FILES['file']['tmp_name'] = $_FILES['lampiran']['tmp_name'][$i];
            $_FILES['file']['size'] = $_FILES['lampiran']['size'][$i];

            $config['upload_path'] = './assets/admin/lampiran/';
            $config['allowed_types'] = 'png|jpg|jpeg|pdf|docx|pptx|xlsx';
            $config['max_size'] = '200000';
            $config['encrypt_name'] = TRUE;
            $this->upload->initialize($config);

            if($this->upload->do_upload('file')) {

                // Kalau data diapa-apakan
                $fileData = $this->upload->data();

                foreach($result as $key){
                    unlink('./assets/admin/lampiran/' . $key->nama_lampiran);
                }

                $data_materi = [
                    'id_kelas' => $id_kelas,
                    'nama_materi' => $nama_materi,
                    'deksripsi_materi' => $deksripsi_materi,
                    'dibuat_materi' => $dibuat_materi,
                    'diupdate_materi' => date('Y-m-d H:i:s')
                ];

                $tambah[$i]['id_materi'] = $id_materi;
                $tambah[$i]['nama_lampiran'] = $fileData['file_name'];

                $this->m_materi->Update($id_materi, $data_materi);

                $this->m_lampiran->DeleteMateri($id_materi);
                $this->m_lampiran->Tambah($tambah);
				$this->session->set_flashdata('message', '<div class="alert bg-green-200 px-6 mb-5 py-4 mx-2 rounded-md flex items-center mx-auto w-full"><svg viewBox="0 0 24 24" class="text-green-600 w-5 h-5 sm:w-5 sm:h-5 mr-3" ><path fill="currentColor" d="M12,0A12,12,0,1,0,24,12,12.014,12.014,0,0,0,12,0Zm6.927,8.2-6.845,9.289a1.011,1.011,0,0,1-1.43.188L5.764,13.769a1,1,0,1,1,1.25-1.562l4.076,3.261,6.227-8.451A1,1,0,1,1,18.927,8.2Z"></path></svg><span class="text-green-800">Materi beserta lampiran berhasil diubah!</span></div>');
            }else{

                // Kalau data tidak diapa-apakan
                $data_materi = [
                    'id_kelas' => $id_kelas,
                    'nama_materi' => $nama_materi,
                    'deksripsi_materi' => $deksripsi_materi,
                    'dibuat_materi' => $dibuat_materi,
                    'diupdate_materi' => date('Y-m-d H:i:s')
                ];

                $this->m_materi->Update($id_materi, $data_materi);
				$this->session->set_flashdata('message', '<div class="alert bg-green-200 px-6 mb-5 py-4 mx-2 rounded-md flex items-center mx-auto w-full"><svg viewBox="0 0 24 24" class="text-green-600 w-5 h-5 sm:w-5 sm:h-5 mr-3" ><path fill="currentColor" d="M12,0A12,12,0,1,0,24,12,12.014,12.014,0,0,0,12,0Zm6.927,8.2-6.845,9.289a1.011,1.011,0,0,1-1.43.188L5.764,13.769a1,1,0,1,1,1.25-1.562l4.076,3.261,6.227-8.451A1,1,0,1,1,18.927,8.2Z"></path></svg><span class="text-green-800">Materi berhasil diubah!</span></div>');
            }
        endfor;
		redirect('guru/materi/' . $id_materi);
	}

	public function materi($id)
	{
		$data_guru = $this->session->userdata('nip_guru');
		$data['guru'] = $this->m_user->CheckingGuru($data_guru)->row_array();

		$where = ['id_materi' => $id];
		$data['materi'] = $this->m_materi->CheckingAll($where)->row_array();

		$data['title'] = $data['materi']['nama_materi'] . " - Materi";

		$this->load->view('user/guru/templates/header', $data);
		$this->load->view('user/guru/kelas/materi');
		$this->load->view('user/guru/templates/footer');	
	}

	public function tambah_tugas($id)
	{
		$data['title'] = "Tambah Tugas - One Space";

		$data_guru = $this->session->userdata('nip_guru');
		$data['guru'] = $this->m_user->CheckingGuru($data_guru)->row_array();
		
		$where = ['id_kelas' => $id];
		$data['kelas'] = $this->m_kelas->CheckingAll($where)->row_array();

		$this->load->view('user/guru/templates/header', $data);
		$this->load->view('user/guru/kelas/tambah_tugas');
		$this->load->view('user/guru/templates/footer');
	}
	public function tambah_tugas_proses()
	{
		$this->_tambahTugas();
	}
	private function _tambahTugas()
	{
		$id_kelas = $this->input->post('id_kelas');
		$nama_tugas = $this->input->post('nama_tugas');
		$deksripsi_tugas = $this->input->post('deksripsi_tugas');
		$tenggat_tanggal = $this->input->post('tenggat_tanggal');
		$tenggat_waktu = $this->input->post('tenggat_waktu');

		if ($tenggat_tanggal == 0) $tenggat_tanggal = null;
		// if ($tenggat_waktu == 0) $tenggat_tanggal = null;

		$tambah_tugas = [
			'id_kelas' => $id_kelas,
			'nama_tugas' => $nama_tugas,
			'deksripsi_tugas' => "<p>".$deksripsi_tugas."</p>",
			'tenggat_tugas' => date('Y-m-d H:i:s', strtotime($tenggat_tanggal." ".$tenggat_waktu)),
			'dibuat_tugas' => date('Y-m-d H:i:s'),
			'diupdate_tugas' => date('Y-m-d H:i:s')
		];

		if ($this->m_tugas->Tambah($tambah_tugas)) {

			$lampiran = count($_FILES['lampiran']['name']);

			for ($i = 0; $i < $lampiran; $i++) :

				$_FILES['file']['name'] = $_FILES['lampiran']['name'][$i];
				$_FILES['file']['type'] = $_FILES['lampiran']['type'][$i];
				$_FILES['file']['tmp_name'] = $_FILES['lampiran']['tmp_name'][$i];
				$_FILES['file']['size'] = $_FILES['lampiran']['size'][$i];

				$config['upload_path'] = './assets/admin/lampiran/';
				$config['allowed_types'] = 'png|jpg|jpeg|pdf|docx|pptx|xlsx';
				$config['max_size']	= '200000';
				$config['encrypt_name'] = TRUE;

				$this->load->library('upload', $config);
				$this->upload->initialize($config);

				if ($this->upload->do_upload('file')) {

					$fileData = $this->upload->data();

					$tambah[$i]['id_tugas'] = $this->db->insert_id();
					$tambah[$i]['nama_lampiran'] = $fileData['file_name'];

					$this->session->set_flashdata('message', '<div class="alert bg-green-200 px-6 py-4 mx-2 rounded-md flex items-center mx-auto w-full"><svg viewBox="0 0 24 24" class="text-green-600 w-5 h-5 sm:w-5 sm:h-5 mr-3" ><path fill="currentColor" d="M12,0A12,12,0,1,0,24,12,12.014,12.014,0,0,0,12,0Zm6.927,8.2-6.845,9.289a1.011,1.011,0,0,1-1.43.188L5.764,13.769a1,1,0,1,1,1.25-1.562l4.076,3.261,6.227-8.451A1,1,0,1,1,18.927,8.2Z"></path></svg><span class="text-green-800">Tugas berhasil ditambahkan!</span></div>');
				}

			endfor;
			$this->m_lampiran->Tambah($tambah);

		} else {
			$this->session->set_flashdata('message', '<div class="alert bg-red-200 px-6 py-4 mx-2 rounded-md flex items-center mx-auto w-full"><svg viewBox="0 0 24 24" class="text-red-600 w-5 h-5 sm:w-5 sm:h-5 mr-3"><path fill="currentColor" d="M11.983,0a12.206,12.206,0,0,0-8.51,3.653A11.8,11.8,0,0,0,0,12.207,11.779,11.779,0,0,0,11.8,24h.214A12.111,12.111,0,0,0,24,11.791h0A11.766,11.766,0,0,0,11.983,0ZM10.5,16.542a1.476,1.476,0,0,1,1.449-1.53h.027a1.527,1.527,0,0,1,1.523,1.47,1.475,1.475,0,0,1-1.449,1.53h-.027A1.529,1.529,0,0,1,10.5,16.542ZM11,12.5v-6a1,1,0,0,1,2,0v6a1,1,0,1,1-2,0Z"></path></svg><span class="text-red-800"> Data gagal ditambahkan!. </span></div>');
		}
		redirect('guru/kelas/' . $id_kelas);
	}
	public function edit_tugas($id)
	{
		$data['title'] = "Edit Tugas - One Space";

		$data_guru = $this->session->userdata('nip_guru');
		$data['guru'] = $this->m_user->CheckingGuru($data_guru)->row_array();
		
		$where = ['id_tugas' => $id];
		$data['tugas'] = $this->m_tugas->CheckingAll($where)->row_array();

		$this->load->view('user/guru/templates/header', $data);
		$this->load->view('user/guru/kelas/edit_tugas');
		$this->load->view('user/guru/templates/footer');
	}
	public function edit_tugas_proses()
	{
		$this->_editTugas();
	}
	private function _editTugas()
	{
		$id_tugas = $this->input->post('id_tugas');
		$id_kelas = $this->input->post('id_kelas');
		$nama_tugas = $this->input->post('nama_tugas');

		$tenggat_tanggal = $this->input->post('tenggat_tanggal');
		$tenggat_waktu = $this->input->post('tenggat_waktu');

		$deksripsi_tugas = $this->input->post('deksripsi_tugas');
		$dibuat_tugas = $this->input->post('dibuat_tugas');

		$where_lampiran = ['id_tugas' => $id_tugas];
		$result = $this->m_lampiran->Checking($where_lampiran)->result();

		$lampiran = count($_FILES['lampiran']['name']);

		for ($i = 0; $i < $lampiran; $i++) :

			$_FILES['file']['name'] = $_FILES['lampiran']['name'][$i];
			$_FILES['file']['type'] = $_FILES['lampiran']['type'][$i];
			$_FILES['file']['tmp_name'] = $_FILES['lampiran']['tmp_name'][$i];
			$_FILES['file']['size'] = $_FILES['lampiran']['size'][$i];

			$config['upload_path'] = './assets/admin/lampiran/';
			$config['allowed_types'] = 'png|jpg|jpeg|pdf|docx|pptx|xlsx';
			$config['max_size'] = '200000';
			$config['encrypt_name'] = TRUE;
			$this->upload->initialize($config);

			if($this->upload->do_upload('file')) {

                // Kalau data diapa-apakan
				$fileData = $this->upload->data();

				foreach($result as $key){
					unlink('./assets/admin/lampiran/' . $key->nama_lampiran);
				}

				$data_tugas = [
					'id_kelas' => $id_kelas,
					'nama_tugas' => $nama_tugas,
					'tenggat_tugas' => date('Y-m-d H:i:s', strtotime($tenggat_tanggal." ".$tenggat_waktu)),
					'deksripsi_tugas' => $deksripsi_tugas,
					'dibuat_tugas' => $dibuat_tugas,
					'diupdate_tugas' => date('Y-m-d H:i:s')
				];

				$tambah[$i]['id_tugas'] = $id_tugas;
				$tambah[$i]['nama_lampiran'] = $fileData['file_name'];

				$this->m_tugas->Update($id_tugas, $data_tugas);

				$this->m_lampiran->DeleteTugas($id_tugas);
				$this->m_lampiran->Tambah($tambah);
				$this->session->set_flashdata('message', '<div class="alert bg-green-200 px-6 mb-5 py-4 mx-2 rounded-md flex items-center mx-auto w-full"><svg viewBox="0 0 24 24" class="text-green-600 w-5 h-5 sm:w-5 sm:h-5 mr-3" ><path fill="currentColor" d="M12,0A12,12,0,1,0,24,12,12.014,12.014,0,0,0,12,0Zm6.927,8.2-6.845,9.289a1.011,1.011,0,0,1-1.43.188L5.764,13.769a1,1,0,1,1,1.25-1.562l4.076,3.261,6.227-8.451A1,1,0,1,1,18.927,8.2Z"></path></svg><span class="text-green-800">Tugas beserta lampiran berhasil diubah!</span></div>');
			}else{

                // Kalau data tidak diapa-apakan
				$data_tugas = [
					'id_kelas' => $id_kelas,
					'nama_tugas' => $nama_tugas,
					'tenggat_tugas' => date('Y-m-d H:i:s', strtotime($tenggat_tanggal." ".$tenggat_waktu)),
					'deksripsi_tugas' => $deksripsi_tugas,
					'dibuat_tugas' => $dibuat_tugas,
					'diupdate_tugas' => date('Y-m-d H:i:s')
				];

				$this->m_tugas->Update($id_tugas, $data_tugas);
				$this->session->set_flashdata('message', '<div class="alert bg-green-200 px-6 py-4 mb-5 mx-2 rounded-md flex items-center mx-auto w-full"><svg viewBox="0 0 24 24" class="text-green-600 w-5 h-5 sm:w-5 sm:h-5 mr-3" ><path fill="currentColor" d="M12,0A12,12,0,1,0,24,12,12.014,12.014,0,0,0,12,0Zm6.927,8.2-6.845,9.289a1.011,1.011,0,0,1-1.43.188L5.764,13.769a1,1,0,1,1,1.25-1.562l4.076,3.261,6.227-8.451A1,1,0,1,1,18.927,8.2Z"></path></svg><span class="text-green-800">Tugas berhasil diubah!</span></div>');
			}
		endfor;
		redirect('guru/tugas/' . $id_tugas);

	}
	public function tugas($id)
	{
		$data_guru = $this->session->userdata('nip_guru');
		$data['guru'] = $this->m_user->CheckingGuru($data_guru)->row_array();

		$where = ['id_tugas' => $id];
		$data['tugas'] = $this->m_tugas->CheckingAll($where)->row_array();

		$data['title'] = $data['tugas']['nama_tugas'] . " - Tugas";

		$this->load->view('user/guru/templates/header', $data);
		$this->load->view('user/guru/kelas/tugas');
		$this->load->view('user/guru/templates/footer');	
	}

	public function tambah_latihan($id)
	{
		$data['title'] = "Tambah Latihan - One Space";

		$data_guru = $this->session->userdata('nip_guru');
		$data['guru'] = $this->m_user->CheckingGuru($data_guru)->row_array();
		
		$where = ['id_kelas' => $id];
		$data['kelas'] = $this->m_kelas->CheckingAll($where)->row_array();

		$this->load->view('user/guru/templates/header', $data);
		$this->load->view('user/guru/kelas/tambah_latihan');
		$this->load->view('user/guru/templates/footer');
	}
	public function tambah_latihan_proses()
	{
		$this->_tambahLatihan();
	}
	private function _tambahLatihan()
	{
		$id_kelas = $this->input->post('id_kelas');
		$nama_latihan = $this->input->post('nama_latihan');
		$tipe_latihan = $this->input->post('tipe_latihan');
		$deksripsi_latihan = $this->input->post('deksripsi_latihan');

		$tenggat_tanggal = $this->input->post('tenggat_tanggal');
		$tenggat_waktu = $this->input->post('tenggat_waktu');

		$tanggal_mulai = $this->input->post('tanggal_mulai');
		$waktu_mulai = $this->input->post('waktu_mulai');

		$waktu_latihan = $this->input->post('waktu_latihan');
		$point_latihan = $this->input->post('point_latihan');
		
		if ($tenggat_tanggal == 0) $tenggat_tanggal = null;
		if ($waktu_latihan == 0) $tenggat_latihan = null;

		$tambah = [
			'id_kelas' => $id_kelas,
			'nama_latihan' => $nama_latihan,
			'tipe_latihan' => $tipe_latihan,
			'deksripsi_latihan' => "<p>".$deksripsi_latihan."</p>",
			'waktu_latihan' => $waktu_latihan,
			'tenggat_latihan' => date('Y-m-d H:i:s', strtotime($tenggat_tanggal." ".$tenggat_waktu)),
			'tanggal_mulai' => date('Y-m-d H:i:s', strtotime($tanggal_mulai." ".$waktu_mulai)),
			'point_latihan' => $point_latihan,
			'dibuat_latihan' => date('Y-m-d H:i:s'),
			'diupdate_latihan' => date('Y-m-d H:i:s')
		];

		if ($this->m_latihan->Tambah($tambah)) {
			$this->session->set_flashdata('message', '<div class="alert bg-green-200 px-6 py-4 mx-2 rounded-md flex items-center mx-auto w-full"><svg viewBox="0 0 24 24" class="text-green-600 w-5 h-5 sm:w-5 sm:h-5 mr-3" ><path fill="currentColor" d="M12,0A12,12,0,1,0,24,12,12.014,12.014,0,0,0,12,0Zm6.927,8.2-6.845,9.289a1.011,1.011,0,0,1-1.43.188L5.764,13.769a1,1,0,1,1,1.25-1.562l4.076,3.261,6.227-8.451A1,1,0,1,1,18.927,8.2Z"></path></svg><span class="text-green-800">Latihan berhasil ditambahkan!</span></div>');
		} else {
			$this->session->set_flashdata('message', '<div class="alert bg-red-200 px-6 py-4 mx-2 rounded-md flex items-center mx-auto w-full"><svg viewBox="0 0 24 24" class="text-red-600 w-5 h-5 sm:w-5 sm:h-5 mr-3"><path fill="currentColor" d="M11.983,0a12.206,12.206,0,0,0-8.51,3.653A11.8,11.8,0,0,0,0,12.207,11.779,11.779,0,0,0,11.8,24h.214A12.111,12.111,0,0,0,24,11.791h0A11.766,11.766,0,0,0,11.983,0ZM10.5,16.542a1.476,1.476,0,0,1,1.449-1.53h.027a1.527,1.527,0,0,1,1.523,1.47,1.475,1.475,0,0,1-1.449,1.53h-.027A1.529,1.529,0,0,1,10.5,16.542ZM11,12.5v-6a1,1,0,0,1,2,0v6a1,1,0,1,1-2,0Z"></path></svg><span class="text-red-800"> Data gagal ditambahkan!. </span></div>');
		}
		redirect('guru/kelas/' . $id_kelas);
	}

	public function edit_latihan($id)
	{
		$data['title'] = "Edit Latihan - One Space";

		$data_guru = $this->session->userdata('nip_guru');
		$data['guru'] = $this->m_user->CheckingGuru($data_guru)->row_array();
		
		$where = ['id_latihan' => $id];
		$data['latihan'] = $this->m_latihan->CheckingAll($where)->row_array();

		$this->load->view('user/guru/templates/header', $data);
		$this->load->view('user/guru/kelas/edit_latihan');
		$this->load->view('user/guru/templates/footer');
	}
	public function edit_latihan_proses()
	{
		$this->_editLatihan();
	}
	private function _editLatihan()
	{
		$id_latihan = $this->input->post('id_latihan');
		$id_kelas = $this->input->post('id_kelas');
		$nama_latihan = $this->input->post('nama_latihan');
		$tipe_latihan = $this->input->post('tipe_latihan');
		$deksripsi_latihan = $this->input->post('deksripsi_latihan');
		$waktu_latihan = $this->input->post('waktu_latihan');

		$tenggat_tanggal = $this->input->post('tenggat_tanggal');
		$tenggat_waktu = $this->input->post('tenggat_waktu');

		$tanggal_mulai = $this->input->post('tanggal_mulai');
		$waktu_mulai = $this->input->post('waktu_mulai');

		$point_latihan = $this->input->post('point_latihan');
		$dibuat_latihan = $this->input->post('dibuat_latihan');

		$data_latihan = [
			'id_kelas' => $id_kelas,
			'nama_latihan' => $nama_latihan,
			'tipe_latihan' => $tipe_latihan,
			'deksripsi_latihan' => "<p>".$deksripsi_latihan."</p>",
			'waktu_latihan' => $waktu_latihan,
			'tenggat_latihan' => date('Y-m-d H:i:s', strtotime($tenggat_tanggal." ".$tenggat_waktu)),
			'tanggal_mulai' => date('Y-m-d H:i:s', strtotime($tanggal_mulai." ".$waktu_mulai)),
			'point_latihan' => $point_latihan,
			'dibuat_latihan' => $dibuat_latihan,
			'diupdate_latihan' => date('Y-m-d H:i:s')
		];

		$this->m_latihan->Update($id_latihan, $data_latihan);
		$this->session->set_flashdata('message', '<div class="alert bg-green-200 px-6 py-4 mx-2 rounded-md flex items-center mx-auto w-full"><svg viewBox="0 0 24 24" class="text-green-600 w-5 h-5 sm:w-5 sm:h-5 mr-3" ><path fill="currentColor" d="M12,0A12,12,0,1,0,24,12,12.014,12.014,0,0,0,12,0Zm6.927,8.2-6.845,9.289a1.011,1.011,0,0,1-1.43.188L5.764,13.769a1,1,0,1,1,1.25-1.562l4.076,3.261,6.227-8.451A1,1,0,1,1,18.927,8.2Z"></path></svg><span class="text-green-800">Latihan berhasil diedit!</span></div>');		

		redirect('guru/latihan/' . $id_latihan);
	}
	public function latihan($id)
	{
		$data_guru = $this->session->userdata('nip_guru');
		$data['guru'] = $this->m_user->CheckingGuru($data_guru)->row_array();

		$where = ['id_latihan' => $id];
		$data['latihan'] = $this->m_latihan->CheckingAll($where)->row_array();

		$data['title'] = $data['latihan']['nama_latihan'] . " - Latihan";
		$data['latihan_row'] = $this->m_hasil_latihan->CheckingLatihan($id)->row_array();
		$data['latihan_result'] = $this->m_hasil_latihan->CheckingLatihan($id)->result();
		$data['jumlah_soal'] = $this->m_soal->Checking($where)->num_rows();

		$this->load->view('user/guru/templates/header', $data);
		$this->load->view('user/guru/kelas/latihan');
		$this->load->view('user/guru/templates/footer');
	}
	public function tambah_soal($id)
	{
		$data['title'] = "Tambah Soal - One Space";

		$data_guru = $this->session->userdata('nip_guru');
		$data['guru'] = $this->m_user->CheckingGuru($data_guru)->row_array();
		
		$where = ['id_latihan' => $id];
		$data['latihan'] = $this->m_latihan->CheckingAll($where)->row_array();

		$where_soal = ['id_latihan' => $data['latihan']['id_latihan']];
		$data['bank_soal_num'] = $this->m_soal->Checking($where_soal)->num_rows();
		$data['bank_soal_result'] = $this->m_soal->Checking($where_soal)->result();

		$this->load->view('user/guru/templates/header', $data);
		$this->load->view('user/guru/kelas/tambah_soal');
		$this->load->view('user/guru/templates/footer');
	}
	public function tambah_soal_proses()
	{
		$this->_tambahSoal();
	}
	private function _tambahSoal()
	{
		$id_latihan = $this->input->post('id_latihan');
		$soal = $this->input->post('soal');
		$tipe_soal = $this->input->post('tipe_soal');
		$pilihan_a = $this->input->post('pilihan_a');
		$pilihan_b = $this->input->post('pilihan_b');
		$pilihan_c = $this->input->post('pilihan_c');
		$pilihan_d = $this->input->post('pilihan_d');
		$pilihan_e = $this->input->post('pilihan_e');
		$kunci_jawaban = $this->input->post('kunci_jawaban');

		if ($pilihan_a == "") $pilihan_a = null;
		if ($pilihan_b == "") $pilihan_b = null;
		if ($pilihan_c == "") $pilihan_c = null;
		if ($pilihan_d == "") $pilihan_d = null;
		if ($pilihan_e == "") $pilihan_e = null;

		if ($tipe_soal == "Essay") {
			$pilihan_a = null;
			$pilihan_b = null;
			$pilihan_d = null;
			$pilihan_e = null;
			$kunci_jawaban = null;
		}

		$tambah = [
			'id_latihan' => $id_latihan,
			'soal' => "<p>".$soal."</p>",
			'tipe_soal' => $tipe_soal,
			'kunci_jawaban' => $kunci_jawaban,
			'pilihan_a' => "<p>".$pilihan_a."</p>",
			'pilihan_b' => "<p>".$pilihan_b."</p>",
			'pilihan_c' => "<p>".$pilihan_c."</p>",
			'pilihan_d' => "<p>".$pilihan_d."</p>",
			'pilihan_e' => "<p>".$pilihan_e."</p>",
			'dibuat_soal' => date('Y-m-d H:i:s')
		];

		if ($this->m_soal->Tambah($tambah)) {
			$this->session->set_flashdata('message', '<div class="alert bg-green-200 px-6 py-4 mx-2 mb-5 rounded-md flex items-center mx-auto w-full"><svg viewBox="0 0 24 24" class="text-green-600 w-5 h-5 sm:w-5 sm:h-5 mr-3" ><path fill="currentColor" d="M12,0A12,12,0,1,0,24,12,12.014,12.014,0,0,0,12,0Zm6.927,8.2-6.845,9.289a1.011,1.011,0,0,1-1.43.188L5.764,13.769a1,1,0,1,1,1.25-1.562l4.076,3.261,6.227-8.451A1,1,0,1,1,18.927,8.2Z"></path></svg><span class="text-green-800">Soal berhasil ditambahkan!</span></div>');
		}
		redirect('guru/tambah_soal/' . $id_latihan);
	}
	public function hapus_soal($id)
	{
		$data =['id_soal' => $id];
		
		$soal = $this->m_soal->Checking($data)->row_array();

		if($this->m_soal->Delete($id)){
			$this->session->set_flashdata('message', '<div class="alert bg-green-200 px-6 py-4 mx-2 mb-5 rounded-md flex items-center mx-auto w-full"><svg viewBox="0 0 24 24" class="text-green-600 w-5 h-5 sm:w-5 sm:h-5 mr-3" ><path fill="currentColor" d="M12,0A12,12,0,1,0,24,12,12.014,12.014,0,0,0,12,0Zm6.927,8.2-6.845,9.289a1.011,1.011,0,0,1-1.43.188L5.764,13.769a1,1,0,1,1,1.25-1.562l4.076,3.261,6.227-8.451A1,1,0,1,1,18.927,8.2Z"></path></svg><span class="text-green-800">Soal berhasil dihapus!</span></div>');
		}
		redirect('guru/tambah_soal/' . $soal['id_latihan']);
	}

	public function detail_hasil($latihan_id, $id)
	{
		$data['title'] = "Detail Hasil - Latihan";

		$data_guru = $this->session->userdata('nip_guru');
		$data['guru'] = $this->m_user->CheckingGuru($data_guru)->row_array();

		$where = ['id_murid' => $id];
		$where = ['id_latihan' => $latihan_id];
		$data['murid'] = $this->m_hasil_latihan->HasilMurid($id, $latihan_id)->row_array();

		$where_latihan = ['id_latihan' => $data['murid']['id_latihan']];
		$id_latihan = $where_latihan['id_latihan'];

		$data['latihan'] = $this->m_hasil_latihan->CheckingLatihan($id_latihan)->row_array();

		$data['hasil_row'] = $this->m_hasil_latihan->HasilMurid($id, $id_latihan)->row_array();
		$data['hasil_result'] = $this->m_hasil_latihan->HasilMurid($id, $id_latihan)->result();

		$data['nilai_murid'] = $this->m_hasil_latihan->NilaiMurid($id, $id_latihan)->row_array();
		$data['jumlah_soal'] = $this->m_soal->Checking($where_latihan)->num_rows();

		$this->load->view('user/guru/templates/header', $data);
		$this->load->view('user/guru/kelas/detail_hasil');
		$this->load->view('user/guru/templates/footer');
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('home/masuk');
	}
}