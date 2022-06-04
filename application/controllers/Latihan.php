<?php

class Latihan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_latihan');
        $this->load->model('m_soal');
        $this->load->model('m_hasil_latihan');
    }

    public function edit_latihan($id)
    {
        $data_latihan = ['id_latihan' => $id];
        echo json_encode($this->m_latihan->Checking($data_latihan)->row());
    }

    public function update_latihan()
    {
        $id_latihan = $this->input->post('id_latihan');

        $id_kelas = $this->input->post('id_kelas');
        $nama_latihan = $this->input->post('nama_latihan');
        $tipe_latihan = $this->input->post('tipe_latihan');
        $deksripsi_latihan = $this->input->post('deksripsi_latihan');
        $waktu_latihan = $this->input->post('waktu_latihan');
        $tenggat_latihan = $this->input->post('tenggat_latihan');
        $tanggal_mulai = $this->input->post('tanggal_mulai');
        $point_latihan = $this->input->post('point_latihan');
        $dibuat_latihan = $this->input->post('dibuat_latihan');
        
        if($tenggat_latihan == 0) $tenggat_latihan = null;

        $data_latihan = [
            'id_kelas' => $id_kelas,
            'nama_latihan' => $nama_latihan,
            'tipe_latihan' => $tipe_latihan,
            'deksripsi_latihan' => $deksripsi_latihan,
            'waktu_latihan' => $waktu_latihan,
            'tenggat_latihan' => $tenggat_latihan,
            'tanggal_mulai' => $tanggal_mulai,
            'point_latihan' => $point_latihan,
            'dibuat_latihan' => $dibuat_latihan,
            'diupdate_latihan' => date('Y-m-d H:i:s')
        ];

        $this->m_latihan->Update($id_latihan, $data_latihan);
        $this->flasher->setFlash('Data berhasil diubah!','check-circle','success');

        redirect('admin/latihan');
    }

    public function delete_latihan($id)
    {
        $data = ['id_latihan' => $id];

        if ($this->m_soal->DeleteLatihan($id)){            
            $this->m_latihan->Delete($id);
            $this->flasher->setFlash('Data berhasil dihapus!', 'check-circle', 'success');
        } else {
            $this->flasher->setFlash('Data gagal dihapus!', 'close-circle', 'success');
        }
        redirect('admin/latihan');
    }
}
