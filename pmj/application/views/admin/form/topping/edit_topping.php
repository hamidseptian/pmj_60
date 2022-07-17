 <div class="row">
    <div class="col-md-6">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Edit Topping</h3>
          <div class="pull-right">
            <a href="<?php echo base_url('user/admin/topping') ?>" class="btn btn-info">Kembali</a>
          </div>
        </div>
        <div class="box-body">
          <form action="<?php echo base_url('user/admin/topping/simpanedit') ?>" method='post'  enctype="multipart/form-data">
            <div class="form-group">
              <label>Topping</label>
              <input type="hidden" name="id" class="form-control" value="<?php echo $topping['id_topping'] ?>">
              <input type="text" name="nama" class="form-control" value="<?php echo $topping['nama_topping'] ?>">
            </div>
             <div class="form-group">
              <label>Harga</label>
              <input type="number" name="harga" class="form-control" required value="<?php echo $topping['harga'] ?>">
            </div>
             <div class="form-group">
              <label>Stok</label>
              <input type="number" name="stok" class="form-control" required value="<?php echo $topping['stok'] ?>">
            </div>

            <div class="form-group">
              <label>Gambar</label>
              <input type="file" name="berkas" class="form-control">
            </div>
            
            
            <div class="form-group">
              <input type="submit" value="Simpan Perubahan" class="btn btn-info">
            </div>
          </form>
        </div>


      </div>
    </div>
  </div>






