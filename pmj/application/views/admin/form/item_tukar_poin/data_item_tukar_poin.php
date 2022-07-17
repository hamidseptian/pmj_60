 <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Data Item Penukaran Poin</h3>
          <div class="pull-right">
            <a href="<?php echo base_url('user/admin/item_tukar_poin/tambah') ?>" class="btn btn-info">Tambah Item Penukaran Poin</a>
          </div>
        </div>
        <div class="box-body">
          <?php echo $this->session->flashdata('pesan') ?>
          <table class="table table-striped table-bordered" id="tabel1">
            <thead>
              <tr>
                <td width="20px">No</td>
                <td>Gambar</td>
                <td>Item Penukaran Poin</td>
                <td>Keterangan</td>
                <td>Poin Dibutuhkan</td>
                <td width="90px">Option</td>
              </tr>
            </thead>
            <?php 
            $no=1;
            foreach ($item_tukar_poin as $d1) { ?>
              <tr>
                <td><?php echo $no++ ?></td>
                <td><img src="<?php echo base_url('file/item_tukar_poin/gambar/').$d1['gambar'] ?>" width="100px"></td>
                <td><?php echo $d1['nama_item_tukar_poin'] ?></td>
                <td><?php echo $d1['keterangan'] ?></td>
                <td><?php echo $d1['poin'] ?></td>
                <td>
                  <a href="<?php echo base_url('user/admin/item_tukar_poin/edit/'.$d1['id_item_tukar_poin']) ?>" class="btn btn-info btn-xs" >Edit</a>
                  <a href="<?php echo base_url('user/admin/item_tukar_poin/hapus/'.$d1['id_item_tukar_poin']) ?>" class="btn btn-info btn-xs" onclick="return confirm('Hapus item <?php echo $d1['nama_item_tukar_poin'] ?>.?')">Hapus</a>
                </td>
              </tr>
            <?php } ?>
            
          </table>
        </div>


      </div>
    </div>
  </div>


















