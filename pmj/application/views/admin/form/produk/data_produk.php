 <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Data Produk</h3>
          <div class="pull-right">
            <a href="<?php echo base_url('user/admin/produk/tambah') ?>" class="btn btn-info">Tambah Produk</a>
          </div>
        </div>
        <div class="box-body">
          <?php echo $this->session->flashdata('pesan') ?>
          <table class="table table-striped table-bordered" id="tabel1">
            <thead>
              <tr>
                <td width="20px">No</td>
                <td>Gambar</td>
                <td>Produk</td>
                <td>Keterangan</td>
                <td>Biaya</td>
                <td>Harga Per</td>
                <td>Poin</td>
                <td width="90px">Option</td>
              </tr>
            </thead>
            <?php 
            $no=1;
            foreach ($produk as $d1) { ?>
              <tr>
                <td><?php echo $no++ ?></td>
                <td><img src="<?php echo base_url('file/produk/gambar/').$d1['gambar'] ?>" width="100px"></td>
                <td><?php echo $d1['nama_produk'] ?></td>
                <td><?php echo $d1['keterangan'] ?></td>
                <td><?php echo number_format($d1['harga']) ?></td>
                <td><?php echo $d1['harga_per'] ?></td>
                <td><?php echo $d1['poin'] ?></td>
                <td>
                  <a href="<?php echo base_url('user/admin/produk/edit/'.$d1['id_produk']) ?>" class="btn btn-info btn-xs" >Edit</a>
                  <a href="<?php echo base_url('user/admin/produk/hapus/'.$d1['id_produk']) ?>" class="btn btn-info btn-xs" onclick="return confirm('Hapus produk <?php echo $d1['nama_produk'] ?>.?')">Hapus</a>
                </td>
              </tr>
            <?php } ?>
            
          </table>
        </div>


      </div>
    </div>
  </div>


















