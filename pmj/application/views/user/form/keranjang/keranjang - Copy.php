
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
					$no=1;
					$nol=0;
					foreach($keranjang as $d1) {
						$idmember=$d1['id_member'];
						$idtoko=$d1['id_toko'];
						$itemdetail = $this->db->query("SELECT * from pesanan 
						join member on member.id_member = pesanan.id_member
						join barang on barang.id_barang = pesanan.id_barang 
						join toko on barang.id_toko=toko.id_toko
						where pesanan.id_member = '$idmember' and status_pesanan = 'Order' and barang.id_toko='$idtoko'")->result_array() ;
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
								<td><?php echo $d2['harga_jual'] ?></td>
								<td>
									<?php 
									$total = $d2['qty'] * $d2['harga_jual'] ;
									echo $total;
									$totalharga = $nol+=$total;
									?>
										
								</td>
								
							</tr>
							<?php } ?>
						<!-- 
							 <tr>
								<td align="right" colspan="5">Total</td>
								<td><?php echo $totalharga ?></td>
							</tr> -->
						</table> 
					

					<?php } ?>
							
						
						<div class="clearfix"> </div>
					</div>
				</div>
			
			</div>

		