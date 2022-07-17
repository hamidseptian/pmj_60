 <div class="row">
    <div class="col-md-8">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Data Ukuran</h3>
          <div class="pull-right">
            <a href="<?php echo base_url('user/admin/ukuran/tambah') ?>" class="btn btn-info">Tambah Ukuran</a>
          </div>
        </div>
        <div class="box-body">
          <?php echo $this->session->flashdata('pesan') ?>
          <table class="table table-striped table-bordered" id="tabel1">
            <thead>
              <tr>
                <td width="20px">No</td>
                <td>Gambar</td>
                <td>Produk</td>
                <td>Ukuran</td>
                <td>Biaya</td>
                <td width="90px">Option</td>
              </tr>
            </thead>
            <?php 
            $no=1;
            foreach ($ukuran as $d1) { 
              ?>
              <tr>
                <td><?php echo $no++ ?></td>
                <td><img src="<?php echo base_url('file/produk/gambar/'.$d1['gambar']) ?>" width="100px"></td>
                <td><?php echo $d1['nama_produk'] ?></td>
                <td><?php echo $d1['ukuran'] ?></td>
                <td><?php echo number_format($d1['biaya']) ?></td>
                <td>
                  <a href="<?php echo base_url('user/admin/ukuran/warna/'.$d1['id_ukuran']) ?>" class="btn btn-info btn-xs">Kelola Warna & Stok</a>
                  <a href="<?php echo base_url('user/admin/ukuran/edit/'.$d1['id_ukuran']) ?>" class="btn btn-info btn-xs">Edit</a>
                  <a href="<?php echo base_url('user/admin/ukuran/hapus/'.$d1['id_ukuran'].'/'.$d1['gambar']) ?>" class="btn btn-info btn-xs" onclick="return confirm('Hapus ukuran <?php echo $d1['ukuran'] ?>.?')">Hapus</a>
                </td>
              </tr>
            <?php } ?>
            
          </table>
        </div>


      </div>
    </div>
  </div>


















