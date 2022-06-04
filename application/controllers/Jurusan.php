<?php 

class Jurusan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_jurusan');
	}

	public function edit_jurusan($id)
	{
		$data_jurusan = ['id_jurusan' => $id];
		echo json_encode($this->m_jurusan->Checking($data_jurusan)->row());
	}

	public function update_jurusan()
	{
		$id_jurusan = $this->input->post('id_jurusan');
		$nama_jurusan = $this->input->post('nama_jurusan');

		$data_jurusan = ['nama_jurusan' => $nama_jurusan];
		
		$this->m_jurusan->Update($id_jurusan, $data_jurusan);
		$this->flasher->setFlash('Data berhasil diubah!','check-circle','success');
		redirect('admin/jurusan');
	}

	public function delete_jurusan($id)
	{
		$data =['id_jurusan' => $id];

		if($this->m_jurusan->Delete($id)){
			$this->flasher->setFlash('Data berhasil dihapus!','check-circle','success');
		}else{
			$this->flasher->setFlash('Data gagal dihapus!','close-circle','success');
		}
		redirect('admin/jurusan');
	}

}

?>