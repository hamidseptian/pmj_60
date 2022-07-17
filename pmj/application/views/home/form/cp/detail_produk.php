

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
				<h4><?php echo $produk['ukuran'] ?></h4>
				<hr class="soft">
				<?php echo $this->session->flashdata('pesan') ?> 
				<form class="form-horizontal qtyFrm" action="<?php echo base_url() ?>user/pelanggan/order/simpan_ke_keranjang" method="post">
				  <div class="control-group">
					 <?php if (!$this->session->userdata('level')=='pelanggan') { ?>
					 	<table class="table">
							<tr>
								<td>Biaya Pembuatan</td>
								<td>:</td>
								<td><?php echo number_format($produk['biaya']) ?></td>
							</tr>
							<tr>
								<td>Ukuran Produk</td>
								<td>:</td>
								<td><?php echo $produk['ukuran'] ?></td>
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
							<td>Ukuran Produk</td>
							<td>:</td>
							<td><?php echo $produk['ukuran'] ?></td>
						</tr>
						<tr>
							<td>Jumlah Pesanan</td>
							<td>:</td>
							<td>
								<input type="number" name="qty" class="form-control span1" required>
								<input type="hidden" name="maksimal_topping" class="form-control span1" value="<?php echo $produk['banyak_topping'] ?>">
								<input type="hidden" name="id_ukuran" class="form-control span1" value="<?php echo $produk['id_ukuran'] ?>">
								<input type="hidden" name="id_produk" class="form-control span1" value="<?php echo $produk['id_produk'] ?>">
							</td>
						</tr>
						<tr>
							<td>Warna Wrapping</td>
							<td>:</td>
							<td>
								<select name="warna" class="form-control">
									<?php 	foreach ($warna as $k => $v) { ?>
										<option value="<?php echo $v['id_warna'] ?>"><?php echo $v['warna'] ?></option>
									<?php } ?>
								</select>
							</td>
						</tr>
						<tr>
							<td>Pilihan Topping <br>Maksimal Topping : <?php echo $produk['banyak_topping'] ?></td>
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
																				?>
									<tr>
										<td><?php echo $v['nama_topping'] ?></td>	
										<td><?php echo number_format($v['harga']) ?></td>	
										<td><?php echo number_format($v['stok']) ?></td>	
										<td>
											<input type="hidden" name="id_topping[]" class="span1" value="<?php echo $id_topping ?>">
											<input type="number" name="qty_topping[]" class="span1">
										</td>	
									</tr>
									<?php } ?>
								</table>
							</td>
						</tr>
					</table>
					  <button type="submit" class="btn btn-sm btn-primary pull-right"> Tambah ke keranjang </button>
					<?php } ?>
					
					
				  </div>
				  <div class="control-group">
					<input type="hidden" class="span1" placeholder="Qty." name="id_produk" value="<?php echo $produk['id_produk'] ?>">
					
				  </div>
				</form>
				
	
			<hr class="soft">
			</div>
			
			

	</div>