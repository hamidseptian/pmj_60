<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pesanan extends CI_Controller {

	public function order($jenis)
	{
		if ($jenis=='baru') {
			$where = "where f.status='Menunggu Pembayaran'";
		}else{
			$where = "";
		}
		$data['faktur']=$this->db->query("SELECT * from faktur f
			left join pelanggan p on f.id_pelanggan = p.id_pelanggan
		 $where")->result_array();
		$this->admin->load('admin/template','admin/form/pesanan/data_pesanan', $data);
	}
	
public function detail_order($id_faktur)
	{
		$q_faktur = $this->db->query("SELECT * from faktur f left join pelanggan p on f.id_pelanggan = p.id_pelanggan where f.id_faktur='$id_faktur'")->row_array();
		$pengambilan = $q_faktur['tgl_pengambilan'];
		$pembayaran = $q_faktur['id_metode_pembayaran'];
		$pengantaran = $q_faktur['id_pengantaran'];
		$ongkir = $q_faktur['ongkir'];

			$id_plg = $this->session->userdata('id_user');
			$q_pesanan = "SELECT * from faktur_rinci fr 
			left join faktur f on fr.id_faktur = f.id_faktur
			left join produk pr on fr.id_produk=pr.id_produk
			where f.id_faktur='$id_faktur'";
			$data['pengambilan']=$pengambilan;
			$data['faktur']=$q_faktur;
			$data['ongkir']=$ongkir;
			$data['pesanan']=$this->db->query($q_pesanan)->result_array();
			$data['j_pesanan']=$this->db->query($q_pesanan)->num_rows();
			$data['pembayaran']=$this->db->query("SELECT * from metode_pembayaran where id_pembayaran='$pembayaran'")->row_array();
			$data['pengantaran']=$this->db->query("SELECT * from metode_pengantaran where id_pengantaran='$pengantaran'")->row_array();
			$this->admin->load('admin/template','admin/form/pesanan/detail_order', $data);
		
	}
public function update_faktur()
	{
		$status = $this->input->get('status');
		$id_faktur = $this->input->get('id_faktur');
		$redirect = $this->input->get('redirect');
		$id_karyawan = $this->session->userdata('id_user');
		$level = $this->session->userdata('level');
		$this->session->set_flashdata('pesan','<div class="alert alert-info">Pesanan '.$status.'</div>');
		$data = $this->db->update('faktur',['status'=>$status,'id_karyawan'=>$id_karyawan], ['id_faktur'=>$id_faktur]);
		
		if ($level!='pelanggan') {
	          
	          redirect('user/admin/pesanan/order/'.$redirect);
		}else{
	          redirect('user/pelanggan/order/detail_order/'.$id_faktur);

		}
		
	}



	public function print_faktur()
	{
		$id_faktur = $this->input->get('id_faktur');
		$level = $this->session->userdata('level');
		$mpdf = new \Mpdf\Mpdf([
		    'mode' => 'utf-8',
		    'format' => 'A4',
		    'orientation' => 'L',
		    'tempDir' => '/tmp'
		]);
		$data['tes'] = '';

		$q_faktur = $this->db->query("SELECT * from faktur  f
			left join pelanggan p on f.id_pelanggan = p.id_pelanggan
			
			left join karyawan k on f.id_karyawan =k.id_karyawan
			where id_faktur='$id_faktur'")->row_array();
		$pengambilan = $q_faktur['tgl_pengambilan'];
		$pembayaran = $q_faktur['id_metode_pembayaran'];
		$pengantaran = $q_faktur['id_pengantaran'];
		$ongkir = $q_faktur['ongkir'];

			$id_plg = $this->session->userdata('id_user');
			$q_pesanan = "SELECT * from faktur_rinci fr 
			left join faktur f on fr.id_faktur = f.id_faktur
			left join produk pr on fr.id_produk=pr.id_produk
			left join wrapping w on fr.id_wrapping =w.id_wrapping
			where f.id_faktur='$id_faktur'";
			$data['pengambilan']=$pengambilan;
			$data['faktur']=$q_faktur;
			$data['ongkir']=$ongkir;
			$data['pesanan']=$this->db->query($q_pesanan)->result_array();
			$data['j_pesanan']=$this->db->query($q_pesanan)->num_rows();
			$data['pembayaran']=$this->db->query("SELECT * from metode_pembayaran where id_pembayaran='$pembayaran'")->row_array();
			$data['pengantaran']=$this->db->query("SELECT * from metode_pengantaran where id_pengantaran='$pengantaran'")->row_array();


        // $header =  $this->load->view('admin/form/pesanan/header_faktur', $data, true);

	    $html =  $this->load->view('admin/form/pesanan/print_faktur', $data, true);


        // $mpdf->SetMargins(0, 0, 40);
        $mpdf->SetHTMLHeader($header);
		$mpdf->WriteHTML($html);
		$mpdf->Output('Faktur.pdf', 'I');
	}
	
	// public function hapus($id)
	// {
	// 	$this->db->delete('produk', array('id_produk' => $id)); 
	// 		$this->session->set_flashdata('pesan','<div class="alert alert-success">Data produk berhasil dihapus</div>');
	// 	redirect('user/admin/produk');
	// }
}
