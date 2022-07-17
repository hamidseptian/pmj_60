<form action="<?php echo base_url('user/admin/pengunjung/simpan') ?>" method='post'>
 <div class="row">
    <div class="col-md-6">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Tambah Penunjung</h3>
          <div class="pull-right">
            <a href="<?php echo base_url('user/admin/kembali') ?>" class="btn btn-info" onclick="return confirm('Apakah anda akan kembali, jika kembali data akan hilang dan tidak tersimpan. \nlanjutkan.?')">Kembali</a>
          </div>
        </div>
        <div class="box-body">
          
            <div class="form-group">
              <label>Tanggal Kunjungan</label>
              <input type="hidden" name="action" class="form-control" value="tambah">
              <input type="date" name="tgl" class="form-control" required value="<?php echo date('Y-m-d') ?>">
            </div>
            <div class="form-group">
              <label>Jam Kunjungan</label>
              <input type="time" name="jam" class="form-control" required value="<?php echo date('H:i') ?>">
            </div>
            <div class="form-group">
              <label>Kategori</label>
              <select name="kategori" class="form-control" id="kategori">
                <option value="">Pilih Kelompok</option>
                <option value="Pribadi" <?php if($pesanan->num_rows()>0 || $kategori_pemesan_aktif=='Pribadi'){echo "selected";} ?>>Pribadi</option>
                <option value="Kelompok" <?php if($kategori_pemesan_aktif=='Kelompok'){echo "selected";} ?>>Kelompok</option>
              </select>
            </div>

            <div class="form-group" id="form_kelompok" style="display:none">
              <label>Nama Kelompok</label>
              <input type="text" name="nama" class="form-control" id="nama_kelompok">
            </div>
            <div class="form-group">
              <input type="hidden" name="id_pelanggan_pemesan" id="id_pelanggan_pemesan">
              <table class="table">
                <tr>
                  <td style="width: 80px">Nama</td>
                  <td style="width: 10px">:</td>
                  <td id="nama_show"></td>
                </tr>
                <tr>
                  <td>No HP</td>
                  <td>:</td>
                  <td id="nohp_show"></td>
                </tr>
              </table>
            </div>
           
            <div class="form-group" hidden="true">
              <label>Status</label>
              <select name="status" class="form-control">
                <option value="Booking">Booking</option>
                <option value="Langsung Di Tempat">Langsung Di Tempat</option>
              </select>
            </div>
            
            <div class="form-group">
              
            </div>
        </div>


      </div>
    </div>

     <div class="col-md-6">
     

      <div class="box" id="f_pelanggan_lama">
        <div class="box-header with-border">
          <h3 class="box-title">Pilih Data Pelanggan</h3>
          <div class="pull-right">
            <a href="<?php echo base_url('user/admin/pelanggan/tambah/pengunjung') ?>" class="btn btn-info">Pelanggan Baru</a>
          </div>
        
        </div>
        <div class="box-body">
          
          <table class="table table-striped table-bordered" id="tabel1">
            <thead>
              <tr>
                <td width="20px">No</td>
                <td>Nama</td>
                <td>No HP</td>
                <td>Email</td>
                <td>Pilih</td>
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

                <td><input type="radio" name="id_pelanggan_pilih" class="id_pelanggan_terpilih" value="<?php echo $d1['id_pelanggan'] ?>"></td>
             
           
              </tr>
            <?php } ?>
            
          </table>
        </div>


      </div>
    </div>

  </div>




  <div class="row" id="f_produk_keranjang" <?php if($pesanan->num_rows()==0){echo 'style="display: none"';} ?>>
    
     <div class="col-md-6">
      <div class="box" id="f_pelanggan_lama">
        <div class="box-header with-border">
          <h3 class="box-title">Produk</h3>
        </div>
        <div class="box-body">
          Tampilkan data ptoduk untuk dipilih oleh pelanggan
          <table class="table table-striped table-bordered" id="tabel1">
            <thead>
              <tr>
                <td width="20px">No</td>
                <td>Gambar</td>
                <td>Produk</td>
                <td>Keterangan</td>
                <td>Harga</td>
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
                <td>
                  <a href="#" class="btn btn-info btn-xs"  data-toggle="modal" data-target="#modal_detail_produk" onclick="detail_produk('<?php echo $d1['nama_produk'] ?>','<?php echo $d1['id_produk'] ?>','<?php echo number_format($d1['harga']) ?>','','tambah','')">Pilih</a>
                
                </td>
              </tr>
            <?php } ?>
          </table>
        </div>
      </div>
    </div>
     <div class="col-md-6">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Pesanan Dipilih</h3>
        </div>
        <div class="box-body">
          <?php echo $this->session->flashdata('pesan_pesanan') ?>
          <table class="table table-striped table-bordered" id="tabel1">
            <thead>
              <tr>
                <td width="20px">No</td>
                <td>Produk</td>
                <td>Harga</td>
                <td>Poin Produk</td>
                <td>Jumlah Pesanan</td>
                <td>Total harga</td>
                <td>Poin Didapatkan</td>
                <td width="90px">Option</td>
              </tr>
            </thead>
            <?php 
            $no=1;
            $total_harga_semua = 0;
            $poin_didapatkan =0;
            foreach ($pesanan->result_array() as $d1) { 
              $harga_total = $d1['qty'] * $d1['harga'] ;
              $poin_1_produk = $d1['qty'] * $d1['poin'] ;
              $poin_didapatkan += $poin_1_produk;
              $total_harga_semua += $harga_total;
              ?>
              <tr>
                <td><?php echo $no++ ?></td>
               
                <td><?php echo $d1['nama_produk'] ?></td>
                <td><?php echo number_format($d1['harga']) ?></td>
                <td><?php echo $d1['poin'] ?></td>
                <td><?php echo $d1['qty'] ?></td>
                <td><?php echo number_format($harga_total) ?></td>
                <td><?php echo $poin_1_produk ?></td>
                <td>
                  <button type="button" class="btn btn-info btn-xs"  data-toggle="modal"  data-target="#modal_detail_produk" onclick="detail_produk('<?php echo $d1['nama_produk'] ?>','<?php echo $d1['id_produk'] ?>','<?php echo number_format($d1['harga']) ?>','<?php echo $d1['qty'] ?>','edit','<?php echo $d1['id_pesanan'] ?>')">Edit</button>
                  <a href="<?php echo base_url('user/admin/pengunjung/hapus_pesanan/'.$d1['id_pesanan'].'/tambah') ?>" class="btn btn-info btn-xs" onclick="return">Hapus</a>
                  
                </td>
              </tr>
            <?php } ?>
            <tr>
              <td colspan="5">Total</td>
              <td><?php echo number_format($total_harga_semua) ?></td>
              <td colspan="2"><?php echo number_format($poin_didapatkan) ?></td>
            </tr>
          </table>
        </div>
      </div>
    </div>

  </div>

<input type="hidden" value="<?php echo $total_harga_semua ?>" name="total_harga">
<input type="hidden" value="<?php echo $poin_didapatkan ?>" name="poin">
<input type="submit" value="Simpan data Pengunjung" class="btn btn-info" id="tombol_simpan_pengunjung">
<br>
</form>


<form action="<?php echo base_url('user/admin/pengunjung/masuk_ke_keranjang') ?>" method="post" id="form_pesanan_produk">
  
 <div class="modal fade" id="modal_detail_produk">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Default Modal</h4>
              </div>
              <div class="modal-body">
                <input type="hidden" name="id_pesanan" id="id_pesanan">
                <input type="hidden" name="id_produk_terpilih" id="id_produk_terpilih">
                <input type="hidden" name="id_pelanggan_keranjang" id="id_pelanggan_keranjang">
                <table class="table">
                  <tr>
                    <td>Produk</td>
                    <td>:</td>
                    <td id="nama_produk_terpilih"></td>
                  </tr>
                   <tr>
                    <td>Harga</td>
                    <td>:</td>
                    <td id="harga_produk_terpilih"></td>
                  </tr>
                  <tr>
                    <td>Qty</td>
                    <td>:</td>
                    <td><input type="number" name="qty" id="qty" class="form-control"></td>
                  </tr>
                </table>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan Ke Keranjang</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
</form>
cattan : form produk dan pesanan dipilih digunakan hanya ketika pesanan pribadi <br>
untuk pesanan kelompok lakukan hal yang sama seperti  ini

<script type="text/javascript">
  identitas_pemesan_aktif(<?php echo $pemesan_aktif ?>, '<?php echo $kategori_pemesan_aktif ?>');

  function detail_produk(nama_produk, id_produk, harga_produk, qty, action, id_pesanan){
    $('#nama_produk_terpilih').html(nama_produk);
    $('#id_produk_terpilih').val(id_produk);
    $('#id_pesanan').val(id_pesanan);
    $('#qty').val(qty);
    $('#harga_produk_terpilih').html(harga_produk);

    if (action=='edit') {
      $('#form_pesanan_produk').attr('action', '<?php echo base_url('user/admin/pengunjung/simpanedit_keranjang') ?>');

    }else{
      $('#form_pesanan_produk').attr('action', '<?php echo base_url('user/admin/pengunjung/masuk_ke_keranjang') ?>');
    }
  }
  function pelanggan_pemesan_aktif(id_pelanggan){
    $.ajax({
      url : '<?php echo base_url('user/admin/pengunjung/pemesan_aktif/') ?>' + id_pelanggan,
      dataType : 'json',
      success : function(data){
        $('#nama_show').html(data.nama);
        $('#nohp_show').html(data.nohp);
        $('#id_pelanggan_pemesan').val(data.id_pelanggan);
      }
    });
  }
  $('.id_pelanggan_terpilih').click(function(){
    var id_pel = $(this).val();
    var kategori = $('#kategori').val();
    pelanggan_pemesan_aktif(id_pel);
    identitas_pemesan_aktif(id_pel, kategori);
    
  });

  function identitas_pemesan_aktif(id_pelanggan, kategori){
    $.ajax({
      url : '<?php echo base_url('user/admin/pelanggan/detail_pelanggan/') ?>' + id_pelanggan,
      dataType : 'json',
      success : function(data){
        $('#nama_show').html(data.nama);
        $('#nohp_show').html(data.nohp);
        $('#id_pelanggan_pemesan').val(data.id_pelanggan);
      }
    });
    $('#kategori option:selected').data(kategori);
    console.log(kategori);
    // $('#kategori').val(kategori).change();

  }
  $('#kategori').change(function(){
    var kategori = $('#kategori').val();
  	$.ajax({
      url : '<?php echo base_url('user/admin/pengunjung/simpan_kategori_terpilih/') ?>' + kategori,
      success : function(data){
      
      }
    })
    if (kategori=='Pribadi') {
      $('#form_kelompok').hide();
      $('#f_produk_keranjang').show();
      $('#nama_show').removeAttr('required','required');
    }else{
      $('#form_kelompok').show();
      $('#f_produk_keranjang').hide();
      $('#nama_show').attr('required','required');

    }
  });
  $('#tombol_simpan_pengunjung').click(function(){
    // var form_Data = $('#form_pemesanan').serialize();
    var id_pel = $('#id_pelanggan_pemesan').val();
    var kategori = $('#kategori').val();
    var keranjang = <?php echo $pesanan->num_rows() ?>;
    if (id_pel=='') {
      alert('Harap pilih pelanggan dulu');
      return false;
    }
    else if (kategori=='') {
      alert('Harap pilih Kategori');
      return false;
    }else{
      if (kategori=='Pribadi') {
          if (keranjang==0) {
            alert('Pesanan Kosong');
            return false;
          }else{
            return true;

          }
      }else{
        return true;

      }

    }
  });
</script>