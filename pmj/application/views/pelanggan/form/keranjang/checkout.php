<ul class="breadcrumb">
		
		<li class="active"> Checkout </li>
    </ul>

    <?php echo $this->session->flashdata('pesan') ?>
<?php 

if ($j_pesanan==0) { ?>
	<ul class="breadcrumb">
		
		<li ><b><h4>Keranjang Kosong</h4></b> </li>
    </ul>
<?php }else{
	
 ?>
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
						$gambar=base_url().'file/produk/gambar/'.$v['gambar'];;
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

<form action="<?php echo base_url() ?>user/pelanggan/keranjang/konfirmasi" method="post">
  
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
            <input type="hidden" name="pengambilan" value="<?php echo $pengambilan ?>">
            <input type="hidden" name="pembayaran" value="<?php echo $pembayaran['id_pembayaran'] ?>">
            <input type="hidden" name="pengantaran" value="<?php echo $pengantaran['id_pengantaran'] ?>">
            <input type="hidden" name="ogkir" value="<?php echo $ongkir ?>">
            <input type="hidden" name="total" value="<?php echo $total_harga ?>">
            <input type="hidden" name="id_faktur" value="<?php echo $id_faktur ?>">
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
       
        </tbody>
        </table>

        <button class="btn btn-info btn-sm" onclick="return confirm('Konfirmasi Pesanan..??')">Konfirmasi Pesanan</button>
</form>

          















            
		  </td>
		  </tr>
	</tbody>
</table>


    
<?php } ?>