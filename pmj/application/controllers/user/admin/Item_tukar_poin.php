<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Item_tukar_poin extends CI_Controller {

	public function index()
	{
		$data['item_tukar_poin']=$this->db->query("SELECT * from item_tukar_poin")->result_array();
		$this->admin->load('admin/template','admin/form/item_tukar_poin/data_item_tukar_poin', $data);
	}
	public function tambah()
	{
		
		$this->admin->load('admin/template','admin/form/item_tukar_poin/tambah_item_tukar_poin');
	}
	
	
	 public function simpan(){
 		
	 	 $this->load->helper(array('form'));
	        $config['upload_path']          = './file/item_tukar_poin/gambar/';
	          $namaberkas         = $_FILES['berkas']['name'];
	         // $config['max_size']             = 20000;
	        $config['allowed_types']        = 'jpg|png|gif';
	       
	      $x = explode('.', $namaberkas );
	        $ekstensi = strtolower(end($x));
	        $namabaru=date('ymdhis.').$ekstensi;


	     
			$item_tukar_poin = $this->input->post('item_tukar_poin');
			$poin = $this->input->post('poin');
			$keterangan = $this->input->post('keterangan');

			$datainput = [
				'nama_item_tukar_poin'=>$item_tukar_poin,
				'keterangan'=>$keterangan,
				'gambar'=>$namabaru,
				
				];
	       // echo $namabaru;
	         $config['file_name']  = $namabaru;
	          $this->load->library('upload', $config);
	 
	        if ( ! $this->upload->do_upload('berkas')){
	            
	                 $pesan_error =  $this->upload->display_errors();
	                 $this->session->set_flashdata('pesan','<div class="alert alert-danger alert-dismissible">
	                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	                
	               Data gagal disimpan<br>Silahkan dicoba lagi memilih file dengan extensi file yang benar <br>'.$pesan_error.'
	              </div>');
	              
	              // redirect('admin/file/');
	        }else{
	                $data = array('upload_data' => $this->upload->data());
	                
	            //    $this->admin_query->simpan_file();
	               
	                $this->session->set_flashdata('pesan','<div class="alert alert-success alert-dismissible">
	                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	                
	               Data disimpan
	              </div>');
 
	             $this->db->insert('item_tukar_poin',$datainput);
	             $last_insert_id = $this->db->insert_id(); 
	         
	        }
	          redirect('user/admin/item_tukar_poin');
	}

	public function edit($id)
	{
		
		$data['item_tukar_poin'] = $this->db->get_where('item_tukar_poin', array('id_item_tukar_poin' => $id))->row_array(); 
		$this->admin->load('admin/template','admin/form/item_tukar_poin/edit_item_tukar_poin', $data);
	}

	
	 public function simpanedit(){
 		
	 	 $this->load->helper(array('form'));
	        $config['upload_path']          = './file/item_tukar_poin/gambar/';
	          $namaberkas         = $_FILES['berkas']['name'];
	         // $config['max_size']             = 20000;
	        $config['allowed_types']        = 'jpg|png|gif';
	       
	      $x = explode('.', $namaberkas );
	        $ekstensi = strtolower(end($x));
	        $namabaru=date('ymdhis.').$ekstensi;


	     
			$item_tukar_poin = $this->input->post('item_tukar_poin');
			$biaya = $this->input->post('biaya');
			$id = $this->input->post('id');
			$filelama = $this->input->post('filelama');
			$keterangan = $this->input->post('keterangan');
			$satuan = $this->input->post('satuan');
			$poin = $this->input->post('poin');
	
			
			$where = [
				'id_item_tukar_poin'=>$id,
				
				];
	       // echo $namabaru;
	         $config['file_name']  = $namabaru;
	          $this->load->library('upload', $config);
	 

	 		if ($namaberkas=='') {
	 			$datainput = [
					'nama_item_tukar_poin'=>$item_tukar_poin,
					'keterangan'=>$keterangan,
					'poin'=>$poin,
					
				];
	 			 $this->db->update('item_tukar_poin',$datainput, $where);

	 			    $this->session->set_flashdata('pesan','<div class="alert alert-success alert-dismissible">
			                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			                
			               Data  diperbaharui
			              </div>');

	 		}else{
	 			  if ( ! $this->upload->do_upload('berkas')){
			            
			                 $pesan_error =  $this->upload->display_errors();
			                 $this->session->set_flashdata('pesan','<div class="alert alert-danger alert-dismissible">
			                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			                
			               Data gagal disimpan<br>Silahkan dicoba lagi memilih file dengan extensi file yang benar <br>'.$pesan_error.'
			              </div>');
			              
			              // redirect('admin/file/');
			        }else{
			                $data = array('upload_data' => $this->upload->data());
			             $datainput = [
							'nama_item_tukar_poin'=>$item_tukar_poin,
							
							'keterangan'=>$keterangan,
							'poin'=>$poin,
							
							'gambar'=>$namabaru,
						];   
							
						// unlink('file/item_tukar_poin/gambar/'.$filelama);		

			            //    $this->admin_query->simpan_file();
			               
			                $this->session->set_flashdata('pesan','<div class="alert alert-success alert-dismissible">
			                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			                
			               Data diperbaharui
			              </div>');
			             $this->db->update('item_tukar_poin',$datainput, $where);
			        }
	 		}
			          redirect('user/admin/item_tukar_poin');
	      
	}
	public function hapus($id)
	{
		$this->db->delete('item_tukar_poin', array('id_item_tukar_poin' => $id)); 
			$this->session->set_flashdata('pesan','<div class="alert alert-success">Data berhasil dihapus</div>');
		redirect('user/admin/item_tukar_poin');
	}
}
