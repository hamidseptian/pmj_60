
			<div class="col-md-9" style="margin-top: -50px ">
				<div class="content-bottom">
					<h3>Riwayat Belanjaan Anda</h3>
			<?php echo $this->session->flashdata('pesan'); ?>
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

						<table class="table">
							<tr>
								<td>No</td>
								<td>Tanggal Transaksi</td>
								<td>Waktu Pesan</td>
								<td>Pembayaran</td>
								<td>Status Pesanan</td>
							
								<td>Option</td>
							</tr>
					<?php
				
					$no=1;
					foreach($data as $d1) { ?>

							<tr>
								<td><?php echo $no++ ?></td>
								
								<td>
									<?php $pt=explode('-', $d1['tanggal_pesan']);
									echo $pt[2].'-'.$pt[1].'-'.$pt[0];
								 	?>
								 	
								 </td>
								 <td><?php echo $d1['waktu_pesan'] ?></td>
								 <td><?php echo $d1['metode_bayar'] ?></td>
								 <td><?php echo $d1['status_pesanan'] ?></td>
								<td>
									<a href="<?php echo base_url('user/user/user/detail_pesanan/'.$d1['tanggal_pesan'].'/'.$d1['waktu_pesan']) ?>" class="btn btn-info btn-xs">Lihat Data Pesanan</a>
								</td>
							</tr>
						
					<?php } ?>
				</table>
			
						<div class="clearfix"> </div>
					</div>
				</div>
			
			</div>

		