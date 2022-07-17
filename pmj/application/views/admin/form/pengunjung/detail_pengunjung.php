 <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Detail Pengunjung</h3>
          <div class="pull-right">
           
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
                  <td>Pendidikan</td>
                  <td>Menu</td>
                  <td>Harga Total</td>
                  <td>Poin</td>
                  <td>Option</td>
                </tr>

                <tbody id="data_anggota">
                  
                </tbody>
              <?php foreach ($detail_pengunjung as $k => $v) { 
                $id_detail_pengunjung = $v['id_detail_pengunjung'];
                $q_pesanan = $this->db->query("SELECT * from pesanan p
                  left join produk pr on p.id_produk=pr.id_produk
                  where p.id_detail_pengunjung='$id_detail_pengunjung'
                  ")->result_array();
                ?>
                <tr style="display:none">
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
                 
                </tr>








              <?php } ?>
              </table>
             
            </div>


        </div>


      </div>
       <a href="#" class="btn btn-info"  onclick="form_tambah_anggota()">Tambah</a>
            <a href="<?php echo base_url('user/admin/pengunjung') ?>" class="btn btn-info">Kembali</a>
            <a href="<?php echo base_url('user/admin/pengunjung/konfirmasi_pesanan_kelompok/'.$pengunjung['id_pengunjung']) ?>" class="btn btn-info">Konfirmasi</a>
    </div>



  </div>

<script type="text/javascript">
  data_anggota(<?php echo $pengunjung['id_pengunjung'] ?>);


  function data_anggota(id_pengunjung){
            $('#data_anggota').html(``);
    var no = 0 ; 
      $.ajax({
        url : '<?php echo base_url('user/admin/pengunjung/data_anggota_kelompok/') ?>' + id_pengunjung,
        dataType : 'json',
        success : function(data){
          $.each(data, function (k,v){
            no++;
            $('#data_anggota').append(`
              <tr>
                <td>`+no+`</td>
                <td>`+v.nama+`</td>
                <td>`+v.alamat+`</td>
                <td>`+v.no_hp+`</td>
                <td>`+v.pendidikan+`</td>
                <td>`+ringkasan_pesanan_anggota(v.id_detail_pengunjung)+`</td>
                <td> ???? </td>

                 <td>
                    <button type="button" class="btn btn-info btn-xs"onclick="pesanan_anggota('`+v.id_detail_pengunjung+`')">Tambah Menu</button>
                    <button type="button" class="btn btn-info btn-xs"onclick=" hapus_anggota('`+v.id_detail_pengunjung+`')">Hapus</button>
                  </td>
              </tr>
              `)
          console.log(v);

          });
        }
      });

  }

  function ringkasan_pesanan_anggota(){

    // $.ajax({
    //     url : '<?php echo base_url('user/admin/pengunjung/list_pesanan_anggota_kelompok/') ?>'+ id_detail_pengunjung,
    //     dataType : 'json',
    //     success : function(data){

    //     $.each(data, function (k,v){

    //       var total_belanja = v.harga * v.qty;
    //       var total_poin = v.poin * v.qty;

    //       total_poin_pesanan+=total_poin;
    //       total_harga_pesanan+=total_belanja;
    //         no++;
    //         $('#ul_pesanan').append(`
             
    //             <li>`+v.nama_produk+`</li>
               
    //           `)

    //       });


    //     }
    //   });
  

    return "???????";

  }

  function hapus_anggota(id_detail_pengunjung){
    var konfirmasi = confirm("Hapus");
    if (konfirmasi==true) {
      


      $.ajax({
        url : '<?php echo base_url('user/admin/pengunjung/hapus_anggota_kelompok/') ?>' + id_detail_pengunjung,
        success : function(data){
          data_anggota(<?php echo $pengunjung['id_pengunjung'] ?>);
        },
        error : function(){
          alert('error');
        }
      });
    }else{
      
    }
  }


  function hapus_pesanan_anggota(id_pesanan, id_detail_pengunjung){
    var konfirmasi = confirm("Hapus");
    if (konfirmasi==true) {
      $.ajax({
        url : '<?php echo base_url('user/admin/pengunjung/hapus_pesanan_anggota/') ?>' + id_pesanan,
        success : function(data){
          list_pesanan_anggota(id_detail_pengunjung);
        }, 
        error : function(){
          console.log('error');
        }
      });
    }else{
      
    }
  }



  function form_tambah_anggota(){
    $('#tambah').modal('show');
  }
  function simpan_anggota(){
    var formdata = $('#form_tambah_anggota').serialize();
    
      $.ajax({
        url : '<?php echo base_url('user/admin/pengunjung/simpan_anggota_kelompok/') ?>',
        data : formdata,
        method : 'POST',
        dataType : 'json',
        success : function(data){

          $('#tambah').modal('hide');
          data_anggota(<?php echo $pengunjung['id_pengunjung'] ?>);
          pesanan_anggota(data.id_detail_pengunjung);
          // pesanan_anggota(3);
        }
      });
  }


  function pesanan_anggota(id_detail_pengunjung){
    $('#pesanan_anggota').modal('show');

    $('#tombol_tambah_pesanan').show();
    $('#f_pesanan_anggota').hide();

     $.ajax({
        url : '<?php echo base_url('user/admin/pengunjung/pesanan_anggota_kelompok/') ?>'+ id_detail_pengunjung,
        dataType : 'json',
        success : function(data){
          $('#pesanan_anggota').find('#nama_anggota').html(data.nama);
          $('#pesanan_anggota').find('#alamat_anggota').html(data.alamat);
          $('#pesanan_anggota').find('#no_hp_anggota').html(data.no_hp);
          $('#pesanan_anggota').find('#pendidikan_anggota').html(data.pendidikan);
          list_pesanan_anggota(id_detail_pengunjung);
          // pesanan_anggota(3);
        }
      });
  }

  function list_pesanan_anggota(id_detail_pengunjung){
    $('#id_detail_pengunjung_pesanan').val(id_detail_pengunjung);
    $('#data_pesanan_anggota').html(``);
    $('#qty_pesanan').val(``);
    var no = 0;
    var total_poin_pesanan = 0;
    var total_harga_pesanan = 0;
     $.ajax({
        url : '<?php echo base_url('user/admin/pengunjung/list_pesanan_anggota_kelompok/') ?>'+ id_detail_pengunjung,
        dataType : 'json',
        success : function(data){
          // console.log(data);
        

        $.each(data, function (k,v){

          var total_belanja = v.harga * v.qty;
          var total_poin = v.poin * v.qty;

          total_poin_pesanan+=total_poin;
          total_harga_pesanan+=total_belanja;
            no++;
            $('#data_pesanan_anggota').append(`
              <tr>
                <td>`+no+`</td>
                <td>`+v.nama_produk+`</td>
                <td>`+v.harga+`</td>
                <td>`+v.poin+`</td>
                <td>`+v.qty+`</td>
                <td>`+total_belanja+`</td>
                <td>`+total_poin+`</td>

                 <td>

                    <button type="button" class="btn btn-info btn-xs"onclick="hapus_pesanan_anggota('`+v.id_pesanan+`','`+v.id_detail_pengunjung+`')">Hapus</button>
                  </td>
              </tr>
              `)
          console.log(v);

          });


             $('#data_pesanan_anggota').append(`
              <tr>
                <td colspan="5">Total</td>
                <td>`+total_harga_pesanan+`</td>
                <td colspan="2">`+total_poin_pesanan+`</td>
              </tr>
              `)
        }
      });
  }



  function tambah_pesanan_anggota(){
    $('#tombol_tambah_pesanan').hide();

    $('#f_pesanan_anggota').show();
  }

  function hidden_form_pesanan(){
    $('#tombol_tambah_pesanan').show();

    $('#f_pesanan_anggota').hide();
  }
  function simpan_pesanan_anggota(){
    var data = $('#form_pesanan_anggota').serialize();
    var id_detail_pengunjung_pesanan = $('#id_detail_pengunjung_pesanan').val();
    var id_produk = $('#id_produk').val();
    var qty = $('#qty_pesanan').val();

    if (qty=='') {
      alert('Harap isikan jumlah pesanan');
    }else{



       $.ajax({
        url : '<?php echo base_url('user/admin/pengunjung/simpan_pesanan_anggota/') ?>',
        method : "POST",
        data : {
          'id_pengunjung' : <?php echo $pengunjung['id_pengunjung'] ?>,
          'id_detail_pengunjung_pesanan' : id_detail_pengunjung_pesanan,
          'id_produk' : id_produk,
          'qty' : qty,
        },
        method : 'POST',
        success : function(data){
          list_pesanan_anggota(id_detail_pengunjung_pesanan);
          // pesanan_anggota(3);
        },
        error : function(){
          console.log('error');
        }
      });



    }
   
  }
</script>



  <div class="modal modal-default fade" id="tambah">
    <form action="<?php echo base_url('user/admin/pengunjung/simpan_detail') ?>" method='post' id="form_tambah_anggota">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tambah Anggota Kelompok</h4>
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
               
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-info pull-left" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-info" onclick="simpan_anggota()">Simpan</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </form>
      </div>

  <div class="modal modal-default fade" id="pesanan_anggota">
    <form action="<?php echo base_url('user/admin/pengunjung/simpan_detail') ?>" method='post' id="form_tambah_anggota">
          <div class="modal-dialog modal-xl">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Pesanan Anggota Kelompok</h4>
              </div>
              <div class="modal-body">
                <div style="overflow-y: scroll; height: 500px">
                <input type="hidden" name="id" class="form-control" required value="<?php echo $pengunjung['id_pengunjung'] ?>">
                
               <div class="form-group">
                 <table class="table">
                   <tr>
                     <td>Nama</td>
                     <td>:</td>
                     <td id="nama_anggota"></td>
                   </tr>
                   <tr>
                     <td>Alamat</td>
                     <td>:</td>
                     <td id="alamat_anggota"></td>
                   </tr>
                   <tr>
                     <td>No HP</td>
                     <td>:</td>
                     <td id="no_hp_anggota"></td>
                   </tr>
                   <tr>
                     <td>Pendidikan</td>
                     <td>:</td>
                     <td id="pendidikan_anggota"></td>
                   </tr>
                 </table>
                </div>
                <div class="form-group">
                  <label>Pesanan</label>
                  


                  <table class="table table-striped table-bordered">
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
                    <tbody id="data_pesanan_anggota">
                      
                    </tbody>
                  </table>
                </div>
                <div class="form-group" id="f_pesanan_anggota" hidden="true">
                  <label> Tambah Pesanan</label>
                  

                  <form id="form_pesanan_anggota">
                    <input type="hidden" name="id_detail_pengunjung_pesanan" id="id_detail_pengunjung_pesanan">
                  <table class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <td>Produk</td>
                        <td>:</td>
                        <td>
                          <select class="form-control" name="id_produk" id="id_produk">
                            <?php foreach ($produk as $k => $v) { ?>
                              <option value="<?php echo $v['id_produk'] ?>"><?php echo $v['nama_produk'] ?></option>
                            <?php } ?>
                          </select>
                        </td>
                      
                      </tr>
                      <tr>
                        <td>QTY</td>
                        <td>:</td>
                        <td>
                          <input type="number" name="qty_pesanan" id="qty_pesanan" class="form-control">
                        </td>
                      
                      </tr>
                      <tr>
                        <td colspan="3">
                          <button type="button" onclick="simpan_pesanan_anggota()" class="btn btn-warning">Tambahkan</button>
                          <button type="button" onclick="hidden_form_pesanan()" class="btn btn-warning">Batal</button>
                        </td>
                      
                      </tr>
                    </thead>
                    <tbody id="data_pesanan_anggota">
                      
                    </tbody>
                  </table>
                  </form>
                </div>
               </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-info pull-left" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-warning" onclick="tambah_pesanan_anggota()" id="tombol_tambah_pesanan">Tambah Pesanan</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </form>
      </div>