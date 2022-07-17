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
          <form action="<?php echo base_url('user/admin/produk/simpanedit') ?>" method='post'  enctype="multipart/form-data">
            <div class="form-group">
              <label>Produk</label>
             
              <input type="hidden" name="id" class="form-control" required value="<?php echo $produk['id_produk'] ?>">
              <input type="text" name="produk" class="form-control" required value="<?php echo $produk['nama_produk'] ?>">
            </div>
            <div class="form-group">
              <label>Keterangan</label>
              <textarea name="keterangan" class="form-control" required><?php echo $produk['keterangan'] ?></textarea>
            </div>
            <div class="form-group">
              <label>Harga</label>
              <input type="number" name="biaya" class="form-control" required value="<?php echo $produk['harga'] ?>">
            </div>
           
            <div class="form-group">
              <label>Harga Per</label>
              <input type="text" name="satuan" class="form-control" required value="<?php echo $produk['harga_per'] ?>">
            </div>
            <div class="form-group">
              <label>Poin Produk</label>
              <input type="number" name="poin" class="form-control" required value="<?php echo $produk['poin'] ?>">
            </div>
           
           
          
           
            <div class="form-group">
              <label>Gambar</label>
              <input type="file" name="berkas">
            </div>
           
            <div class="form-group">
              <input type="submit" value="Simpan Data produk" class="btn btn-info">
            </div>
          </form>
        </div>


      </div>
    </div>
  </div>
