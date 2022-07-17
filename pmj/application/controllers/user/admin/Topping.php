<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class topping extends CI_Controller {

	public function index()
	{
		$data['topping']=$this->db->query("SELECT * from topping")->result_array();
		$this->admin->load('admin/template','admin/form/topping/data_topping', $data);
	}
	public function tambah()
	{
		
		$this->admin->load('admin/template','admin/form/topping/tambah_topping');
	}
	
	
	 public function simpan(){
 		
	 	 $this->load->helper(array('form'));
	        $config['upload_path']          = './file/topping/gambar/';
	          $namaberkas         = $_FILES['berkas']['name'];
	         // $config['max_size']             = 20000;
	        $config['allowed_types']        = 'jpg|png|gif';
	       
	      $x = explode('.', $namaberkas );
	        $ekstensi = strtolower(end($x));
	        $namabaru=date('ymdhis.').$ekstensi;


	     
			$nama = $this->input->post('nama');
			$harga = $this->input->post('harga');
			$stok = $this->input->post('stok');
			$datainput = [
				'nama_topping'=>$nama,
				'harga'=>$harga,
				'stok'=>$stok,
				'gambar_topping'=>$namabaru,
			];

			
	       // echo $namabaru;
	         $config['file_name']  = $namabaru;
	          $this->load->library('upload', $config);
	 
	        if ( ! $this->upload->do_upload('berkas')){
	            
	                 $pesan_error =  $this->upload->display_errors();
	                 $this->session->set_flashdata('pesan','<div class="alert alert-danger alert-dismissible">
	                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	                
	               Data topping gagal disimpan<br>Silahkan dicoba lagi memilih file dengan extensi file yang benar <br>'.$pesan_error.'
	              </div>');
	              
	              // redirect('admin/file/');
	        }else{
	                $data = array('upload_data' => $this->upload->data());
	                
	            //    $this->admin_query->simpan_file();
	               
	                $this->session->set_flashdata('pesan','<div class="alert alert-success alert-dismissible">
	                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	                
	               Data topping disimpan
	              </div>');

	             $banyak = $this->input->post('banyak');
	             $id_bahan_baku = $this->input->post('id_bahan_baku');
	             $this->db->insert('topping',$datainput);
	             $last_insert_id = $this->db->insert_id(); 
	             foreach ($banyak as $k=>$v) { 
	             	$id_bahan_baku_digunakan = $id_bahan_baku[$k];
	             	if ($v!='') {
	             		$data_bahan = [
	             			'id_topping'=>$last_insert_id,
	             			'banyak_pemakaian'=>$v,
	             			'id_bahan_baku'=>$id_bahan_baku_digunakan
		             	];
	             		$this->db->insert('pemakaian_bahan_baku',$data_bahan);
	             	}
	             }
	        }
	          redirect('user/admin/topping');
	}

	public function edit($id)
	{
		
		$data['topping'] = $this->db->get_where('topping', array('id_topping' => $id))->row_array(); 
		$this->admin->load('admin/template','admin/form/topping/edit_topping', $data);
	}

	
	 public function simpanedit(){
 		
	 	 $this->load->helper(array('form'));
	        $config['upload_path']          = './file/topping/gambar/';
	          $namaberkas         = $_FILES['berkas']['name'];
	         // $config['max_size']             = 20000;
	        $config['allowed_types']        = 'jpg|png|gif';
	       
	      $x = explode('.', $namaberkas );
	        $ekstensi = strtolower(end($x));
	        $namabaru=date('ymdhis.').$ekstensi;


	     
			$id = $this->input->post('id');
			$nama = $this->input->post('nama');
			$harga = $this->input->post('harga');
			$stok = $this->input->post('stok');
			
	
			
			$where = [
				'id_topping'=>$id,
				
				];
	       // echo $namabaru;
	         $config['file_name']  = $namabaru;
	          $this->load->library('upload', $config);
	 

	 		if ($namaberkas=='') {
	 			$datainput = [
					'nama_topping'=>$nama,
					'harga'=>$harga,
					'stok'=>$stok,
				];
	 			 $this->db->update('topping',$datainput, $where);

	 			    $this->session->set_flashdata('pesan','<div class="alert alert-success alert-dismissible">
			                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			                
			               Data topping diperbaharui
			              </div>');

	 		}else{
	 			  if ( ! $this->upload->do_upload('berkas')){
			            
			                 $pesan_error =  $this->upload->display_errors();
			                 $this->session->set_flashdata('pesan','<div class="alert alert-danger alert-dismissible">
			                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			                
			               Data topping gagal disimpan<br>Silahkan dicoba lagi memilih file dengan extensi file yang benar <br>'.$pesan_error.'
			              </div>');
			              
			              // redirect('admin/file/');
			        }else{
			                $data = array('upload_data' => $this->upload->data());
			             $datainput = [
							'nama_topping'=>$nama,
							'harga'=>$harga,
							'stok'=>$stok,
							'gambar_topping'=>$namabaru,
						];
							
						// unlink('file/topping/gambar/'.$filelama);		

			            //    $this->admin_query->simpan_file();
			               
			                $this->session->set_flashdata('pesan','<div class="alert alert-success alert-dismissible">
			                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			                
			               Data topping diperbaharui
			              </div>');
			             $this->db->update('topping',$datainput, $where);
			        }
	 		}
			          redirect('user/admin/topping');
	      
	}
	public function hapus($id)
	{
		$this->db->delete('topping', array('id_topping' => $id)); 
			$this->session->set_flashdata('pesan','<div class="alert alert-success">Data topping berhasil dihapus</div>');
		redirect('user/admin/topping');
	}
}
