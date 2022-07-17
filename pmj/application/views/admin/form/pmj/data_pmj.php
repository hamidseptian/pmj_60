 <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Data pmj</h3>
          <div class="pull-right">
            <a href="<?php echo base_url('user/admin/pmj/tambah') ?>" class="btn btn-info">Tambah pmj</a>
          </div>
        </div>
        <div class="box-body">
          <?php echo $this->session->flashdata('pesan') ?>
          <table class="table table-striped table-bordered" id="tabel1">
            <thead>
              <tr>
                <td width="20px">No</td>
                <td>Foto</td>
                <td>Nama</td>
                <td>Jabatan</td>
                <td>Alamat</td>
                <td>No HP</td>
                <td>Email</td>
                <td width="90px">Option</td>
              </tr>
            </thead>
            <?php 
            $no=1;
            foreach ($pmj as $d1) { ?>
              <tr>
                <td><?php echo $no++ ?></td>

                <td><img src="<?php echo base_url('file/pmj/gambar/').$d1['foto'] ?>" width="100px">
                <td><?php echo $d1['nama'] ?></td>
                <td><?php echo $d1['jabatan'] ?></td>
                <td><?php echo $d1['alamat'] ?></td>
                <td><?php echo $d1['nohp'] ?></td>
                <td><?php echo $d1['email'] ?></td>
                <td>
                  <a href="<?php echo base_url('user/admin/pmj/edit/'.$d1['id']) ?>" class="btn btn-info btn-xs" >Edit</a>
                  <a href="<?php echo base_url('user/admin/pmj/hapus/'.$d1['id']) ?>" class="btn btn-info btn-xs" onclick="return confirm('Hapus pmj <?php echo $d1['nama'] ?>.?')">Hapus</a>
                </td>
              </tr>
            <?php } ?>
            
          </table>
        </div>


      </div>
    </div>
  </div>


















