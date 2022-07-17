 <div class="row">
    <div class="col-md-6">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Tambah Produk</h3>
          <div class="pull-right">
            <a href="<?php echo base_url('user/admin/produk') ?>" class="btn btn-info">Kembali</a>
          </div>
        </div>
        <div class="box-body">
          <form action="<?php echo base_url('user/admin/produk/simpan') ?>" method='post'  enctype="multipart/form-data">
            <div class="form-group">
              <label>Produk</label>
             
              <input type="text" name="produk" class="form-control" required>
            </div>
            <div class="form-group">
              <label>Maksimal Topping</label>
              <input type="number" name="topping" class="form-control" required>
            </div>

            <div class="form-group">
              <label>Wrapping Dibutuhkan</label>
              <input type="number" name="wrapping" class="form-control" required>
            </div>
           
            <div class="form-group">
              <label>Biaya</label>
              <input type="text" name="biaya" class="form-control" required>
            </div>
           
           
          
           
            <div class="form-group">
              <label>Gambar</label>
              <input type="file" name="berkas"  required>
            </div>
           
            <div class="form-group">
              <input type="submit" value="Simpan Data produk" class="btn btn-info">
            </div>
          </form>
        </div>


      </div>
    </div>
  </div>
