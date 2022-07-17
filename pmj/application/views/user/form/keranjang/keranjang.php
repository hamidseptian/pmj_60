	<form  action="<?php echo base_url('user/user/user/konfirmasi_pesanan') ?>" method="post">
			<div class="col-md-9" style="margin-top: -50px ">
		
			<?php echo $this->session->flashdata('pesan'); ?>
				<div class="content-bottom">
						<h3>Keranjang Belanjaan Anda</h3>
					<div class="bottom-grid">
						<!-- <table class="table table-striped table-bordered">
							<tr>
								<td>No</td>
								<td>Toko</td>
								<td>Nama Barang</td>
								<td>Jumlah Item</td>
								<td>Harga </td>
								<td>Total</td>
							</tr> -->
					<?php
				
					$nol=0;
					$noll=0;
					foreach($keranjang as $d1) {
							$no=1;
						$idpelanggan=$d1['id_pelanggan'];
						$idtoko=$d1['id_toko'];

						$dtpelanggan = $this->db->query("SELECT * FROM pelanggan where id_pelanggan='$idpelanggan'")->row_array();
						$idkelurahan = $dtpelanggan['id_kelurahan'];
						$ongkir = $this->db->query("SELECT * from ongkir where id_toko ='$idtoko' and id_kelurahan='$idkelurahan'")->row_array();
						$dongkir = $ongkir['ongkir'];
						$itemdetail = $this->db->query("SELECT * from pesanan 
						join pelanggan on pelanggan.id_pelanggan = pesanan.id_pelanggan
						join barang on barang.id_barang = pesanan.id_barang 
						join toko on barang.id_toko=toko.id_toko
						where pesanan.id_pelanggan = '$idpelanggan' and status_pesanan = 'Masuk Ke Keranjang' and pesanan.id_toko='$idtoko'")->result_array() ;
?>


						<h4><?php echo $d1['nama_toko'] ?></h4><br>
						<table class="table">
							<tr>
								<td>No</td>
								<td>Nama Barang</td>
								<td>Jumlah Item</td>
								<td>Satuan</td>
								<td>Harga </td>
								<td>Total</td>
								<td>Diskon</td>
								<td>Harga setelah diskon</td>
								<td>Option</td>
							</tr>
							<?php 

							$kosong = 0; ;
							foreach ($itemdetail as $d2) { ?>
								
							 <tr>
								<td><?php echo $no++ ?></td>
								
								<td><?php echo $d2['nama_barang'] ?></td>
								<td><?php echo $d2['qty'] ?></td>
								<td><?php echo $d2['satuan_barang'] ?></td>
								<td>Rp. <?php echo number_format($d2['harga_jual']) ?></td>
								<td>
									<?php 
									$total = $d2['qty'] * $d2['harga_jual'] ;
									$potongan = $total * ($d2['diskon'] / 100);
									$diskon = $total - $potongan;
									echo "Rp. ".number_format($total);
									$totalharga = $kosong+=$diskon;
									?>
										
								</td>
								<td><?php echo $d2['diskon'] ?>%</td>
								<td><?php echo $diskon ?></td>
								<td>
									<a href="<?php echo base_url('user/user/user/hapus_pesanan/'.$d2['id_pesanan']) ?>" class="btn btn-info btn-xs">Hapus</a>
								</td>
								
							</tr>
							<?php } ?>
						
							 <tr>
								<td align="right" colspan="7">Total Belanja</td>
								<td colspan="2">Rp. <?php echo number_format($totalharga) ?></td>
							</tr>
							<tr>
								<td align="right" colspan="7">Ongkir</td>
								<td colspan="2">Rp. <?php echo number_format($dongkir) ?></td>
							</tr>
							<tr>
								<td align="right" colspan="7">Total Belanja di <?php echo $d1['nama_toko'] ?> </td>
								<td colspan="2"><?php $total = $totalharga + $dongkir;
								echo "Rp. ". number_format($total);
								$bayar = $noll +=$total;
									?></td>
							</tr>
							<!-- <tr>
								<td align="right" colspan="7">Metode pembayaran untuk <?php echo $d1['nama_toko'] ?></td>
								<td colspan="2"> 
									<select class="form-control" id="metode">
										<option value="Tunai">Tunai</option>
										<option value="Transfer">Transfer</option>
									</select>
								</td>
							</tr> -->
						</table> 
					
					<hr>

					<?php } ?>
							
							<?php if ($j1>0) { ?>
								<h4>Total Belanja Anda Adalah : Rp. <?php echo number_format($bayar) ?></h4><br>
								
								<div class="col-md-4">
									<select class="form-control" name="metode">
										<option value="Tunai">Metode Pembayaran : Tunai</option>
										<option value="Transfer">Metode Pembayaran :Transfer</option>
									</select>
								</div>
								<button  class="btn btn-info">Konfirmasi Pesanan</button>
							<?php } else{
								echo "Keranjang Belanja Koksong"; }?>
						<div class="clearfix"> </div>
					</div>
				</div>
			
			</div>

		
	</form>