<?php 

class Auth extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_admin');
	}

	public function index()
	{
		$this->form_validation->set_rules('id_privilege','Privilege','required|trim');
		$this->form_validation->set_rules('password','Password','required|trim');
		
		if($this->form_validation->run() == FALSE){

			$data['title'] = 'Login Admin | One Space';

			$data['privilege'] = $this->m_admin->Tampil()->result();

			$this->load->view('admin/auth/login', $data);

		}else{
			$this->_proses();
		}
	}

	private function _proses()
	{
		$id_privilege = $this->input->post('id_privilege');
		$password = $this->input->post('password');

		$data_privilege = ['id_privilege' => $id_privilege];

		$admin = $this->m_admin->Checking($data_privilege)->row_array();

		if($admin){
			
			if(password_verify($password, $admin['password'])){

				$data_session = ['id_privilege' => $admin['id_privilege'], 'status' => "Login"];
				$this->session->set_userdata($data_session);

				switch ($admin['id_admin']) {
					case 1:
					redirect('admin/');
					break;
					case 2:
					redirect('admin/');
					break;
				}
				// $data = ['username' => $admin['username']];

			}else{
				$this->flasher->setFlash('Password salah!','close-circle','danger');
				redirect('auth/');
			}

		}else {
			$this->flasher->setFlash('Privilage salah!','close-circle','danger');
			redirect('auth/');
		}
	}

	public function register()
	{
		$this->form_validation->set_rules('id_privilege','Privilege','required|trim');
		$this->form_validation->set_rules('password','Password','required|trim');
		
		if($this->form_validation->run() == FALSE){

			$data['title'] = 'Register Admin | One Space';

			$data['privilege'] = $this->m_admin->Privilege()->result();

			$this->load->view('admin/auth/register', $data);

		}else{

			$id_privilege = $this->input->post('id_privilege');
			$password = $this->input->post('password');

			$tambah = [
				'id_privilege' => $id_privilege, 
				'password' => password_hash($password,PASSWORD_DEFAULT),
				'foto' => "admin.png"
			];

			$data_check = ['id_privilege' => $id_privilege];
			$checking = $this->m_admin->Checking($data_check)->num_rows();

			if($checking > 0){
				$this->flasher->setFlash('Privilege sudah digunakan,coba yang lain!','alert-circle','warning');
			}else if($this->m_admin->Tambah($tambah)){
				$this->flasher->setFlash('Data berhasil ditambahkan!','check-circle','success');
			}else{	
				$this->flasher->setFlash('Data gagal ditambahkan!','close-circle','danger');
			}
			redirect('auth/');

		}
	}

}