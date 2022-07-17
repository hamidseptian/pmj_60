<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function index()
	{	
		$id_user = $this->session->userdata('id_user');
		$data['user']= $this->db->query("SELECT * from pelanggan where id_pelanggan='$id_user'")->row_array();
		$this->admin->load('home/template','pelanggan/form/dashboard/dashboard', $data);
	}
	public function tambah()
	{
		
	}
}
