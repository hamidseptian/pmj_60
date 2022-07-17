 <div class="row">
    <div class="col-md-6">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Edit Item Penukaran Poin</h3>
          <div class="pull-right">
            <a href="<?php echo base_url('user/admin/item_tukar_poin') ?>" class="btn btn-info">Kembali</a>
          </div>
        </div>
        <div class="box-body">
          <form action="<?php echo base_url('user/admin/item_tukar_poin/simpanedit') ?>" method='post'  enctype="multipart/form-data">
            <div class="form-group">
              <label>Item Penukaran Poin</label>
             
              <input type="hidden" name="id" class="form-control" required value="<?php echo $item_tukar_poin['id_item_tukar_poin'] ?>">
              <input type="text" name="item_tukar_poin" class="form-control" required value="<?php echo $item_tukar_poin['nama_item_tukar_poin'] ?>">
            </div>
            <div class="form-group">
              <label>Keterangan</label>
              <textarea name="keterangan" class="form-control" required><?php echo $item_tukar_poin['keterangan'] ?></textarea>
            </div>
           
            <div class="form-group">
              <label>Poin Dibutuhkan</label>
              <input type="number" name="poin" class="form-control" required value="<?php echo $item_tukar_poin['poin'] ?>">
            </div>
           
           
          
           
            <div class="form-group">
              <label>Gambar</label>
              <input type="file" name="berkas">
            </div>
           
            <div class="form-group">
              <input type="submit" value="Simpan Perubahan" class="btn btn-info">
            </div>
          </form>
        </div>


      </div>
    </div>
  </div>
