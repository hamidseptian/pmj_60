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
              <label>Keterangan</label>
              <textarea name="keterangan" class="form-control" required></textarea>
            </div>

           
            <div class="form-group">
              <label>Biaya</label>
              <input type="text" name="biaya" class="form-control" required>
            </div>
            <div class="form-group">
              <label>Satuan Harga (Harga Per)</label>
              <input type="text" name="satuan" class="form-control" required>
            </div>
            <div class="form-group">
              <label>Poin Produk</label>
              <input type="number" name="poin" class="form-control" required>
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
