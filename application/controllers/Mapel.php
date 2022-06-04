<?php 

class Mapel extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_mapel');
	}

	public function edit_mapel($id)
	{
		$data_mapel = ['id_mapel' => $id];
		echo json_encode($this->m_mapel->Checking($data_mapel)->row());
	}

	public function update_mapel()
	{

		$id_mapel = $this->input->post('id_mapel');
		$nama_mapel = $this->input->post('nama_mapel');

		$data_mapel = ['nama_mapel' => $nama_mapel];
		
		$this->m_mapel->Update($id_mapel, $data_mapel);
		$this->flasher->setFlash('Data berhasil diubah!','check-circle','success');
		redirect('admin/mapel');
	}

	public function delete_mapel($id)
	{
		$data =['id_mapel' => $id];

		if($this->m_mapel->Delete($id)){
			$this->flasher->setFlash('Data berhasil dihapus!','check-circle','success');
		}else{
			$this->flasher->setFlash('Data gagal dihapus!','close-circle','success');
		}
		redirect('admin/mapel');
	}

}

?>