 <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Detail Pengunjung</h3>
          <div class="pull-right">
            <a href="#" class="btn btn-info"  onclick="form_tambah_anggota()">Tambah</a>
            <a href="<?php echo base_url('user/admin/pengunjung') ?>" class="btn btn-info">Kembali</a>
          </div>
        </div>
        <div class="box-body">
          
          
            <div class="form-group">
              
              <table class="table">
                <tr>
                  <td>Tanggal Kunjungan</td>
                  <td>:</td>
                  <td><?php echo $pengunjung['tgl_kunjungan'] ?></td>
                </tr>
                <tr>
                  <td>Nama Kelompok</td>
                  <td>:</td>
                  <td><?php echo $pengunjung['nama_kelompok'] ?></td>
                </tr>
                <tr>
                  <td>Penanggung Jawab</td>
                  <td>:</td>
                  <td><?php echo $pengunjung['nama'] ?></td>
                </tr>
                <tr>
                  <td>No HP Penanggung Jawab</td>
                  <td>:</td>
                  <td><?php echo $pengunjung['nohp'] ?></td>
                </tr>
              </table>
              <hr>
              <table class="table">
                <tr>
                  <td>No</td>
                  <td>Nama</td>
                  <td>Alamat</td>
                  <td>No HP</td>
                  <td>Menu</td>
                  <td>Harga Total</td>
                  <td>Option</td>
                </tr>
              <?php foreach ($detail_pengunjung as $k => $v) { 
                $id_detail_pengunjung = $v['id_detail_pengunjung'];
                $q_pesanan = $this->db->query("SELECT * from pesanan p
                  left join produk pr on p.id_produk=pr.id_produk
                  where p.id_detail_pengunjung='$id_detail_pengunjung'
                  ")->result_array();
                ?>
                <tr>
                  <td></td>
                  <td><?php echo $v['nama'] ?></td>
                  <td><?php echo $v['alamat'] ?></td>
                  <td><?php echo $v['no_hp'] ?></td>
                  <td>
                    <ol>
                      <?php 
                      $harga_total = 0;
                      foreach ($q_pesanan as $k_p => $v_p) { 
                        $total = $v_p['harga'] * $v_p['qty'];
                        $harga_total += $total ; 
                        ?>
                        <li>
                          <?php echo $v['nama_produk'] ?> [<?php echo $v_p['qty'] ?>] [Rp. <?php echo number_format($v_p['harga']) ?>] 
                          [<?php echo number_format($total) ?>]
                           <a href=""><i class="fa fa-trash"></i></a>
                        </li>
                      <?php } ?>
                    </ol>
                  </td>
                  <td><?php echo number_format($harga_total) ?></td>
                  <td>
                    <a href="" class="btn btn-info btn-xs"  data-toggle="modal" data-target="#tambah_menu_<?php echo $id_detail_pengunjung ?>">Tambah Menu</a>
                    <a href="" class="btn btn-info btn-xs">Hapus</a>
                  </td>
                </tr>










  <div class="modal modal-default fade" id="tambah_menu_<?php echo $id_detail_pengunjung ?>">
    <form action="<?php echo base_url('user/admin/pengunjung/simpan_tambah_menu') ?>" method='post'>
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tambah Menu <br><?php echo $v['nama'] ?></h4>
              </div>
              <div class="modal-body">
                <input type="hidden" name="id" class="form-control" required value="<?php echo $id_detail_pengunjung ?>">
                <input type="hidden" name="id_pengunjung" class="form-control" required value="<?php echo $pengunjung['id_pengunjung'] ?>">
                <div class="form-group">
                  <label>Menu</label>
                  <select name="produk" class="form-control">
                    <?php foreach ($produk as $key => $v) { ?>
                      <option value="<?php echo $v['id_produk'] ?>"><?php echo $v['nama_produk'] ?></option>
                    <?php } ?>
                     
                   
                  </select>
                </div>
                <div class="form-group">
                  <label>Qty</label>
                  <input type="text" name="qty" class="form-control" required>
                </div>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-info pull-left" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-info">Simpan</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </form>
      </div>
              <?php } ?>
              </table>
             
            </div>


          </form>
        </div>


      </div>
    </div>
  </div>




  <div class="modal modal-default fade" id="tambah">
    <form action="<?php echo base_url('user/admin/pengunjung/simpan_detail') ?>" method='post'>
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Primary Modal</h4>
              </div>
              <div class="modal-body">
                <input type="hidden" name="id" class="form-control" required value="<?php echo $pengunjung['id_pengunjung'] ?>">
                



                <div class="form-group">
                  <label>Nama</label>
                  <input type="text" name="nama" class="form-control" required >
                </div>
                <div class="form-group">
                  <label>Alamat</label>
                  <input type="text" name="alamat" class="form-control" required >
                </div>
                <div class="form-group">
                  <label>No HP</label>
                  <input type="text" name="nohp" class="form-control" required >
                </div>
                <div class="form-group">
                  <label>Pendidikan</label>
                  <select name="pendidikan" class="form-control">
                    <option>TK</option>
                    <option>SD</option>
                    <option>SMP</option>
                    <option>SMA</option>
                  </select>
                </div>
                <div class="form-group">
                  <label>Menu</label>
                  <select name="produk" class="form-control">
                    <?php foreach ($produk as $key => $v) { ?>
                      <option value="<?php echo $v['id_produk'] ?>"><?php echo $v['nama_produk'] ?></option>
                    <?php } ?>
                     
                   
                  </select>
                </div>
                <div class="form-group">
                  <label>Qty</label>
                  <input type="text" name="qty" class="form-control" required>
                </div>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-info pull-left" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-info">Simpan</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </form>
      </div>