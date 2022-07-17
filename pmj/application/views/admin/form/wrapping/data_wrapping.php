 <div class="row">
    <div class="col-md-6">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Data wrapping</h3>
          <div class="pull-right">
            <a href="<?php echo base_url('user/admin/wrapping/tambah') ?>" class="btn btn-info">Tambah wrapping</a>
          </div>
        </div>
        <div class="box-body">
          <?php echo $this->session->flashdata('pesan') ?>
          <table class="table table-striped table-bordered" id="tabel1">
            <thead>
              <tr>
                <td width="20px">No</td>
                <td>Gambar</td>
                <td>Wrapping</td>
                <td>Stok</td>
              
                <td width="90px">Option</td>
              </tr>
            </thead>
            <?php 
            $no=1;
            foreach ($wrapping as $d1) { ?>
              <tr>
                <td><?php echo $no++ ?></td>
                
                <td><img src="<?php echo base_url('file/produk/gambar/').$d1['gambar'] ?>" width="100px"></td>
                <td><?php echo $d1['wrapping'] ?></td>
                <td><?php echo $d1['stok'] ?></td>
                <td>
                  <a href="<?php echo base_url('user/admin/wrapping/edit/'.$d1['id_wrapping']) ?>" class="btn btn-info btn-xs" >Edit</a>
                  <a href="<?php echo base_url('user/admin/wrapping/hapus/'.$d1['id_wrapping']) ?>" class="btn btn-info btn-xs" onclick="return confirm('Hapus wrapping <?php echo $d1['wrapping'] ?>.?')">Hapus</a>
                </td>
              </tr>
            <?php } ?>
            
          </table>
        </div>


      </div>
    </div>
  </div>


















