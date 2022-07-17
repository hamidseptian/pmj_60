<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function index()
	{
		$data['admin']=$this->db->query("SELECT * from admin")->result_array();
		$this->admin->load('admin/template','admin/form/admin/data_admin', $data);
	}
	public function edit_akun()
	{
		$id_user = $this->session->userdata('id_user');
		$user = $this->db->get_where('pelanggan',['id_pelanggan'=>$id_user])->row_array();
		$data['user'] = $user;
		$this->home->load('home/template','pelanggan/form/user/edit_user', $data);
	}
	
	public function simpanedit_user()
	{
		$id_user = $this->session->userdata('id_user');
		$nama = $this->input->post('nama');
		$alamat = $this->input->post('alamat');
		$nohp = $this->input->post('nohp');
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$cek_username = $this->db->get_where('pelanggan',['username'=>$username, 'id_pelanggan !='=>$id_user])->num_rows();
		if ($cek_username>0) {
			$this->session->set_flashdata('pesan','<div class="alert alert-danger">Data admin gagal ditambahkan<br>Username sudah dipakai</div>');
		redirect('user/pelanggan/user/edit_akun');
		}else{

		$data = [
			'nama_pelanggan'=>$nama,
			'alamat_pelanggan'=>$alamat,
			'nohp_pelanggan'=>$nohp,
			'username'=>$username,
			'password'=>$password,
		];
		$where = [
			'id_pelanggan'=>$id_user
		];
		$this->db->update('pelanggan', $data);
		$this->session->set_flashdata('pesan','<div class="alert alert-success">Pendaftaran berhasil<br>silahkan login</div>');
		redirect('user/pelanggan/dashboard');
		}
	}
	public function edit($id)
	{
		
		$data['admin'] = $this->db->get_where('admin', array('id_admin' => $id))->row_array(); 
		$this->admin->load('admin/template','admin/form/admin/edit_admin', $data);
	}

	public function simpanedit()
	{
		$id = $this->input->post('id');
		$nama = $this->input->post('nama');
		$jabatan = $this->input->post('jabatan');
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$cek_username = $this->db->get_where('admin',['username'=>$username,'id_admin!='=>$id])->num_rows();
		if ($cek_username>0) {
			$this->session->set_flashdata('pesan','<div class="alert alert-danger">Data admin gagal ditambahkan<br>Username sudah dipakai</div>');
		redirect('user/admin/user/edit/'.$id);
		}else{
			$data = [
				'nama_admin'=>$nama,
				'jabatan'=>$jabatan,
				'username'=>$username,
				'password'=>$password,
				'level'=>'Admin',
			];
			$where = [
				'id_admin'=>$id
			];
			$this->db->update('admin', $data, $where);
			$this->session->set_flashdata('pesan','<div class="alert alert-success">Data admin berhasil diperbaharui</div>');
		}
		redirect('user/admin/user');
	}
	public function hapus($id)
	{
		$this->db->delete('admin', array('id_admin' => $id)); 
			$this->session->set_flashdata('pesan','<div class="alert alert-success">Data admin berhasil dihapus</div>');
		redirect('user/admin/user');
	}
}
