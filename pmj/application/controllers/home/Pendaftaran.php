<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pendaftaran extends CI_Controller {

	public function index()
	{
				$data['judul_konten'] = "Pendaftaran Siswa";
				$data['menu'] = "Pendaftaran";
				$this->template->load('template/home','form/home/pendaftaran/pendaftaran', $data);
	}

     public function simpan_pendaftaran(){
 		
	 	 $this->load->helper(array('form'));
	        $config['upload_path']          = './file/gambar/siswa/';
	          $namaberkas         = $_FILES['berkas']['name'];
	         $config['max_size']             = 100;
	        $config['allowed_types']        = 'jpg|png|gif';
	       
	      $x = explode('.', $namaberkas );


	        $ekstensi = strtolower(end($x));
	        $namabaru=date('ymdhis').'.'.$ekstensi;
	         $config['file_name']  = $namabaru;
	          $this->load->library('upload', $config);
	 			echo $namabaru;
					$nik = $this->input->post('nik');
	                $nama = $this->input->post('nama');
	                $jenis_kelamin = $this->input->post('jenis_kelamin');
	                $tmpl = $this->input->post('tmpl');
	                $tgll = $this->input->post('tgll');
	                $agama = $this->input->post('agama');
	                $alamat = $this->input->post('alamat');
	                $nohp = $this->input->post('nohp');
	                $email = $this->input->post('email');
	                $asal_polres = $this->input->post('asal_polres');
	                $nama_orang_tua = $this->input->post('nama_orang_tua');
	                $alamat_orang_tua = $this->input->post('alamat_orang_tua');
	                $nohp_orang_tua = $this->input->post('nohp_orang_tua');
	                $fb = $this->input->post('fb');
	                $ig = $this->input->post('ig');
	              
	                $password = password_hash(123, PASSWORD_DEFAULT);
					
					$data = [
						'nik_siswa'=>$nik,
						'nama_siswa'=>$nama,
						'jenis_kelamin'=>$jenis_kelamin,
						'tmpl'=>$tmpl,
						'tgll'=>$tgll,
						'agama'=>$agama,
						'alamat'=>$alamat,
						'nohp'=>$nohp,
						'email'=>$email,
						'asal_polres'=>$asal_polres,
						'nama_orang_tua'=>$nama_orang_tua,
						'alamat_orang_tua'=>$alamat_orang_tua,
						'nohp_orang_tua'=>$nohp_orang_tua,
						'fb'=>$fb,
						'ig'=>$ig,
					
						'foto'=>$namaberkas == '' ? '' : $namabaru,
						'status_siswa'=>0,
						'id_hak_akses'=>4,
						'waktu_mendaftar'=>date('Y-m-d H:i:s'),
						'password'=>$password,
						
					];
	 		if ($namaberkas=='') {
	 			# code...
					$this->db->insert('siswa', $data);
					$this->session->set_flashdata('pesan','<div class="alert alert-success alert-dismissible">
		                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		               Pendaftaran disimpan tanpa menggunakan foto
		              </div>');
	 		}else{

		        if ( ! $this->upload->do_upload('berkas')){
		            
		                 $pesan_error =  $this->upload->display_errors();
		                 $this->session->set_flashdata('pesan','<div class="alert alert-danger alert-dismissible">
		                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		               Pendaftaran gagal disimpan<br>Silahkan dicoba lagi memilih file dengan extensi file yang benar <br>'.$pesan_error.'
		              </div>');
		        }else{
		            // $data = array('upload_data' => $this->upload->data());
		            $this->session->set_flashdata('pesan','<div class="alert alert-success alert-dismissible">
		                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		               Pendaftaran disimpan dengan menggunakan foto</div>');
		       

	                
					$this->db->insert('siswa', $data);
				}
	        }
				redirect('home/pendaftaran');
	}
}
