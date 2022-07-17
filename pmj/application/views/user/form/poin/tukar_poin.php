<div class="col-md-9">
	<?php echo $this->session->flashdata('pesan') ?>
			<div class="col-md-5 single-top">	
				<img class="etalage_thumb_image img-responsive" src="<?php echo base_url() ?>/file/barang/gambar/<?php echo $detail['gambar'] ?>" style="display: inline; width: 300px; opacity: 1;">
					

					</div>	
					<div class="col-md-7 single-top-in">
						<div class="single-para">
							<h4>Tukar Poin dengan </h4>
							<h4><?php echo $detail['nama_barang'] ?></h4>
							Kategori : <?php echo $detail['kategori'] ?>
							<div class="para-grid">
								<span class="add-to">Tukarkan <?php echo $detail['tukar_poin'] ?> Poin</span>
								<a href="#" class=" cart-to"><?php echo $detail['nama_toko'] ?></a>					
								<div class="clearfix"></div>
							 </div>
							<h5> Stok Tersedia : <?php echo $detail['stok'] ?> <?php echo $detail['satuan_barang'] ?></h5>
							<div class="available">
								<?php 	
								if ($this->session->userdata('id_user')) { ?>
									
								<form method="post" action="<?php echo base_url('user/user/user/simpan_penukaran') ?>">
								<input type="hidden" name="idb" class="form-control" value="<?php echo $detail['id_barang'] ?>">
								<input type="hidden" name="idt" class="form-control" value="<?php echo $detail['id_toko'] ?>">
						
								<?php if ($detail['stok']>0) {
									echo '<input type="submit" value="Tukarkan">';
								}else{
									echo "Maaf, Poin anda tidak bisa ditukarkan dengan produk ini<br>Stok barang ini habis";
								} ?>
								
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

			