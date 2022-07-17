<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pmj extends CI_Controller {

	public function index()
	{
		$data['pmj']=$this->db->query("SELECT * from pmj")->result_array();
		$this->admin->load('admin/template','admin/form/pmj/data_pmj', $data);
	}
	public function tambah()
	{
		
		$this->admin->load('admin/template','admin/form/pmj/tambah_pmj');
	}
	
	
	 public function simpan(){
 		
	 	 $this->load->helper(array('form'));
	        $config['upload_path']          = './file/pmj/gambar/';
	          $namaberkas         = $_FILES['berkas']['name'];
	         // $config['max_size']             = 20000;
	        $config['allowed_types']        = 'jpg|png|gif';
	       
	      $x = explode('.', $namaberkas );
	        $ekstensi = strtolower(end($x));
	        $namabaru=date('ymdhis.').$ekstensi;


	     
			$nama = $this->input->post('nama');
			$jabatan = $this->input->post('jabatan');
			$alamat = $this->input->post('alamat');
			$nohp = $this->input->post('nohp');
			$email = $this->input->post('email');
			$password = $this->input->post('password');

			$datainput = [
				'nama'=>$nama,
				'alamat'=>$jabatan,
				'nohp'=>$alamat,
				'jabatan'=>$nohp,
				'email'=>$email,
				'password'=>$password,
				'foto'=>$namabaru,
				
				
				];
	       // echo $namabaru;
	         $config['file_name']  = $namabaru;
	          $this->load->library('upload', $config);
	 
	        if ( ! $this->upload->do_upload('berkas')){
	            
	                 $pesan_error =  $this->upload->display_errors();
	                 $this->session->set_flashdata('pesan','<div class="alert alert-danger alert-dismissible">
	                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	                
	               Data pmj gagal disimpan<br>Silahkan dicoba lagi memilih file dengan extensi file yang benar <br>'.$pesan_error.'
	              </div>');
	              
	              // redirect('admin/file/');
	        }else{
	                $data = array('upload_data' => $this->upload->data());
	                
	            //    $this->admin_query->simpan_file();
	               
	                $this->session->set_flashdata('pesan','<div class="alert alert-success alert-dismissible">
	                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	                
	               Data pmj disimpan
	              </div>');

	             $banyak = $this->input->post('banyak');
	             $id_bahan_baku = $this->input->post('id_bahan_baku');
	             $this->db->insert('pmj',$datainput);
	             $last_insert_id = $this->db->insert_id(); 
	             foreach ($banyak as $k=>$v) { 
	             	$id_bahan_baku_digunakan = $id_bahan_baku[$k];
	             	if ($v!='') {
	             		$data_bahan = [
	             			'id'=>$last_insert_id,
	             			'banyak_pemakaian'=>$v,
	             			'id_bahan_baku'=>$id_bahan_baku_digunakan
		             	];
	             		$this->db->insert('pemakaian_bahan_baku',$data_bahan);
	             	}
	             }
	        }
	          redirect('user/admin/pmj');
	}

	public function edit($id)
	{
		
		$data['pmj'] = $this->db->get_where('pmj', array('id' => $id))->row_array(); 
		$this->admin->load('admin/template','admin/form/pmj/edit_pmj', $data);
	}

	
	 public function simpanedit(){
 		
	 	 $this->load->helper(array('form'));
	        $config['upload_path']          = './file/pmj/gambar/';
	          $namaberkas         = $_FILES['berkas']['name'];
	         // $config['max_size']             = 20000;
	        $config['allowed_types']        = 'jpg|png|gif';
	       
	      $x = explode('.', $namaberkas );
	        $ekstensi = strtolower(end($x));
	        $namabaru=date('ymdhis.').$ekstensi;


	     
			$id = $this->input->post('id');
			$nama = $this->input->post('nama');
			$jabatan = $this->input->post('jabatan');
			$alamat = $this->input->post('alamat');
			$nohp = $this->input->post('nohp');
			$email = $this->input->post('email');
			$password = $this->input->post('password');

			
			$where = [
				'id'=>$id,
				
				];
	       // echo $namabaru;
	         $config['file_name']  = $namabaru;
	          $this->load->library('upload', $config);
	 

	 		if ($namaberkas=='') {
	 			$datainput = [
					'nama'=>$nama,
					'alamat'=>$alamat,
					'nohp'=>$nohp,
					'jabatan'=>$jabatan,
					'email'=>$email,
					'password'=>$password,
				];
	 			 $this->db->update('pmj',$datainput, $where);

	 			    $this->session->set_flashdata('pesan','<div class="alert alert-success alert-dismissible">
			                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			                
			               Data pmj diperbaharui
			              </div>');

	 		}else{
	 			  if ( ! $this->upload->do_upload('berkas')){
			            
			                 $pesan_error =  $this->upload->display_errors();
			                 $this->session->set_flashdata('pesan','<div class="alert alert-danger alert-dismissible">
			                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			                
			               Data pmj gagal disimpan<br>Silahkan dicoba lagi memilih file dengan extensi file yang benar <br>'.$pesan_error.'
			              </div>');
			              
			              // redirect('admin/file/');
			        }else{
			                $data = array('upload_data' => $this->upload->data());
			                $datainput = [
								'nama'=>$nama,
								'alamat'=>$alamat,
								'nohp'=>$nohp,
								'jabatan'=>$jabatan,
								'email'=>$email,
								'password'=>$password,
								'foto'=>$namabaru,
							];
							
						// unlink('file/pmj/gambar/'.$filelama);		

			            //    $this->admin_query->simpan_file();
			               
			                $this->session->set_flashdata('pesan','<div class="alert alert-success alert-dismissible">
			                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			                
			               Data pmj diperbaharui
			              </div>');
			             $this->db->update('pmj',$datainput, $where);
			        }
	 		}
			          redirect('user/admin/pmj');
	      
	}
	public function hapus($id)
	{
		$this->db->delete('pmj', array('id' => $id)); 
			$this->session->set_flashdata('pesan','<div class="alert alert-success">Data pmj berhasil dihapus</div>');
		redirect('user/admin/pmj');
	}
}
