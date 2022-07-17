 <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Data Produk</h3>
          <div class="pull-right">
           <!--  <a href="<?php echo base_url('user/admin/produk/tambah') ?>" class="btn btn-info">Tambah Produk</a> -->
          </div>
        </div>
        <div class="box-body">
          <?php echo $this->session->flashdata('pesan') ?>
          <table class="table table-striped table-bordered" id="tabel1">
            <thead>
                <tr>
                  <th>No</th>
                  <th>No Faktur</th>
                  <th>Tanggal Pesan</th>
                  <th>Tanggal Pengambilan</th>
                  <th>Total </th>
                  <th>Status</th>
                  <th>Option</th>
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
        <td><?php echo number_format($v['total']) ?></td>
        <td><?php echo $v['status'] ?></td>
        <td>
          <a href="<?php echo base_url() ?>user/admin/pesanan/detail_order/<?php echo $v['id_faktur'] ?>" class="btn btn-info btn-xs">Detail Order</a>
        </td>
      </tr>
      <?php } ?>
    </tbody>
            
          </table>
        </div>


      </div>
    </div>
  </div>


















