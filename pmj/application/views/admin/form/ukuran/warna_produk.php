 <div class="row">
    <div class="col-md-6">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Kelola Warna Dan Stok</h3>
          <div class="pull-right">
            <a href="<?php echo base_url('user/admin/ukuran') ?>" class="btn btn-info">Kembali</a>
            <a href="<?php echo base_url('user/admin/ukuran/tambah_warna/'.$produk['id_ukuran']) ?>" class="btn btn-info">Tambah Warna Produk</a>
          </div>
        </div>
        <div class="box-body">
          <form action="<?php echo base_url('user/admin/ukuran/simpanedit') ?>" method='post'  enctype="multipart/form-data">
            <div class="form-group">
              <label>Identitas Produk</label>
              <table class="table">
                <tr>
                  <td>Produk</td>
                  <td>:</td>
                  <td><?php echo $produk['nama_produk'] ?></td>
                </tr>
                <tr>
                  <td>Ukuran</td>
                  <td>:</td>
                  <td><?php echo $produk['ukuran'] ?></td>
                </tr>
                <tr>
                  <td>Biaya</td>
                  <td>:</td>
                  <td><?php echo $produk['biaya'] ?></td>
                </tr>
              </table>
            </div>
           
            <div class="form-group">
              <label>Warna Produk</label>
              <?php if ($j_warna>0) { ?>
              <table class="table">
                <tr>
                  <td>No</td>
                  <td>Warna</td>
                  <td>Stok</td>
                  <td>Option</td>
                </tr>
                <?php 
                $no=1;
                foreach ($warna as $k => $v) { ?>
                  <tr>
                    <td><?php echo $no++ ?></td>
                    <td><?php echo $v['warna'] ?></td>
                    <td><?php echo $v['stok'] ?></td>
                    <td>
                      <a href="<?php echo base_url('user/admin/ukuran/hapus_warna/'.$produk['id_ukuran'].'/'.$v['id_warna']) ?>" class="btn btn-danger btn-xs">Hapus</a>
                      <a href="<?php echo base_url('user/admin/ukuran/edit_warna/'.$produk['id_ukuran'].'/'.$v['id_warna']) ?>" class="btn btn-warning btn-xs">Edit</a>
                    </td>
                  </tr>
                <?php } ?>
              </table>
            <?php }else{ ?>
              <div class="alert alert-info">Tidak ada data warna</div>
            <?php } ?>
            </div>
            
            
          </form>
        </div>


      </div>
    </div>
  </div>
