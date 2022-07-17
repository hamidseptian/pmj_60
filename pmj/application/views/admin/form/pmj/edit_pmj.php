 <div class="row">
    <div class="col-md-6">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Edit pmj</h3>
          <div class="pull-right">
            <a href="<?php echo base_url('user/admin/pmj') ?>" class="btn btn-info">Kembali</a>
          </div>
        </div>
        <div class="box-body">
          <form action="<?php echo base_url('user/admin/pmj/simpanedit') ?>" method='post' enctype="multipart/form-data">
            <div class="form-group">
              <label>pmj</label>
              <input type="hidden" name="id" class="form-control" value="<?php echo $pmj['id'] ?>">
              <input type="text" name="nama" class="form-control" value="<?php echo $pmj['nama'] ?>">
            </div>

            <div class="form-group">
              <label>Jabatan</label>
              <input type="text" name="jabatan" class="form-control" required value="<?php echo $pmj['jabatan'] ?>">
            </div>
                <div class="form-group">
              <label>Alamat</label>
              <input type="text" name="alamat" class="form-control" required value="<?php echo $pmj['alamat'] ?>">
            </div>
           
            <div class="form-group">
              <label>No HP</label>
              <input type="text" name="nohp" class="form-control" required value="<?php echo $pmj['nohp'] ?>">
            </div>
            <div class="form-group">
              <label>Foto</label>
              <input type="file" name="berkas" class="form-control" >
            </div>
            <div class="form-group">
              <label>Email</label>
              <input type="text" name="email" class="form-control" required value="<?php echo $pmj['email'] ?>">
            </div>
            <div class="form-group">
              <label>Password</label>
              <input type="password" name="password" class="form-control" required value="<?php echo $pmj['password'] ?>">
            </div>
            
            <div class="form-group">
              <input type="submit" value="Simpan Perubahan" class="btn btn-info">
            </div>
          </form>
        </div>


      </div>
    </div>
  </div>






