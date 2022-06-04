<?php 

class Gkelas extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_gabung_kelas');
	}

	public function edit_kelas($id)
	{
		$data_kelas = ['id_gabung_kelas' => $id];
		echo json_encode($this->m_gabung_kelas->Checking($data_kelas)->row());
	}

	public function update_kelas()
	{
		$id = $this->input->post('id_bergabung_kelas');
		$id_kelas = $this->input->post('id_kelas');
		$id_murid = $this->input->post('id_murid');
		$bergabung_pada = $this->input->post('bergabung_pada');

		$data_kelas = [
			'id_kelas' => $id_kelas,
			'id_murid' => $id_murid,
			'bergabung_pada' => $bergabung_pada
		];

		$this->m_gabung_kelas->Update($id, $data_kelas);
		$this->flasher->setFlash('Data berhasil diubah!','check-circle','success');
		redirect('admin/gabung_kelas');
	}

	public function delete_kelas($id)
	{
		$data =['id_gabung_kelas' => $id];

		if($this->m_gabung_kelas->Delete($id)){
			$this->flasher->setFlash('Data berhasil dihapus!','check-circle','success');
		}else{
			$this->flasher->setFlash('Data gagal dihapus!','close-circle','success');
		}
		redirect('admin/gabung_kelas');
	}

}

?>