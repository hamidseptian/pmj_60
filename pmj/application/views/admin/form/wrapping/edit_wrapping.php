 <div class="row">
    <div class="col-md-6">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Edit wrapping</h3>
          <div class="pull-right">
            <a href="<?php echo base_url('user/admin/wrapping') ?>" class="btn btn-info">Kembali</a>
          </div>
        </div>
        <div class="box-body">
          <form action="<?php echo base_url('user/admin/wrapping/simpanedit') ?>" method='post'  enctype="multipart/form-data">
          
            <div class="form-group">
              <label>Wrapping</label>
              <input type="hidden" name="id" class="form-control" value="<?php echo $wrapping['id_wrapping'] ?>">
              <input type="text" name="wrapping" class="form-control" required value="<?php echo $wrapping['wrapping'] ?>">
            </div>
            <div class="form-group">
              <label>Stok</label>
             
              <input type="number" name="stok" class="form-control" required value="<?php echo $wrapping['stok'] ?>">
            </div>

           
            <div class="form-group">
              <label>Gambar</label>
              <input type="file" name="berkas"  required>
            </div>
           
            
            <div class="form-group">
              <input type="submit" value="Simpan Perubahan" class="btn btn-info">
            </div>
          </form>
        </div>


      </div>
    </div>
  </div>






