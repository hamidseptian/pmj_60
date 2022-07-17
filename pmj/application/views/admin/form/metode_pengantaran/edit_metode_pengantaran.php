 <div class="row">
    <div class="col-md-6">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Edit metode_pengantaran</h3>
          <div class="pull-right">
            <a href="<?php echo base_url('user/admin/metode_pengantaran') ?>" class="btn btn-info">Kembali</a>
          </div>
        </div>
        <div class="box-body">
          <form action="<?php echo base_url('user/admin/metode_pengantaran/simpanedit') ?>" method='post'>
            <div class="form-group">
              <label>metode_pengantaran</label>
              <input type="hidden" name="id" class="form-control" value="<?php echo $metode_pengantaran['id_pengantaran'] ?>">
            </div>
           
            <div class="form-group">
              <label>Metode pengantaran</label>
              <input type="text" name="metode_pengantaran" class="form-control" required value="<?php echo $metode_pengantaran['metode_pengantaran'] ?>">
            </div>
           
            
            <div class="form-group">
              <input type="submit" value="Simpan Perubahan" class="btn btn-info">
            </div>
          </form>
        </div>


      </div>
    </div>
  </div>






