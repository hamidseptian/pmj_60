
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
									echo "Rp. ".number_format($total);
									$totalharga = $kosong+=$total;
									?>
										
								</td>
								
								
							</tr>
							<?php } ?>
						
							 <tr>
								<td align="right" colspan="4">Total Belanja</td>
								<td colspan="2">Rp. <?php echo $totalharga ?></td>
							</tr>
							<tr>
								<td align="right" colspan="4">Ongkir</td>
								<td colspan="2">Rp. <?php echo number_format($dongkir) ?></td>
							</tr>
							<tr>
								<td align="right" colspan="4">Total Belanja di <?php echo $d1['nama_toko'] ?> </td>
								<td colspan="2">Rp. <?php  echo number_format($totalharga + $dongkir)?></td>
							</tr>
							<tr>
								<td colspan="6">
									<a href="#" class="btn btn-info btn-xs" style="pointer-events: none">Status Pesanan : <?php echo $d1['status_pesanan'] ?></a>
									<a href="#" class="btn btn-default btn-xs">Print Bukti Pemesanan Di <?php echo $d1['nama_toko'] ?> </a>
									<?php if ($d1['status_pesanan']=='Diantarkan') { ?>
									<a href="<?php echo base_url() ?>/user/user/user/terima_barang/<?php echo $tgldb.'/'.$idtoko.'/'.$waktudb ?>" class="btn btn-info btn-xs">Sudah Menerima Barang Dari Toko <?php echo $d1['nama_toko'] ?></a>
									<?php } 
									if ($d1['status_pesanan']=='Order') { ?>
									<a href="<?php echo base_url() ?>/user/user/user/batalkan_pesanan/<?php echo $tgldb.'/'.$idtoko.'/'.$waktudb ?>" class="btn btn-info btn-xs">Batalkan Pesanan Dari Toko <?php echo $d1['nama_toko'] ?></a>
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

		