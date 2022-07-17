
			<div class="col-md-9" style="margin-top: -50px ">
			<?php echo $this->session->flashdata('pesan'); ?>
				<div class="content-bottom">
					<h3>Barang Dati toko <?php echo $toko['nama_toko'] ?></h3>
					<div class="bottom-grid">
					<?php foreach($barang as $d1) {?>
						<div class="col-md-4 shirt" style="margin-bottom: 25px">
							<div class="bottom-grid-top">
								<a href="<?php echo base_url() ?>homepage/detail_barang/<?php echo $d1['id_barang'] ?>"><img src="<?php echo base_url() ?>/file/barang/gambar/<?php echo $d1['gambar'] ?>" style="width:100%; height: 150px">
								
								<div class="pre">
									<p><?php echo $d1['nama_barang'] ?></p> <br>
									<span style="float: left;">Rp. <?php echo $d1['harga_jual'] ?></span>
									<div class="clearfix"> </div>
								</div></a>
								
								
							</div>
						</div>
					<?php } ?>
						
						<div class="clearfix"> </div>
					</div>
				</div>
			
			</div>

		