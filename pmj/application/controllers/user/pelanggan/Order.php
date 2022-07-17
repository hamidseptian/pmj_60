<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller {

	public function index()
	{
		$id_pelanggan = $this->session->userdata('id_user');
		$q = $this->db->query("SELECT * from faktur where id_pelanggan='$id_pelanggan'");
		$data['faktur']=$q->result_array();
		$data['j_faktur']=$q->num_rows();
		$this->admin->load('home/template','pelanggan/form/pesanan/pesanan', $data);
	}
	
	public function simpan_ke_keranjang()
	{

		$qty = $this->input->post('qty');
		
		$id_produk = $this->input->post('id_produk');
		$id_wrapping = $this->input->post('id_wrapping');
		$maksimal_topping = $this->input->post('maksimal_topping');
		$wrapping_dibutuhkan = $this->input->post('wrapping_dibutuhkan');
		$id_topping = $this->input->post('id_topping');
		$qty_topping = $this->input->post('qty_topping');
		$id_pelanggan = $this->session->userdata('id_user');

		$cek_wrapping = $this->db->query("SELECT * from wrapping where id_wrapping='$id_wrapping'")->row_array();
		$stok_wrapping = intval($cek_wrapping['stok'] / $wrapping_dibutuhkan);
		$stok_wrapping_tersisa = $cek_wrapping['stok'] - ($wrapping_dibutuhkan * $qty);
			
		if ($stok_wrapping < $qty) {
			$this->session->set_flashdata('pesan','<div class="alert alert-danger">Gagal memasukkan ke keranjang<br>Total pesanan melebihi stok'.$maksimal_topping.'</div>');
				redirect('homepage/detail_produk/'.$id_produk);
		}else{
			if ($qty>$cek_wrapping['stok']) {
				$this->session->set_flashdata('pesan','<div class="alert alert-danger">Gagal memasukkan ke keranjang<br>Total maksimal topping yang dibolehkan adalah '.$maksimal_topping.'</div>');
					redirect('homepage/detail_produk/'.$id_produk);
			}else{


				$banyak_toping = array_sum($qty_topping);

				$cek_faktur = $this->db->query("SELECT * from faktur where id_pelanggan='$id_pelanggan' and status='Masuk Ke Keranjang'");
				if ($cek_faktur->num_rows()>0) {
					$id_faktur = $cek_faktur->row_array()['id_faktur'];
				}else{
					$data = [
							'id_pelanggan'=>$id_pelanggan,
							'status'=>'Masuk Ke Keranjang'
						];
					$this->db->insert('faktur', $data);
					$id_faktur = $this->db->insert_id(); 
				}
				if ($maksimal_topping>0) {
					if ($banyak_toping>$maksimal_topping) {
						$this->session->set_flashdata('pesan','<div class="alert alert-danger">Gagal memasukkan ke keranjang<br>Total maksimal topping yang dibolehkan adalah '.$maksimal_topping.'</div>');
						redirect('homepage/detail_produk/'.$id_produk);
					}else{
						$this->session->set_flashdata('pesan','<div class="alert alert-success">Data di masukkan ke keranjang</div>');
						$data = [
							'id_pelanggan'=>$this->session->userdata('id_user'),
							'id_faktur'=>$id_faktur,
							'id_produk'=>$id_produk,
							'id_wrapping'=>$id_wrapping,
							'qty'=>$qty,
						];
						
						$this->db->insert('faktur_rinci', $data);
						$last_insert_id = $this->db->insert_id(); 
						foreach ($qty_topping as $k => $v) {
							$id_topping_terpilih = $id_topping[$k];
							$q_topping = $this->db->get_where('topping', ['id_topping'=>$id_topping_terpilih])->row_array();
							$harga_topping = $q_topping['harga'];
							$nama_topping = $q_topping['nama_topping'];
							$stok_topping = $q_topping['stok'];
							$stok_sisa = $stok_topping - $v;
							if ($v>0) {
								$data = [
									'id_faktur'=>$id_faktur,
									'id_topping'=>$id_topping_terpilih,
									'id_order'=>$last_insert_id,
									'qty_topping'=>$v,
								];
								$this->db->insert('topping_pesanan', $data);
								$this->db->update('topping', ['stok'=>$stok_sisa], ['id_topping'=>$id_topping_terpilih]);
							}
						}
					}
				}else{
						$data = [
							'id_pelanggan'=>$this->session->userdata('id_user'),
							'id_faktur'=>$id_faktur,
							'id_produk'=>$id_produk,
							'id_wrapping'=>$id_wrapping,
							'qty'=>$qty,
						];
						
						$this->db->insert('faktur_rinci', $data);
					}

			}
						$this->db->update('wrapping', ['stok'=>$stok_wrapping_tersisa],['id_wrapping'=>$id_wrapping]);
		redirect('homepage/produk');
		}
	}
	
	
	public function simpanedit_ke_keranjang()
	{
		$qty = $this->input->post('qty');
		$id_faktur = $this->input->post('id_faktur');
		
		$id_order = $this->input->post('id_order');
		$id_produk = $this->input->post('id_produk');
		$id_wrapping = $this->input->post('id_wrapping');
		$maksimal_topping = $this->input->post('maksimal_topping');
		$id_topping = $this->input->post('id_topping');
		$qty_topping = $this->input->post('qty_topping');
		$id_pelanggan = $this->session->userdata('id_user');








// -------------------------------------------------kembalikan stok wrapping
		$pr = $this->db->get_where('produk', array('id_produk' => $id_produk))->row_array(); 
		$wrapping_dibutuhkan_sebelumnya = $pr['wrapping_dibutuhkan'];
		$fr = $this->db->get_where('faktur_rinci', array('id_order' => $id_order))->row_array(); 
		$id_wrapping_sebelumnya = $fr['id_wrapping'];
		$w = $this->db->get_where('wrapping',['id_wrapping'=>$id_wrapping_sebelumnya])->row_array();
		$stok_wrapping_tersedia = $w['stok'];
		$qty_produk = $fr['qty'];
		$kembalikan_stok = ($wrapping_dibutuhkan_sebelumnya * $qty_produk) + $stok_wrapping_tersedia;

		$this->db->update('wrapping', ['stok'=>$kembalikan_stok], ['id_wrapping'=>$id_wrapping]);
// -------------------------------------------------kembalikan stok wrapping






		
		$wrapping_dibutuhkan = $this->input->post('wrapping_dibutuhkan');
		$cek_wrapping = $this->db->query("SELECT * from wrapping where id_wrapping='$id_wrapping'")->row_array();
		$stok_wrapping = intval($cek_wrapping['stok'] / $wrapping_dibutuhkan);
		$stok_wrapping_tersisa = $cek_wrapping['stok'] - ($wrapping_dibutuhkan * $qty);

		$where_delete_order = ['id_produk'=>$id_produk, 'id_order'=>$id_order];

		if ($stok_wrapping < $qty) {
			$this->session->set_flashdata('pesan','<div class="alert alert-danger">Gagal memasukkan ke keranjang<br>Total pesanan melebihi stok</div>');
				redirect('user/pelanggan/keranjang/edit/'.$id_produk.'/'.$id_order);
		}else{
			if ($qty>$cek_wrapping['stok']) {
				$this->session->set_flashdata('pesan','<div class="alert alert-danger">Gagal memasukkan ke keranjang<br>Total maksimal topping yang dibolehkan adalah '.$maksimal_topping.'</div>');
					redirect('user/pelanggan/keranjang/edit/'.$id_produk.'/'.$id_order);
			}else{


				$banyak_toping = array_sum($qty_topping);

				if ($maksimal_topping>0) {
					if ($banyak_toping>$maksimal_topping) {
						$this->session->set_flashdata('pesan','<div class="alert alert-danger">Gagal memasukkan ke keranjang<br>Total maksimal topping yang dibolehkan adalah '.$maksimal_topping.'</div>');
						redirect('user/pelanggan/keranjang/edit/'.$id_produk.'/'.$id_order);
					}else{
						$this->session->set_flashdata('pesan','<div class="alert alert-success">Data di masukkan ke keranjang</div>');
						$data = [
							'id_pelanggan'=>$this->session->userdata('id_user'),
							'id_faktur'=>$id_faktur,
							'id_produk'=>$id_produk,
							'id_wrapping'=>$id_wrapping,
							'qty'=>$qty,
						];
						$this->db->delete('faktur_rinci', $where_delete_order);
						$this->db->insert('faktur_rinci', $data);
						$last_insert_id = $this->db->insert_id(); 
						foreach ($qty_topping as $k => $v) {
							$id_topping_terpilih = $id_topping[$k];
							$q_topping = $this->db->get_where('topping', ['id_topping'=>$id_topping_terpilih])->row_array();
							$harga_topping = $q_topping['harga'];
							$nama_topping = $q_topping['nama_topping'];
							$stok_topping = $q_topping['stok'];
							if ($v>0) {
								$data = [
									'id_faktur'=>$id_faktur,
									'id_topping'=>$id_topping_terpilih,
									'id_order'=>$last_insert_id,
									'qty_topping'=>$v,
								];
								$where_delete_order_toppinf = ['id_topping'=>$id_topping_terpilih, 'id_order'=>$id_order];
								$this->db->delete('topping_pesanan', $where_delete_order_toppinf);
								$this->db->insert('topping_pesanan', $data);
							}
						}
					}
				}else{
						$data = [
							'id_pelanggan'=>$this->session->userdata('id_user'),
							'id_faktur'=>$id_faktur,
							'id_produk'=>$id_produk,
							'id_wrapping'=>$id_wrapping,
							'qty'=>$qty,
						];
						$this->db->delete('faktur_rinci', $where_delete_order);
						$this->db->insert('faktur_rinci', $data);
					}
			}
			
		$this->db->update('wrapping', ['stok'=>$stok_wrapping_tersisa],['id_wrapping'=>$id_wrapping]);
		redirect('user/pelanggan/keranjang');
		}
	}

public function detail_order($id_faktur)
	{
		$q_faktur = $this->db->query("SELECT * from faktur where id_faktur='$id_faktur'")->row_array();
		$pengambilan = $q_faktur['tgl_pengambilan'];
		$pembayaran = $q_faktur['id_metode_pembayaran'];
		$pengantaran = $q_faktur['id_pengantaran'];
		$ongkir = $q_faktur['ongkir'];

			$id_plg = $this->session->userdata('id_user');
			$q_pesanan = "SELECT * from faktur_rinci fr 
			left join faktur f on fr.id_faktur = f.id_faktur
			left join produk pr on fr.id_produk=pr.id_produk
			where fr.id_pelanggan='$id_plg' and f.id_faktur='$id_faktur'";
			$data['pengambilan']=$pengambilan;
			$data['faktur']=$q_faktur;
			$data['ongkir']=$ongkir;
			$data['pesanan']=$this->db->query($q_pesanan)->result_array();
			$data['j_pesanan']=$this->db->query($q_pesanan)->num_rows();
			$data['pembayaran']=$this->db->query("SELECT * from metode_pembayaran where id_pembayaran='$pembayaran'")->row_array();
			$data['pengantaran']=$this->db->query("SELECT * from metode_pengantaran where id_pengantaran='$pengantaran'")->row_array();
			$this->admin->load('home/template','pelanggan/form/pesanan/detail_order', $data);
		
	}

	 public function upload_bukti_pembayaran(){
 		
	 	 $this->load->helper(array('form'));
	        $config['upload_path']          = './file/bukti_pembayaran/gambar/';
	          $namaberkas         = $_FILES['berkas']['name'];
	         // $config['max_size']             = 20000;
	        $config['allowed_types']        = 'jpg|png|gif';
	       
	      $x = explode('.', $namaberkas );
	        $ekstensi = strtolower(end($x));
	        $namabaru=date('ymdhis.').$ekstensi;


			$id = $this->input->post('id_faktur');
	
			
			$where = [
				'id_faktur'=>$id,
				
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
			             $datainput = [
							
							'bukti_pembayaran'=>$namabaru,
							'status'=>'Cek Pembayaran',
						];   
							
						// unlink('file/produk/gambar/'.$filelama);		

			            //    $this->admin_query->simpan_file();
			               
			                $this->session->set_flashdata('pesan','<div class="alert alert-success alert-dismissible">
			                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			                
			               Data produk diperbaharui
			              </div>');
			             $this->db->update('faktur',$datainput, $where);
			        }
	 		
			          redirect('user/pelanggan/order/detail_order/'.$id);
	      
	}


}
