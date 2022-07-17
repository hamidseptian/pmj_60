 <div class="row">
    <div class="col-md-6">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Tambah Item Penukaran Poin</h3>
          <div class="pull-right">
            <a href="<?php echo base_url('user/admin/item_tukar_poin') ?>" class="btn btn-info">Kembali</a>
          </div>
        </div>
        <div class="box-body">
          <form action="<?php echo base_url('user/admin/item_tukar_poin/simpan') ?>" method='post'  enctype="multipart/form-data">
            <div class="form-group">
              <label>Item Penukaran Poin</label>
             
              <input type="text" name="item_tukar_poin" class="form-control" required>
            </div>
            <div class="form-group">
              <label>Keterangan</label>
              <textarea name="keterangan" class="form-control" required></textarea>
            </div>

           
            <div class="form-group">
              <label>Poin Dibutuhkan</label>
              <input type="number" name="poin" class="form-control" required>
            </div>
           
           
          
           
            <div class="form-group">
              <label>Gambar</label>
              <input type="file" name="berkas"  required>
            </div>
           
            <div class="form-group">
              <input type="submit" value="Simpan Data" class="btn btn-info">
            </div>
          </form>
        </div>


      </div>
    </div>
  </div>
