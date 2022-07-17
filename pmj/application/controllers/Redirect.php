<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Redirect extends CI_Controller {

	public function index()
	{
		redirect('home/beranda');
	}
		public function logout(){
		$this->session->sess_destroy();
		redirect('redirect');
	}
}
