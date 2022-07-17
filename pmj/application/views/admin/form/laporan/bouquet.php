 <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Laporan Penjualan Bouquet <br><?php echo $periode_penjualan ?></h3>
          <div class="pull-right">
            <a href="<?php echo base_url('user/admin/laporan/print_laporan_penjualan') ?>" class="btn btn-info">Print</a>
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
                  <th>Nama Pelanggan</th>
                  <th>Alamat</th>
                  <th>Produk</th>
                  <th>Qty</th>
                  <th>Biaya</th>
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
        <td><?php echo $v['nama_pelanggan'] ?></td>
        <td><?php echo $v['alamat_pelanggan'] ?></td>
        <td><?php echo $v['nohp_pelanggan'] ?></td>
        <td><?php echo $v['qty'] ?></td>
        <td><?php echo number_format($v['biaya']) ?></td>
        <td><?php echo $v['qty']*$v['biaya']; ?></td>
    
      </tr>
      <?php } ?>
    </tbody>
            
          </table>
          
          
        </div>


      </div>
    </div>
  </div>


















