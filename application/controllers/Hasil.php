<?php

class Hasil extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_hasil_tugas');
        $this->load->model('m_lampiran');
    }

    public function update_hasil()
    {
        $id_hasil_tugas = $this->input->post('id_hasil_tugas');
        $id_tugas = $this->input->post('id_tugas');
        $id_murid = $this->input->post('id_murid');

        $where_lampiran = ['id_hasil_tugas' => $id_hasil_tugas];
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

                $data_hasil = [
                    'id_tugas' => $id_tugas,
                    'id_murid' => $id_murid,
                    'dikumpulkan_tugas' => date('Y-m-d H:i:s'),
                    'diupdate_hasil' => date('Y-m-d H:i:s')
                ];

                $tambah[$i]['id_hasil_tugas'] = $id_hasil_tugas;
                $tambah[$i]['nama_lampiran'] = $fileData['file_name'];

                $this->m_hasil_tugas->Update($id_hasil_tugas, $data_hasil);

                $this->m_lampiran->DeleteHasil($id_hasil_tugas);
                $this->m_lampiran->Tambah($tambah);
                $this->flasher->setFlash('Data beserta lampiran berhasil diubah!', 'check-circle', 'success');
            }else{

                // Kalau data tidak diapa-apakan
                $data_hasil = [
                    'id_tugas' => $id_tugas,
                    'id_murid' => $id_murid,
                    'dikumpulkan_tugas' => date('Y-m-d H:i:s'),
                    'diupdate_hasil' => date('Y-m-d H:i:s')
                ];

                $this->m_hasil_tugas->Update($id_hasil_tugas, $data_hasil);
                $this->flasher->setFlash('Data berhasil diubah!', 'check-circle', 'success');
            }
        endfor;
        redirect('admin/hasil_tugas');
    }

    public function delete_hasil($id)
    {
        $data = ['id_hasil_tugas' => $id];

        $lampiran = $this->m_lampiran->WhereHasil($id)->result();

        if ($this->m_lampiran->DeleteHasil($id)){
            foreach($lampiran as $key){ unlink('./assets/admin/lampiran/'.$key->nama_lampiran); }
            $this->m_hasil_tugas->Delete($id);
            $this->flasher->setFlash('Data berhasil dihapus!', 'check-circle', 'success');
        } else {
            $this->flasher->setFlash('Data gagal dihapus!', 'close-circle', 'success');
        }
        redirect('admin/hasil_tugas');
    }
}
