<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function index()
	{	
		$id_user = $this->session->userdata('id_user');
		$data['user']= $this->db->query("SELECT * from pmj where id='$id_user'")->row_array();
		$this->admin->load('admin/template','admin/form/dashboard/dashboard', $data);
	}
	public function tambah()
	{
		
	}
}
