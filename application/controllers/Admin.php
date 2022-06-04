<?php

class Admin extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('id_privilege') == "") {
			redirect('auth/');
		}
		$this->load->model('m_soal');
		$this->load->model('m_guru');
		$this->load->model('m_absen');
		$this->load->model('m_ortu');
		$this->load->model('m_mapel');
		$this->load->model('m_murid');
		$this->load->model('m_admin');
		$this->load->model('m_tugas');
		$this->load->model('m_kelas');
		$this->load->model('m_materi');
		$this->load->model('m_alamat');
		$this->load->model('m_jurusan');
		$this->load->model('m_latihan');
		$this->load->model('m_komentar');
		$this->load->model('m_absen');
		$this->load->model('m_lampiran');
		$this->load->model('m_privilege');
		$this->load->model('m_hasil_tugas');
		$this->load->model('m_gabung_kelas');
		$this->load->model('m_hasil_latihan');
		$this->load->library('Ciqrcode');
	}

	public function index()
	{
		// Header
		$data['title'] = "Dashboard | One Space";
		$data['sidebar'] = "Dashboard";

		$data_admin = ['id_privilege' => $this->session->userdata('id_privilege')];
		$data['admin'] = $this->m_admin->Checking($data_admin)->row_array();

		$data_privilege = ['id_privilege' => $data['admin']['id_privilege']];
		$data['privilege'] = $this->m_privilege->Checking($data_privilege)->row_array();
		
		$data['jmlh_murid'] = $this->m_murid->Tampil()->num_rows();
		$data['jmlh_guru'] = $this->m_guru->Tampil()->num_rows();
		$data['jmlh_ortu'] = $this->m_ortu->Tampil()->num_rows();

		$data['jmlh_absen_murid'] = $this->m_absen->AbsenMasukMuridHariIni()->num_rows();
		$data['jmlh_absen_guru'] = $this->m_absen->AbsenMasukGuruHariIni()->num_rows();

		// Custom
		$this->load->view('admin/template/header', $data);
		$this->load->view('admin/dashboard');
		$this->load->view('admin/template/footer');
	}
	
	public function absen_masuk_murid()
	{
		// Header
		$data['title'] = "Absen Masuk | One Space";
		$data['sidebar'] = "Absen Murid";

		$data_admin = ['id_privilege' => $this->session->userdata('id_privilege')];
		$data['admin'] = $this->m_admin->Checking($data_admin)->row_array();

		$data_privilege = ['id_privilege' => $data['admin']['id_privilege']];
		$data['privilege'] = $this->m_privilege->Checking($data_privilege)->row_array();

		// Custom
		$data['absen_masuk'] = $this->m_absen->AbsenMasukMurid()->result();

		$this->load->view('admin/template/header', $data);
		$this->load->view('admin/absen/absen_masuk_murid');
		$this->load->view('admin/template/footer');
	}

	public function absen_masuk_guru()
	{
		// Header
		$data['title'] = "Absen Masuk | One Space";
		$data['sidebar'] = "Absen Guru";

		$data_admin = ['id_privilege' => $this->session->userdata('id_privilege')];
		$data['admin'] = $this->m_admin->Checking($data_admin)->row_array();

		$data_privilege = ['id_privilege' => $data['admin']['id_privilege']];
		$data['privilege'] = $this->m_privilege->Checking($data_privilege)->row_array();

		// Custom
		$data['absen_masuk'] = $this->m_absen->AbsenMasukGuru()->result();

		$this->load->view('admin/template/header', $data);
		$this->load->view('admin/absen/absen_masuk_guru');
		$this->load->view('admin/template/footer');
	}
	
	public function absen_mapel()
	{
		// Header
		$data['title'] = "Absen Mapel | One Space";
		$data['sidebar'] = "Absen Mapel";

		$data_admin = ['id_privilege' => $this->session->userdata('id_privilege')];
		$data['admin'] = $this->m_admin->Checking($data_admin)->row_array();

		$data_privilege = ['id_privilege' => $data['admin']['id_privilege']];
		$data['privilege'] = $this->m_privilege->Checking($data_privilege)->row_array();

		// Custom
		$data['absen_mapel'] = $this->m_absen->TampilNgabsenMapel()->result();

		$this->load->view('admin/template/header', $data);
		$this->load->view('admin/absen/absen_mapel');
		$this->load->view('admin/template/footer');
	}

	// Ruang Kelas //
	public function jurusan()
	{
		$this->form_validation->set_rules('nama_jurusan', 'Nama Jurusan', 'required|trim');

		if ($this->form_validation->run() == FALSE) {

			// Header
			$data['title'] = "Jurusan | One Space";
			$data['sidebar'] = "Jurusan";

			$data_admin = ['id_privilege' => $this->session->userdata('id_privilege')];
			$data['admin'] = $this->m_admin->Checking($data_admin)->row_array();

			$data_privilege = ['id_privilege' => $data['admin']['id_privilege']];
			$data['privilege'] = $this->m_privilege->Checking($data_privilege)->row_array();

			// Custom
			$data['jurusan'] = $this->m_jurusan->Tampil()->result();

			$this->load->view('admin/template/header', $data);
			$this->load->view('admin/kelas/jurusan');
			$this->load->view('admin/template/footer');
		} else {

			$nama_jurusan = $this->input->post('nama_jurusan');

			$tambah = ['nama_jurusan' => $nama_jurusan];

			$checking = $this->m_jurusan->Checking($tambah)->num_rows();

			if ($checking > 0) {
				$this->flasher->setFlash('Data sudah ada, silahkan coba yang lain!', 'alert-circle', 'warning');
			} elseif ($this->m_jurusan->Tambah($tambah)) {
				$this->flasher->setFlash('Data berhasil ditambahkan!', 'check-circle', 'success');
			} else {
				$this->flasher->setFlash('Data gagal ditambahkan!', 'close-circle', 'danger');
			}
			redirect('admin/jurusan');
		}
	}

	public function kelas()
	{
		$this->form_validation->set_rules('id_guru', 'Guru', 'required|trim');
		$this->form_validation->set_rules('id_jurusan', 'Jurusan', 'required|trim');
		$this->form_validation->set_rules('id_mapel', 'Mapel', 'required|trim');
		$this->form_validation->set_rules('nama_kelas', 'Nama Kelas', 'required|trim');
		$this->form_validation->set_rules('tahun_pembelajaran', 'Tahun Pembelajaran', 'required|trim');

		if ($this->form_validation->run() == FALSE) {

			// Header
			$data['title'] = "Kelas | One Space";
			$data['sidebar'] = "Kelas";

			$data_admin = ['id_privilege' => $this->session->userdata('id_privilege')];
			$data['admin'] = $this->m_admin->Checking($data_admin)->row_array();

			$data_privilege = ['id_privilege' => $data['admin']['id_privilege']];
			$data['privilege'] = $this->m_privilege->Checking($data_privilege)->row_array();

			// Custom
			$data['jurusan'] = $this->m_jurusan->Tampil()->result();
			$data['kelas'] = $this->m_kelas->Tampil()->result();
			$data['mapel'] = $this->m_mapel->Tampil()->result();
			$data['data_guru'] = $this->m_guru->Tampil()->result();

			$this->load->view('admin/template/header', $data);
			$this->load->view('admin/kelas/kelas');
			$this->load->view('admin/template/footer');
		} else {

			$id_guru = $this->input->post('id_guru');
			$id_mapel = $this->input->post('id_mapel');
			$id_jurusan = $this->input->post('id_jurusan');
			$nama_kelas = $this->input->post('nama_kelas');
			$tahun_pembelajaran = $this->input->post('tahun_pembelajaran');
			$token_kelas = strtoupper(random_string('alnum', 7));

			$tambah = [
				'id_guru' => $id_guru,
				'id_mapel' => $id_mapel,
				'id_jurusan' => $id_jurusan,
				'nama_kelas' => $nama_kelas,
				'tahun_pembelajaran' => $tahun_pembelajaran,
				'token_kelas' => $token_kelas,
				'dibuat_kelas' => date('Y-m-d H:i:s'),
				'diupdate_kelas' => date('Y-m-d H:i:s')
			];

			$data_check = ['id_guru' => $id_guru, 'nama_kelas' => $nama_kelas, 'id_jurusan' => $id_jurusan, 'tahun_pembelajaran' => $tahun_pembelajaran];
			$checking = $this->m_kelas->Checking($data_check)->num_rows();

			if ($checking > 0) {
				$this->flasher->setFlash('Data sudah ada, silahkan coba yang lain!', 'alert-circle', 'warning');
			} elseif ($this->m_kelas->Tambah($tambah)) {
				$this->flasher->setFlash('Data berhasil ditambahkan!', 'check-circle', 'success');
			} else {
				$this->flasher->setFlash('Data gagal ditambahkan!', 'close-circle', 'danger');
			}
			redirect('admin/kelas');
		}
	}
	public function gabung_kelas()
	{
		$this->form_validation->set_rules('id_kelas', 'Ruang Kelas', 'required|trim');
		$this->form_validation->set_rules('id_murid', 'Nama Murid', 'required|trim');

		if ($this->form_validation->run() == FALSE) {

			// Header
			$data['title'] = "Gabung Kelas | One Space";
			$data['sidebar'] = "Gabung Kelas";

			$data_admin = ['id_privilege' => $this->session->userdata('id_privilege')];
			$data['admin'] = $this->m_admin->Checking($data_admin)->row_array();

			$data_privilege = ['id_privilege' => $data['admin']['id_privilege']];
			$data['privilege'] = $this->m_privilege->Checking($data_privilege)->row_array();

			// Custom
			$data['gabung_kelas'] = $this->m_gabung_kelas->Tampil()->result();

			$data['kelas'] = $this->m_kelas->Tampil()->result();
			$data['data_murid'] = $this->m_murid->Tampil()->result();

			$this->load->view('admin/template/header', $data);
			$this->load->view('admin/kelas/gabung_kelas');
			$this->load->view('admin/template/footer');
		} else {

			$id_kelas = $this->input->post('id_kelas');
			$id_murid = $this->input->post('id_murid');

			$tambah = [
				'id_kelas' => $id_kelas,
				'id_murid' => $id_murid,
				'bergabung_pada' => date('Y-m-d H:i:s')
			];

			$checking = $this->m_gabung_kelas->Checking($tambah)->num_rows();

			if ($checking > 0) {
				$this->flasher->setFlash('Murid sudah bergabung!', 'alert-circle', 'warning');
			} elseif ($this->m_gabung_kelas->Tambah($tambah)) {
				$this->flasher->setFlash('Data berhasil ditambahkan!', 'check-circle', 'success');
			} else {
				$this->flasher->setFlash('Data gagal ditambahkan!', 'close-circle', 'danger');
			}
			redirect('admin/gabung_kelas');
		}
	}
	// Tutup Kelas

	// Materi
	public function materi()
	{
		$this->form_validation->set_rules('id_kelas', 'Kelas', 'required|trim');
		$this->form_validation->set_rules('nama_materi', 'Judul', 'required|trim');
		$this->form_validation->set_rules('deksripsi_materi', 'Deksripsi', 'required|trim');

		if ($this->form_validation->run() == FALSE) {

			// Header
			$data['title'] = "Materi | One Space";
			$data['sidebar'] = "Materi";

			$data_admin = ['id_privilege' => $this->session->userdata('id_privilege')];
			$data['admin'] = $this->m_admin->Checking($data_admin)->row_array();

			$data_privilege = ['id_privilege' => $data['admin']['id_privilege']];
			$data['privilege'] = $this->m_privilege->Checking($data_privilege)->row_array();

			// Custom
			$data['materi'] = $this->m_materi->Tampil()->result();
			$data['kelas'] = $this->m_kelas->Tampil()->result();

			$this->load->view('admin/template/header', $data);
			$this->load->view('admin/materi/materi');
			$this->load->view('admin/template/footer');
		} else {

			$id_kelas = $this->input->post('id_kelas');
			$nama_materi = $this->input->post('nama_materi');
			$deksripsi_materi = $this->input->post('deksripsi_materi');

			$tambah_materi = [
				'id_kelas' => $id_kelas,
				'nama_materi' => $nama_materi,
				'deksripsi_materi' => $deksripsi_materi,
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

						$this->flasher->setFlash('Data berhasil ditambahkan', 'check-circle', 'success');
					}
				endfor;
				$this->m_lampiran->Tambah($tambah);

			} else {
				$this->flasher->setFlash('Data gagal ditambahkan', 'close-circle', 'danger');
			}
			redirect('admin/materi');
		}
	}
	public function edit_materi($id)
	{
		// Header
		$data['title'] = "Materi | One Space";
		$data['sidebar'] = "Materi";

		$data_admin = ['id_privilege' => $this->session->userdata('id_privilege')];
		$data['admin'] = $this->m_admin->Checking($data_admin)->row_array();

		$data_privilege = ['id_privilege' => $data['admin']['id_privilege']];
		$data['privilege'] = $this->m_privilege->Checking($data_privilege)->row_array();


		$where = ['id_materi' => $id];
		$data['materi'] = $this->m_materi->Checking($where)->row_array();

		$where_lampiran = ['id_materi' => $data['materi']['id_materi']];
		$data['lampiran'] = $this->m_lampiran->Checking($where_lampiran)->result();

		$data['kelas'] = $this->m_kelas->Tampil()->result();

		$this->load->view('admin/template/header', $data);
		$this->load->view('admin/materi/edit_materi');
		$this->load->view('admin/template/footer');
	}
	// Tutup Materi

	// Tugas
	public function tugas()
	{
		$this->form_validation->set_rules('id_kelas', 'Kelas', 'required|trim');
		$this->form_validation->set_rules('nama_tugas', 'Nama Tugas', 'required|trim');
		$this->form_validation->set_rules('deksripsi_tugas', 'Deksripsi', 'required|trim');

		if ($this->form_validation->run() == FALSE) {

			// Header
			$data['title'] = "Tugas | One Space";
			$data['sidebar'] = "Tugas";

			$data_admin = ['id_privilege' => $this->session->userdata('id_privilege')];
			$data['admin'] = $this->m_admin->Checking($data_admin)->row_array();

			$data_privilege = ['id_privilege' => $data['admin']['id_privilege']];
			$data['privilege'] = $this->m_privilege->Checking($data_privilege)->row_array();

			// Custom
			$data['tugas'] = $this->m_tugas->Tampil()->result();
			$data['kelas'] = $this->m_kelas->Tampil()->result();

			$this->load->view('admin/template/header', $data);
			$this->load->view('admin/tugas/tugas');
			$this->load->view('admin/template/footer');
		} else {

			$id_kelas = $this->input->post('id_kelas');
			$nama_tugas = $this->input->post('nama_tugas');
			$deksripsi_tugas = $this->input->post('deksripsi_tugas');
			$tenggat_tugas = $this->input->post('tenggat_tugas');

			if ($tenggat_tugas == 0) $tenggat_tugas = null;

			$tambah_tugas = [
				'id_kelas' => $id_kelas,
				'nama_tugas' => $nama_tugas,
				'deksripsi_tugas' => $deksripsi_tugas,
				'tenggat_tugas' => $tenggat_tugas,
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

						$this->flasher->setFlash('Data berhasil ditambahkan', 'check-circle', 'success');
					}

				endfor;
				$this->m_lampiran->Tambah($tambah);

			} else {
				$this->flasher->setFlash('Data gagal ditambahkan', 'close-circle', 'danger');
			}
			redirect('admin/tugas');
		}
	}
	public function edit_tugas($id)
	{
		// Header
		$data['title'] = "Tugas | One Space";
		$data['sidebar'] = "Tugas";

		$data_admin = ['id_privilege' => $this->session->userdata('id_privilege')];
		$data['admin'] = $this->m_admin->Checking($data_admin)->row_array();

		$data_privilege = ['id_privilege' => $data['admin']['id_privilege']];
		$data['privilege'] = $this->m_privilege->Checking($data_privilege)->row_array();

		$where = ['id_tugas' => $id];
		$data['tugas'] = $this->m_tugas->Checking($where)->row_array();

		$where_lampiran = ['id_tugas' => $data['tugas']['id_tugas']];
		$data['lampiran'] = $this->m_lampiran->Checking($where_lampiran)->result();

		$data['kelas'] = $this->m_kelas->Tampil()->result();

		$this->load->view('admin/template/header', $data);
		$this->load->view('admin/tugas/edit_tugas');
		$this->load->view('admin/template/footer');
	}
	public function hasil_tugas()
	{
		$this->form_validation->set_rules('id_tugas', 'Kelas', 'required|trim');
		$this->form_validation->set_rules('id_murid', 'Judul', 'required|trim');

		if ($this->form_validation->run() == FALSE) {

			// Header
			$data['title'] = "Hasil Tugas | One Space";
			$data['sidebar'] = "Hasil Tugas";

			$data_admin = ['id_privilege' => $this->session->userdata('id_privilege')];
			$data['admin'] = $this->m_admin->Checking($data_admin)->row_array();

			$data_privilege = ['id_privilege' => $data['admin']['id_privilege']];
			$data['privilege'] = $this->m_privilege->Checking($data_privilege)->row_array();

			// Custom
			$data['hasil_tugas'] = $this->m_hasil_tugas->Tampil()->result();

			$data['tugas'] = $this->m_tugas->Tampil()->result();
			$data['data_murid'] = $this->m_murid->Tampil()->result();

			$this->load->view('admin/template/header', $data);
			$this->load->view('admin/tugas/hasil_tugas');
			$this->load->view('admin/template/footer');
		} else {
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
				$this->flasher->setFlash('Murid sudah mengumpulkan tugas', 'alert-circle', 'warning');
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

						$this->flasher->setFlash('Data berhasil ditambahkan', 'check-circle', 'success');
					}
				endfor;
				$this->m_lampiran->Tambah($tambah);
			}else{
				$this->flasher->setFlash('Data gagal ditambahkan', 'close-circle', 'danger');
			}
			redirect('admin/hasil_tugas');
		}
	}
	public function edit_hasil($id)
	{
		// Header
		$data['title'] = "Hasil Tugas | One Space";
		$data['sidebar'] = "Hasil Tugas";

		$data_admin = ['id_privilege' => $this->session->userdata('id_privilege')];
		$data['admin'] = $this->m_admin->Checking($data_admin)->row_array();

		$data_privilege = ['id_privilege' => $data['admin']['id_privilege']];
		$data['privilege'] = $this->m_privilege->Checking($data_privilege)->row_array();

		$where = ['id_hasil_tugas' => $id];
		$data['hasil_tugas'] = $this->m_hasil_tugas->Checking($where)->row_array();

		$where_lampiran = ['id_hasil_tugas' => $data['hasil_tugas']['id_hasil_tugas']];
		$data['lampiran'] = $this->m_lampiran->Checking($where_lampiran)->result();

		$data['tugas'] = $this->m_tugas->Tampil()->result();
		$data['data_murid'] = $this->m_murid->Tampil()->result();

		$this->load->view('admin/template/header', $data);
		$this->load->view('admin/tugas/edit_hasil');
		$this->load->view('admin/template/footer');
	}
	// Tutup Tugas

	// Latihan
	public function latihan()
	{
		$this->form_validation->set_rules('id_kelas', 'Kelas', 'required|trim');
		$this->form_validation->set_rules('nama_latihan', 'Nama Latihan', 'required|trim');
		$this->form_validation->set_rules('tipe_latihan', 'Tipe Latihan', 'required|trim');
		$this->form_validation->set_rules('deksripsi_latihan', 'Deksripsi Latihan', 'required|trim');
		$this->form_validation->set_rules('waktu_latihan', 'Waktu Latihan', 'required|trim');
		$this->form_validation->set_rules('point_latihan', 'Tipe Latihan', 'required|trim');

		if ($this->form_validation->run() == FALSE) {

			// Header
			$data['title'] = "Latihan | One Space";
			$data['sidebar'] = "Latihan";

			$data_admin = ['id_privilege' => $this->session->userdata('id_privilege')];
			$data['admin'] = $this->m_admin->Checking($data_admin)->row_array();

			$data_privilege = ['id_privilege' => $data['admin']['id_privilege']];
			$data['privilege'] = $this->m_privilege->Checking($data_privilege)->row_array();

			// Custom
			$data['kelas'] = $this->m_kelas->Tampil()->result();
			$data['latihan'] = $this->m_latihan->Tampil()->result();
			$data['bank_soal'] = $this->m_soal->Tampil()->result();

			$this->load->view('admin/template/header', $data);
			$this->load->view('admin/latihan/latihan');
			$this->load->view('admin/template/footer');
		} else {

			$id_kelas = $this->input->post('id_kelas');
			$nama_latihan = $this->input->post('nama_latihan');
			$tipe_latihan = $this->input->post('tipe_latihan');
			$deksripsi_latihan = $this->input->post('deksripsi_latihan');
			$tenggat_latihan = $this->input->post('tenggat_latihan');
			$waktu_latihan = $this->input->post('waktu_latihan');
			$point_latihan = $this->input->post('point_latihan');

			if ($tenggat_latihan == 0) $tenggat_latihan = null;
			if ($waktu_latihan == 0) $tenggat_latihan = null;

			$tambah = [
				'id_kelas' => $id_kelas,
				'nama_latihan' => $nama_latihan,
				'tipe_latihan' => $tipe_latihan,
				'deksripsi_latihan' => $deksripsi_latihan,
				'waktu_latihan' => $waktu_latihan,
				'tenggat_latihan' => $tenggat_latihan,
				'point_latihan' => $point_latihan,
				'dibuat_latihan' => date('Y-m-d H:i:s'),
				'diupdate_latihan' => date('Y-m-d H:i:s')
			];

			if ($this->m_latihan->Tambah($tambah)) {
				$this->flasher->setFlash('Data berhasil ditambahkan', 'check-circle', 'success');
			} else {
				$this->flasher->setFlash('Data gagal ditambahkan', 'close-circle', 'danger');
			}
			redirect('admin/latihan');
		}
	}
	public function simulasi_latihan($id)
	{
		$this->form_validation->set_rules('id_murid', 'Murid', 'required|trim');

		if ($this->form_validation->run() == FALSE) {
			// Header
			$data['title'] = "Latihan | One Space";
			$data['sidebar'] = "Latihan";

			$data_admin = ['id_privilege' => $this->session->userdata('id_privilege')];
			$data['admin'] = $this->m_admin->Checking($data_admin)->row_array();

			$data_privilege = ['id_privilege' => $data['admin']['id_privilege']];
			$data['privilege'] = $this->m_privilege->Checking($data_privilege)->row_array();

			$where = ['id_latihan' => $id];
			$data['latihan'] = $this->m_latihan->Checking($where)->row_array();

			$where_soal = ['id_latihan' => $data['latihan']['id_latihan']];
			$data['bank_soal_row'] = $this->m_soal->Checking($where_soal)->row_array();
			$data['bank_soal_result'] = $this->m_soal->Checking($where_soal)->result();
			$data['bank_soal_num'] = $this->m_soal->Checking($where_soal)->num_rows();

			$data['data_murid'] = $this->m_murid->Tampil()->result();

			$this->load->view('admin/template/header', $data);
			$this->load->view('admin/latihan/simulasi_latihan');
			$this->load->view('admin/template/footer');
		} else {

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
				$this->flasher->setFlash('Data sudah mengisi ujian!', 'alert-circle', 'warning');
				redirect('admin/latihan');
			} elseif ($this->m_hasil_latihan->TambahBatch($tambah)) {
				$this->flasher->setFlash('Data berhasil ditambahkan', 'check-circle', 'success');
				redirect('admin/hasil_latihan');
			}
		}
	}

	// Hasil Latihan
	public function hasil_latihan()
	{
		// Header
		$data['title'] = "Hasil Latihan | One Space";
		$data['sidebar'] = "Hasil Latihan";

		$data_admin = ['id_privilege' => $this->session->userdata('id_privilege')];
		$data['admin'] = $this->m_admin->Checking($data_admin)->row_array();

		$data_privilege = ['id_privilege' => $data['admin']['id_privilege']];
		$data['privilege'] = $this->m_privilege->Checking($data_privilege)->row_array();

		// Custom
		$data['latihan'] = $this->m_latihan->Tampil()->result();
		$data['bank_soal'] = $this->m_soal->Tampil()->result();
		$data['data_murid'] = $this->m_murid->Tampil()->result();

		$data['hasil_latihan'] = $this->m_hasil_latihan->Tampil()->result();

		$this->load->view('admin/template/header', $data);
		$this->load->view('admin/latihan/hasil_latihan');
		$this->load->view('admin/template/footer');
	}
	public function hasil_latihan_detail($id)
	{
		// Header
		$data['title'] = "Hasil Latihan | One Space";
		$data['sidebar'] = "Hasil Latihan";

		$data_admin = ['id_privilege' => $this->session->userdata('id_privilege')];
		$data['admin'] = $this->m_admin->Checking($data_admin)->row_array();

		$data_privilege = ['id_privilege' => $data['admin']['id_privilege']];
		$data['privilege'] = $this->m_privilege->Checking($data_privilege)->row_array();

		$where = ['id_latihan' => $id];
		$data['latihan_row'] = $this->m_hasil_latihan->CheckingLatihan($id)->row_array();
		$data['latihan_result'] = $this->m_hasil_latihan->CheckingLatihan($id)->result();
		$data['jumlah_soal'] = $this->m_soal->Checking($where)->num_rows();


		$this->load->view('admin/template/header', $data);
		$this->load->view('admin/latihan/hasil_latihan_detail');
		$this->load->view('admin/template/footer');
	}
	public function hasil_latihan_murid($latihan_id, $id)
	{
		// Header
		$data['title'] = "Hasil Latihan | One Space";
		$data['sidebar'] = "Hasil Latihan";

		$data_admin = ['id_privilege' => $this->session->userdata('id_privilege')];
		$data['admin'] = $this->m_admin->Checking($data_admin)->row_array();

		$data_privilege = ['id_privilege' => $data['admin']['id_privilege']];
		$data['privilege'] = $this->m_privilege->Checking($data_privilege)->row_array();

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

		$data['bank_soal'] = $this->m_soal->Tampil()->result();

		$this->load->view('admin/template/header', $data);
		$this->load->view('admin/latihan/hasil_latihan_murid');
		$this->load->view('admin/template/footer');
	}
	// Tutup Hasil Latihan

	// Tutup Latihan


	// Bank Soal
	public function bank_soal()
	{
		// Header
		$data['title'] = "Bank Soal | One Space";
		$data['sidebar'] = "Bank Soal";

		$data_admin = ['id_privilege' => $this->session->userdata('id_privilege')];
		$data['admin'] = $this->m_admin->Checking($data_admin)->row_array();

		$data_privilege = ['id_privilege' => $data['admin']['id_privilege']];
		$data['privilege'] = $this->m_privilege->Checking($data_privilege)->row_array();

		// Custom
		$data['latihan'] = $this->m_latihan->Tampil()->result();
		$data['bank_soal'] = $this->m_soal->Tampil()->result();

		$this->load->view('admin/template/header', $data);
		$this->load->view('admin/soal/bank_soal');
		$this->load->view('admin/template/footer');
	}
	public function tambah_bank_soal()
	{
		$this->form_validation->set_rules('id_latihan', 'Kelas', 'required|trim');
		$this->form_validation->set_rules('soal', 'Soal', 'required|trim');
		$this->form_validation->set_rules('tipe_soal', 'Tipe Soal', 'required|trim');

		if ($this->form_validation->run() == FALSE) {

			// Header
			$data['title'] = "Bank Soal | One Space";
			$data['sidebar'] = "Bank Soal";

			$data_admin = ['id_privilege' => $this->session->userdata('id_privilege')];
			$data['admin'] = $this->m_admin->Checking($data_admin)->row_array();

			$data_privilege = ['id_privilege' => $data['admin']['id_privilege']];
			$data['privilege'] = $this->m_privilege->Checking($data_privilege)->row_array();

			// Custom
			$data['latihan'] = $this->m_latihan->Tampil()->result();
			$data['bank_soal'] = $this->m_soal->Tampil()->result();

			$this->load->view('admin/template/header', $data);
			$this->load->view('admin/soal/tambah_bank_soal');
			$this->load->view('admin/template/footer');
		} else {

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
				'soal' => $soal,
				'tipe_soal' => $tipe_soal,
				'kunci_jawaban' => $kunci_jawaban,
				'pilihan_a' => $pilihan_a,
				'pilihan_b' => $pilihan_b,
				'pilihan_c' => $pilihan_c,
				'pilihan_d' => $pilihan_d,
				'pilihan_e' => $pilihan_e,
				'dibuat_soal' => date('Y-m-d H:i:s')
			];

			if ($this->m_soal->Tambah($tambah)) {
				$this->flasher->setFlash('Data berhasil ditambahkan', 'check-circle', 'success');
			} else {
				$this->flasher->setFlash('Data gagal ditambahkan', 'close-circle', 'danger');
			}
			redirect('admin/bank_soal');
		}
	}
	public function edit_bank_soal($id)
	{
		// Header
		$data['title'] = "Bank Soal | One Space";
		$data['sidebar'] = "Bank Soal";

		$data_admin = ['id_privilege' => $this->session->userdata('id_privilege')];
		$data['admin'] = $this->m_admin->Checking($data_admin)->row_array();

		$data_privilege = ['id_privilege' => $data['admin']['id_privilege']];
		$data['privilege'] = $this->m_privilege->Checking($data_privilege)->row_array();

		$where = ['id_soal' => $id];
		$data['bank_soal'] = $this->m_soal->Checking($where)->row_array();

		$data['latihan'] = $this->m_latihan->Tampil()->result();

		$this->load->view('admin/template/header', $data);
		$this->load->view('admin/soal/edit_bank_soal');
		$this->load->view('admin/template/footer');
	}
	// Tutup Bank Soal


	// Komentar
	public function komentar_tugas()
	{
		$this->form_validation->set_rules('id_tugas', 'Tugas', 'required|trim');
		$this->form_validation->set_rules('id_murid', 'Murid', 'required|trim');
		$this->form_validation->set_rules('isi_komentar', 'Komentar', 'required|trim');

		if ($this->form_validation->run() == FALSE) {

			// Header
			$data['title'] = "Komentar Tugas | One Space";
			$data['sidebar'] = "Komentar Tugas";

			$data_admin = ['id_privilege' => $this->session->userdata('id_privilege')];
			$data['admin'] = $this->m_admin->Checking($data_admin)->row_array();

			$data_privilege = ['id_privilege' => $data['admin']['id_privilege']];
			$data['privilege'] = $this->m_privilege->Checking($data_privilege)->row_array();

			$data['komentar'] = $this->m_komentar->TampilTugasAdmin()->result();
			$data['tugas'] = $this->m_tugas->Tampil()->result();
			$data['data_murid'] = $this->m_murid->Tampil()->result();

			$this->load->view('admin/template/header', $data);
			$this->load->view('admin/komentar/komentar_tugas');
			$this->load->view('admin/template/footer');
		} else {

			$id_tugas = $this->input->post('id_tugas');
			$id_murid = $this->input->post('id_murid');
			$isi_komentar = $this->input->post('isi_komentar');

			$tambah = [
				'id_tugas' => $id_tugas,
				'id_murid' => $id_murid,
				'isi_komentar' => $isi_komentar
			];

			if ($this->m_komentar->Tambah($tambah)) {
				$this->flasher->setFlash('Data berhasil ditambahkan', 'check-circle', 'success');
			} else {
				$this->flasher->setFlash('Data gagal ditambahkan', 'close-circle', 'danger');
			}
			redirect('admin/komentar_tugas');
		}
	}
	public function komentar_materi()
	{
		$this->form_validation->set_rules('id_materi', 'Materi', 'required|trim');
		$this->form_validation->set_rules('id_murid', 'Murid', 'required|trim');
		$this->form_validation->set_rules('isi_komentar', 'Komentar', 'required|trim');

		if ($this->form_validation->run() == FALSE) {

			// Header
			$data['title'] = "Komentar Materi | One Space";
			$data['sidebar'] = "Komentar Materi";

			$data_admin = ['id_privilege' => $this->session->userdata('id_privilege')];
			$data['admin'] = $this->m_admin->Checking($data_admin)->row_array();

			$data_privilege = ['id_privilege' => $data['admin']['id_privilege']];
			$data['privilege'] = $this->m_privilege->Checking($data_privilege)->row_array();

			$data['komentar'] = $this->m_komentar->TampilMateriAdmin()->result();
			$data['materi'] = $this->m_materi->Tampil()->result();
			$data['data_murid'] = $this->m_murid->Tampil()->result();

			$this->load->view('admin/template/header', $data);
			$this->load->view('admin/komentar/komentar_materi');
			$this->load->view('admin/template/footer');
		} else {

			$id_materi = $this->input->post('id_materi');
			$id_murid = $this->input->post('id_murid');
			$isi_komentar = $this->input->post('isi_komentar');

			$tambah = [
				'id_materi' => $id_materi,
				'id_murid' => $id_murid,
				'isi_komentar' => $isi_komentar
			];

			if ($this->m_komentar->Tambah($tambah)) {
				$this->flasher->setFlash('Data berhasil ditambahkan', 'check-circle', 'success');
			} else {
				$this->flasher->setFlash('Data gagal ditambahkan', 'close-circle', 'danger');
			}
			redirect('admin/komentar_materi');
		}
	}
	// Tutup Komentar


	// Data Master 
	public function data_guru()
	{
		$this->form_validation->set_rules('nama_guru', 'Nama Lengkap', 'required|trim|is_unique[guru.nama_guru]', ['is_unique' => 'Nama guru sudah terdaftar, silahkan coba yang lain!']);
		$this->form_validation->set_rules('nip_guru', 'NIP Guru', 'required|trim|is_unique[guru.nip_guru]', ['is_unique' => 'NIP guru sudah terdaftar, silahkan coba yang lain!']);
		$this->form_validation->set_rules('email_guru', 'Email', 'required|trim|valid_email|is_unique[guru.email_guru]', ['is_unique' => 'Email sudah terdaftar!']);
		$this->form_validation->set_rules('gender_guru', 'Jenis Kelamin', 'required|trim');
		$this->form_validation->set_rules('tempat_lahir_guru', 'Tempat Lahir', 'required|trim');
		$this->form_validation->set_rules('tanggal_lahir_guru', 'Tanggal Lahir', 'required|trim');
		$this->form_validation->set_rules('telepon_guru', 'Nomor Telepon', 'required|trim');
		$this->form_validation->set_rules('gelar_guru', 'Gelar', 'required|trim');

		// Alamat //
		$this->form_validation->set_rules('alamat', 'Alamat', 'required|trim');
		$this->form_validation->set_rules('kecamatan', 'Kecamatan', 'required|trim');
		$this->form_validation->set_rules('kelurahan', 'Kelurahan', 'required|trim');
		$this->form_validation->set_rules('kota', 'Kota', 'required|trim');
		$this->form_validation->set_rules('provinsi', 'Provinsi', 'required|trim');
		$this->form_validation->set_rules('kode_pos', 'Kode Pos', 'required|trim');

		if ($this->form_validation->run() == FALSE) {

			// Header
			$data['title'] = "Data Guru | One Space";
			$data['sidebar'] = "Data Guru";

			$data_admin = ['id_privilege' => $this->session->userdata('id_privilege')];
			$data['admin'] = $this->m_admin->Checking($data_admin)->row_array();

			$data_privilege = ['id_privilege' => $data['admin']['id_privilege']];
			$data['privilege'] = $this->m_privilege->Checking($data_privilege)->row_array();

			// Custom
			$data['data_guru'] = $this->m_guru->Tampil()->result();

			$this->load->view('admin/template/header', $data);
			$this->load->view('admin/guru/data_guru');
			$this->load->view('admin/template/footer');
		} else {

			$nama_guru = $this->input->post('nama_guru');
			$nip_guru = $this->input->post('nip_guru');
			$email_guru = $this->input->post('email_guru');
			$gender_guru = $this->input->post('gender_guru');
			$tempat_lahir_guru = $this->input->post('tempat_lahir_guru');
			$tanggal_lahir_guru = $this->input->post('tanggal_lahir_guru');
			$telepon_guru = $this->input->post('telepon_guru');
			$gelar_guru = $this->input->post('gelar_guru');

			// Alamat
			$alamat = $this->input->post('alamat');
			$kecamatan = $this->input->post('kecamatan');
			$kelurahan = $this->input->post('kelurahan');
			$kota = $this->input->post('kota');
			$provinsi = $this->input->post('provinsi');
			$kode_pos = $this->input->post('kode_pos');

			$tambah_alamat = [
				'alamat' => $alamat,
				'kecamatan' => $kecamatan,
				'kelurahan' => $kelurahan,
				'kota' => $kota,
				'provinsi' => $provinsi,
				'kode_pos' => $kode_pos
			];

			if ($this->m_alamat->Tambah($tambah_alamat)) {

				$id_alamat = $this->db->insert_id();
				$tambah = [
					'id_alamat' => $id_alamat,
					'nama_guru' => $nama_guru,
					'nip_guru' => $nip_guru,
					'email_guru' => $email_guru,
					'tempat_lahir_guru' => $tempat_lahir_guru,
					'tanggal_lahir_guru' => date('Y-m-d', strtotime($tanggal_lahir_guru)),
					'gender_guru' => $gender_guru,
					'telepon_guru' => $telepon_guru,
					'gelar_guru' => $gelar_guru,
					'dibuat_guru' => date('Y-m-d H:i:s'),
					'diupdate_guru' => date('Y-m-d H:i:s')
				];
				$this->m_guru->Tambah($tambah);
				$this->flasher->setFlash('Data berhasil ditambahkan!', 'check-circle', 'success');
			} else {
				$this->flasher->setFlash('Data gagal ditambahkan!', 'close-circle', 'danger');
			}
			redirect('admin/data_guru');
		}
	}
	public function data_murid()
	{
		$this->form_validation->set_rules('nama_murid', 'Nama Lengkap', 'required|trim|is_unique[murid.nama_murid]', ['is_unique' => 'Nama murid sudah terdaftar, silahkan coba yang lain!']);
		$this->form_validation->set_rules('email_murid', 'Email', 'required|trim|valid_email|is_unique[murid.email_murid]', ['is_unique' => 'Email sudah terdaftar!']);
		$this->form_validation->set_rules('nisn_murid', 'NISN', 'required|trim|is_unique[murid.nisn_murid]', ['is_unique' => 'NISN murid sudah terdaftar, silahkan coba yang lain!']);
		$this->form_validation->set_rules('nis_murid', 'NIS', 'required|trim|is_unique[murid.nis_murid]', ['is_unique' => 'NIS murid sudah terdaftar, silahkan coba yang lain!']);
		$this->form_validation->set_rules('kelas_murid', 'Kelas', 'required|trim');
		$this->form_validation->set_rules('id_jurusan', 'Jurusan', 'required|trim');
		$this->form_validation->set_rules('jurusan_murid', 'Jurusan', 'required|trim');
		$this->form_validation->set_rules('tempat_lahir_murid', 'Tempat Lahir', 'required|trim');
		$this->form_validation->set_rules('tanggal_lahir_murid', 'Tanggal Lahir', 'required|trim');
		$this->form_validation->set_rules('gender_murid', 'Jenis Kelamin', 'required|trim');
		$this->form_validation->set_rules('telepon_murid', 'Nomor Telepon', 'required|trim');

		// Alamat //
		$this->form_validation->set_rules('alamat', 'Alamat', 'required|trim');
		$this->form_validation->set_rules('kecamatan', 'Kecamatan', 'required|trim');
		$this->form_validation->set_rules('kelurahan', 'Kelurahan', 'required|trim');
		$this->form_validation->set_rules('kota', 'Kota', 'required|trim');
		$this->form_validation->set_rules('provinsi', 'Provinsi', 'required|trim');
		$this->form_validation->set_rules('kode_pos', 'Kode Pos', 'required|trim');

		if ($this->form_validation->run() == FALSE) {

			// Header
			$data['title'] = "Data Murid | One Space";
			$data['sidebar'] = "Data Murid";

			$data_admin = ['id_privilege' => $this->session->userdata('id_privilege')];
			$data['admin'] = $this->m_admin->Checking($data_admin)->row_array();

			$data_privilege = ['id_privilege' => $data['admin']['id_privilege']];
			$data['privilege'] = $this->m_privilege->Checking($data_privilege)->row_array();

			// Custom
			$data['data_murid'] = $this->m_murid->Tampil()->result();
			$data['jurusan'] = $this->m_jurusan->Tampil()->result();

			$this->load->view('admin/template/header', $data);
			$this->load->view('admin/murid/data_murid');
			$this->load->view('admin/template/footer');
		} else {

			$id_jurusan = $this->input->post('id_jurusan');
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

			// Alamat
			$alamat = $this->input->post('alamat');
			$kecamatan = $this->input->post('kecamatan');
			$kelurahan = $this->input->post('kelurahan');
			$kota = $this->input->post('kota');
			$provinsi = $this->input->post('provinsi');
			$kode_pos = $this->input->post('kode_pos');

			$tambah_alamat = [
				'alamat' => $alamat,
				'kecamatan' => $kecamatan,
				'kelurahan' => $kelurahan,
				'kota' => $kota,
				'provinsi' => $provinsi,
				'kode_pos' => $kode_pos
			];

			if ($this->m_alamat->Tambah($tambah_alamat)) {

				$id_alamat = $this->db->insert_id();
				$tambah = [
					'id_alamat' => $id_alamat,
					'id_jurusan' => $id_jurusan,
					'nama_murid' => $nama_murid,
					'email_murid' => $email_murid,
					'nisn_murid' => $nisn_murid,
					'nis_murid' => $nis_murid,
					'kelas_murid' => $kelas_murid,
					'jurusan_murid' => $jurusan_murid,
					'tempat_lahir_murid' => $tempat_lahir_murid,
					'tanggal_lahir_murid' => date('Y-m-d', strtotime($tanggal_lahir_murid)),
					'gender_murid' => $gender_murid,
					'telepon_murid' => $telepon_murid,
					'dibuat_murid' => date('Y-m-d H:i:s'),
					'diupdate_murid' => date('Y-m-d H:i:s')
				];
				$this->m_murid->Tambah($tambah);
				$this->flasher->setFlash('Data berhasil ditambahkan!', 'check-circle', 'success');
			} else {
				$this->flasher->setFlash('Data gagal ditambahkan!', 'close-circle', 'danger');
			}
			redirect('admin/data_murid');
		}
	}
	public function data_ortu()
	{
		$this->form_validation->set_rules('id_murid', 'Nama Anak', 'required|trim');
		$this->form_validation->set_rules('nama_ortu', 'Nama Ayah', 'required|trim');
		$this->form_validation->set_rules('email_ortu', 'Email', 'required|trim|valid_email|is_unique[orang_tua.email_ortu]', ['is_unique' => 'Email sudah terdaftar!']);
		$this->form_validation->set_rules('telepon_ortu', 'Telepon', 'required|trim');
		$this->form_validation->set_rules('status_ortu', 'Status', 'required|trim');

		if ($this->form_validation->run() == FALSE) {

			// Header
			$data['title'] = "Data Orang Tua | One Space";
			$data['sidebar'] = "Data Orang Tua";

			$data_admin = ['id_privilege' => $this->session->userdata('id_privilege')];
			$data['admin'] = $this->m_admin->Checking($data_admin)->row_array();

			$data_privilege = ['id_privilege' => $data['admin']['id_privilege']];
			$data['privilege'] = $this->m_privilege->Checking($data_privilege)->row_array();

			// Custom
			$data['data_ortu'] = $this->m_ortu->Tampil()->result();
			$data['data_murid'] = $this->m_murid->Tampil()->result();

			$this->load->view('admin/template/header', $data);
			$this->load->view('admin/ortu/data_ortu');
			$this->load->view('admin/template/footer');
		} else {

			$id_murid = $this->input->post('id_murid');
			$nama_ortu = $this->input->post('nama_ortu');
			$email_ortu = $this->input->post('email_ortu');
			$status_ortu = $this->input->post('status_ortu');
			$telepon_ortu = $this->input->post('telepon_ortu');

			$tambah = [
				'id_murid' => $id_murid,
				'nama_ortu' => $nama_ortu,
				'email_ortu' => $email_ortu,
				'status_ortu' => $status_ortu,
				'telepon_ortu' => $telepon_ortu,
				'dibuat_ortu' => date('Y-m-d H:i:s')
			];

			$data_check = ['nama_ortu' => $nama_ortu, 'id_murid' => $id_murid];
			$checking = $this->m_ortu->Checking($data_check)->num_rows();

			if ($checking > 0) {
				$this->flasher->setFlash('Data sudah ada, silahkan coba yang lain!', 'alert-circle', 'warning');
			} elseif ($this->m_ortu->Tambah($tambah)) {
				$this->flasher->setFlash('Data berhasil ditambahkan!', 'check-circle', 'success');
			} else {
				$this->flasher->setFlash('Data gagal ditambahkan!', 'close-circle', 'danger');
			}
			redirect('admin/data_ortu');
		}
	}
	public function mapel()
	{
		$this->form_validation->set_rules('nama_mapel', 'Kode Pos', 'required|trim');

		if ($this->form_validation->run() == FALSE) {

			// Header
			$data['title'] = "Mata Pelajaran | One Space";
			$data['sidebar'] = "Mata Pelajaran";

			$data_admin = ['id_privilege' => $this->session->userdata('id_privilege')];
			$data['admin'] = $this->m_admin->Checking($data_admin)->row_array();

			$data_privilege = ['id_privilege' => $data['admin']['id_privilege']];
			$data['privilege'] = $this->m_privilege->Checking($data_privilege)->row_array();

			// Custom
			$data['mapel'] = $this->m_mapel->Tampil()->result();

			$this->load->view('admin/template/header', $data);
			$this->load->view('admin/kbm/mapel');
			$this->load->view('admin/template/footer');
		} else {

			$nama_mapel = $this->input->post('nama_mapel');
			$tambah = ['nama_mapel' => $nama_mapel];

			$checking = $this->m_mapel->Checking($tambah)->num_rows();

			if ($checking > 0) {
				$this->flasher->setFlash(' ' . $nama_mapel . ', silahkan coba yang lain!', 'alert-circle', 'warning');
			} elseif ($this->m_mapel->Tambah($tambah)) {
				$this->flasher->setFlash('Data berhasil ditambahkan!', 'check-circle', 'success');
			} else {
				$this->flasher->setFlash('Data gagal ditambahkan!', 'close-circle', 'danger');
			}
			redirect('admin/mapel');
		}
	}

	// Tutup Data Master

	public function logout()
	{
		session_destroy();
		redirect('auth/');
	}

	//qrcode
	public function QRcode($kodenya = '1234567890')
	{
		//render qrcodenya pake format PNG
		QRcode::png(
			$kodenya,
			$outfile    = false,
			$level      = QR_ECLEVEL_H,
			$size       = 6,
			$margin     = 2

		);
	}
}
