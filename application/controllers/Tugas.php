<?php

class Tugas extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_tugas');
        $this->load->model('m_lampiran');
        $this->load->model('m_hasil_tugas');
    }

    public function update_tugas()
    {
        $id_tugas = $this->input->post('id_tugas');
        $id_kelas = $this->input->post('id_kelas');
        $nama_tugas = $this->input->post('nama_tugas');
        $tenggat_tugas = $this->input->post('tenggat_tugas');
        $deksripsi_tugas = $this->input->post('deksripsi_tugas');
        $dibuat_tugas = $this->input->post('dibuat_tugas');

        $where_lampiran = ['id_tugas' => $id_tugas];
        $result = $this->m_lampiran->Checking($where_lampiran)->result();

        $lampiran = count($_FILES['lampiran']['name']);

        for ($i = 0; $i < $lampiran; $i++) :

            $_FILES['file']['name'] = $_FILES['lampiran']['name'][$i];
            $_FILES['file']['type'] = $_FILES['lampiran']['type'][$i];
            $_FILES['file']['tmp_name'] = $_FILES['lampiran']['tmp_name'][$i];
            $_FILES['file']['size'] = $_FILES['lampiran']['size'][$i];

            $config['upload_path'] = './assets/admin/lampiran/';
            $config['allowed_types'] = 'png|jpg|jpeg|pdf|docx|pptx|xlsx';
            $config['max_size'] = '200000';
            $config['encrypt_name'] = TRUE;
            $this->upload->initialize($config);

            if($this->upload->do_upload('file')) {

                // Kalau data diapa-apakan
                $fileData = $this->upload->data();

                foreach($result as $key){
                    unlink('./assets/admin/lampiran/' . $key->nama_lampiran);
                }

                $data_tugas = [
                    'id_kelas' => $id_kelas,
                    'nama_tugas' => $nama_tugas,
                    'tenggat_tugas' => $tenggat_tugas,
                    'deksripsi_tugas' => $deksripsi_tugas,
                    'dibuat_tugas' => $dibuat_tugas,
                    'diupdate_tugas' => date('Y-m-d H:i:s')
                ];

                $tambah[$i]['id_tugas'] = $id_tugas;
                $tambah[$i]['nama_lampiran'] = $fileData['file_name'];

                $this->m_tugas->Update($id_tugas, $data_tugas);

                $this->m_lampiran->DeleteTugas($id_tugas);
                $this->m_lampiran->Tambah($tambah);
                $this->flasher->setFlash('Data beserta lampiran berhasil diubah!', 'check-circle', 'success');
            }else{

                // Kalau data tidak diapa-apakan
                $data_tugas = [
                    'id_kelas' => $id_kelas,
                    'nama_tugas' => $nama_tugas,
                    'tenggat_tugas' => $tenggat_tugas,
                    'deksripsi_tugas' => $deksripsi_tugas,
                    'dibuat_tugas' => $dibuat_tugas,
                    'diupdate_tugas' => date('Y-m-d H:i:s')
                ];

                $this->m_tugas->Update($id_tugas, $data_tugas);
                $this->flasher->setFlash('Data berhasil diubah!', 'check-circle', 'success');
            }
        endfor;
        redirect('admin/tugas');
    }

    public function delete_tugas($id)
    {
        $data = ['id_tugas' => $id];

        $lampiran_tugas = $this->m_lampiran->WhereTugas($id)->result();
        $lampiran_hasil = $this->m_lampiran->WhereHasil($id)->result();

        if ($this->m_lampiran->DeleteTugas($id)){

            foreach($lampiran_tugas as $key){ unlink('./assets/admin/lampiran/'.$key->nama_lampiran); }
            foreach($lampiran_hasil as $key){ unlink('./assets/admin/lampiran/'.$key->nama_lampiran); }
            
            $this->m_hasil_tugas->DeleteTugas($id);
            $this->m_tugas->Delete($id);
            $this->flasher->setFlash('Data berhasil dihapus!', 'check-circle', 'success');
        } else {
            $this->flasher->setFlash('Data gagal dihapus!', 'close-circle', 'success');
        }
        redirect('admin/tugas');
    }
}
