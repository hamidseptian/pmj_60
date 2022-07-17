<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class metode_pengantaran extends CI_Controller {

	public function index()
	{
		$data['metode_pengantaran']=$this->db->query("SELECT * from metode_pengantaran")->result_array();
		$this->admin->load('admin/template','admin/form/metode_pengantaran/data_metode_pengantaran', $data);
	}
	public function tambah()
	{
		
		$this->admin->load('admin/template','admin/form/metode_pengantaran/tambah_metode_pengantaran');
	}
	
	public function simpan()
	{
		$metode = $this->input->post('metode');
		$data = [
			'metode_pengantaran'=>$metode,
		];
		$this->db->insert('metode_pengantaran', $data);
		$this->session->set_flashdata('pesan','<div class="alert alert-success">Data metode pengantaran berhasil ditambahkan</div>');
		redirect('user/admin/metode_pengantaran');
	}

	public function edit($id)
	{
		
		$data['metode_pengantaran'] = $this->db->get_where('metode_pengantaran', array('id_pengantaran' => $id))->row_array(); 
		$this->admin->load('admin/template','admin/form/metode_pengantaran/edit_metode_pengantaran', $data);
	}

	public function simpanedit()
	{
		$id = $this->input->post('id');
		$metode_pengantaran = $this->input->post('metode_pengantaran');
		$norek = $this->input->post('norek');
		$narek = $this->input->post('narek');
		$data = [
			'metode_pengantaran'=>$metode_pengantaran,
			
			'no_rek'=>$norek,
			'nama_rek'=>$narek,
		];
		$where = [
			'id_pengantaran'=>$id
		];
		$this->db->update('metode_pengantaran', $data, $where);
		$this->session->set_flashdata('pesan','<div class="alert alert-success">Data metode_pengantaran berhasil diperbaharui</div>');
		redirect('user/admin/metode_pengantaran');
	}
	public function hapus($id)
	{
		$this->db->delete('metode_pengantaran', array('id_pengantaran' => $id)); 
			$this->session->set_flashdata('pesan','<div class="alert alert-success">Data metode_pengantaran berhasil dihapus</div>');
		redirect('user/admin/metode_pengantaran');
	}
}
