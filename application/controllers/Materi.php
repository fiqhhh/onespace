<?php

class Materi extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_materi');
        $this->load->model('m_lampiran');
    }

    public function update_materi()
    {
        $id_materi = $this->input->post('id_materi');
        $id_kelas = $this->input->post('id_kelas');
        $nama_materi = $this->input->post('nama_materi');
        $deksripsi_materi = $this->input->post('deksripsi_materi');
        $dibuat_materi = $this->input->post('dibuat_materi');

        $where_lampiran = ['id_materi' => $id_materi];
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

                $data_materi = [
                    'id_kelas' => $id_kelas,
                    'nama_materi' => $nama_materi,
                    'deksripsi_materi' => $deksripsi_materi,
                    'dibuat_materi' => $dibuat_materi,
                    'diupdate_materi' => date('Y-m-d H:i:s')
                ];

                $tambah[$i]['id_materi'] = $id_materi;
                $tambah[$i]['nama_lampiran'] = $fileData['file_name'];

                $this->m_materi->Update($id_materi, $data_materi);

                $this->m_lampiran->DeleteMateri($id_materi);
                $this->m_lampiran->Tambah($tambah);
                $this->flasher->setFlash('Data beserta lampiran berhasil diubah!', 'check-circle', 'success');
            }else{

                // Kalau data tidak diapa-apakan
                $data_materi = [
                    'id_kelas' => $id_kelas,
                    'nama_materi' => $nama_materi,
                    'deksripsi_materi' => $deksripsi_materi,
                    'dibuat_materi' => $dibuat_materi,
                    'diupdate_materi' => date('Y-m-d H:i:s')
                ];

                $this->m_materi->Update($id_materi, $data_materi);
                $this->flasher->setFlash('Data berhasil diubah!', 'check-circle', 'success');
            }
        endfor;
        redirect('admin/materi');
    }

    public function delete_materi($id)
    {
        $data = ['id_materi' => $id];

        $lampiran = $this->m_lampiran->WhereMateri($id)->result();

        if ($this->m_lampiran->DeleteMateri($id)){
            foreach($lampiran as $key){ unlink('./assets/admin/lampiran/'.$key->nama_lampiran); }
            $this->m_materi->Delete($id);
            $this->flasher->setFlash('Data berhasil dihapus!', 'check-circle', 'success');
        } else {
            $this->flasher->setFlash('Data gagal dihapus!', 'close-circle', 'success');
        }
        redirect('admin/materi');
    }
}
