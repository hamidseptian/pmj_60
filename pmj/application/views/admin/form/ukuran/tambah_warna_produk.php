 <div class="row">
    <div class="col-md-6">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Tambah Warna Dan Stok</h3>
          <div class="pull-right">
            <a href="<?php echo base_url('user/admin/ukuran/warna/'.$produk['id_ukuran']) ?>" class="btn btn-info">Kembali</a>
          </div>
        </div>
        <div class="box-body">
          
            <div class="form-group">
              <label>Identitas Produk</label>
              <table class="table">
                <tr>
                  <td>Produk</td>
                  <td>:</td>
                  <td><?php echo $produk['nama_produk'] ?></td>
                </tr>
                <tr>
                  <td>Ukuran</td>
                  <td>:</td>
                  <td><?php echo $produk['ukuran'] ?></td>
                </tr>
                <tr>
                  <td>Biaya</td>
                  <td>:</td>
                  <td><?php echo $produk['biaya'] ?></td>
                </tr>
              </table>
            </div>
           <hr>
           <form action="<?php echo base_url('user/admin/ukuran/simpan_warna/'.$produk['id_ukuran'].'/'.$produk['id_produk']) ?>" method="post">
              <div class="form-group">
                <label>Tambah Warna Produk</label>
                <input type="" name="warna" class="form-control">
              </div>
              <div class="form-group">
                <label>Stok</label>
                <input type="" name="stok" class="form-control">
              </div>
              <div class="form-group">
                <button class="btn btn-info">Simpan</button>
              </div>
           </form>
            
            
        </div>


      </div>
    </div>
  </div>
