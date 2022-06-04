<?php 

class Home extends CI_Controller {

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
        $data['title'] = "Selamat Datang di Aplikasi Kita - One Space";
        $this->load->view('user/index', $data);
    }   

    public function masuk()
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
                $this->session->set_flashdata('message', '<div class="alert bg-red-200 px-6 py-4 mx-2 my-4 rounded-md flex items-center mx-auto w-full"><svg viewBox="0 0 24 24" class="text-red-600 w-5 h-5 sm:w-5 sm:h-5 mr-3"><path fill="currentColor" d="M11.983,0a12.206,12.206,0,0,0-8.51,3.653A11.8,11.8,0,0,0,0,12.207,11.779,11.779,0,0,0,11.8,24h.214A12.111,12.111,0,0,0,24,11.791h0A11.766,11.766,0,0,0,11.983,0ZM10.5,16.542a1.476,1.476,0,0,1,1.449-1.53h.027a1.527,1.527,0,0,1,1.523,1.47,1.475,1.475,0,0,1-1.449,1.53h-.027A1.529,1.529,0,0,1,10.5,16.542ZM11,12.5v-6a1,1,0,0,1,2,0v6a1,1,0,1,1-2,0Z"></path></svg><span class="text-red-800"> Data tidak terdaftar. </span></div>');
                redirect('home/masuk');
            }else{
                // Mengecek Kalau sudah terdaftar
                $check_murid = ['id_murid' => $data_murid['id_murid']];
                $checking_murid = $this->m_user->Checking($check_murid)->num_rows();

                if($checking_murid > 0){

                    // Jika Sudah Terdaftar data langsung di cek
                    $data_murid = ['nisn_murid' => $nisn_murid];
                    $user = $this->m_user->Checking($data_murid)->row_array();

                    $where_murid = ['id_murid' => $user['id_murid']];
                    $murid = $this->m_murid->Checking($where_murid)->row_array();

                    if($user['ip_address'] == $_SERVER['REMOTE_ADDR']){
                        $data_session = ['nisn_murid' => $user['nisn_murid']];
                        $this->session->set_userdata($data_session);

                        $this->session->set_flashdata('message', '<div class="alert bg-green-200 px-6 py-4 mx-2 mb-5 rounded-md flex items-center mx-auto w-full"><svg viewBox="0 0 24 24" class="text-green-600 w-5 h-5 sm:w-5 sm:h-5 mr-3" ><path fill="currentColor" d="M12,0A12,12,0,1,0,24,12,12.014,12.014,0,0,0,12,0Zm6.927,8.2-6.845,9.289a1.011,1.011,0,0,1-1.43.188L5.764,13.769a1,1,0,1,1,1.25-1.562l4.076,3.261,6.227-8.451A1,1,0,1,1,18.927,8.2Z"></path></svg><span class="text-green-800">Selamat datang, '.$murid['nama_murid'].' :)</span></div>');

                        redirect('murid/');
                    }else{
                        $this->session->set_flashdata('message', '<div class="alert bg-red-200 px-6 py-4 mx-2 my-4 rounded-md flex items-center mx-auto w-full"><svg viewBox="0 0 24 24" class="text-red-600 w-5 h-5 sm:w-5 sm:h-5 mr-3"><path fill="currentColor" d="M11.983,0a12.206,12.206,0,0,0-8.51,3.653A11.8,11.8,0,0,0,0,12.207,11.779,11.779,0,0,0,11.8,24h.214A12.111,12.111,0,0,0,24,11.791h0A11.766,11.766,0,0,0,11.983,0ZM10.5,16.542a1.476,1.476,0,0,1,1.449-1.53h.027a1.527,1.527,0,0,1,1.523,1.47,1.475,1.475,0,0,1-1.449,1.53h-.027A1.529,1.529,0,0,1,10.5,16.542ZM11,12.5v-6a1,1,0,0,1,2,0v6a1,1,0,1,1-2,0Z"></path></svg><span class="text-red-800"> Tidak bisa masuk, bukan akun anda!. </span></div>');
                        redirect('home/masuk');
                    }

                }else{
                    // Jika Belum Terdaftar data akan ditambah lalu dicek
                    $tambah = [
                        'ip_address' => $ip_address,
                        'id_murid' => $data_murid['id_murid'],
                        'nisn_murid' => $nisn_murid,
                        'foto_pengguna' => "default.jpg"
                    ];

                    $check_ip = ['ip_address' => $ip_address];
                    $check_nisn = ['nisn_murid' => $nisn_murid];

                    $checking_ip = $this->m_user->Checking($check_ip)->num_rows();
                    $checking_nisn = $this->m_user->Checking($check_nisn)->num_rows();

                    if($checking_ip > 0){

                        $this->session->set_flashdata('message', '<div class="alert bg-red-200 px-6 py-4 mx-2 my-4 rounded-md flex items-center mx-auto w-full"><svg viewBox="0 0 24 24" class="text-red-600 w-5 h-5 sm:w-5 sm:h-5 mr-3"><path fill="currentColor" d="M11.983,0a12.206,12.206,0,0,0-8.51,3.653A11.8,11.8,0,0,0,0,12.207,11.779,11.779,0,0,0,11.8,24h.214A12.111,12.111,0,0,0,24,11.791h0A11.766,11.766,0,0,0,11.983,0ZM10.5,16.542a1.476,1.476,0,0,1,1.449-1.53h.027a1.527,1.527,0,0,1,1.523,1.47,1.475,1.475,0,0,1-1.449,1.53h-.027A1.529,1.529,0,0,1,10.5,16.542ZM11,12.5v-6a1,1,0,0,1,2,0v6a1,1,0,1,1-2,0Z"></path></svg><span class="text-red-800"> Ip Address sudah terdaftar. </span></div>');
                        redirect('home/masuk');

                    }elseif($checking_nisn > 0){

                        $this->session->set_flashdata('message', '<div class="alert bg-red-200 px-6 py-4 mx-2 my-4 rounded-md flex items-center mx-auto w-full"><svg viewBox="0 0 24 24" class="text-red-600 w-5 h-5 sm:w-5 sm:h-5 mr-3"><path fill="currentColor" d="M11.983,0a12.206,12.206,0,0,0-8.51,3.653A11.8,11.8,0,0,0,0,12.207,11.779,11.779,0,0,0,11.8,24h.214A12.111,12.111,0,0,0,24,11.791h0A11.766,11.766,0,0,0,11.983,0ZM10.5,16.542a1.476,1.476,0,0,1,1.449-1.53h.027a1.527,1.527,0,0,1,1.523,1.47,1.475,1.475,0,0,1-1.449,1.53h-.027A1.529,1.529,0,0,1,10.5,16.542ZM11,12.5v-6a1,1,0,0,1,2,0v6a1,1,0,1,1-2,0Z"></path></svg><span class="text-red-800"> NISN sudah terdaftar. </span></div>');
                        redirect('home/masuk');

                    }elseif($this->m_user->Tambah($tambah)){

                        $data_murid = ['nisn_murid' => $nisn_murid];
                        $user = $this->m_user->Checking($data_murid)->row_array();

                        $where_murid = ['id_murid' => $user['id_murid']];
                        $murid = $this->m_murid->Checking($where_murid)->row_array();

                        if($user['ip_address'] == $_SERVER['REMOTE_ADDR']){
                            $data_session = ['nisn_murid' => $user['nisn_murid']];
                            $this->session->set_userdata($data_session);

                            $this->session->set_flashdata('message', '<div class="alert bg-green-200 px-6 py-4 mx-2 mb-5 rounded-md flex items-center mx-auto w-full"><svg viewBox="0 0 24 24" class="text-green-600 w-5 h-5 sm:w-5 sm:h-5 mr-3" ><path fill="currentColor" d="M12,0A12,12,0,1,0,24,12,12.014,12.014,0,0,0,12,0Zm6.927,8.2-6.845,9.289a1.011,1.011,0,0,1-1.43.188L5.764,13.769a1,1,0,1,1,1.25-1.562l4.076,3.261,6.227-8.451A1,1,0,1,1,18.927,8.2Z"></path></svg><span class="text-green-800">Selamat datang, '.$murid['nama_murid'].' :)</span></div>');
                            redirect('murid/');
                        }else{
                            $this->session->set_flashdata('message', '<div class="alert bg-red-200 px-6 py-4 mx-2 my-4 rounded-md flex items-center mx-auto w-full"><svg viewBox="0 0 24 24" class="text-red-600 w-5 h-5 sm:w-5 sm:h-5 mr-3"><path fill="currentColor" d="M11.983,0a12.206,12.206,0,0,0-8.51,3.653A11.8,11.8,0,0,0,0,12.207,11.779,11.779,0,0,0,11.8,24h.214A12.111,12.111,0,0,0,24,11.791h0A11.766,11.766,0,0,0,11.983,0ZM10.5,16.542a1.476,1.476,0,0,1,1.449-1.53h.027a1.527,1.527,0,0,1,1.523,1.47,1.475,1.475,0,0,1-1.449,1.53h-.027A1.529,1.529,0,0,1,10.5,16.542ZM11,12.5v-6a1,1,0,0,1,2,0v6a1,1,0,1,1-2,0Z"></path></svg><span class="text-red-800"> Tidak bisa masuk, bukan akun anda!. </span></div>');
                            redirect('home/masuk');
                        }
                    }
                    
                }
            }

        }elseif($data_guru != null && $data_murid == null && $data_ortu == null){

            if(empty($data_guru)){
                $this->session->set_flashdata('message', '<div class="alert bg-red-200 px-6 py-4 mx-2 my-4 rounded-md flex items-center mx-auto w-full"><svg viewBox="0 0 24 24" class="text-red-600 w-5 h-5 sm:w-5 sm:h-5 mr-3"><path fill="currentColor" d="M11.983,0a12.206,12.206,0,0,0-8.51,3.653A11.8,11.8,0,0,0,0,12.207,11.779,11.779,0,0,0,11.8,24h.214A12.111,12.111,0,0,0,24,11.791h0A11.766,11.766,0,0,0,11.983,0ZM10.5,16.542a1.476,1.476,0,0,1,1.449-1.53h.027a1.527,1.527,0,0,1,1.523,1.47,1.475,1.475,0,0,1-1.449,1.53h-.027A1.529,1.529,0,0,1,10.5,16.542ZM11,12.5v-6a1,1,0,0,1,2,0v6a1,1,0,1,1-2,0Z"></path></svg><span class="text-red-800"> Data tidak terdaftar. </span></div>');

                redirect('home/masuk');
            }else{
                // Mengecek Kalau sudah terdaftar
                $check_guru = ['id_guru' => $data_guru['id_guru']]; 
                $checking_guru = $this->m_user->Checking($check_guru)->num_rows();

                if($checking_guru > 0){

                    // Jika Sudah Terdaftar data akan dicek
                    $data_guru = ['nip_guru' => $nip_guru];
                    $user = $this->m_user->Checking($data_guru)->row_array();

                    $where_guru = ['id_guru' => $user['id_guru']];
                    $guru = $this->m_guru->Checking($where_guru)->row_array();

                    if($user['ip_address'] == $_SERVER['REMOTE_ADDR']) {
                        $data_session = ['nip_guru' => $user['nip_guru']];
                        $this->session->set_userdata($data_session);
                        
                        $this->session->set_flashdata('message', '<div class="alert bg-green-200 px-6 py-4 mx-2 mb-5 rounded-md flex items-center mx-auto w-full"><svg viewBox="0 0 24 24" class="text-green-600 w-5 h-5 sm:w-5 sm:h-5 mr-3" ><path fill="currentColor" d="M12,0A12,12,0,1,0,24,12,12.014,12.014,0,0,0,12,0Zm6.927,8.2-6.845,9.289a1.011,1.011,0,0,1-1.43.188L5.764,13.769a1,1,0,1,1,1.25-1.562l4.076,3.261,6.227-8.451A1,1,0,1,1,18.927,8.2Z"></path></svg><span class="text-green-800">Selamat datang, '.$guru['nama_guru'].' :)</span></div>');

                        redirect('guru/');
                    }else{
                        $this->session->set_flashdata('message', '<div class="alert bg-red-200 px-6 py-4 mx-2 my-4 rounded-md flex items-center mx-auto w-full"><svg viewBox="0 0 24 24" class="text-red-600 w-5 h-5 sm:w-5 sm:h-5 mr-3"><path fill="currentColor" d="M11.983,0a12.206,12.206,0,0,0-8.51,3.653A11.8,11.8,0,0,0,0,12.207,11.779,11.779,0,0,0,11.8,24h.214A12.111,12.111,0,0,0,24,11.791h0A11.766,11.766,0,0,0,11.983,0ZM10.5,16.542a1.476,1.476,0,0,1,1.449-1.53h.027a1.527,1.527,0,0,1,1.523,1.47,1.475,1.475,0,0,1-1.449,1.53h-.027A1.529,1.529,0,0,1,10.5,16.542ZM11,12.5v-6a1,1,0,0,1,2,0v6a1,1,0,1,1-2,0Z"></path></svg><span class="text-red-800"> Tidak bisa masuk, bukan akun anda!. </span></div>');
                        redirect('home/masuk');
                    }

                }else{
                    // Jika Belum Terdaftar data akan ditambah lalu dicek
                    $tambah = [
                        'ip_address' => $ip_address,
                        'id_guru' => $data_guru['id_guru'],
                        'nip_guru' => $nip_guru,
                        'foto_pengguna' => "default.jpg"
                    ];

                    $check_ip = ['ip_address' => $ip_address];
                    $check_nip = ['nip_guru' => $nip_guru];

                    $checking_ip = $this->m_user->Checking($check_ip)->num_rows();
                    $checking_nip = $this->m_user->Checking($check_nip)->num_rows();

                    if($checking_ip > 0){

                        $this->session->set_flashdata('message', '<div class="alert bg-red-200 px-6 py-4 mx-2 my-4 rounded-md flex items-center mx-auto w-full"><svg viewBox="0 0 24 24" class="text-red-600 w-5 h-5 sm:w-5 sm:h-5 mr-3"><path fill="currentColor" d="M11.983,0a12.206,12.206,0,0,0-8.51,3.653A11.8,11.8,0,0,0,0,12.207,11.779,11.779,0,0,0,11.8,24h.214A12.111,12.111,0,0,0,24,11.791h0A11.766,11.766,0,0,0,11.983,0ZM10.5,16.542a1.476,1.476,0,0,1,1.449-1.53h.027a1.527,1.527,0,0,1,1.523,1.47,1.475,1.475,0,0,1-1.449,1.53h-.027A1.529,1.529,0,0,1,10.5,16.542ZM11,12.5v-6a1,1,0,0,1,2,0v6a1,1,0,1,1-2,0Z"></path></svg><span class="text-red-800"> Ip Address sudah terdaftar. </span></div>');
                        redirect('home/masuk');

                    }elseif($checking_nip > 0){

                        $this->session->set_flashdata('message', '<div class="alert bg-red-200 px-6 py-4 mx-2 my-4 rounded-md flex items-center mx-auto w-full"><svg viewBox="0 0 24 24" class="text-red-600 w-5 h-5 sm:w-5 sm:h-5 mr-3"><path fill="currentColor" d="M11.983,0a12.206,12.206,0,0,0-8.51,3.653A11.8,11.8,0,0,0,0,12.207,11.779,11.779,0,0,0,11.8,24h.214A12.111,12.111,0,0,0,24,11.791h0A11.766,11.766,0,0,0,11.983,0ZM10.5,16.542a1.476,1.476,0,0,1,1.449-1.53h.027a1.527,1.527,0,0,1,1.523,1.47,1.475,1.475,0,0,1-1.449,1.53h-.027A1.529,1.529,0,0,1,10.5,16.542ZM11,12.5v-6a1,1,0,0,1,2,0v6a1,1,0,1,1-2,0Z"></path></svg><span class="text-red-800"> NISN sudah terdaftar. </span></div>');
                        redirect('home/masuk');

                    }elseif($this->m_user->Tambah($tambah)){

                        $data_guru = ['nip_guru' => $nip_guru];
                        $user = $this->m_user->Checking($data_guru)->row_array();

                        $where_guru = ['id_guru' => $user['id_guru']];
                        $guru = $this->m_guru->Checking($where_guru)->row_array();

                        if($user['ip_address'] == $_SERVER['REMOTE_ADDR']){
                            $data_session = ['nip_guru' => $user['nip_guru']];

                            $this->session->set_userdata($data_session);
                            $this->session->set_flashdata('message', '<div class="alert bg-green-200 px-6 py-4 mx-2 mb-5 rounded-md flex items-center mx-auto w-full"><svg viewBox="0 0 24 24" class="text-green-600 w-5 h-5 sm:w-5 sm:h-5 mr-3" ><path fill="currentColor" d="M12,0A12,12,0,1,0,24,12,12.014,12.014,0,0,0,12,0Zm6.927,8.2-6.845,9.289a1.011,1.011,0,0,1-1.43.188L5.764,13.769a1,1,0,1,1,1.25-1.562l4.076,3.261,6.227-8.451A1,1,0,1,1,18.927,8.2Z"></path></svg><span class="text-green-800">Selamat datang, '.$guru['nama_guru'].' :)</span></div>');
                            redirect('guru/');
                        }else{
                            $this->session->set_flashdata('message', '<div class="alert bg-red-200 px-6 py-4 mx-2 my-4 rounded-md flex items-center mx-auto w-full"><svg viewBox="0 0 24 24" class="text-red-600 w-5 h-5 sm:w-5 sm:h-5 mr-3"><path fill="currentColor" d="M11.983,0a12.206,12.206,0,0,0-8.51,3.653A11.8,11.8,0,0,0,0,12.207,11.779,11.779,0,0,0,11.8,24h.214A12.111,12.111,0,0,0,24,11.791h0A11.766,11.766,0,0,0,11.983,0ZM10.5,16.542a1.476,1.476,0,0,1,1.449-1.53h.027a1.527,1.527,0,0,1,1.523,1.47,1.475,1.475,0,0,1-1.449,1.53h-.027A1.529,1.529,0,0,1,10.5,16.542ZM11,12.5v-6a1,1,0,0,1,2,0v6a1,1,0,1,1-2,0Z"></path></svg><span class="text-red-800"> Tidak bisa masuk, bukan akun anda!. </span></div>');
                            redirect('home/masuk');
                        }
                    }
                }
            }

        }elseif($data_guru == null && $data_murid == null && $data_ortu != null){

            if(empty($data_ortu)){
                $this->session->set_flashdata('message', '<div class="alert bg-red-200 px-6 py-4 mx-2 my-4 rounded-md flex items-center mx-auto w-full"><svg viewBox="0 0 24 24" class="text-red-600 w-5 h-5 sm:w-5 sm:h-5 mr-3"><path fill="currentColor" d="M11.983,0a12.206,12.206,0,0,0-8.51,3.653A11.8,11.8,0,0,0,0,12.207,11.779,11.779,0,0,0,11.8,24h.214A12.111,12.111,0,0,0,24,11.791h0A11.766,11.766,0,0,0,11.983,0ZM10.5,16.542a1.476,1.476,0,0,1,1.449-1.53h.027a1.527,1.527,0,0,1,1.523,1.47,1.475,1.475,0,0,1-1.449,1.53h-.027A1.529,1.529,0,0,1,10.5,16.542ZM11,12.5v-6a1,1,0,0,1,2,0v6a1,1,0,1,1-2,0Z"></path></svg><span class="text-red-800"> Data tidak terdaftar. </span></div>');
                redirect('home/masuk');
            }else{

                // Mengecek Kalau sudah terdaftar
                $check_ortu = ['id_orang_tua' => $data_ortu['id_orang_tua']]; 
                $checking_ortu = $this->m_user->Checking($check_ortu)->num_rows();

                if($checking_ortu > 0){

                    // Jika Sudah Terdaftar data akan dicek
                    $data_ortu = ['id_orang_tua' => $data_ortu['id_orang_tua']];
                    $user = $this->m_user->Checking($data_ortu)->row_array();

                    $where_ortu = ['id_orang_tua' => $user['id_orang_tua']];
                    $ortu = $this->m_ortu->Checking($where_ortu)->row_array();

                    if($user['ip_address'] == $_SERVER['REMOTE_ADDR']) {
                        $data_session = ['nisn_murid' => $user['nisn_murid']];

                        $this->session->set_userdata($data_session);
                        $this->session->set_flashdata('message', '<div class="alert bg-green-200 px-6 py-4 mx-2 mb-5 rounded-md flex items-center mx-auto w-full"><svg viewBox="0 0 24 24" class="text-green-600 w-5 h-5 sm:w-5 sm:h-5 mr-3" ><path fill="currentColor" d="M12,0A12,12,0,1,0,24,12,12.014,12.014,0,0,0,12,0Zm6.927,8.2-6.845,9.289a1.011,1.011,0,0,1-1.43.188L5.764,13.769a1,1,0,1,1,1.25-1.562l4.076,3.261,6.227-8.451A1,1,0,1,1,18.927,8.2Z"></path></svg><span class="text-green-800">Selamat datang, '.$ortu['nama_ortu'].' :)</span></div>');
                        redirect('ortu/');
                    }else{
                        $this->session->set_flashdata('message', '<div class="alert bg-red-200 px-6 py-4 mx-2 my-4 rounded-md flex items-center mx-auto w-full"><svg viewBox="0 0 24 24" class="text-red-600 w-5 h-5 sm:w-5 sm:h-5 mr-3"><path fill="currentColor" d="M11.983,0a12.206,12.206,0,0,0-8.51,3.653A11.8,11.8,0,0,0,0,12.207,11.779,11.779,0,0,0,11.8,24h.214A12.111,12.111,0,0,0,24,11.791h0A11.766,11.766,0,0,0,11.983,0ZM10.5,16.542a1.476,1.476,0,0,1,1.449-1.53h.027a1.527,1.527,0,0,1,1.523,1.47,1.475,1.475,0,0,1-1.449,1.53h-.027A1.529,1.529,0,0,1,10.5,16.542ZM11,12.5v-6a1,1,0,0,1,2,0v6a1,1,0,1,1-2,0Z"></path></svg><span class="text-red-800"> Tidak bisa masuk, bukan akun anda!. </span></div>');
                        redirect('home/masuk');
                    }

                }else{
                    // Jika Belum Terdaftar data akan ditambah lalu dicek
                    $tambah = [
                        'ip_address' => $ip_address,
                        'id_orang_tua' => $data_ortu['id_orang_tua'],
                        'nisn_murid' => $nisn_anak,
                        'foto_pengguna' => "default.jpg"
                    ];

                    $check_ip = ['ip_address' => $ip_address];
                    $check_nisn = ['nisn_murid' => $nisn_murid];

                    $checking_ip = $this->m_user->Checking($check_ip)->num_rows();

                    if($checking_ip > 0){

                        $this->session->set_flashdata('message', '<div class="alert bg-red-200 px-6 py-4 mx-2 my-4 rounded-md flex items-center mx-auto w-full"><svg viewBox="0 0 24 24" class="text-red-600 w-5 h-5 sm:w-5 sm:h-5 mr-3"><path fill="currentColor" d="M11.983,0a12.206,12.206,0,0,0-8.51,3.653A11.8,11.8,0,0,0,0,12.207,11.779,11.779,0,0,0,11.8,24h.214A12.111,12.111,0,0,0,24,11.791h0A11.766,11.766,0,0,0,11.983,0ZM10.5,16.542a1.476,1.476,0,0,1,1.449-1.53h.027a1.527,1.527,0,0,1,1.523,1.47,1.475,1.475,0,0,1-1.449,1.53h-.027A1.529,1.529,0,0,1,10.5,16.542ZM11,12.5v-6a1,1,0,0,1,2,0v6a1,1,0,1,1-2,0Z"></path></svg><span class="text-red-800"> Ip Address sudah terdaftar. </span></div>');
                        redirect('home/masuk');

                    // }elseif($check_nisn > 0){

                    //     $this->session->set_flashdata('message', '<div class="alert bg-red-200 px-6 py-4 mx-2 my-4 rounded-md flex items-center mx-auto w-full"><svg viewBox="0 0 24 24" class="text-red-600 w-5 h-5 sm:w-5 sm:h-5 mr-3"><path fill="currentColor" d="M11.983,0a12.206,12.206,0,0,0-8.51,3.653A11.8,11.8,0,0,0,0,12.207,11.779,11.779,0,0,0,11.8,24h.214A12.111,12.111,0,0,0,24,11.791h0A11.766,11.766,0,0,0,11.983,0ZM10.5,16.542a1.476,1.476,0,0,1,1.449-1.53h.027a1.527,1.527,0,0,1,1.523,1.47,1.475,1.475,0,0,1-1.449,1.53h-.027A1.529,1.529,0,0,1,10.5,16.542ZM11,12.5v-6a1,1,0,0,1,2,0v6a1,1,0,1,1-2,0Z"></path></svg><span class="text-red-800"> NISN sudah terdaftar. </span></div>');
                    //     redirect('home/masuk');

                    }elseif($this->m_user->Tambah($tambah)){

                        $data_ortu = ['id_orang_tua' => $data_ortu['id_orang_tua']];
                        $user = $this->m_user->Checking($data_ortu)->row_array();

                        $where_ortu = ['id_orang_tua' => $user['id_orang_tua']];
                        $ortu = $this->m_ortu->Checking($where_ortu)->row_array();

                        if($user['ip_address'] == $_SERVER['REMOTE_ADDR']){
                            $data_session = ['id_orang_tua' => $user['id_orang_tua']];
                            $this->session->set_userdata($data_session);

                            $this->session->set_flashdata('message', '<div class="alert bg-green-200 px-6 py-4 mx-2 mb-5 rounded-md flex items-center mx-auto w-full"><svg viewBox="0 0 24 24" class="text-green-600 w-5 h-5 sm:w-5 sm:h-5 mr-3" ><path fill="currentColor" d="M12,0A12,12,0,1,0,24,12,12.014,12.014,0,0,0,12,0Zm6.927,8.2-6.845,9.289a1.011,1.011,0,0,1-1.43.188L5.764,13.769a1,1,0,1,1,1.25-1.562l4.076,3.261,6.227-8.451A1,1,0,1,1,18.927,8.2Z"></path></svg><span class="text-green-800">Selamat datang, '.$ortu['nama_ortu'].' :)</span></div>');
                            redirect('ortu/');

                        }else{
                            $this->session->set_flashdata('message', '<div class="alert bg-red-200 px-6 py-4 mx-2 my-4 rounded-md flex items-center mx-auto w-full"><svg viewBox="0 0 24 24" class="text-red-600 w-5 h-5 sm:w-5 sm:h-5 mr-3"><path fill="currentColor" d="M11.983,0a12.206,12.206,0,0,0-8.51,3.653A11.8,11.8,0,0,0,0,12.207,11.779,11.779,0,0,0,11.8,24h.214A12.111,12.111,0,0,0,24,11.791h0A11.766,11.766,0,0,0,11.983,0ZM10.5,16.542a1.476,1.476,0,0,1,1.449-1.53h.027a1.527,1.527,0,0,1,1.523,1.47,1.475,1.475,0,0,1-1.449,1.53h-.027A1.529,1.529,0,0,1,10.5,16.542ZM11,12.5v-6a1,1,0,0,1,2,0v6a1,1,0,1,1-2,0Z"></path></svg><span class="text-red-800"> Tidak bisa masuk, bukan akun anda!. </span></div>');
                            redirect('home/masuk');
                        }
                    }
                }
            }

        }else{
            $this->session->set_flashdata('message', '<div class="alert bg-red-200 px-6 py-4 mx-2 my-4 rounded-md flex items-center mx-auto w-full"><svg viewBox="0 0 24 24" class="text-red-600 w-5 h-5 sm:w-5 sm:h-5 mr-3"><path fill="currentColor" d="M11.983,0a12.206,12.206,0,0,0-8.51,3.653A11.8,11.8,0,0,0,0,12.207,11.779,11.779,0,0,0,11.8,24h.214A12.111,12.111,0,0,0,24,11.791h0A11.766,11.766,0,0,0,11.983,0ZM10.5,16.542a1.476,1.476,0,0,1,1.449-1.53h.027a1.527,1.527,0,0,1,1.523,1.47,1.475,1.475,0,0,1-1.449,1.53h-.027A1.529,1.529,0,0,1,10.5,16.542ZM11,12.5v-6a1,1,0,0,1,2,0v6a1,1,0,1,1-2,0Z"></path></svg><span class="text-red-800"> Data tidak terdaftar. </span></div>');
            redirect('home/masuk');
        }
    }

}