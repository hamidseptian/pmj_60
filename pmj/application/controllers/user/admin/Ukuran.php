<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ukuran extends CI_Controller {

	public function index()
	{
		$data['ukuran']=$this->db->query("SELECT * from ukuran u left join produk p on u.id_produk=p.id_produk")->result_array();
		$this->admin->load('admin/template','admin/form/ukuran/data_ukuran', $data);
	}
	public function tambah()
	{
		
		$data['produk']=$this->db->query("SELECT * from produk")->result_array();
		$data['bahan_baku']=$this->db->query("SELECT * from bahan_baku where peruntukan='Hand Baquet'")->result_array();
		$this->admin->load('admin/template','admin/form/ukuran/tambah_ukuran', $data);
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
			$ukuran = $this->input->post('ukuran');
			$biaya = $this->input->post('biaya');
			$topping = $this->input->post('topping');

			$datainput = [
				'id_produk'=>$produk,
				'ukuran'=>$ukuran,
				'biaya'=>$biaya,
				'banyak_topping'=>$topping,
				'gambar'=>$namabaru,
				
				];
	       // echo $namabaru;
	         $config['file_name']  = $namabaru;
	          $this->load->library('upload', $config);
	 
	        if ( ! $this->upload->do_upload('berkas')){
	            
	                 $pesan_error =  $this->upload->display_errors();
	                 $this->session->set_flashdata('pesan','<div class="alert alert-danger alert-dismissible">
	                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	                
	               Data ukuran gagal disimpan<br>Silahkan dicoba lagi memilih file dengan extensi file yang benar <br>'.$pesan_error.'
	              </div>');
	              
	              // redirect('admin/file/');
	        }else{
	                $data = array('upload_data' => $this->upload->data());
	                
	            //    $this->admin_query->simpan_file();
	               
	                $this->session->set_flashdata('pesan','<div class="alert alert-success alert-dismissible">
	                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	                
	               Data ukuran disimpan
	              </div>');

	             $banyak = $this->input->post('banyak');
	             $id_bahan_baku = $this->input->post('id_bahan_baku');
	             $this->db->insert('ukuran',$datainput);
	             $last_insert_id = $this->db->insert_id(); 
	             foreach ($banyak as $k=>$v) { 
	             	$id_bahan_baku_digunakan = $id_bahan_baku[$k];
	             	if ($v!='') {
	             		$data_bahan = [
	             			'id_ukuran'=>$last_insert_id,
	             			'banyak_pemakaian'=>$v,
	             			'id_bahan_baku'=>$id_bahan_baku_digunakan
		             	];
	             		$this->db->insert('pemakaian_bahan_baku',$data_bahan);
	             	}
	             }
	        }
	          redirect('user/admin/ukuran');
	}

	public function edit($id)
	{
		$data['produk']=$this->db->query("SELECT * from produk")->result_array();
		$data['bahan_baku']=$this->db->query("SELECT * from bahan_baku where peruntukan='Hand Baquet'")->result_array();
		$data['ukuran'] = $this->db->get_where('ukuran', array('id_ukuran' => $id))->row_array(); 
		$this->admin->load('admin/template','admin/form/ukuran/edit_ukuran', $data);
	}
	public function warna($id)
	{
		$data['produk']=$this->db->query("SELECT u.*, p.nama_produk from ukuran u  left join produk p on u.id_produk=p.id_produk where u.id_ukuran='$id'")->row_array();
		$query_warna="SELECT * from warna where id_ukuran='$id'";
		$data['warna']=$this->db->query($query_warna)->result_array();
		$data['j_warna']=$this->db->query($query_warna)->num_rows();
		$this->admin->load('admin/template','admin/form/ukuran/warna_produk', $data);
	}
	public function tambah_warna($id)
	{
		$data['produk']=$this->db->query("SELECT u.*, p.nama_produk from ukuran u  left join produk p on u.id_produk=p.id_produk where u.id_ukuran='$id'")->row_array();
		$this->admin->load('admin/template','admin/form/ukuran/tambah_warna_produk', $data);
	}
	public function edit_warna($id, $id_warna)
	{
		$data = [
				'id_warna'=>$id_warna,
				];
		$data['warna'] = $this->db->get_where('warna',$data)->row_array();
		$data['produk']=$this->db->query("SELECT u.*, p.nama_produk from ukuran u  left join produk p on u.id_produk=p.id_produk where u.id_ukuran='$id'")->row_array();
		$this->admin->load('admin/template','admin/form/ukuran/edit_warna_produk', $data);
	}
	public function simpan_warna($id_ukuran, $id_produk)
	{
		$warna = $this->input->post('warna');
			$stok = $this->input->post('stok');
		

			$data = [
				'id_ukuran'=>$id_ukuran,
				'id_produk'=>$id_produk,
				'warna'=>$warna,
				'stok'=>$stok,
				
				];
		$this->db->insert('warna',$data);


		redirect('user/admin/ukuran/warna/'.$id_ukuran);
	}
	public function simpanedit_warna($id_ukuran, $id_produk)
	{
		$warna = $this->input->post('warna');
			$stok = $this->input->post('stok');
			$id = $this->input->post('id');
		

			$data = [
				'warna'=>$warna,
				'stok'=>$stok,
				
				];
			$where = [
				'id_warna'=>$id,
				];
		$this->db->update('warna',$data, $where);


		redirect('user/admin/ukuran/warna/'.$id_ukuran);
	}
	public function hapus_warna($id_ukuran, $id_warna)
	{
			$data = [
				'id_warna'=>$id_warna,
				];
		$this->db->delete('warna',$data);


		redirect('user/admin/ukuran/warna/'.$id_ukuran);
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
			$ukuran = $this->input->post('ukuran');
			$biaya = $this->input->post('biaya');
			$id = $this->input->post('id');
			$filelama = $this->input->post('filelama');
			$topping = $this->input->post('topping');
	
			
			$where = [
				'id_ukuran'=>$id,
				
				];
	       // echo $namabaru;
	         $config['file_name']  = $namabaru;
	          $this->load->library('upload', $config);
	 

	 		if ($namaberkas=='') {
	 			$datainput = [
					'id_produk'=>$produk,
					'ukuran'=>$ukuran,
					'biaya'=>$biaya,
					'banyak_topping'=>$topping,
					
				];
	 			 $this->db->update('ukuran',$datainput, $where);



	 			  $banyak = $this->input->post('banyak');
		             $id_bahan_baku = $this->input->post('id_bahan_baku');
             		$this->db->delete('pemakaian_bahan_baku',['id_ukuran'=>$id]);
		           
		             foreach ($banyak as $k=>$v) { 
		             	$id_bahan_baku_digunakan = $id_bahan_baku[$k];
		             	if ($v!='') {
		             		$data_bahan = [
		             			'id_ukuran'=>$id,
		             			'banyak_pemakaian'=>$v,
		             			'id_bahan_baku'=>$id_bahan_baku_digunakan
			             	];
		             		$this->db->insert('pemakaian_bahan_baku',$data_bahan);
		             	}
		             }
	 		}else{
	 			  if ( ! $this->upload->do_upload('berkas')){
			            
			                 $pesan_error =  $this->upload->display_errors();
			                 $this->session->set_flashdata('pesan','<div class="alert alert-danger alert-dismissible">
			                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			                
			               Data ukuran gagal disimpan<br>Silahkan dicoba lagi memilih file dengan extensi file yang benar <br>'.$pesan_error.'
			              </div>');
			              
			              // redirect('admin/file/');
			        }else{
			                $data = array('upload_data' => $this->upload->data());
			             $datainput = [
							'id_produk'=>$produk,
							'ukuran'=>$ukuran,
							'biaya'=>$biaya,
							'banyak_topping'=>$topping,
							'gambar'=>$namabaru,
						];   
							
						unlink('file/produk/gambar/'.$filelama);		

			            //    $this->admin_query->simpan_file();
			               
			                $this->session->set_flashdata('pesan','<div class="alert alert-success alert-dismissible">
			                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			                
			               Data ukuran diperbaharui
			              </div>');
			             $this->db->update('ukuran',$datainput, $where);
			        }
	 		}
			          redirect('user/admin/ukuran');
	      
	}
	public function hapus($id, $file)
	{
		$this->db->delete('ukuran', array('id_ukuran' => $id)); 
		unlink('file/produk/gambar/'.$file);
			$this->session->set_flashdata('pesan','<div class="alert alert-success">Data ukuran berhasil dihapus</div>');
		redirect('user/admin/ukuran');
	}
}
