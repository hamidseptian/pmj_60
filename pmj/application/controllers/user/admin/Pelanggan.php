<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggan extends CI_Controller {

	public function index()
	{
		$data['pelanggan']=$this->db->query("SELECT * from pelanggan")->result_array();
		$this->admin->load('admin/template','admin/form/pelanggan/data_pelanggan', $data);
	}
	public function tambah($menu='')
	{
		$data['menu']=$menu;
		$this->admin->load('admin/template','admin/form/pelanggan/tambah_pelanggan', $data);
	}
	
	public function simpan()
	{
		$nama = $this->input->post('nama');
		$email = $this->input->post('email');
		$nohp = $this->input->post('nohp');
		$data = [
			'nama'=>$nama,
			'email'=>$email,
			'nohp'=>$nohp,
		];

		$cek_email = $this->db->get_where('pelanggan',['email'=>$email])->num_rows();
		if ($cek_email>0) {
			$this->session->set_flashdata('pesan','<div class="alert alert-danger">Data pelanggan gagal ditambahkan<br>email '.$email.' sudah digunakan</div>');
			redirect('user/admin/pelanggan/tambah/');
		}else{
			$this->db->insert('pelanggan', $data);
			redirect('user/admin/pelanggan');
		}


		$this->session->set_flashdata('pesan','<div class="alert alert-success">Data pelanggan berhasil ditambahkan</div>');
		redirect('user/admin/pelanggan');
	}

	public function edit($id)
	{
		
		$data['pelanggan'] = $this->db->get_where('pelanggan', array('id_pelanggan' => $id))->row_array(); 
		$this->admin->load('admin/template','admin/form/pelanggan/edit_pelanggan', $data);
	}
	public function detail_pelanggan($id)
	{
		
		$data= $this->db->get_where('pelanggan', array('id_pelanggan' => $id))->row_array(); 
		echo json_encode($data);
	}

	public function simpanedit()
	{
		$id = $this->input->post('id');
		$nama = $this->input->post('nama');
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$nohp = $this->input->post('nohp');
		$data = [
			'nama'=>$nama,
			'email'=>$email,
			'password'=>$password,
			'nohp'=>$nohp,
		];
		$where = [
			'id_pelanggan'=>$id
		];

		$cek_email = $this->db->get_where('pelanggan',['email'=>$email, 'id_pelanggan!='=>$id])->num_rows();
		if ($cek_email>0) {
			$this->session->set_flashdata('pesan','<div class="alert alert-danger">Data pelanggan gagal diperbaharui<br>email '.$email.' sudah digunakan</div>');
			redirect('user/admin/pelanggan/edit/'.$id);
		}else{
			$this->db->update('pelanggan', $data, $where);
			redirect('user/admin/pelanggan');
		}
	}
	public function hapus($id)
	{
		$this->db->delete('pelanggan', array('id_pelanggan' => $id)); 
			$this->session->set_flashdata('pesan','<div class="alert alert-success">Data pelanggan berhasil dihapus</div>');
		redirect('user/admin/pelanggan');
	}
}
