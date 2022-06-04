<?php 

class GuruAdmin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_guru');
		$this->load->model('m_alamat');
	}

	public function edit_guru($id)
	{
		$data_guru = ['id_guru' => $id];
		echo json_encode($this->m_guru->CheckingAll($data_guru)->row());
	}

	public function update_guru()
	{
		$id_guru = $this->input->post('id_guru');
		$id_alamat = $this->input->post('id_alamat');
		
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
		$alamat = $this->input->post('alamat');
		$kecamatan = $this->input->post('kecamatan');
		$kelurahan = $this->input->post('kelurahan');
		$kota = $this->input->post('kota');
		$provinsi = $this->input->post('provinsi');
		$kode_pos = $this->input->post('kode_pos');

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
		
		$this->m_alamat->Update($id_alamat, $data_alamat);
		$this->m_guru->Update($id_guru, $data_guru);

		$this->flasher->setFlash('Data berhasil diubah!','check-circle','success');
		redirect('admin/data_guru');
	}

	public function delete_guru($id)
	{
		$data =['id_guru' => $id];
		$guru = $this->m_guru->Checking($data)->row_array();

		$id_alamat = $guru['id_alamat'];

		if($this->m_alamat->Delete($id_alamat)){
			$this->m_guru->Delete($id);
			$this->flasher->setFlash('Data berhasil dihapus!','check-circle','success');
		}else{
			$this->flasher->setFlash('Data gagal dihapus!','close-circle','success');
		}
		redirect('admin/data_guru');
	}

}

?>