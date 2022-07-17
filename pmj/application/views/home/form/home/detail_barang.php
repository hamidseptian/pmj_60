<?php 
// diskon
$diskon = $this->db->query("SELECT diskon from diskon where id_barang='$id' and status='Aktif' and mulai<=current_date() and selesai >=current_date()")->row_array();
$besardiskon = $diskon['diskon'];
 ?>

<div class="col-md-9">
	<?php echo $this->session->flashdata('pesan') ?>
			<div class="col-md-5 single-top">	
				<img class="etalage_thumb_image img-responsive" src="<?php echo base_url() ?>/file/barang/gambar/<?php echo $detail['gambar'] ?>" style="display: inline; width: 300px; opacity: 1;">
					

					</div>	
					<div class="col-md-7 single-top-in">
						<div class="single-para">
							<h4><?php echo $detail['nama_barang'] ?></h4>
							Kategori : <?php echo $detail['kategori'] ?>
							<div class="para-grid">
								<?php if ($besardiskon!='') { 
									$potongandiskon = $detail['harga_jual'] * ($besardiskon /100);
									$setelahdiskon = $detail['harga_jual'] - $potongandiskon?>
									<p class="add-to"><s>Rp. <?php echo $detail['harga_jual'] ?></s> <br>
									Diskon <?php echo $besardiskon ?>%</p>

											<span class="add-to">Rp. <?php echo $setelahdiskon ?></span>
									
								<?php }else{ ?>
									<span class="add-to">Rp. <?php echo $detail['harga_jual'] ?></span>
								<?php } ?>
								
								<a href="#" class=" cart-to"><?php echo $detail['nama_toko'] ?></a>					
								<div class="clearfix"></div>
							 </div>
							<h5> Stok Tersedia : <?php echo $detail['stok'] ?> <?php echo $detail['satuan_barang'] ?></h5>
							<div class="available">
								<?php 	
								if ($this->session->userdata('id_user')) { ?>
									<h6>Jumlah Pembelian</h6>
								<form method="post" action="<?php echo base_url('user/user/user/simpan_pesanan') ?>">
								<input type="hidden" name="idb" class="form-control" value="<?php echo $detail['id_barang'] ?>">
								<input type="hidden" name="idtoko" class="form-control" value="<?php echo $detail['id_toko'] ?>">
								<input type="hidden" name="stok" class="form-control" value="<?php echo $detail['stok'] ?>">
								<input type="hidden" name="diskon" class="form-control" value="<?php echo $besardiskon ?>">
								<input type="hidden" name="satuan" class="form-control" value="<?php echo $detail['satuan_barang'] ?>">
								<input type="text" name="qty" class="form-control" placeholder="masukan jumlah yang akan anda beli untuk produk ini"> 
								<input type="submit" value="Masukan Ke Keranjang">
								</form>
								<?php }
								else{
								 ?>
								
								<h6>Harap Login terlebih dahulu sebelum melakukan pembelian	</h6>
							<?php } ?>
								
								
						</div>
							
					
						</div>
					</div>
				<div class="clearfix"> </div>

	    
<!---->

<!---->
			</div>

			