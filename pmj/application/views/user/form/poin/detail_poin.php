
			<div class="col-md-9" style="margin-top: -50px ">
			<?php echo $this->session->flashdata('pesan'); ?>
				<div class="content-bottom">
					<h3>Poin Anda dari  <?php echo $toko['nama_toko'] ?></h3>
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
							<h4>Poin Masuk</h4>
						<table class="table table-bordered">
							<tr>
								<td>No</td>
								<td>Tanggal Transaksi</td>
								
								<td>Syarat transaksi</td>
								<td>Jumlah Transaksi</td>
								<td>Jumlah Poin</td>
								
							</tr>
					<?php
				
					$no=1;
					$nol=0;
					$totpoinmin=0;
					foreach($poinadd as $d1) { 
					$totpoinadd = $nol+=$d1['poin']; ?>

							<tr>
								<td><?php echo $no++ ?></td>
								
								<td>
									<?php $pt=explode('-', $d1['tanggal']);
									echo $pt[2].'-'.$pt[1].'-'.$pt[0];
								 	?>
								 	
								 </td>
								
								 <td><?php echo $d1['syarat'] ?></td>
								 <td><?php echo $d1['jumlah_transaksi'] ?></td>
								 <td><?php echo $d1['poin'] ?></td>
								
							</tr>
						
					<?php } ?>
					<tr>	
						<td colspan="4">Total Poin Didapatkan</td>
						<td><?php echo $totpoinadd ?>	</td>
					</tr>
				</table>



							<h4>Poin Keluar</h4>
						<table class="table table-bordered">
							<tr>
								<td>No</td>
								<td>Tanggal Transaksi</td>
								<td>Ditukar dengan barang</td>
								<td>Syarat Penukaran</td>
								<td>Status Penukaran</td>
								<td>Option</td>
								
								
								
							</tr>
					<?php
				
					$no=1;
					$nol2=0;
					foreach($poinmin as $d1) { 
						if ($d1['status_penukaran']=='Penukaran Ditolak Toko') {
							$poinnya = 0;
						
						}else{
							$poinnya = $d1['tukar_poin'];
						}
					$totpoinmin = $nol2+=$poinnya; ?>

							<tr>
								<td><?php echo $no++ ?></td>
								
								<td>
									<?php 
									    @$pw = explode(' ', $d1['tanggal']);
       @ $pt = explode('-', $pw[0]);
          @$waktu = $pt[2].'-'.$pt[1].'-'.$pt[0].'<br>'.$pw[1];
          echo $waktu;
								 	?>
								 	
								 </td>
								 <td><?php echo $d1['nama_barang'] ?></td>
								 <td><?php echo $d1['tukar_poin'] ?></td>
								 <td><?php echo $d1['status_penukaran'] ?></td>
								 <td>
								 	<?php if ($d1['status_penukaran']=='Menunggu Persetujuan Toko'): ?>
								 		
								 	<a href="<?php echo base_url() ?>user/user/user/batal_tukar/<?php echo $d1['id_poin_plg'] ?>/<?php echo $toko['id_toko'] ?>">Batalkan</a>
								 	<?php elseif ($d1['status_penukaran']=='Penukaran Ditolak Toko'): ?>
								 	<a href="<?php echo base_url() ?>user/user/user/batal_tukar/<?php echo $d1['id_poin_plg'] ?>/<?php echo $toko['id_toko'] ?>">Hapus</a>

								 	<?php elseif ($d1['status_penukaran']=='Penukaran Disetujui'): ?>
								 	<a href="<?php echo base_url() ?>user/user/user/penukaran_selesai/<?php echo $d1['id_poin_plg'] ?>/<?php echo $toko['id_toko'] ?>" onclick="return confirm('Apakah anda sudah menerima barang <?php echo $d1['nama_barang'] ?>.?')">Barang sudah diterima</a>
								 	<?php endif ?>
								 </td>
								
								
							</tr>
						
					<?php } ?>
					<tr>	
						<td colspan="3">Total Poin Ditukarkan</td>
						<td colspan="2"><?php echo $totpoinmin ?>	</td>
					</tr>
				</table>
				<br>
				<h4>Sisa Poin Anda : <?php echo $sisapoin= $totpoinadd - $totpoinmin ?></h4>
						<div class="clearfix"> </div>
						<?php if ($sisapoin>0) { ?>
							
						
						<hr>
						<h4>Tukarkan poin anda</h4>
							<?php 
							$barang = $this->db->query("SELECT * from barang join toko on toko.id_toko = barang.id_toko where toko.status_toko='Mitra' and barang.tukar_poin<='$sisapoin'")->result_array();


							foreach($barang as $d1) {?>
						<div class="col-md-4 shirt" style="margin-bottom: 25px">
							<div class="bottom-grid-top">
								<a href="<?php echo base_url() ?>user/user/user/tukar_poin/<?php echo $d1['id_barang'] ?>"><img src="<?php echo base_url() ?>/file/barang/gambar/<?php echo $d1['gambar'] ?>" style="width:100%; height: 150px">
								
								<div class="pre">
									<p><?php echo $d1['nama_barang'] ?></p> <br>
									<span style="float: left;"><?php echo $d1['tukar_poin'] ?> poin</span>
									<div class="clearfix"> </div>
								</div></a>
								
								
							</div>
						</div>
					<?php } 
				}?>
					</div>
				</div>
			
			</div>

		