<?php 

class HasilLatihan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_hasil_latihan');
	}

	public function delete_hasil($id)
	{
		$data =['id_latihan' => $id];

		if($this->m_hasil_latihan->Delete($id)){
			$this->flasher->setFlash('Data berhasil dihapus!','check-circle','success');
		}else{
			$this->flasher->setFlash('Data gagal dihapus!','close-circle','success');
		}
		redirect('admin/hasil_latihan');
	}

}

?>