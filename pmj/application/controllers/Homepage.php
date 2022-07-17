	<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Homepage extends CI_Controller {
	public function __construct(){
		parent::__construct();
		// $this->load->model('homepage_model');
	}
	public function index()
	{
		$this->produk();
	}
	public function daftar()
	{
		$this->home->load('home/template','home/form/daftar/daftar');
	}

	public function simpan_pelanggan()
	{
		$nama = $this->input->post('nama');
		$alamat = $this->input->post('alamat');
		$nohp = $this->input->post('nohp');
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$cek_username = $this->db->get_where('pelanggan',['username'=>$username])->num_rows();
		if ($cek_username>0) {
			$this->session->set_flashdata('pesan','<div class="alert alert-danger">Data admin gagal ditambahkan<br>Username sudah dipakai</div>');
		redirect('homepage/daftar');
		}else{

		$data = [
			'nama_pelanggan'=>$nama,
			'alamat_pelanggan'=>$alamat,
			'nohp_pelanggan'=>$nohp,
			'username'=>$username,
			'password'=>$password,
		];
		$this->db->insert('pelanggan', $data);
		$this->session->set_flashdata('pesan','<div class="alert alert-success">Pendaftaran berhasil<br>silahkan login</div>');
		redirect('homepage/login_pelanggan');
		}
	}
	public function login_admin()
	{
		$this->home->load('home/template','home/form/login/admin');
	}
	public function cara_pesan()
	{
		
		$this->home->load('home/template','home/form/cara_pesan/cara_pesan');
	}
	public function login_pelanggan()
	{
		$this->home->load('home/template','home/form/login/pelanggan');
	}

	public function proseslogin_admin(){
		$username = $this->input->post('username');
		//$pass = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
		$pass=$this->input->post('password');
			$user= $this->db->get_where('pmj', ['email'=>$username])->row_array();
			if ($user) {
				$pasword_tersimpan = $user['password'];
				//$verivikasi=password_verify($pass, $pasword_tersimpan);
			
				if ($pasword_tersimpan == $pass) {
					$data_session = [
						'status' => "login",
						'level'=>$user['level'],
						'nama_user'=>$user['nama'],
						'id_user'=>$user['id']
					];
 					$this->session->set_userdata($data_session);
					redirect('user/admin/dashboard');
				}
				else{
					$this->session->set_flashdata('pesan','<div class="alert alert-danger">Password salah</div>');
					redirect('homepage/login_admin');
					
				}

			}
			else{
				$this->session->set_flashdata('pesan','<div class="alert alert-danger">Username dan password salah</div>');
				redirect('homepage/login_admin');
			}
	}
	public function proseslogin_pelanggan(){
		$username = $this->input->post('username');
		//$pass = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
		$pass=$this->input->post('password');
			$user= $this->db->get_where('pelanggan', ['username'=>$username])->row_array();
			if ($user) {
				$pasword_tersimpan = $user['password'];
				//$verivikasi=password_verify($pass, $pasword_tersimpan);
			
				if ($pasword_tersimpan == $pass) {
					$data_session = [
						'status' => "login",
						'level'=>'pelanggan',
						'nama_user'=>$user['nama_pelanggan'],
						'id_user'=>$user['id_pelanggan']
					];
 					$this->session->set_userdata($data_session);
					redirect('user/pelanggan/dashboard');
				}
				else{
					$this->session->set_flashdata('pesan','<div class="alert alert-danger">Password salah</div>');
					redirect('homepage/login_pelanggan');
					
				}

			}
			else{
				$this->session->set_flashdata('pesan','<div class="alert alert-danger">Username dan password salah</div>');
				redirect('homepage/login_pelanggan');
			}



///		$data=$this->db->insert('admin',['username'=>$username, 'password'=>$pass]);
	}





	public function produk()
	{
		if (!$this->input->post('keyword')) {
			$data['caption_cari']='';
			$data['produk']=$this->db->query("SELECT * from produk p")->result_array();
		}else{
			$keyword = $this->input->post('keyword');
			$data['caption_cari']=$keyword;
			$data['produk']=$this->db->query("SELECT * from produk p where p.nama_produk like '%$keyword%'")->result_array();

		}
		$this->admin->load('home/template','home/form/produk/produk', $data);
	}

	public function detail_produk($id)
	{
			$produk = $this->db->query("SELECT * from produk p where p.id_produk='$id'")->row_array();
			$id_produk = $produk['id_produk'];
			$wrapping_dibutuhkan = $produk['wrapping_dibutuhkan'];
			$qwrapping_produk = "SELECT * from wrapping where stok>='$wrapping_dibutuhkan'";
			$qtopping = "SELECT * from topping where stok >0";
			$data['wrapping']=$this->db->query($qwrapping_produk)->result_array();
			$data['topping']=$this->db->query($qtopping)->result_array();
			$data['maksimal_topping']=$produk['maksimal_topping'];
			$data['produk']=$produk;
			$data['caption_cari']='';
		
			

		
		$this->admin->load('home/template','home/form/produk/detail_produk', $data);
	}
	public function cp()
	{

			$data['cp']=$this->db->query("SELECT * from pmj")->result_array();


		$this->admin->load('home/template','home/form/cp/cp', $data);
	}
	
}
