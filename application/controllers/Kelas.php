<?php 

class Kelas extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_kelas');
		$this->load->model('m_gabung_kelas');
	}

	public function edit_kelas($id)
	{
		$data_kelas = ['id_kelas' => $id];
		echo json_encode($this->m_kelas->Checking($data_kelas)->row());
	}

	public function update_kelas()
	{
		$id_kelas = $this->input->post('id_kelas');
		$id_mapel = $this->input->post('id_mapel');
		$id_guru = $this->input->post('id_guru');
		$id_jurusan = $this->input->post('id_jurusan');
		$nama_kelas = $this->input->post('nama_kelas');
		$tahun_pembelajaran = $this->input->post('tahun_pembelajaran');
		$token_kelas = $this->input->post('token_kelas');
		$dibuat_kelas = $this->input->post('dibuat_kelas');

		$data_kelas = [
			'id_guru' => $id_guru,
			'id_mapel' => $id_mapel,
			'id_jurusan' => $id_jurusan,
			'nama_kelas' => $nama_kelas,
			'tahun_pembelajaran' => $tahun_pembelajaran,
			'token_kelas' => $token_kelas,
			'dibuat_kelas' => $dibuat_kelas,
			'diupdate_kelas' => date('Y-m-d H:i:s')
		];

		$this->m_kelas->Update($id_kelas, $data_kelas);
		$this->flasher->setFlash('Data berhasil diubah!','check-circle','success');
		redirect('admin/kelas');
	}

	public function delete_kelas($id)
	{
		$data =['id_kelas' => $id];
		
		if($this->m_gabung_kelas->DeleteKelas($id)){
			$this->m_kelas->Delete($id);
			$this->flasher->setFlash('Data berhasil dihapus!','check-circle','success');
		}else{
			$this->flasher->setFlash('Data gagal dihapus!','close-circle','success');
		}
		redirect('admin/kelas');
	}

}

?>