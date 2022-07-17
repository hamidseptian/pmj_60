<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class wrapping extends CI_Controller {

	public function index()
	{
		$data['wrapping']=$this->db->query("SELECT * from wrapping")->result_array();
		$this->admin->load('admin/template','admin/form/wrapping/data_wrapping', $data);
	}
	public function tambah()
	{
		
		$this->admin->load('admin/template','admin/form/wrapping/tambah_wrapping');
	}
	



	 public function simpan(){
 		
	 	 $this->load->helper(array('form'));
	        $config['upload_path']          = './file/produk/gambar/';
	          $namaberkas         = $_FILES['berkas']['name'];
	         // $config['max_size']             = 20000;
	        $config['allowed_types']        = 'jpg|png|gif';
	       
	      $x = explode('.', $namaberkas );
	        $ekstensi = strtolower(end($x));
	        $namabaru=date('ymdhis.').$ekstensi;


	     
			$stok = $this->input->post('stok');
			$wrapping = $this->input->post('wrapping');
			$data_wrapping = [
				'gambar'=>$namabaru,
				'wrapping'=>$wrapping,
				'stok'=>$stok,
			];
	       // echo $namabaru;
	         $config['file_name']  = $namabaru;
	          $this->load->library('upload', $config);
	 
	        if ( ! $this->upload->do_upload('berkas')){
	            
	                 $pesan_error =  $this->upload->display_errors();
	                 $this->session->set_flashdata('pesan','<div class="alert alert-danger alert-dismissible">
	                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	                
	               Data produk gagal disimpan<br>Silahkan dicoba lagi memilih file dengan extensi file yang benar <br>'.$pesan_error.'
	              </div>');
	              
	              // redirect('admin/file/');
	        }else{
	                $data = array('upload_data' => $this->upload->data());
	                
	            //    $this->admin_query->simpan_file();
	               
				$this->db->insert('wrapping', $data_wrapping);
	                $this->session->set_flashdata('pesan','<div class="alert alert-success alert-dismissible">
	                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	                
	               Data produk disimpan
	              </div>');

	        }
	          redirect('user/admin/wrapping');
	}




	// public function simpan()
	// {
	// 	$stok = $this->input->post('stok');
	// 	$wrapping = $this->input->post('wrapping');
	// 	$data = [
	// 		'wrapping'=>$wrapping,
	// 		'stok'=>$stok,
	// 	];
	// 	$this->db->insert('wrapping', $data);
	// 	$this->session->set_flashdata('pesan','<div class="alert alert-success">Data metode wrapping berhasil ditambahkan</div>');
	// 	redirect('user/admin/wrapping');
	// }

	public function edit($id)
	{
		
		$data['wrapping'] = $this->db->get_where('wrapping', array('id_wrapping' => $id))->row_array(); 
		$this->admin->load('admin/template','admin/form/wrapping/edit_wrapping', $data);
	}



	
	 public function simpanedit(){
 		
	 	 $this->load->helper(array('form'));
	        $config['upload_path']          = './file/produk/gambar/';
	          $namaberkas         = $_FILES['berkas']['name'];
	         // $config['max_size']             = 20000;
	        $config['allowed_types']        = 'jpg|png|gif';
	       
	      $x = explode('.', $namaberkas );
	        $ekstensi = strtolower(end($x));
	        $namabaru=date('ymdhis.').$ekstensi;


	     
				$id = $this->input->post('id');
				$wrapping = $this->input->post('wrapping');
				$stok = $this->input->post('stok');
				
				
				$where = [
					'id_wrapping'=>$id
				];
	
			
			
	       // echo $namabaru;
	         $config['file_name']  = $namabaru;
	          $this->load->library('upload', $config);
	 

	 		if ($namaberkas=='') {
	 			$datainput = [
					'wrapping'=>$wrapping,
					
					'stok'=>$stok,
				];
	 			 $this->db->update('wrapping',$datainput, $where);

	 			    $this->session->set_flashdata('pesan','<div class="alert alert-success alert-dismissible">
			                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			                
			               Data produk diperbaharui
			              </div>');

	 		}else{
	 			  if ( ! $this->upload->do_upload('berkas')){
			            
			                 $pesan_error =  $this->upload->display_errors();
			                 $this->session->set_flashdata('pesan','<div class="alert alert-danger alert-dismissible">
			                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			                
			               Data produk gagal disimpan<br>Silahkan dicoba lagi memilih file dengan extensi file yang benar <br>'.$pesan_error.'
			              </div>');
			              
			              // redirect('admin/file/');
			        }else{
			                $data = array('upload_data' => $this->upload->data());
			             $datainput = [
							'wrapping'=>$wrapping,
					
					'stok'=>$stok,
							'gambar'=>$namabaru,
						];   
							
						// unlink('file/produk/gambar/'.$filelama);		

			            //    $this->admin_query->simpan_file();
			               
			             $this->db->update('wrapping',$datainput, $where);
			                $this->session->set_flashdata('pesan','<div class="alert alert-success alert-dismissible">
			                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			                
			               Data produk diperbaharui
			              </div>');
			        }
	 		}
			          redirect('user/admin/wrapping');
	      
	}



		// public function simpanedit()
	// {
	// 	$id = $this->input->post('id');
	// 	$wrapping = $this->input->post('wrapping');
	// 	$stok = $this->input->post('stok');
		
	// 	$data = [
	// 		'wrapping'=>$wrapping,
			
	// 		'stok'=>$stok,
	// 	];
	// 	$where = [
	// 		'id_wrapping'=>$id
	// 	];
	// 	$this->db->update('wrapping', $data, $where);
	// 	$this->session->set_flashdata('pesan','<div class="alert alert-success">Data wrapping berhasil diperbaharui</div>');
	// 	redirect('user/admin/wrapping');
	// }
	public function hapus($id)
	{
		$this->db->delete('wrapping', array('id_wrapping' => $id)); 
			$this->session->set_flashdata('pesan','<div class="alert alert-success">Data wrapping berhasil dihapus</div>');
		redirect('user/admin/wrapping');
	}
}
