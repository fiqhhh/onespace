<?php 

class OrtuAdmin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_ortu');
	}

	public function edit_ortu($id)
	{
		$data_ortu = ['id_orang_tua' => $id];
		echo json_encode($this->m_ortu->Checking($data_ortu)->row());
	}

	public function update_ortu()
	{
		$id_orang_tua = $this->input->post('id_orang_tua');
		$id_murid = $this->input->post('id_murid');
		$nama_ortu = $this->input->post('nama_ortu');
		$email_ortu = $this->input->post('email_ortu');
		$status_ortu = $this->input->post('status_ortu');
		$telepon_ortu = $this->input->post('telepon_ortu');
		$dibuat_ortu = $this->input->post('dibuat_ortu');

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
		$this->flasher->setFlash('Data berhasil diubah!','check-circle','success');
		redirect('admin/data_ortu');
	}

	public function delete_ortu($id)
	{
		$data =['id_orang_tua' => $id];

		if($this->m_ortu->Delete($id)){
			$this->flasher->setFlash('Data berhasil dihapus!','check-circle','success');
		}else{
			$this->flasher->setFlash('Data gagal dihapus!','close-circle','success');
		}
		redirect('admin/data_ortu');
	}

}

?>