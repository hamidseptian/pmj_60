<div class="row">
    <div class="col-12">
      <?php echo $this->session->flashdata('pesan');

$mata_pelajaran=$this->db->query("SELECT * from mata_pelajaran where jenis_mapel='Umum'")->result_array();
    $kumpul_mapel = [];
    foreach ($mata_pelajaran as $key => $value) {
      $data_db = [
        'id_mapel'=>$value['id_mapel'],
        'nama_mapel'=>$value['nama_mapel'],
      ];
      array_push($kumpul_mapel, $data_db);
    }

      $psk = [
        'id_mapel'=>'psikologi',
        'nama_mapel'=>'Psikologi',
      ];
      array_push($kumpul_mapel, $psk);
      $data['mata_pelajaran'] = $kumpul_mapel ;
       ?>
      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Edit Data</h3>

          <div class="card-tools">
            
          </div>
        </div>
        <div class="card-body">
          <form action="<?php echo base_url() ?>user/admin/siswa/simpanedit" method="post" enctype="multipart/form-data" id="form_input">
         <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>NIK</label>
                        <input  type="hidden" class="form-control" name="input" id="input">
                        <input  type="hidden" class="form-control" name="filelama" id="filelama">
                        <input  type="hidden" class="form-control" name="id_siswa" id="id_siswa">
                        <input required type="text" class="form-control" style="width: 100%;" id="nik"  name="nik" onkeypress="return hanyaAngka(event)">
                        <small id="catatan_nik"></small>
                      </div><div class="form-group">
                        <label>Nama</label>
                        <input required type="text" class="form-control" style="width: 100%;" id="nama"  name="nama">
                      </div>
                      <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <select class="form-control select2" style="width: 100%;" id="jenis_kelamin"  name="jenis_kelamin">
                          <option value="">Pilih Jenis Kelamin</option>
                          <option>Laki-laki</option>
                          <option>Perempuan</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label>Tempat Lahir</label>
                        <input required type="text" class="form-control" style="width: 100%;" id="tmpl" name="tmpl">
                      </div>
                      <div class="form-group">
                        <label>Tanggal Lahir</label>
                        <input required type="date" class="form-control" style="width: 100%;" id="tgll" name="tgll">
                      </div>
                       <div class="form-group">
                        <label>Agama</label>
                        <select class="form-control select2" style="width: 100%;" id="agama" name="agama">
                          <option value="">Pilih Agama</option>
                          <option>Islam</option>
                          <option>Kristen</option>
                          <option>Khatolik</option>
                          <option>Hindu</option>
                          <option>Budha</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label>Alamat</label>
                        <textarea class="form-control" style="width: 100%;" id="alamat"  name="alamat"></textarea>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>No HP</label>
                        <input required type="text" class="form-control" style="width: 100%;" id="nohp" name="nohp" onkeypress="return hanyaAngka(event)">
                      </div>
                      <div class="form-group">
                        <label>Email</label>
                        <input required type="email" class="form-control" style="width: 100%;" id="email" name="email">
                        <small id="catatan_email"></small>
                      </div>
                      <div class="form-group">
                        <label>Polres / Polsek Tujuan</label>
                        <input required type="text" class="form-control" style="width: 100%;" id="asal_polres" name="asal_polres">
                      </div>
                      <div class="form-group">
                        <label>Nama Orang Tua</label>
                        <input required type="text" class="form-control" style="width: 100%;" id="nama_orang_tua" name="nama_orang_tua">
                      </div>
                      <div class="form-group">
                        <label>Alamat Orang tua</label>
                        <textarea class="form-control" style="width: 100%;" id="alamat_orang_tua"  name="alamat_orang_tua"></textarea>
                      </div>
                      <div class="form-group">
                        <label>No HP Orang tua</label>
                        <input required type="text" class="form-control" style="width: 100%;" id="nohp_orang_tua" name="nohp_orang_tua" onkeypress="return hanyaAngka(event)">
                      </div>
                      <div class="form-group">
                        <label>Foto </label>
                        <input type="file" class="form-control" style="width: 100%;" id="berkas" name="berkas">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Media Sosial Aktif</label>
                        <table class="table">
                          <tr>
                            <td>Facebook</td>
                            <td><input type="text" class="form-control" id="fb"  name="fb"></td>
                          </tr>
                          <tr>
                            <td>Instagram</td>
                            <td><input type="text" class="form-control" id="ig"  name="ig"></td>
                          </tr>
                       
                        </table>
                      </div>
                      <div class="form-group">

                        <button type="submit" class="btn btn-primary" id="tbl_save" disabled="true">Simpan Siswa</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                      </div>
            
                    </div>
                    <div class="clearfix"></div>
                  </div>
                  </form>
        </div>
      <!-- /.card -->
    </div>
  </div>
</div>


<script type="text/javascript">

  edit_siswa('<?php echo $id_siswa ?>');
$('#form_input').on('submit', function(){
  if ($('#jenis_kelamin').val()=='') {
    alert('Jenis Kelamin belum dilipih');
     return false;
  }
  else if ($('#agama').val()=='') {
    alert('Agama belum dilipih');
     return false;
  }else{
     return true;

  }
});

$('#nik').keyup(function(){
  var nik = $('#nik').val();
  var input = $('#input').val();
  var id_siswa = $('#id_siswa').val();
  $.ajax({
      url:'<?php echo base_url() ?>user/admin/siswa/cek_nik/',
      data : { 
        nik : nik ,
        id_siswa : id_siswa ,
        input : input ,
      },
      type    : 'POST',
      success : function(data){
        if (data>0) {
         $('#catatan_nik').html('NIK '+nik+' sudah digunakan.');
         $('#tbl_save').attr('disabled','true');

        }else{
         $('#catatan_nik').html('');
         $('#tbl_save').removeAttr('disabled');

        }
      },
      error : function (){
        console.log('err');
      }

    });
});
$('#email').keyup(function(){
  var email = $('#email').val();
  var input = $('#input').val();
  var id_siswa = $('#id_siswa').val();
  $.ajax({
      url:'<?php echo base_url() ?>user/admin/siswa/cek_email/',
      data : { 
        email : email ,
        id_siswa : id_siswa ,
        input : input ,
      },
      type    : 'POST',
      success : function(data){
        if (data>0) {
         $('#catatan_email').html('email '+email+' sudah digunakan.');
         $('#tbl_save').attr('disabled','true');

        }else{
         $('#tbl_save').removeAttr('disabled');

        }
      },
      error : function (){
        console.log('err');
      }

    });
});
// $(document).ready(function(){
//   var id_siswa = $('#id_siswa').val();
//   if (id_siswa=='') {
//     alert('as');
//   }else{
//     alert('sa');

//   }
// });
  function edit_siswa(id_siswa){
     $('#tbl_save').removeAttr('disabled');
    $('#catatan_nik').html('');
    $('#catatan_email').html('');
    $('#title_modal').html('Edit Data Siswa');
    $('#tombol_simpan').hide();
    $('#tombol_simpanedit').show();
    $('#input').val('edit');
    $.ajax({
      url:'<?php echo base_url() ?>user/admin/siswa/detail_siswa/',
      data : { id_siswa : id_siswa },
       dataType: 'JSON',
      type    : 'POST',
      success : function(data){
        $('#nik').val(data.nik_siswa);
        $('#filelama').val(data.foto);
        $('#id_siswa').val(data.id_siswa);
        $('#nama').val(data.nama_siswa);
        $('#jenis_kelamin').val(data.jenis_kelamin).change();
        $('#agama').val(data.agama).change();
        $('#alamat').val(data.alamat);
        $('#nohp').val(data.nohp);
        $('#tmpl').val(data.tmpl);
        $('#tgll').val(data.tgll);
        $('#email').val(data.email);

        
        $('#asal_polres').val(data.asal_polres);
        $('#nama_orang_tua').val(data.nama_orang_tua);
        $('#alamat_orang_tua').val(data.alamat_orang_tua);
        $('#nohp_orang_tua').val(data.nohp_orang_tua);
        $('#berkas').val(data.berkas);
        $('#fb').val(data.fb);
        $('#ig').val(data.ig);
      },
      error : function (){
        console.log('err');
      }
    });
  }

</script>