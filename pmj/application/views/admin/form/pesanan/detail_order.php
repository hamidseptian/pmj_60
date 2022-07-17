 <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Detail Order</h3>
          <div class="pull-right">
           <!--  <a href="<?php echo base_url('user/admin/produk/tambah') ?>" class="btn btn-info">Tambah Produk</a> -->
          </div>
        </div>
        <div class="box-body">
          <div class="col-md-6">
            <div class="box-header with-border">
          <h3 class="box-title">Produk</h3>
         
        </div>
            <table class="table table-bordered" border=1>
              <thead>
                <tr>
                  <th>Nama Produk</th>
                  <th>Detail Order</th>
                  <th width="100px">Gambar</th>
                 
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
                  
                  <td><img src="<?php echo $gambar ?>" width="100%"></td>
               
                </tr>
              
                

                <?php } ?>
        </tbody>
                
             
        
            </table>
          </div>
          <div class="col-md-6">
             <div class="box-header with-border">
          <h3 class="box-title">Keterangan Faktur</h3>
         
        </div>
              <table class="table table-bordered">
        <tbody>
       
        <tr class="techSpecRow">
          <td class="techSpecTD1">Pelanggan</td>
          <td class="techSpecTD2"><?php echo $faktur['nama_pelanggan'];  ?></td>
        </tr>
        <tr class="techSpecRow">
          <td class="techSpecTD1">Alamat</td>
          <td class="techSpecTD2"><?php echo $faktur['alamat_pelanggan'];  ?></td>
        </tr>
        <tr class="techSpecRow">
          <td class="techSpecTD1">No HP </td>
          <td class="techSpecTD2"><?php echo $faktur['nohp_pelanggan'];  ?></td>
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
          <td class="techSpecTD1">Bukti Pembayaran</td>
          <td class="techSpecTD2">
              <?php if ($faktur['bukti_pembayaran']=='') { ?>
               
                Belum ada bukti pembayaran 

              <?php }else{ 
                $bukti=base_url().'file/bukti_pembayaran/gambar/'.$faktur['bukti_pembayaran'];?>
                <img src="<?php echo $bukti ?>" width="300px">


              <?php } ?>
          </td>
        </tr>
        <tr class="techSpecRow">
          <td class="techSpecTD1">Status</td>
          <td class="techSpecTD2">
              <?php echo $faktur['status']; ?> <br>
              <?php if ($faktur['status']=='Cek Pembayaran') { ?>
              <a href="<?php echo base_url() ?>user/admin/pesanan/update_faktur?id_faktur=<?php echo $faktur['id_faktur'] ?>&status=Pembayaran Ditolak&redirect=semua" class="btn btn-info btn-xs" onclick="return confirm('Tolak Pesanan?')">Tolak</a>
              <a href="<?php echo base_url() ?>user/admin/pesanan/update_faktur?id_faktur=<?php echo $faktur['id_faktur'] ?>&status=Diproses&redirect=semua" class="btn btn-info btn-xs" onclick="return confirm('Proses Pesanan?')">Proses</a>
              <?php }
              else if ($faktur['status']=='Diproses') {  ?>
              <a href="<?php echo base_url() ?>user/admin/pesanan/update_faktur?id_faktur=<?php echo $faktur['id_faktur'] ?>&status=Diantarkan&redirect=semua" class="btn btn-info btn-xs" onclick="return confirm('Antarkan Pesanan.?')">Antarkan</a>
              <?php } 
              else if ($faktur['status']=='Diantarkan') {  ?>
              <a href="<?php echo base_url() ?>user/admin/pesanan/update_faktur?id_faktur=<?php echo $faktur['id_faktur'] ?>&status=Diterima&redirect=semua" class="btn btn-info btn-xs" onclick="return confirm('Apakah pesanan sudah diterima pelanggan?')">Diterima Pelanggan</a>
              <?php }else{ ?>
              <?php } ?>
              <a href="<?php echo base_url() ?>user/admin/pesanan/print_faktur?id_faktur=<?php echo $faktur['id_faktur'] ?>" class="btn btn-info btn-xs" target="_blank">Print Faktur</a>
              <a href="<?php echo base_url() ?>user/admin/pesanan/order/semua/" class="btn btn-info btn-xs">Kembali</a>
          </td>
        </tr>
        
       
        </tbody>
        </table>
          </div>


            <hr>

          
        </div>


      </div>
    </div>
  </div>


















