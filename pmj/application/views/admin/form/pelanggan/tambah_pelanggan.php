 <div class="row">
    <div class="col-md-6">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Tambah pelanggan</h3>
          <div class="pull-right">
            <?php if ($menu=='pengunjung') { ?>
            <a href="<?php echo base_url('user/admin/pengunjung/tambah') ?>" class="btn btn-info">Kembali</a>
            <?php }else{ ?>
            <a href="<?php echo base_url('user/admin/pelanggan') ?>" class="btn btn-info">Kembali</a>
            <?php } ?>
              
          </div>
        </div>
        <div class="box-body">
          
          <?php echo $this->session->flashdata('pesan') ?>
          <form action="<?php echo base_url('user/admin/pelanggan/simpan') ?>" method='post'>
            <div class="form-group">
              <label>Nama</label>
              <input type="text" name="nama" class="form-control" required>
            </div>
           
            <div class="form-group">
              <label>No HP</label>
              <input type="text" name="nohp" class="form-control" required>
            </div>
           
            <div class="form-group">
              <label>Email</label>
              <input type="text" name="email" class="form-control" required>
            </div>
            <div class="form-group">
              <label>Password</label>
              <input type="text" name="password" class="form-control" readonly value="123">
            </div>
           
            <div class="form-group">
              <input type="submit" value="Simpan Data pelanggan" class="btn btn-info">
            </div>
          </form>
        </div>


      </div>
    </div>
  </div>
