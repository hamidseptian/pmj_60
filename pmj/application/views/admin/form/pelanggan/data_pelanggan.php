 <div class="row">
    <div class="col-md-6">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Data pelanggan</h3>
          <div class="pull-right">
            <a href="<?php echo base_url('user/admin/pelanggan/tambah') ?>" class="btn btn-info">Tambah pelanggan</a>
          </div>
        </div>
        <div class="box-body">
          <?php echo $this->session->flashdata('pesan') ?>
          <table class="table table-striped table-bordered" id="tabel1">
            <thead>
              <tr>
                <td width="20px">No</td>
                <td>Nama</td>
                <td>No HP</td>
                <td>Email / Username</td>
                <td>Password</td>
                <td>Option</td>
              </tr>
            </thead>
            <?php 
            $no=1;
            foreach ($pelanggan as $d1) { ?>
              <tr>
                <td><?php echo $no++ ?></td>
                <td><?php echo $d1['nama'] ?></td>
                <td><?php echo $d1['nohp'] ?></td>
                <td><?php echo $d1['email'] ?></td>
                <td><?php echo $d1['password'] ?></td>
                <td>
                  
                  <a href="<?php echo base_url('user/admin/pelanggan/edit/'.$d1['id_pelanggan']) ?>" class="btn btn-info btn-xs" >Edit</a>
                  <a href="<?php echo base_url('user/admin/pelanggan/hapus/'.$d1['id_pelanggan']) ?>" class="btn btn-info btn-xs" onclick="return confirm('Hapus pelanggan <?php echo $d1['nama'] ?>.?')">Hapus</a>
                </td>
           
              </tr>
            <?php } ?>
            
          </table>
        </div>


      </div>
    </div>
  </div>


















