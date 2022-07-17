
 <div class="modal fade" id="tambah">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="title_modal">Tambah Data guru</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
             <div class="card card-default">
              <form action="<?php echo base_url() ?>user/admin/guru/simpan" method="post" enctype="multipart/form-data" id="form_input">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>NIK</label>
                        <input  type="hidden" class="form-control" name="input" id="input">
                        <input  type="hidden" class="form-control" name="filelama" id="filelama">
                        <input  type="hidden" class="form-control" name="id_guru" id="id_guru">
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
                        <label>Riwayat Pekerjaan</label>
                        <textarea class="form-control" style="width: 100%;" id="riwayat_pekerjaan"  name="riwayat_pekerjaan" rows="4"></textarea>
                      </div>
                      
                      <div class="form-group">
                        <label>Foto </label>
                        <input type="file" class="form-control" style="width: 100%;" id="berkas" name="berkas">
                      </div>
                      <div class="form-group">
                        <label>Mata Pelajaran diajarkan</label>
                        <select class="form-control select2" name="mapel" id="mapel">
                          <option value="">Pilih Mata Pelajaran</option>
                          <?php 
                          $no =1;
                          foreach ($mata_pelajaran as $k => $v) { ?>
                            <option value="<?php echo $v['id_mapel'] ?>"><?php echo $v['nama_mapel'] ?></option>
                         <?php } ?>
                        </select>
                      </div>
                      <div class="form-group">

                        <button type="submit" class="btn btn-primary" id="tbl_save" disabled="true">Simpan guru</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                      </div>
            
                    </div>
                    <div class="clearfix"></div>
                  </div>
                </div>
              </form>
        </div>
            </div>
          </div>
      
        </div>

    </div>
