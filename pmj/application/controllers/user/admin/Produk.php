<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller {

	public function index()
	{
		$data['produk']=$this->db->query("SELECT * from produk")->result_array();
		$this->admin->load('admin/template','admin/form/produk/data_produk', $data);
	}
	public function tambah()
	{
		
		$this->admin->load('admin/template','admin/form/produk/tambah_produk');
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


	     
			$produk = $this->input->post('produk');
			$poin = $this->input->post('poin');
			$biaya = $this->input->post('biaya');
			$keterangan = $this->input->post('keterangan');
			$satuan = $this->input->post('satuan');

			$datainput = [
				'nama_produk'=>$produk,
				'harga'=>$biaya,
				'keterangan'=>$keterangan,
				'harga_per'=>$satuan,
				'gambar'=>$namabaru,
				
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
	               
	                $this->session->set_flashdata('pesan','<div class="alert alert-success alert-dismissible">
	                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	                
	               Data produk disimpan
	              </div>');
 
	             $this->db->insert('produk',$datainput);
	             $last_insert_id = $this->db->insert_id(); 
	         
	        }
	          redirect('user/admin/produk');
	}

	public function edit($id)
	{
		
		$data['produk'] = $this->db->get_where('produk', array('id_produk' => $id))->row_array(); 
		$this->admin->load('admin/template','admin/form/produk/edit_produk', $data);
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


	     
			$produk = $this->input->post('produk');
			$biaya = $this->input->post('biaya');
			$id = $this->input->post('id');
			$filelama = $this->input->post('filelama');
			$keterangan = $this->input->post('keterangan');
			$satuan = $this->input->post('satuan');
			$poin = $this->input->post('poin');
	
			
			$where = [
				'id_produk'=>$id,
				
				];
	       // echo $namabaru;
	         $config['file_name']  = $namabaru;
	          $this->load->library('upload', $config);
	 

	 		if ($namaberkas=='') {
	 			$datainput = [
					'nama_produk'=>$produk,
					'harga'=>$biaya,
					'keterangan'=>$keterangan,
					'harga_per'=>$satuan,
					'poin'=>$poin,
					
				];
	 			 $this->db->update('produk',$datainput, $where);

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
							'nama_produk'=>$produk,
							'harga'=>$biaya,
							'keterangan'=>$keterangan,
							'poin'=>$poin,
							'harga_per'=>$satuan,
							'gambar'=>$namabaru,
						];   
							
						// unlink('file/produk/gambar/'.$filelama);		

			            //    $this->admin_query->simpan_file();
			               
			                $this->session->set_flashdata('pesan','<div class="alert alert-success alert-dismissible">
			                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			                
			               Data produk diperbaharui
			              </div>');
			             $this->db->update('produk',$datainput, $where);
			        }
	 		}
			          redirect('user/admin/produk');
	      
	}
	public function hapus($id)
	{
		$this->db->delete('produk', array('id_produk' => $id)); 
			$this->session->set_flashdata('pesan','<div class="alert alert-success">Data produk berhasil dihapus</div>');
		redirect('user/admin/produk');
	}
}
