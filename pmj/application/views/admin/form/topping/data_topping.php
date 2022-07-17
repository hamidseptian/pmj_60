 <div class="row">
    <div class="col-md-6">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Data Topping</h3>
          <div class="pull-right">
            <a href="<?php echo base_url('user/admin/topping/tambah') ?>" class="btn btn-info">Tambah Topping</a>
          </div>
        </div>
        <div class="box-body">
          <?php echo $this->session->flashdata('pesan') ?>
          <table class="table table-striped table-bordered" id="tabel1">
            <thead>
              <tr>
                <td width="20px">No</td>
                <td>Gambar</td>
                <td>Nama Topping</td>
                <td>Harga</td>
                <td>Stok</td>
                <td width="90px">Option</td>
              </tr>
            </thead>
            <?php 
            $no=1;
            foreach ($topping as $d1) { ?>
              <tr>
                <td><?php echo $no++ ?></td>
                <td><img src="<?php echo base_url('file/topping/gambar/').$d1['gambar_topping'] ?>" width="100px">
                
                <td><?php echo $d1['nama_topping'] ?></td>
                <td><?php echo number_format($d1['harga']) ?></td>
                <td><?php echo number_format($d1['stok']) ?></td>
                <td>
                  <a href="<?php echo base_url('user/admin/topping/edit/'.$d1['id_topping']) ?>" class="btn btn-info btn-xs" >Edit</a>
                  <a href="<?php echo base_url('user/admin/topping/hapus/'.$d1['id_topping']) ?>" class="btn btn-info btn-xs" onclick="return confirm('Hapus topping <?php echo $d1['nama_topping'] ?>.?')">Hapus</a>
                </td>
              </tr>
            <?php } ?>
            
          </table>
        </div>


      </div>
    </div>
  </div>


















