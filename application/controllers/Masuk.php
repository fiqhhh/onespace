<?php 

class Masuk extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_user');
        $this->load->model('m_murid');
        $this->load->model('m_guru');
        $this->load->model('m_ortu');
    }

    public function index()
    {
        $data['title'] = "Masuk - One Space";
        $this->load->view('user/masuk', $data);   
    }
    public function proses_masuk()
    {
        $this->_proses();
    }

    private function _proses()
    {
        $ip_address = $_SERVER['REMOTE_ADDR'];

        $nip_guru = $this->input->post('nip_guru');
        $nisn_murid = $this->input->post('nisn_murid');
        $nisn_anak = $this->input->post('nisn_anak');

        // Mengambil Data -Data
        $cek_nip = ['nip_guru' => $nip_guru];
        $cek_nisn = ['nisn_murid' => $nisn_murid];
        
        // Mengambil data setiap tabel untuk diambil idNya
        $data_guru = $this->m_guru->Checking($cek_nip)->row_array();
        $data_murid = $this->m_murid->Checking($cek_nisn)->row_array();
        $data_ortu = $this->m_ortu->CheckingAll($nisn_anak)->row_array();

        if($data_guru == null && $data_murid != null && $data_ortu == null){

            if(empty($data_murid)){
                $this->flasher->setFlash('Data Murid tidak terdaftar!', 'close-circle', 'danger');
                redirect('masuk/');
            }else{
                // Mengecek Kalau sudah terdaftar
                $check_murid = ['id_murid' => $data_murid['id_murid']];
                $checking_murid = $this->m_user->Checking($check_murid)->num_rows();

                if($checking_murid > 0){

                    // Jika Sudah Terdaftar data langsung di cek
                    $data_murid = ['nisn_murid' => $nisn_murid];
                    $user = $this->m_user->Checking($data_murid)->row_array();

                    if($user['ip_address'] == $_SERVER['REMOTE_ADDR']){
                        $data_session = ['nisn_murid' => $user['nisn_murid']];
                        $this->session->set_userdata($data_session);
                        redirect('murid/');
                    }else{
                        $this->flasher->setFlash('Tidak bisa masuk, bukan akun anda!', 'close-circle', 'danger');
                        redirect('masuk/');
                    }

                }else{
                    // Jika Belum Terdaftar data akan ditambah lalu dicek
                    $tambah = [
                        'ip_address' => $ip_address,
                        'id_murid' => $data_murid['id_murid'],
                        'nisn_murid' => $nisn_murid,
                        'foto_pengguna' => "default_murid.png"
                    ];

                    $check_ip = ['ip_address' => $ip_address];
                    $check_nisn = ['nisn_murid' => $nisn_murid];

                    $checking_ip = $this->m_user->Checking($check_ip)->num_rows();
                    $checking_nisn = $this->m_user->Checking($check_nisn)->num_rows();

                    if($checking_ip > 0){

                        $this->flasher->setFlash('Ip Address sudah terdaftar!', 'close-circle', 'danger');
                        redirect('masuk/');

                    }elseif($checking_nisn > 0){

                        $this->flasher->setFlash('Nisn sudah terdaftar!', 'close-circle', 'danger');
                        redirect('masuk/');

                    }elseif($this->m_user->Tambah($tambah)){

                        $data_murid = ['nisn_murid' => $nisn_murid];
                        $user = $this->m_user->Checking($data_murid)->row_array();

                        if($user['ip_address'] == $_SERVER['REMOTE_ADDR']){
                            $data_session = ['nisn_murid' => $user['nisn_murid']];

                            $this->session->set_userdata($data_session);
                            redirect('murid/');
                        }else{
                            $this->flasher->setFlash('Tidak bisa masuk, bukan akun anda!', 'close-circle', 'danger');
                            redirect('masuk/');
                        }

                    }

                }
            }

        }elseif($data_guru != null && $data_murid == null && $data_ortu == null){

            if(empty($data_guru)){
                $this->flasher->setFlash('Data Guru tidak terdaftar!', 'close-circle', 'danger');
                redirect('masuk/');
            }else{
                // Mengecek Kalau sudah terdaftar
                $check_guru = ['id_guru' => $data_guru['id_guru']]; 
                $checking_guru = $this->m_user->Checking($check_guru)->num_rows();

                if($checking_guru > 0){

                    // Jika Sudah Terdaftar data akan dicek
                    $data_guru = ['nip_guru' => $nip_guru];
                    $user = $this->m_user->Checking($data_guru)->row_array();

                    if($user['ip_address'] == $_SERVER['REMOTE_ADDR']) {
                        $data_session = ['nip_guru' => $user['nip_guru']];

                        $this->session->set_userdata($data_session);
                        redirect('guru/');
                    }else{
                        $this->flasher->setFlash('Tidak bisa masuk, bukan akun anda!', 'close-circle', 'danger');
                        redirect('masuk/');
                    }

                }else{
                    // Jika Belum Terdaftar data akan ditambah lalu dicek
                    $tambah = [
                        'ip_address' => $ip_address,
                        'id_guru' => $data_guru['id_guru'],
                        'nip_guru' => $nip_guru,
                        'foto_pengguna' => "default_guru.png"
                    ];

                    $check_ip = ['ip_address' => $ip_address];
                    $check_nip = ['nip_guru' => $nip_guru];

                    $checking_ip = $this->m_user->Checking($check_ip)->num_rows();

                    if($checking_ip > 0){

                        $this->flasher->setFlash('Ip Address sudah terdaftar!', 'close-circle', 'danger');
                        redirect('masuk/');

                    }elseif($checking_nip > 0){    

                        $this->flasher->setFlash('Nip sudah terdaftar!', 'close-circle', 'danger');
                        redirect('masuk/');

                    }elseif($this->m_user->Tambah($tambah)){

                        $data_guru = ['nip_guru' => $nip_guru];
                        $user = $this->m_user->Checking($data_guru)->row_array();

                        if($user['ip_address'] == $_SERVER['REMOTE_ADDR']){
                            $data_session = ['nip_guru' => $user['nip_guru']];
                            
                            $this->session->set_userdata($data_session);
                            redirect('guru/');
                        }else{
                            $this->flasher->setFlash('Tidak bisa masuk, bukan akun anda!', 'close-circle', 'danger');
                            redirect('masuk/');
                        }
                    }
                }
            }

        }elseif($data_guru == null && $data_murid == null && $data_ortu != null){

            if(empty($data_ortu)){
                $this->flasher->setFlash('Data Ortu tidak terdaftar!', 'close-circle', 'danger');
                redirect('masuk/');
            }else{

                // Mengecek Kalau sudah terdaftar
                $check_ortu = ['id_orang_tua' => $data_ortu['id_orang_tua']]; 
                $checking_ortu = $this->m_user->Checking($check_ortu)->num_rows();

                if($checking_ortu > 0){

                    // Jika Sudah Terdaftar data akan dicek
                    $data_ortu = ['id_orang_tua' => $data_ortu['id_orang_tua']];
                    $user = $this->m_user->Checking($data_ortu)->row_array();

                    if($user['ip_address'] == $_SERVER['REMOTE_ADDR']) {
                        $data_session = ['nisn_murid' => $user['nisn_murid']];

                        $this->session->set_userdata($data_session);
                        redirect('ortu/');
                    }else{
                        $this->flasher->setFlash('Tidak bisa masuk, bukan akun anda!', 'close-circle', 'danger');
                        redirect('masuk/');
                    }

                }else{
                    // Jika Belum Terdaftar data akan ditambah lalu dicek
                    $tambah = [
                        'ip_address' => $ip_address,
                        'id_orang_tua' => $data_ortu['id_orang_tua'],
                        'nisn_murid' => $nisn_anak,
                        'foto_pengguna' => "default_ortu.png"
                    ];

                    $check_ip = ['ip_address' => $ip_address];
                    $check_nisn = ['nisn_murid' => $nisn_murid];

                    $checking_ip = $this->m_user->Checking($check_ip)->num_rows();

                    if($checking_ip > 0){

                        $this->flasher->setFlash('Ip Address sudah terdaftar!', 'close-circle', 'danger');
                        redirect('masuk/');

                    }elseif($checking_nisn > 0){    

                        $this->flasher->setFlash('Nisn sudah terdaftar!', 'close-circle', 'danger');
                        redirect('masuk/');

                    }elseif($this->m_user->Tambah($tambah)){

                        $data_ortu = ['id_orang_tua' => $data_ortu['id_orang_tua']];
                        $user = $this->m_user->Checking($data_ortu)->row_array();

                        if($user['ip_address'] == $_SERVER['REMOTE_ADDR']){
                            $data_session = ['id_orang_tua' => $user['id_orang_tua']];
                            
                            $this->session->set_userdata($data_session);
                            redirect('ortu/');
                        }else{
                            $this->flasher->setFlash('Tidak bisa masuk, bukan akun anda!', 'close-circle', 'danger');
                            redirect('masuk/');
                        }
                    }
                }
            }

        }else{
            $this->flasher->setFlash('Data tidak terdaftar!', 'close-circle', 'danger');
            redirect('masuk/');
        }
    }

}