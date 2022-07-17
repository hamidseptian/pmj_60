 <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Data Pengunjung</h3>
          <div class="pull-right">
            <a href="<?php echo base_url('user/admin/pengunjung/tambah') ?>" class="btn btn-info">Tambah Pengunjung</a>
          </div>
        </div>
        <div class="box-body">
          <?php echo $this->session->flashdata('pesan') ?>
          <table class="table table-striped table-bordered" id="tabel1">
            <thead>
              <tr>
                <td width="20px">No</td>
                <td>Tanggal Kunjungan</td>
                <td>Pelanggan</td>
                <td>No Hp</td>
                <td>Kategori</td>
                <td>Nama Kelompok</td>
                <td>Banyak Anak</td>
                <td>Status</td>
                <td width="90px">Option</td>
              </tr>
            </thead>
            <?php 
            $no=1;
            foreach ($pengunjung as $d1) { 
              $id_pengunjung = $d1['id_pengunjung'];
              $kategori = $d1['kategori'];
              $q_detail = $this->db->query("SELECT * from detail_pengunjung where id_pengunjung='$id_pengunjung'");
              ?>
              <tr>
                <td><?php echo $no++ ?></td>
                <td><?php echo $d1['tgl_kunjungan'] ?></td>
                <td><?php echo $d1['nama'] ?></td>
                <td><?php echo $d1['nohp'] ?></td>
                <td><?php echo $d1['kategori'] ?></td>
               <?php
                if ($kategori=='Pribadi') { ?>
                  <td>-</td>
                  <td>-</td>
                <?php }else{ ?>
                  <td><?php echo $d1['nama_kelompok'] ?></td>
                  <td><?php echo $q_detail->num_rows() ?></td>
                <?php }?>
                <td><?php echo $d1['status'] ?></td>
                <td>
                  <?php if ($d1['kategori']=='Kelompok'): ?>
                    <a href="<?php echo base_url('user/admin/pengunjung/detail/'.$d1['id_pengunjung']) ?>" class="btn btn-warning btn-xs" >Detail</a>
                    
                  <?php endif ?>
                  <a href="<?php echo base_url('user/admin/pengunjung/edit/'.$d1['id_pengunjung']) ?>" class="btn btn-info btn-xs" >Edit</a>
                  <a href="<?php echo base_url('user/admin/pengunjung/hapus/'.$d1['id_pengunjung']) ?>" class="btn btn-info btn-xs" onclick="return confirm('Hapus pengunjung <?php echo $d1['nama_kelompok'] ?>.?')">Hapus</a>
                </td>
              </tr>
            <?php } ?>
            
          </table>
        </div>


      </div>
    </div>
  </div>


















