<ul class="breadcrumb">
		
		<li class="active"> Checkout </li>
    </ul>

    <?php echo $this->session->flashdata('pesan') ?>

    <table class="table table-bordered">
		<tbody>
			<tr>
				<th>List Order</th>
			</tr>
		 <tr> 
		 <td>
			<table class="table table-bordered" border=1>
              <thead>
                <tr>
                  <th width="100px">Gambar</th>
                  <th>Nama Produk</th>
                  <th>Detail Order</th>
                 
				</tr>
              </thead>
              <tbody>
              	<?php 
                $total_harga = 0;
                foreach ($pesanan as $k => $v) {
              		if ($v['gambar']=='') {
						$gambar=base_url().'file/produk/default.png';
						# code...
					}else{
						$gambar=base_url().'file/produk/gambar/'.$v['gambar'];
					}
              	$id_pesanan = $v['id_order']; 
              	$q_topping =$this->db->query("SELECT tp.*, t.* from topping_pesanan tp left join topping t on tp.id_topping=t.id_topping where tp.id_order='$id_pesanan'");
              	$j_topping = $q_topping->num_rows();
              	$rowspan = $j_topping +1;

                $total_harga_jasa =$v['biaya'] * $v['qty'];
                $total_harga  += $total_harga_jasa ;
              	?>
              	<tr>
              		<td><img src="<?php echo $gambar ?>" width="100%"></td>
              		<td ><?php echo $v['nama_produk'] ?></td>
                  <td>
                    <table class="table">
                        <tr>
                           <th>Item</th>
                            <th width="30px">Banyak</th>
                            <th  width="50px">Harga</th>
                            <th  width="60px">Total</th>
                        </tr>
                        <tr>
                          <td>Penanganan</td>
                          <td><?php echo $v['qty'] ?></td>
                          <td><?php echo number_format($v['biaya']) ?></td>
                          <td><?php echo number_format($total_harga_jasa) ?></td>
                        </tr>
                        <?php foreach ($q_topping->result_array() as $k_t => $v_t) { 
                          $total_harga_topping  =$v_t['harga'] *$v_t['qty_topping'];
                          $total_harga  += $total_harga_topping ;
                          ?>
                  <tr>
                    <td><?php echo $v_t['nama_topping'] ?></td>
                    <td><?php echo $v_t['qty_topping'] ?></td>
                    <td><?php echo number_format($v_t['harga']) ?></td>
                    <td><?php echo number_format($total_harga_topping) ?></td>
                  </tr>
                <?php } ?>
                    </table>
                  </td>
               
              	</tr>
              
              	

              	<?php } ?>
			  </tbody>
              	
             
				
            </table>

  
            <table class="table table-bordered">
        <tbody>
        <tr class="techSpecRow">
          <th colspan="2">Konfirmasi Pemesanan</th>
        </tr>
        <tr class="techSpecRow">
          <td class="techSpecTD1">Total Pemesanan</td>
          <td class="techSpecTD2"><?php echo  number_format($total_harga)   ?></td>
        </tr>
        <tr class="techSpecRow">
          <td class="techSpecTD1">Tanggal Pengambilan</td>
          <td class="techSpecTD2"><?php echo $pengambilan ?>
          </td>
        </tr>
        <tr class="techSpecRow">
          <td class="techSpecTD1">Info Pembayaran</td>
          <td class="techSpecTD2">
                 Metode Pembayaran : <?php echo $pembayaran['metode_pembayaran'] ?><br>
                 No Rekening : <?php echo $pembayaran['no_rek'] ?><br>
                 Atas Nama : <?php echo $pembayaran['nama_rek'] ?>
          </td>
        </tr>
        <tr class="techSpecRow">
          <td class="techSpecTD1">Pengantaran</td>
          <td class="techSpecTD2">
            <?php echo $pengantaran['metode_pengantaran'] ?>
          </td>
        </tr>
        <tr class="techSpecRow">
          <td class="techSpecTD1">Ongkir</td>
          <td class="techSpecTD2">
                 <?php echo number_format($ongkir) ?>
          </td>
        </tr>
        <tr class="techSpecRow">
          <td class="techSpecTD1">Total</td>
          <td class="techSpecTD2">
                 <?php 
                 $total_semua = $total_harga + $ongkir;
                echo number_format($total_semua);
                echo '<br>Total yang harus di bayarkan ke Gelato Romance '.number_format($total_harga);
 ?>
          </td>
        </tr>
        <tr class="techSpecRow">
          <td class="techSpecTD1">Status</td>
          <td class="techSpecTD2">
              <?php echo $faktur['status']; ?>
          </td>
        </tr>
        <tr class="techSpecRow">
          <td class="techSpecTD1">Bukti Pembayaran</td>
          <td class="techSpecTD2">
              <?php 
              $bukti=base_url().'file/bukti_pembayaran/gambar/'.$faktur['bukti_pembayaran'];
              if ($faktur['status']=='Menunggu Pembayaran') { ?>
                <form action="<?php echo base_url('user/pelanggan/order/upload_bukti_pembayaran') ?>" method='post'  enctype="multipart/form-data">
                  
                Belum ada bukti pembayaran <br>Silahkan upload dulu
                <br>

                <input type="hidden" name="id_faktur" value="<?php echo $faktur['id_faktur'] ?>">
                <input type="file" name="berkas" required> <br>
                <button class="btn btn-info btn-xs">Upload</button>
                </form>
              <?php }
              else if ($faktur['status']=='Pembayaran Ditolak') { ?>
                <form action="<?php echo base_url('user/pelanggan/order/upload_bukti_pembayaran') ?>" method='post'  enctype="multipart/form-data">
                
                <img src="<?php echo $bukti ?>" width="300px"> <br>
                Bukti pembayaran ditolak  <br>Silahkan upload ulang
                <br>

                <input type="hidden" name="id_faktur" value="<?php echo $faktur['id_faktur'] ?>">
                <input type="file" name="berkas" required> <br>
                <button class="btn btn-info btn-xs">Upload</button>
                </form>
              <?php }else{ 
                ?>
            <img src="<?php echo $bukti ?>" width="300px">


              <?php } ?>
          </td>
        </tr>
        
       
        </tbody>
        </table>
        <?php if ($faktur['status']=='Diantarkan') { ?>
                <a href="<?php echo base_url() ?>user/admin/pesanan/update_faktur?id_faktur=<?php echo $faktur['id_faktur'] ?>&status=Diterima&redirect=semua" class="btn btn-info btn-xs">Sudah menerima pesanan</a>
        <?php } ?>
                <a href="<?php echo base_url() ?>user/pelanggan/order" class="btn btn-info btn-xs">Kembali</a>
        
          















            
		  </td>
		  </tr>
	</tbody>
</table>

