
			<div class="col-md-9" style="margin-top: -50px ">
			<?php echo $this->session->flashdata('pesan'); ?>
				<div class="content-bottom">
					<h3>Poin Anda</h3>
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
						<table class="table table-bordered">
							<tr>
								<td>No</td>
								
								<td>Belanja Dari toko</td>
								<td>Poin Masuk</td>
								<td>Poin  Keluar</td>
								<td>Sisa Poin</td>
								<td>Option</td>
								
							</tr>
					<?php
				
					$no=1;
					$nol=0;
					foreach($poinadd as $d1) { 
						$idpelanggan = $d1['id_pelanggan'];
						$idtoko = $d1['id_toko'];
						$add = $this->db->query("
			SELECT sum(b.poin) as poinmasuk from poin_pelanggan as a
			left join poin as b on a.id_poin = b.id_poin
			 where a.id_pelanggan='$idpelanggan'  and a.id_toko='$idtoko' and a.jenis='+'")->row_array() ;
						$poinmasuk = $add['poinmasuk'];


						$min = $this->db->query("
			SELECT sum(b.tukar_poin) as poinkeluar from poin_pelanggan as a
			left join barang as b on a.id_barang = b.id_barang
			 where a.id_pelanggan='$idpelanggan'  and a.id_toko='$idtoko' and a.jenis='-'")->row_array() ;
						$poinkeluar = $min['poinkeluar'];
						$sisapoin = $poinmasuk - $poinkeluar;
					 ?>

							<tr>
								<td><?php echo $no++ ?></td>
								
							
								 <td><?php echo $d1['nama_toko'] ?></td>
							
								 <td><?php echo $poinmasuk?></td>
								 <td><?php echo $poinkeluar?></td>
								 <td><?php echo $sisapoin?></td>
								 <td>
								 	<a href="<?php echo base_url() ?>user/user/user/detail_poin/<?php echo $d1['id_toko'] ?>/<?php echo $d1['nama_toko'] ?>" class="btn btn-info btn-xs">
								 	Lihat Detail
								 </a>
								 </td>
								
							</tr>
						
					<?php } ?>
					
				</table>



						
			
					</div>
				</div>
			
			</div>

		