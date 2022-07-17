 <div class="row">
    <div class="col-md-6">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Data metode pengantaran</h3>
          <div class="pull-right">
            <a href="<?php echo base_url('user/admin/metode_pengantaran/tambah') ?>" class="btn btn-info">Tambah metode pengantaran</a>
          </div>
        </div>
        <div class="box-body">
          <?php echo $this->session->flashdata('pesan') ?>
          <table class="table table-striped table-bordered" id="tabel1">
            <thead>
              <tr>
                <td width="20px">No</td>
                <td>Metode Pengantaran</td>
              
                <td width="90px">Option</td>
              </tr>
            </thead>
            <?php 
            $no=1;
            foreach ($metode_pengantaran as $d1) { ?>
              <tr>
                <td><?php echo $no++ ?></td>
                <td><?php echo $d1['metode_pengantaran'] ?></td>
                <td>
                  <a href="<?php echo base_url('user/admin/metode_pengantaran/edit/'.$d1['id_pengantaran']) ?>" class="btn btn-info btn-xs" >Edit</a>
                  <a href="<?php echo base_url('user/admin/metode_pengantaran/hapus/'.$d1['id_pengantaran']) ?>" class="btn btn-info btn-xs" onclick="return confirm('Hapus metode_pengantaran <?php echo $d1['metode_pengantaran'] ?>.?')">Hapus</a>
                </td>
              </tr>
            <?php } ?>
            
          </table>
        </div>


      </div>
    </div>
  </div>


















