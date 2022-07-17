
			<div class="col-md-9" style="margin-top: -50px ">
			
				<div class="content-bottom">

					<h3>Detail Pesanan tanggal <?php echo $tgl ?> jam <?php echo $waktudb ?></h3>
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
						$rek = $this->db->get_where('rekening', ['id_toko'=>$idtoko])->result_array();
						$query = "SELECT * from pembayaran join rekening on pembayaran.id_rekening = rekening.id_rekening where pembayaran.id_toko='$idtoko' and pembayaran.id_pelanggan='$idpelanggan' and tanggal_pesan='$tgldb' and waktu_pesan='$waktudb' order by pembayaran.id_pembayaran  desc limit 1";
						$jpembayaran = $this->db->query($query)->num_rows();
						$dpembayaran = $this->db->query($query)->row_array();
						$tglp=$d1['tanggal_pesan'];

						$dtpelanggan = $this->db->query("SELECT * FROM pelanggan where id_pelanggan='$idpelanggan'")->row_array();
						$idkelurahan = $dtpelanggan['id_kelurahan'];
						$ongkir = $this->db->query("SELECT * from ongkir where id_toko ='$idtoko' and id_kelurahan='$idkelurahan'")->row_array();
						$dongkir = $ongkir['ongkir'];
						$itemdetail = $this->db->query("SELECT * from pesanan 
						join pelanggan on pelanggan.id_pelanggan = pesanan.id_pelanggan
						join barang on barang.id_barang = pesanan.id_barang 
						join toko on barang.id_toko=toko.id_toko
						where pesanan.id_pelanggan = '$idpelanggan' and status_pesanan != 'Masuk Ke Keranjang' and pesanan.id_toko='$idtoko' and tanggal_pesan='$tglp' and pesanan.waktu_pesan='$waktudb'")->result_array() ;
?>


						<h4><?php echo $d1['nama_toko'] ?></h4><br>
						<table class="table">
							<tr>
								<td>No</td>
								<td>Nama Barang</td>
								<td>Jumlah Item</td>
								<td>Harga </td>
								<td>Total</td>
								<td>Diskon</td>
								<td>Harga setelah diskon</td>
								
							</tr>
							<?php 

							$kosong = 0; ;
							foreach ($itemdetail as $d2) { ?>
								
							 <tr>
								<td><?php echo $no++ ?></td>
								
								<td><?php echo $d2['nama_barang'] ?></td>
								<td><?php echo $d2['qty'] ?></td>
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
								
							</tr>
							<?php } ?>
						
							 <tr>
								<td align="right" colspan="6">Total Belanja</td>
								<td colspan="2">Rp. <?php echo $totalharga ?></td>
							</tr>
							<tr>
								<td align="right" colspan="6">Ongkir</td>
								<td colspan="2">Rp. <?php echo number_format($dongkir) ?></td>
							</tr>
							<tr>
								<td align="right" colspan="6">Total Belanja di <?php echo $d1['nama_toko'] ?> </td>
								<td colspan="2">Rp. <?php  echo number_format($totalharga + $dongkir)?></td>
							</tr>
								<?php if ($d1['metode_bayar']=='Transfer') { ?>
							<tr>
								<td colspan="8">Harap melakukan pembayaran ke  <br>
								<ul>
									<?php foreach ($rek as $r) {
										echo "<li style='margin-left:20px'>".$r['bank'] .'-'. $r['no_rekening']." Atas nama : ".$r['nama_rekening']."</li>";
									} ?>
									
								</ul>
								Pesanan anda akan di proses setelah anda melakukan transfer
							</td>
							</tr>
							<?php if ($jpembayaran>0) { ?>
							
						
							<tr>
								 <td colspan="6">
								 	<?php 
								 	
								 	if ($dpembayaran['status']=='Pengecekan') {
								 		echo "Pembayaran Anda sedang di proses oleh admin kami <br>File Transfer : <br>";
								 		echo "<img src='".base_url()."pembayaran/".$dpembayaran['file']."' style='max-width:300px'>";
								 	}else  if ($dpembayaran['status']=='Ditolak') { ?>

								 		Pembayaran anda ditolak oleh admin <br>Silahkan coba lagi
								 	<form action="<?php echo base_url() ?>belanja/upload_pembayaran" method="post" enctype="multipart/form-data">
								 		Upload bukti pembayaran <br>
								 	<div class="form-group">
								 		Pilih Rekening Tujuan <br>
								 		<select name="rek" class="form-control">
								 			<?php foreach ($rek as $r) { ?>
								 				<option value="<?php echo $r['id_rekening'] ?>"><?php echo $r['bank'] ?> - No Rekening : <?php echo $r['no_rekening'] ?></option>
								 			<?php } ?>
								 			
								 		</select>
								 	</div>
								 		<div class="form-group">
								 		Pilih File bukti pembayaran <br>
								 	<input type="file" name="berkas" required>
								 		
								 	</div>
								 	<input type="hidden" name="idtoko" value="<?php echo $idtoko ?>" readonly>
								 	<input type="hidden" name="tglp" value="<?php echo $tgldb ?>" readonly>
								 	<input type="hidden" name="waktup" value="<?php echo $waktudb ?>" readonly>
								 	<button class="btn btn-info btn-xs">Kirim Bukti Pembayaran</button>
								 	</form>
								 <?php }else{
								 	echo "Pembayaran di ACC<br>Pesanan anda sedang di proses oleh admin toko ".$d1['nama_toko'];
								 } ?>
								 </td>
							</tr>
						<?php }else{?>
							<tr>
								 <td colspan="6">
								 	<form action="<?php echo base_url() ?>user/user/user/upload_pembayaran" method="post" enctype="multipart/form-data">
								 		Upload bukti pembayaran <br>
								 	<div class="form-group">
								 		Pilih Rekening Tujuan <br>
								 		<select name="rek" class="form-control">
								 			<?php foreach ($rek as $r) { ?>
								 				<option value="<?php echo $r['id_rekening'] ?>"><?php echo $r['bank'] ?> - No Rekening : <?php echo $r['no_rekening'] ?></option>
								 			<?php } ?>
								 			
								 		</select>
								 	</div>
								 		<div class="form-group">
								 		Pilih File bukti pembayaran <br>
								 	<input type="file" name="berkas" required>
								 		
								 	</div>
								 	<input type="hidden" name="idtoko" value="<?php echo $idtoko ?>" readonly>
								 	<input type="hidden" name="tglp" value="<?php echo $tgldb ?>" readonly>
								 	<input type="hidden" name="waktup" value="<?php echo $waktudb ?>" readonly>
								 	<button class="btn btn-info btn-xs">Kirim Bukti Pembayaran</button>
								 	</form>
								 </td>
							</tr>
							<?php } } ?>
							<tr>
								<td colspan="8">
										
									<a href="#" class="btn btn-info btn-xs" style="pointer-events: none">Status Pesanan : <?php echo $d1['status_pesanan'] ?></a>
								<?php if ($d1['metode_bayar']=='Transfer') { ?>
									<?php if ($d1['status_pesanan']=='Diantarkan') { ?>
									<a href="<?php echo base_url() ?>/user/user/user/terima_barang/<?php echo $tgldb.'/'.$idtoko.'/'.$waktudb ?>" class="btn btn-info btn-xs">Sudah Menerima Barang Dari Toko <?php echo $d1['nama_toko'] ?></a>
									<?php } 
									if ($d1['status_pesanan']=='Order') { 
										 if ($dpembayaran['status']!='Acc') { ?>
									<a href="<?php echo base_url() ?>/user/user/user/batalkan_pesanan/<?php echo $tgldb.'/'.$idtoko.'/'.$waktudb ?>" class="btn btn-info btn-xs">Batalkan Pesanan Dari Toko <?php echo $d1['nama_toko'] ?></a>
								<?php } ?>
									<?php } ?>
									
								<?php }else{ ?>
									<!-- <a href="#" class="btn btn-default btn-xs">Print Bukti Pemesanan Di <?php echo $d1['nama_toko'] ?> </a> -->
									<?php if ($d1['status_pesanan']=='Diantarkan') { ?>
									<a href="<?php echo base_url() ?>/user/user/user/terima_barang/<?php echo $tgldb.'/'.$idtoko.'/'.$waktudb ?>" class="btn btn-info btn-xs">Sudah Menerima Barang Dari Toko <?php echo $d1['nama_toko'] ?></a>
									<?php } 
									if ($d1['status_pesanan']=='Order') { ?>
									<a href="<?php echo base_url() ?>/user/user/user/batalkan_pesanan/<?php echo $tgldb.'/'.$idtoko.'/'.$waktudb ?>" class="btn btn-info btn-xs">Batalkan Pesanan Dari Toko <?php echo $d1['nama_toko'] ?></a>
									<?php } ?>
								<?php } ?>
							</td>
								
							</tr>
						</table> 
					
				<?php 
				$bayar = $noll +=$totalharga;
			}
							if ($j1>0) { ?>
								<h4>Total Belanja Anda Adalah : Rp. <?php echo number_format($bayar) ?></h4><br>
								<!-- <a href="<?php echo base_url('user/user/user/konfirmasi_pesanan') ?>" class="btn btn-info">Konfirmasi Pesanan</a> -->
							<?php } else{
								echo "Keranjang Belanja Kosong"; }?>
								<?php echo $this->session->flashdata('pesan'); ?>
				
							
			
						<div class="clearfix"> </div>
					</div>
				</div>
			
			</div>

		