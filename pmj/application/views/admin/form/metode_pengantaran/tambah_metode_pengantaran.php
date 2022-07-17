 <div class="row">
    <div class="col-md-6">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Tambah metode pengantaran</h3>
          <div class="pull-right">
            <a href="<?php echo base_url('user/admin/metode_pengantaran') ?>" class="btn btn-info">Kembali</a>
          </div>
        </div>
        <div class="box-body">
          <form action="<?php echo base_url('user/admin/metode_pengantaran/simpan') ?>" method='post'>
          
            <div class="form-group">
              <label>Metode pengantaran</label>
              <input type="text" name="metode" class="form-control" required>
            </div>
        
            <div class="form-group">
              <input type="submit" value="Simpan data metode pengantaran" class="btn btn-info">
            </div>
          </form>
        </div>


      </div>
    </div>
  </div>
