

<?php 

if ($produk['gambar']=='') {
	$gambar=base_url().'file/produk/default.png';
	# code...
}else{
	$gambar=base_url().'file/produk/gambar/'.$produk['gambar'];;
}
 ?>
<div class="row">	 

			<div id="gallery" class="span3">
            <a href="themes/images/products/large/f1.jpg" title="Fujifilm FinePix S2950 Digital Camera">
				<img  src="<?php echo $gambar ?>" style="width:100%" alt="<?php echo $produk['nama_produk'] ?>">
            </a>
			</div>
			<div class="span6">
				<h3><?php echo $produk['nama_produk'] ?></h3>
				<hr class="soft">
				<?php echo $this->session->flashdata('pesan') ?> 
				<form class="form-horizontal qtyFrm" action="<?php echo base_url() ?>user/pelanggan/order/simpanedit_ke_keranjang" method="post">
				  <div class="control-group">
					 <?php if (!$this->session->userdata('level')=='pelanggan') { ?>
					 	<table class="table">
							<tr>
								<td>Biaya Pembuatan</td>
								<td>:</td>
								<td><?php echo number_format($produk['biaya']) ?></td>
							</tr>
						
						</table>
						Silahkan login dulu agar bisa memesan produk
					<?php }else{ ?>
						<table class="table">
						<tr>
							<td>Biaya Pembuatan</td>
							<td>:</td>
							<td><?php echo number_format($produk['biaya']) ?></td>
						</tr>
						
						<tr>
							<td>Jumlah Pesanan</td>
							<td>:</td>
							<td>
								<input type="number" name="qty" class="form-control span1" required value="<?php echo $pesanan['qty'] ?>">
								<input type="hidden" name="maksimal_topping" class="form-control span1" value="<?php echo $produk['maksimal_topping'] ?>">

								<input type="hidden" name="wrapping_dibutuhkan" class="form-control span1" value="<?php echo $produk['wrapping_dibutuhkan'] ?>">
								<input type="hidden" name="id_produk" class="form-control span1" value="<?php echo $produk['id_produk'] ?>">
								<input type="hidden" name="id_order" class="form-control span1" value="<?php echo $id_order ?>">
								<input type="hidden" name="id_faktur" class="form-control span1" value="<?php echo $id_faktur ?>">
							</td>
						</tr>
						<tr>
							<td>Stok Wrapping</td>
							<td>:</td>
							<td>
									<?php 
									if (count($wrapping)>0) { 
										foreach ($wrapping as $k => $v) { 
										@$stok_wrapping = $v['stok'] / $produk['wrapping_dibutuhkan'];

										?>
										<input type="radio" name="id_wrapping" value="<?php echo $v['id_wrapping'] ?>" required <?php if($v['id_wrapping']==$pesanan['id_wrapping']){echo "checked";} ?>><span style="margin-left :10px"> <?php echo $v['wrapping'] ?> [ Stok : <?php echo intval($stok_wrapping) ?>]</span> <br>
									<?php }
									}else{
										echo "Stok Kosong";
									} ?>
								
							</td>
						</tr>
						<?php if ($maksimal_topping>0) {  ?>
						<tr>
							<td>Pilihan Topping <br>Maksimal Topping : <?php echo $produk['maksimal_topping'] ?></td>
							<td>:</td>
							<td>
								<table class="table">
									<tr>
										<td>Topping</td>	
										<td>Harga</td>	
										<td>Stok Tersedia</td>	
										<td>Jumlah</td>	
									</tr>
									<?php foreach ($topping as $k => $v) { 
										$id_topping = $v['id_topping'];
										$topping_pesanan = $this->db->query("SELECT * from topping_pesanan where id_order='$id_order' and id_topping='$id_topping'")->row_array();
																				?>
									<tr>
										<td><?php echo $v['nama_topping'] ?></td>	
										<td><?php echo number_format($v['harga']) ?></td>	
										<td><?php echo number_format($v['stok']) ?></td>	
										<td>
											<input type="hidden" name="id_topping[]" class="span1" value="<?php echo $id_topping ?>">
											<input type="number" name="qty_topping[]" class="span1" value="<?php echo $topping_pesanan['qty_topping'] ?>">
										</td>	
									</tr>
									<?php } ?>
								</table>
							</td>
						</tr>
					<?php } ?>
					</table>
					<?php if (count($wrapping)>0) {  ?>
					  <button type="submit" class="btn btn-sm btn-primary pull-right"> Tambah ke keranjang </button>
					<?php 
					}else{ ?>

					  <button type="button" class="btn btn-sm btn-primary pull-right" onclick="return confirm('Tidak bisa memesan karena stok kosong')"> Tambah ke keranjang </button>
					<?php }
				} ?>
					
					
				  </div>
				  <div class="control-group">
					<input type="hidden" class="span1" placeholder="Qty." name="id_produk" value="<?php echo $produk['id_produk'] ?>">
					
				  </div>
				</form>
				
	
			<hr class="soft">
			</div>
			
			

	</div>