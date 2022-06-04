<?php 

class MuridAdmin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_murid');
		$this->load->model('m_gabung_kelas');
		$this->load->model('m_alamat');
	}

	public function edit_murid($id)
	{
		$data = ['id_murid' => $id];
		echo json_encode($this->m_murid->CheckingAll($data)->row());
	}

	public function update_murid()
	{
		$id_murid = $this->input->post('id_murid');
		$id_alamat = $this->input->post('id_alamat');
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
		$dibuat_murid = $this->input->post('dibuat_murid');

		// Alamat
		$alamat = $this->input->post('alamat');
		$kecamatan = $this->input->post('kecamatan');
		$kelurahan = $this->input->post('kelurahan');
		$kota = $this->input->post('kota');
		$provinsi = $this->input->post('provinsi');
		$kode_pos = $this->input->post('kode_pos');

		$data_murid = [
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

		$this->m_alamat->Update($id_alamat, $data_alamat);
		$this->m_murid->Update($id_murid,$data_murid);

		$this->flasher->setFlash('Data berhasil diubah!','check-circle','success');
		redirect('admin/data_murid');
	}

	public function delete_murid($id)
	{
		$data = ['id_murid' => $id];
		$murid = $this->m_murid->Checking($data)->row_array();
		
		$id_alamat = $murid['id_alamat'];

		if($this->m_alamat->Delete($id_alamat)){
			$this->m_gabung_kelas->DeleteMurid($id);
			$this->m_murid->Delete($id);
			$this->flasher->setFlash('Data berhasil dihapus!','check-circle','success');
		}else{
			$this->flasher->setFlash('Hapus data gagal!','close-circle','danger');	
		}
		redirect('admin/data_murid');
	}

	

}

?>