 <div class="row">
    <div class="col-md-6">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Tambah Ukuran</h3>
          <div class="pull-right">
            <a href="<?php echo base_url('user/admin/ukuran') ?>" class="btn btn-info">Kembali</a>
          </div>
        </div>
        <div class="box-body">
          <form action="<?php echo base_url('user/admin/ukuran/simpan') ?>" method='post'  enctype="multipart/form-data">
            <div class="form-group">
              <label>Produk</label>
              <select name="produk" class="form-control">
                <?php foreach ($produk as $p) { ?>
                <option value="<?php echo $p['id_produk'] ?>"><?php echo $p['nama_produk'] ?></option>
                 
                <?php } ?>
              </select>
            </div>
           
            <div class="form-group">
              <label>Ukuran</label>
              <input type="text" name="ukuran" class="form-control" required>
            </div>
            <div class="form-group">
              <label>Banyak Topping</label>
              <input type="number" name="topping" class="form-control" required>
            </div>
           
            <div class="form-group">
              <label>Biaya</label>
              <input type="text" name="biaya" class="form-control" required>
            </div>
           
           
            <div class="form-group">
              <label>Bahan baku yang digunakan</label>
              <table class="table table-bordered">
                <tr>
                  <td>Nama Bahan Baku</td>
                  <td>Warna</td>
                  <td>Banyak Kebutuhan</td>
                </tr>
                <?php foreach ($bahan_baku as $v) { ?>
                  <tr>
                    <td><?php echo $v['nama_bahan_baku'] ?></td>
                    <td><?php echo $v['keterangan'] ?></td>
                    <td>
                      <input type="hidden" name="id_bahan_baku[]" class="form-control" value="<?php echo $v['id_bahan_baku'] ?>">
                      <input type="number" name="banyak[]" class="form-control" placeholder="banyak yang akan digunakan">
                    </td>
                  </tr>
                <?php } ?>
              </table>
            </div>
           
            <div class="form-group">
              <label>Gambar</label>
              <input type="file" name="berkas"  required>
            </div>
           
            <div class="form-group">
              <input type="submit" value="Simpan Data Ukuran" class="btn btn-info">
            </div>
          </form>
        </div>


      </div>
    </div>
  </div>
