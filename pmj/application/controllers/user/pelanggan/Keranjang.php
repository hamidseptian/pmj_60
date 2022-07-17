<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Keranjang extends CI_Controller {

	public function index()
	{
		$id_plg = $this->session->userdata('id_user');
		$q_pesanan = "SELECT * from faktur_rinci fr 
		left join faktur f on fr.id_faktur = f.id_faktur
		left join produk pr on fr.id_produk=pr.id_produk
		left join wrapping w on fr.id_wrapping = w.id_wrapping
		where f.id_pelanggan='$id_plg' and f.status='Masuk Ke Keranjang'";
		$data['pesanan']=$this->db->query($q_pesanan)->result_array();
		$data['pembayaran']=$this->db->get('metode_pembayaran')->result_array();
		$data['pengantaran']=$this->db->get('metode_pengantaran')->result_array();
		$data['j_pesanan']=$this->db->query($q_pesanan)->num_rows();
		$data['rekening']=$this->db->query("SELECT * from metode_pembayaran")->result_array();
		$this->admin->load('home/template','pelanggan/form/keranjang/keranjang', $data);
	}
	public function checkout()
	{
		$id_faktur = $this->input->post('id_faktur');
		$pengambilan = $this->input->post('pengambilan');
		$pembayaran = $this->input->post('pembayaran');
		$pengantaran = $this->input->post('pengantaran');
		$ongkir = $this->input->post('ongkir');
		$tgls =date('Y-m-d');
		$sesudah = date('Y-m-d', strtotime("+2 days", strtotime($tgls)));


		if (strtotime($pengambilan) < strtotime($sesudah)) {
			$this->session->set_flashdata('pesan','<div class="alert alert-success">Gagal Checkout <br>Waktu pengambilan yang di bolehkan adalah diatas tanggal '.$sesudah.'</div>');
			redirect('user/pelanggan/keranjang');
		}else{
			date_default_timezone_set("Asia/Bangkok");
			$jam_sekarang = date('H');
			$jam_berakhir = $jam_sekarang + 6;
			if ($jam_berakhir>23) {
				$tgl_expired = date('Y-m-d', strtotime("+2 days", strtotime($tgls)));
				$sisa_jam = $jam_berakhir - 24;
				$akhir_pembayaran = $tgl_expired.' 0'.$sisa_jam.':'.date('i');
			}else{
				$akhir_pembayaran = $tgls.' '.$jam_berakhir.':'.date('i');
			}
			// $this->session->set_flashdata('pesan','<div class="alert alert-success">Checkout Sukses<br>Silahkan lakukan pembayaran sebelum  '.$akhir_pembayaran.'</div>');
			$id_plg = $this->session->userdata('id_user');
			$q_pesanan = "SELECT * from faktur_rinci fr 
			left join faktur f on fr.id_faktur = f.id_faktur
			left join produk pr on fr.id_produk=pr.id_produk
			where fr.id_pelanggan='$id_plg' and f.status='Masuk Ke Keranjang'";
			$data['pengambilan']=$pengambilan;
			$data['id_faktur']=$id_faktur;
			$data['ongkir']=$ongkir;
			$data['pesanan']=$this->db->query($q_pesanan)->result_array();
			$data['j_pesanan']=$this->db->query($q_pesanan)->num_rows();
			$data['pembayaran']=$this->db->query("SELECT * from metode_pembayaran where id_pembayaran='$pembayaran'")->row_array();
			$data['pengantaran']=$this->db->query("SELECT * from metode_pengantaran where id_pengantaran='$pengantaran'")->row_array();
			$this->admin->load('home/template','pelanggan/form/keranjang/checkout', $data);
		}
	}
	public function konfirmasi()
	{
		date_default_timezone_set("Asia/Bangkok");
		$pengambilan = $this->input->post('pengambilan');
		$pembayaran = $this->input->post('pembayaran');
		$id_faktur = $this->input->post('id_faktur');
		$pengantaran = $this->input->post('pengantaran');
		$ongkir = $this->input->post('ogkir');
		$total = $this->input->post('total');
		$no_faktur = date('ymdHis');
		$tgls =date('Y-m-d');
		$waktu_skrg =date('H:i');
		$waktu_pesan = $tgls.' '.$waktu_skrg;
		$sesudah = date('Y-m-d', strtotime("+2 days", strtotime($tgls)));


		if (strtotime($pengambilan) < strtotime($sesudah)) {
			$this->session->set_flashdata('pesan','<div class="alert alert-success">Gagal Checkout <br>Waktu pengambilan yang di bolehkan adalah diatas tanggdasdal '.$pengambilan.'</div>');
			redirect('user/pelanggan/keranjang');
		}else{
			
			$jam_sekarang = date('H');
			$jam_berakhir = $jam_sekarang + 6;
			if ($jam_berakhir>23) {
				$tgl_expired = date('Y-m-d', strtotime("+2 days", strtotime($tgls)));
				$sisa_jam = $jam_berakhir - 24;
				$showjam = $sisa_jam<=9 ? ''.$sisa_jam : $sisa_jam;
				$akhir_pembayaran = $tgl_expired.' 0'.$showjam.':'.date('i');
			}else{
				$showjam = $jam_berakhir<=9 ? '0'.$jam_berakhir : $jam_berakhir;
				$akhir_pembayaran = $tgls.' '.$showjam.':'.date('i');
			}
			$this->session->set_flashdata('pesan','<div class="alert alert-success">Checkout Sukses<br>Silahkan lakukan pembayaran sebelum  '.$akhir_pembayaran.'</div>');
			$id_plg = $this->session->userdata('id_user');
			echo $id_plg;
			$q_pesanan = "UPDATE  faktur 
			set 
			no_faktur = '$no_faktur',
			status = 'Menunggu Pembayaran', 
			batas_pembayaran='$akhir_pembayaran',
			tgl_pengambilan='$pengambilan', 
			id_pengantaran='$pengantaran', 
			id_metode_pembayaran='$pembayaran', 
			tanggal_pemesanan ='$waktu_pesan', 
			ongkir='$ongkir',
			total='$total'
			where id_pelanggan='$id_plg' and status='Masuk Ke Keranjang'";
			$update = $this->db->query($q_pesanan);
			redirect('user/pelanggan/order/detail_order/'.$id_faktur);
		}
	}
	
	
	public function hapus($id, $id_produk)
	{
		$pr = $this->db->get_where('produk', array('id_produk' => $id_produk))->row_array(); 
		$wrapping_dibutuhkan = $pr['wrapping_dibutuhkan'];
		$fr = $this->db->get_where('faktur_rinci', array('id_order' => $id))->row_array(); 
		$id_wrapping = $fr['id_wrapping'];
		$w = $this->db->get_where('wrapping',['id_wrapping'=>$id_wrapping])->row_array();
		$stok_wrapping_tersedia = $w['stok'];
		$qty_produk = $fr['qty'];
		$kembalikan_stok = ($wrapping_dibutuhkan * $qty_produk) + $stok_wrapping_tersedia;

		$this->db->update('wrapping', ['stok'=>$kembalikan_stok], ['id_wrapping'=>$id_wrapping]);

		$this->db->delete('faktur_rinci', array('id_order' => $id)); 
		$this->db->delete('topping_pesanan', array('id_order' => $id)); 
			$this->session->set_flashdata('pesan','<div class="alert alert-success">Data produk berhasil dihapus dalam keranjang</div>');
		redirect('user/pelanggan/keranjang');
	}


	public function edit($id, $id_order)
	{
			$produk = $this->db->query("SELECT * from produk p where p.id_produk='$id'")->row_array();
			$id_produk = $produk['id_produk'];
			$wrapping_dibutuhkan = $produk['wrapping_dibutuhkan'];
			$qwrapping_produk = "SELECT * from wrapping where stok>='$wrapping_dibutuhkan'";
			$qtopping = "SELECT * from topping where stok >0";
			$fr = $this->db->query("SELECT * from faktur_rinci where id_order='$id_order'")->row_array();
			$data['pesanan'] = $fr;
			
			$data['wrapping']=$this->db->query($qwrapping_produk)->result_array();
			$data['topping']=$this->db->query($qtopping)->result_array();
			$data['maksimal_topping']=$produk['maksimal_topping'];
			$data['produk']=$produk;
			$data['id_order']=$id_order;
			$data['id_faktur']=$fr['id_faktur'];
			$data['caption_cari']='';







			// $produk = $this->db->query("SELECT * from  produk  where id_produk='$id'")->row_array();
			// $id_ukuran = $produk['id_ukuran'];
			// $wrapping_dibutuhkan = $produk['wrapping_dibutuhkan'];
			// $qwrapping_produk = "SELECT * from wrapping where stok>='$wrapping_dibutuhkan'";
			// $qtopping = "SELECT * from topping where stok >0";

			// $data['id_pesanan'] = $id_pesanan;
			// $data['pesanan'] = $this->db->query("SELECT * from faktur_rinci where id_order='$id_pesanan'")->row_array();
			// $data['warna']=$this->db->query($qwarna_produk)->result_array();
			// $data['topping']=$this->db->query($qtopping)->result_array();
			// $data['produk']=$produk;
			// $data['caption_cari']='';
		
			

		
		$this->admin->load('home/template','pelanggan/form/keranjang/edit_keranjang', $data);
	}
}
