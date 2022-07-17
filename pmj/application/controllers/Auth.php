<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
	public function __construct(){
		parent::__construct();
		
	}
	public function user()
	{
		$this->home->load('home/template','home/form/login/user');
	}
	public function master()
	{
		$this->home->load('home/template','home/form/login/admin_master');
	}
	public function toko()
	{
		$this->home->load('home/template','home/form/login/admin_toko');
	}
	public function distributor()
	{
		$this->home->load('home/template','home/form/login/distributor');
	}
	public function proseslogin_user(){
		$username = $this->input->post('username');
		//$pass = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
		$pass=$this->input->post('password');
			$user= $this->db->get_where('pelanggan', ['email_pelanggan'=>$username])->row_array();
			if ($user) {
				$pasword_tersimpan = $user['password'];
				$verivikasi=password_verify($pass, $pasword_tersimpan);
			
				if ($pasword_tersimpan==$pass) {
					$data_session = [
						'id_user' => $user['id_pelanggan'],
						'nama_user'=>$user['nama_pelanggan']
					//	'alamat'=>$user['alamat_pelanggan'],
					//	'nohp'=>$user['nohp_pelanggan']
					];
 					$this->session->set_userdata($data_session);
					redirect('user/user/user');
				}
				else{
					$this->session->set_flashdata('pesan','<div class="alert alert-danger">Password salah</div>');
					redirect('auth/user');
					
				}

			}
			else{
				$this->session->set_flashdata('pesan','<div class="alert alert-danger">Username dan password salah</div>');
				redirect('auth/user');
			}



///		$data=$this->db->insert('admin',['username'=>$username, 'password'=>$pass]);
	}
	public function proseslogin_admintoko(){
		$username = $this->input->post('username');
		//$pass = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
		$pass=$this->input->post('password');
			$user= $this->db->get_where('toko', ['email_toko'=>$username])->row_array();
			if ($user) {
				$pasword_tersimpan = $user['password'];
				// $verivikasi=password_verify($pass, $pasword_tersimpan);
			
				if ($pasword_tersimpan==$pass) {

					if ($user['status_toko']=='Mitra') {
						$data_session = [
							'status' => true,
							'level'=>'Admin Toko',
							'nama_toko'=>$user['nama_toko'],
							'id_admin'=>$user['id_toko'],
							'nama_user'=>$user['pemilik_toko']
						];
	 					$this->session->set_userdata($data_session);
						redirect('user/admin/toko');
					}
					else{
						$this->session->set_flashdata('pesan','<div class="alert alert-danger">Toko anda belum disetujui oleh admin</div>');
						redirect('auth/toko');
					}
				}
				else{
					$this->session->set_flashdata('pesan','<div class="alert alert-danger">Password salah</div>');
					redirect('auth/toko');
						
					}
				

			}
			else{
				$this->session->set_flashdata('pesan','<div class="alert alert-danger">Username dan password salah </div>');
								
					redirect('auth/toko');
			}



///		$data=$this->db->insert('admin',['username'=>$username, 'password'=>$pass]);
	}
	public function proseslogin_adminmaster(){
		$username = $this->input->post('username');
		//$pass = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
		$pass=$this->input->post('password');
			$user= $this->db->get_where('admin', ['username'=>$username])->row_array();
			if ($user) {
				$pasword_tersimpan = $user['password'];
				//$verivikasi=password_verify($pass, $pasword_tersimpan);
			
				if ($pasword_tersimpan == $pass) {
					$data_session = [
						'status' => "login",
						'level'=>$user['level'],
						'nama_user'=>$user['nama_admin'],
						'id_user'=>$user['id_admin']
					];
 					$this->session->set_userdata($data_session);
					redirect('user/admin/dashboard');
				}
				else{
					$this->session->set_flashdata('pesan','<div class="alert alert-danger">Password salah</div>');
					redirect('auth/master');
					
				}

			}
			else{
				$this->session->set_flashdata('pesan','<div class="alert alert-danger">Username dan password salah</div>');
				redirect('auth/master');
			}



///		$data=$this->db->insert('admin',['username'=>$username, 'password'=>$pass]);
	}
	public function proseslogin_distributor(){
		$username = $this->input->post('username');
		//$pass = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
		$pass=$this->input->post('password');
			$user= $this->db->get_where('distributor', ['username'=>$username])->row_array();
			if ($user) {
				$pasword_tersimpan = $user['password'];
				//$verivikasi=password_verify($pass, $pasword_tersimpan);
			
				if ($pasword_tersimpan == $pass) {
					$data_session = [
						'status' => "login",
						'level'=>'Admin Distributor',
						'id_admin'=>$user['id_distributor'],
						'nama_user'=>$user['nama_distributor']
					];
 					$this->session->set_userdata($data_session);
					redirect('user/admin/distributor');
				}
				else{
					$this->session->set_flashdata('pesan','<div class="alert alert-danger">Password salah</div>');
					redirect('auth/distributor');
					
				}

			}
			else{
				$this->session->set_flashdata('pesan','<div class="alert alert-danger">Username dan password salah</div>');
				redirect('auth/distributor');
			}



///		$data=$this->db->insert('admin',['username'=>$username, 'password'=>$pass]);
	}


	


	public function logout(){
		$this->session->sess_destroy();
		redirect('homepage');
	}
}
?>
