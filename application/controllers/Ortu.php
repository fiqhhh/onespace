<?php 

class Ortu extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('nisn_murid') == "") {
			redirect('home');
		}
		$this->load->model('m_user');
		$this->load->model('m_absen');
		$this->load->model('m_ortu');
		$this->load->model('m_gabung_kelas');
	}
	public function index()
	{
		$data['title'] = "Dashboard - One Space";

		$data_ortu = $this->session->userdata('nisn_murid');
		$data['ortu'] = $this->m_user->CheckingOrtu($data_ortu)->row_array();

		$data['kelas'] = $this->m_gabung_kelas->CheckingMurid($data['ortu']['id_murid'])->result();
		$data['jmlh_kelas'] = $this->m_gabung_kelas->CheckingMurid($data['ortu']['id_murid'])->num_rows();

		$data['absen_hari_ini'] = $this->m_absen->MuridMasukHariIni($data['ortu']['id_murid'])->row_array();
		$data['absensi_masuk'] = $this->m_absen->AbsenMasukOrtuTgl($data['ortu']['id_murid'])->result();

		$data['data_absensi_masuk'] = $this->m_absen->TampilAbsenMasukOrtu($data['ortu']['id_murid'])->result();

		$this->load->view('user/ortu/templates/header', $data);
		$this->load->view('user/ortu/dashboard', $data);
		$this->load->view('user/ortu/templates/footer');

	}
	
	public function profile()
	{
		$data['title'] = "Profile - One Space";

		$data_ortu = $this->session->userdata('nisn_murid');
		$data['ortu'] = $this->m_user->CheckingOrtu($data_ortu)->row_array();

		$this->load->view('user/ortu/templates/header', $data);
		$this->load->view('user/ortu/profile/profile');
		$this->load->view('user/ortu/templates/footer');
	}

	public function edit_profile($id)
	{
		$this->form_validation->set_rules('nama_ortu', 'Nama Lengkap', 'required|trim');

		if ($this->form_validation->run() == FALSE) {
			$data['title'] = "Profile - One Space";

			$data_ortu = $this->session->userdata('nisn_murid');
			$data['ortu'] = $this->m_user->CheckingOrtu($data_ortu)->row_array();

			$where = ['id_orang_tua' => $id];
			$data['edit_ortu'] = $this->m_ortu->Checking($where)->row_array();

			$this->load->view('user/ortu/templates/header', $data);
			$this->load->view('user/ortu/profile/edit_profile');
			$this->load->view('user/ortu/templates/footer');
		} else {

			// Murid
			$id_orang_tua = $this->input->post('id_orang_tua');
			$id_murid = $this->input->post('id_murid');
			$nama_ortu = $this->input->post('nama_ortu');
			$email_ortu = $this->input->post('email_ortu');
			$status_ortu = $this->input->post('status_ortu');
			$telepon_ortu = $this->input->post('telepon_ortu');
			$dibuat_ortu = $this->input->post('dibuat_ortu');

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

				$data_ortu = [
					'id_murid' => $id_murid,
					'nama_ortu' => $nama_ortu,
					'email_ortu' => $email_ortu,
					'status_ortu' => $status_ortu,
					'telepon_ortu' => $telepon_ortu,
					'dibuat_ortu' => $dibuat_ortu,
					'diupdate_ortu' => date('Y-m-d H:i:s')
				];

				$this->m_ortu->Update($id_orang_tua, $data_ortu);
				$this->m_user->Update($id_auth, $data_auth);

				$this->session->set_flashdata('message', '<div class="alert bg-green-200 px-6 py-4 mt-5 mx-2 mb-5 rounded-md flex items-center mx-auto w-full"><svg viewBox="0 0 24 24" class="text-green-600 w-5 h-5 sm:w-5 sm:h-5 mr-3" ><path fill="currentColor" d="M12,0A12,12,0,1,0,24,12,12.014,12.014,0,0,0,12,0Zm6.927,8.2-6.845,9.289a1.011,1.011,0,0,1-1.43.188L5.764,13.769a1,1,0,1,1,1.25-1.562l4.076,3.261,6.227-8.451A1,1,0,1,1,18.927,8.2Z"></path></svg><span class="text-green-800">Profile berhasil diubah!</span></div>');
				redirect('ortu/profile');
			} else {

				$data_auth = [
					'foto_pengguna' => $this->upload->data('file_name'),
					'tanggal_dibuat' => $tanggal_dibuat
				];

				$data_ortu = [
					'id_murid' => $id_murid,
					'nama_ortu' => $nama_ortu,
					'email_ortu' => $email_ortu,
					'status_ortu' => $status_ortu,
					'telepon_ortu' => $telepon_ortu,
					'dibuat_ortu' => $dibuat_ortu,
					'diupdate_ortu' => date('Y-m-d H:i:s')
				];

				$old_foto = $old_foto_pengguna;

				if ($old_foto != "default.jpg") {
					unlink(FCPATH . 'assets/img/foto_pengguna/' . $old_foto);
				}

				$this->m_ortu->Update($id_orang_tua, $data_ortu);
				$this->m_user->Update($id_auth, $data_auth);

				$this->session->set_flashdata('message', '<div class="alert bg-green-200 px-6 py-4 mt-5 mx-2 mb-5 rounded-md flex items-center mx-auto w-full"><svg viewBox="0 0 24 24" class="text-green-600 w-5 h-5 sm:w-5 sm:h-5 mr-3" ><path fill="currentColor" d="M12,0A12,12,0,1,0,24,12,12.014,12.014,0,0,0,12,0Zm6.927,8.2-6.845,9.289a1.011,1.011,0,0,1-1.43.188L5.764,13.769a1,1,0,1,1,1.25-1.562l4.076,3.261,6.227-8.451A1,1,0,1,1,18.927,8.2Z"></path></svg><span class="text-green-800">Profile berhasil diubah!</span></div>');
				redirect('ortu/profile');
			}
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('home/masuk');
	}
	
}