 <div class="row">
    <div class="col-md-6">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Edit Ukuran</h3>
          <div class="pull-right">
            <a href="<?php echo base_url('user/admin/ukuran') ?>" class="btn btn-info">Kembali</a>
          </div>
        </div>
        <div class="box-body">
          <form action="<?php echo base_url('user/admin/ukuran/simpanedit') ?>" method='post'  enctype="multipart/form-data">
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
              <input type="hidden" name="id" class="form-control" required value="<?php echo $ukuran['id_ukuran'] ?>">
              <input type="hidden" name="filelama" class="form-control" required value="<?php echo $ukuran['gambar'] ?>">
              <input type="text" name="ukuran" class="form-control" required value="<?php echo $ukuran['ukuran'] ?>">
            </div>
              <div class="form-group">
              <label>Banyak Topping</label>
              <input type="number" name="topping" class="form-control" required value="<?php echo $ukuran['banyak_topping'] ?>">
            </div>
           
            <div class="form-group">
              <label>Biaya</label>
              <input type="text" name="biaya" class="form-control" required value="<?php echo $ukuran['biaya'] ?>">
            </div>
           
            <div class="form-group">
              <label>Bahan baku yang digunakan</label>
              <table class="table table-bordered">
                <tr>
                  <td>Nama Bahan Baku</td>
                  <td>Warna</td>
                  <td>Banyak Kebutuhan</td>
                </tr>
                <?php foreach ($bahan_baku as $v) { 
                  $cek =$this->db->query("SELECT * from pemakaian_bahan_baku where id_ukuran='".$ukuran['id_ukuran']."' and  id_bahan_baku='".$v['id_bahan_baku']."'")->row_array() ;
                  ?>
                  <tr>
                    <td><?php echo $v['nama_bahan_baku'] ?></td>
                    <td><?php echo $v['keterangan'] ?></td>
                    <td>
                      <input type="hidden" name="id_bahan_baku[]" class="form-control" value="<?php echo $v['id_bahan_baku'] ?>">
                      <input type="number" name="banyak[]" class="form-control" placeholder="banyak yang akan digunakan" value="<?php echo $cek['banyak_pemakaian'] ?>">
                    </td>
                  </tr>
                <?php } ?>
              </table>
            </div>
            <div class="form-group">
              <label>Gambar</label> <br>
              <img src="<?php echo base_url('file/produk/gambar/'.$ukuran['gambar']) ?>" width="150px"> <br><br>
              <input type="file" name="berkas" >
            </div>
           
            <div class="form-group">
              <input type="submit" value="Simpan Data Ukuran" class="btn btn-info">
            </div>
          </form>
        </div>


      </div>
    </div>
  </div>
