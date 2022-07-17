<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function index()
	{
		$data['admin']=$this->db->query("SELECT * from admin")->result_array();
		$this->admin->load('admin/template','admin/form/admin/data_admin', $data);
	}
	public function tambah()
	{
		
		$this->admin->load('admin/template','admin/form/admin/tambah_admin');
	}
	
	public function simpan()
	{
		$nama = $this->input->post('nama');
		$jabatan = $this->input->post('jabatan');
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$cek_username = $this->db->get_where('admin',['username'=>$username])->num_rows();
		if ($cek_username>0) {
			$this->session->set_flashdata('pesan','<div class="alert alert-danger">Data admin gagal ditambahkan<br>Username sudah dipakai</div>');
		redirect('user/admin/user/tambah');
		}else{

		$data = [
			'nama_admin'=>$nama,
			'jabatan'=>$jabatan,
			'username'=>$username,
			'password'=>$password,
			'level'=>'Admin',
		];
		$this->db->insert('admin', $data);
		$this->session->set_flashdata('pesan','<div class="alert alert-success">Data admin berhasil ditambahkan</div>');
		redirect('user/admin/user');
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
