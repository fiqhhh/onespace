<?php 

class Komentar extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_komentar');
	}

	public function edit_komentar($id)
	{
		$data_komentar = ['id_komentar' => $id];
		echo json_encode($this->m_komentar->Checking($data_komentar)->row());
	}

	public function update_komentar()
	{

		$id_komentar = $this->input->post('id_komentar');
		$id_tugas = $this->input->post('id_tugas');
		$id_materi = $this->input->post('id_materi');
		$id_murid = $this->input->post('id_murid');
		$isi_komentar = $this->input->post('isi_komentar');
		$dibuat_komentar = $this->input->post('dibuat_komentar');

		$data_komentar = [
			'id_tugas' => $id_tugas,
			'id_materi' => $id_materi,
			'id_murid' => $id_murid,
			'isi_komentar' => $isi_komentar,
			'dibuat_komentar' => $dibuat_komentar
		];
		
		$this->m_komentar->Update($id_komentar, $data_komentar);
		$this->flasher->setFlash('Data berhasil diubah!','check-circle','success');
		redirect('admin/komentar_tugas');
	}

	public function delete_komentar($id)
	{
		$data =['id_komentar' => $id];

		if($this->m_komentar->Delete($id)){
			$this->flasher->setFlash('Data berhasil dihapus!','check-circle','success');
		}else{
			$this->flasher->setFlash('Data gagal dihapus!','close-circle','success');
		}
		redirect('admin/komentar_tugas');
	}

}

?>