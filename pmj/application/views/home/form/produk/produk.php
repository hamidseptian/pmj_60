<div class="tab-content">
	

	<div class="tab-pane  active" id="blockView">
		<h4>Produk
		<?php echo $caption_cari ?> </h4>
		<ul class="thumbnails">
			<?php 	
			$id_pelanggan = $this->session->userdata('id_user');
			
			foreach ($produk as  $d) {
				if ($d['gambar']=='') {
					$gambar=base_url().'file/produk/default.png';
					# code...
				}else{
					$gambar=base_url().'file/produk/gambar/'.$d['gambar'];;
				}
				$id_produk=$d['id_produk'];

				$q_pesanan = $this->db->query("SELECT fr.* from faktur_rinci fr
					left join faktur f on fr.id_faktur = f.id_faktur
				 where fr.id_produk='$id_produk' and f.id_pelanggan='$id_pelanggan' and f.status='Masuk Ke Keranjang'");
				$j_pesanan = $q_pesanan->num_rows();
				$d_pesanan = $q_pesanan->row_array();
				// if ($j_pesanan>0) {
				// 	$id_pesanan = $d_pesanan['id_pesanan'];
				// 	$link = base_url().'user/pelanggan/keranjang/edit/'.$d['id_produk'].'/'.$id_pesanan ;
				// }else{
					$link = base_url().'homepage/detail_produk/'.$d['id_produk'] ;
				// }
			 ?>
			<li class="span3">
			  <div class="thumbnail" >
				<a href="product_details.html"><img src="<?php echo $gambar ?>" style="height: 100px; margin-top:10px"></a>
				<div class="caption">
				  <h5><?php echo $d['nama_produk'] ?></h5>
				 
				  <h4 style="text-align:center"><a class="btn" href="<?php echo $link ?>" title="Lihat detail Produk" data-toggle="tooltip"> <i class="icon-zoom-in"></i></a> <a class="btn btn-primary" href="#" >Rp. <?php echo number_format($d['biaya']) ?></a></h4>
				</div>
			  </div>
			</li>
		<?php 	} ?>
			
		  </ul>


	<hr class="soft">
	</div>
</div>