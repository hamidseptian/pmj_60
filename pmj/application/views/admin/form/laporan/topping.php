 <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Laporan Penjualan Topping <br><?php echo $periode_penjualan ?></h3>
          <div class="pull-right">
            <a href="<?php echo base_url('user/admin/laporan/print_laporan_topping') ?>" class="btn btn-info">Print</a>
          </div>
        </div>
        <div class="box-body">
         <table class="table table-striped table-bordered" id="tabel1">
            <thead>
                <tr>
                  <th>No</th>
                  <th>No Faktur</th>
                  <th>Tanggal Pesan</th>
                  <th>Tanggal Pengambilan</th>
                 
                  <th>Produk</th>
                  <th>Topping</th>
                  <th>Qty</th>
                  <th>Harga</th>
                  <th>Total</th>
                </tr>
            </thead>
            
             <tbody>
      <?php  
      $no=1;
      foreach ($faktur as $k => $v) { ?>
      <tr>
        <td><?php echo $no++ ?></td>
        <td><?php echo $v['no_faktur'] ?></td>
        <td><?php echo $v['tanggal_pemesanan'] ?></td>
        <td><?php echo $v['tgl_pengambilan'] ?></td>
        <td><?php echo $v['nama_produk'] ?></td>
        <td><?php echo $v['nama_topping'] ?></td>
        <td><?php echo $v['qty_topping'] ?></td>
        <td><?php echo $v['harga'] ?></td>
        <td><?php echo $v['qty_topping']*$v['harga']; ?></td>
    
      </tr>
      <?php } ?>
    </tbody>
            
          </table>
          
          
        </div>


      </div>
    </div>
  </div>


















