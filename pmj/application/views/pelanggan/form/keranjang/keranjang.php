<ul class="breadcrumb">
		
		<li class="active"> Keranjang </li>
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
                  <th>Option</th>
                 
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
              	$id_order = $v['id_order']; 
                $id_faktur = $v['id_faktur']; 
              	$q_topping =$this->db->query("SELECT * from topping_pesanan tp left join topping t on tp.id_topping=t.id_topping where tp.id_order='$id_order'");
              	$j_topping = $q_topping->num_rows();
              	$rowspan = $j_topping +1;

                $total_harga_jasa =$v['biaya'] * $v['qty'];
                $total_harga  += $total_harga_jasa ;
              	?>
              	<tr>
              		<td><img src="<?php echo $gambar ?>" width="100%"></td>
              		<td ><?php echo $v['nama_produk'] ?> <br><?php echo $v['wrapping'] ?></td>
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
                          <td><?php echo $v['biaya'] ?></td>
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
                  <td>
                    <a href="<?php echo base_url() ?>user/pelanggan/keranjang/edit/<?php echo $v['id_produk'].'/'.$v['id_order'] ?>" class="btn btn-default btn-xs">Edit</a>
                    <a href="<?php echo base_url() ?>user/pelanggan/keranjang/hapus/<?php echo $v['id_order'].'/'.$v['id_produk'] ?>" class="btn btn-info btn-xs" onclick="return confirm('Hapus produk dari keranjang.?')">Hapus</a>
                  </td>
              	</tr>
              
              	

              	<?php } ?>
			  </tbody>
              	
             
				
            </table>

<form action="<?php echo base_url() ?>user/pelanggan/keranjang/checkout" method="post">
  <input type="hidden" name="id_faktur" value="<?php echo $id_faktur ?>" required>
  
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
          <td class="techSpecTD2"><input type="date" name="pengambilan" class="form-control" required></td>
        </tr>
        <tr class="techSpecRow">
          <td class="techSpecTD1">Metode Pembayaran</td>
          <td class="techSpecTD2">
            <table class="table table-bordered">
              <tr>
                <td>Pilih</td>
                <td>Nama Bank</td>
                <td>No Rekening</td>
                <td>Nama Rekening</td>
              </tr>
              <?php foreach ($rekening as $k => $v) { ?>
               <tr>
                 <td><input type="radio" name="pembayaran" value="<?php echo $v['id_pembayaran'] ?>" required></td>
                 <td><?php echo $v['metode_pembayaran'] ?></td>
                 <td><?php echo $v['no_rek'] ?></td>
                 <td><?php echo $v['nama_rek'] ?></td>
                 
               </tr>
              <?php } ?>
            </table>
          </td>
        </tr>
        <tr class="techSpecRow">
          <td class="techSpecTD1">Metode Pengantaran</td>
          <td class="techSpecTD2">
            <select class="form-control" name="pengantaran">
              <?php foreach ($pengantaran as $k => $v) { ?>
                <option value="<?php echo $v['id_pengantaran'] ?>"><?php echo $v['metode_pengantaran'] ?></option>
              <?php } ?>
            </select>
          </td>
        </tr>
        <tr class="techSpecRow">
          <td class="techSpecTD1">Ongkir (cek menual)</td>
          <td class="techSpecTD2">
            <input type="number" name="ongkir" class="form-control" required>
            <br>Untuk ongkir diluar aplikasi ini dan bisa dilihat pada aplikasi expedisi (Gojek, Grab, Dll) <br>Pesanan akan di proses setelah melakukan pembayaran
          </td>
        </tr>
        <tr class="techSpecRow" style="display:none">
          <td class="techSpecTD1">Info Pembayaran</td>
          <td class="techSpecTD2">
            Pembayaran dilakukan pada Bank Berikut <br>
            <table class="table table-bordered">
              <tr>
                <td>Kode Bank</td>
                <td>Nama Bank</td>
                <td>No Rekening</td>
                <td>Nama Rekening</td>
              </tr>
              <?php foreach ($rekening as $k => $v) { ?>
               <tr>
                 <td><?php echo $v['kode_bank'] ?></td>
                 <td><?php echo $v['nama_bank'] ?></td>
                 <td><?php echo $v['no_rekening'] ?></td>
                 <td><?php echo $v['nama_rekening'] ?></td>
                 
               </tr>
              <?php } ?>
            </table>
          </td>
        </tr>
       
        </tbody>
        </table>

        <button class="btn btn-info btn-sm" >Checkout</button>
</form>

          















            
		  </td>
		  </tr>
	</tbody>
</table>


    
<?php } ?>