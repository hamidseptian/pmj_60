 <div class="row">
    <div class="col-md-6">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Edit pelanggan</h3>
          <div class="pull-right">
            <a href="<?php echo base_url('user/admin/pelanggan') ?>" class="btn btn-info">Kembali</a>
          </div>
        </div>
        <div class="box-body">
          
          <?php echo $this->session->flashdata('pesan') ?>
          <form action="<?php echo base_url('user/admin/pelanggan/simpanedit') ?>" method='post'>
            <div class="form-group">
              <label>pelanggan</label>
              <input type="hidden" name="id" class="form-control" value="<?php echo $pelanggan['id_pelanggan'] ?>">
              <input type="text" name="nama" class="form-control" value="<?php echo $pelanggan['nama'] ?>">
            </div>
           
            <div class="form-group">
              <label>No HP</label>
              <input type="text" name="nohp" class="form-control" required value="<?php echo $pelanggan['nohp'] ?>">
            </div>
                <div class="form-group">
              <label>Email</label>
              <input type="text" name="email" class="form-control" required value="<?php echo $pelanggan['email'] ?>">
            </div>
                <div class="form-group">
              <label>Password</label>
              <input type="text" name="password" class="form-control" required value="<?php echo $pelanggan['password'] ?>">
            </div>
            
            <div class="form-group">
              <input type="submit" value="Simpan Perubahan" class="btn btn-info">
            </div>
          </form>
        </div>


      </div>
    </div>
  </div>






