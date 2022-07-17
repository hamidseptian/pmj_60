 <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Data Item Penukaran Poin</h3>
          <div class="pull-right">
          </div>
        </div>
        <div class="box-body">
          <?php echo $this->session->flashdata('pesan') ?>
          <table class="table table-striped table-bordered" id="tabel1">
            <thead>
              <tr>
                <td rowspan="2" width="20px">No</td>
                <td rowspan="2">Tanggal</td>
                <td rowspan="2">Poin Masuk</td>
                <td colspan="4">Poin Keluar</td>
              </tr>
              <tr>
                <td>Ditukarkan dengan</td>
                <td>Poin Dibutuhkan Per Item</td>
                <td>Qty Item</td>
                <td>Poin Digunakan</td>
              </tr>
            </thead>
            <?php 
            $no=1;
            $poin_masuk_total = 0;
            $poin_keluar_total = 0;
            foreach ($transaksi_poin as $d1) { 
             
              ?>
              <tr>
                <td><?php echo $no++ ?></td>
                <td><?php echo $d1['tgl_transaksi'] ?></td>
                <?php 
                if ($d1['status_poin']=='+') { 
                  $poin_masuk_total +=$d1['poin'];
                  ?>
                  <td><?php echo $d1['poin'] ?></td>
                  <td>-</td>
                  <td>-</td>
                  <td>-</td>
                  <td>-</td>
                <?php }else{ 
                  $poin_digunakan = $d1['poin_dibutuhkan'] * $d1['qty'];
                  $poin_keluar_total += $poin_digunakan ;
                  ?>
                  <td>-</td>
                  <td><?php echo $d1['nama_item_tukar_poin'] ?></td>
                  <td><?php echo $d1['poin_dibutuhkan'] ?></td>
                  <td><?php echo $d1['qty'] ?></td>
                  <td><?php echo $poin_digunakan ?></td>

                <?php } ?>
              
              </tr>
            <?php } 
              $sisa_poin = $poin_masuk_total - $poin_keluar_total ;  
            ?>
            <tr>
              <td colspan="2">Total</td>
              <td><?php echo $poin_masuk_total ?></td>
              <td colspan="4"><?php echo $poin_keluar_total ?></td>
            </tr>
            <tr>
              <td colspan="2">Sisa Poin</td>
              <td colspan="5"><?php echo $sisa_poin ?></td>
            </tr>
            
          </table>
          <?php if ($sisa_poin>0): ?>
            
          <button class="btn btn-info" type="button" onclick="tukarkan_poin(<?php echo $sisa_poin ?>)">Tukarkan</button>
          <?php endif ?>
        </div>


      </div>
    </div>
  </div>


<script type="text/javascript">
  function tukarkan_poin(sisa_poin){
    $('#tukarkan_poin').modal('show');
  }
</script>







<form action="<?php echo base_url('user/admin/pengunjung/masuk_ke_keranjang') ?>" method="post" id="form_penukaran_poin">
  
 <div class="modal fade" id="tukarkan_poin">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Poin Tersedia : <?php echo $sisa_poin ?></h4>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  
                  <table class="table table-bordered">
                    <tr>
                      <td>Item</td>
                      <td>Poin Dibutuhkan</td>
                      <td>Pilih Item</td>
                    
                    </tr>
                    <?php foreach ($item_tukar_poin as $k => $v) { ?>
                      <tr class="itemnya">
                        <td><?php echo $v['nama_item_tukar_poin'] ?></td>
                        <td class="poin_item_dibutuhkan"><?php echo $v['poin'] ?></td>
                        <td><input type="radio" name="item_dipilih" class="item_dipilih" value="<?php echo $v['id_item_tukar_poin'] ?>"></td>
                      </tr>
                    <?php } ?>
                  </table>
                </div>
                <div class="form-group">
                  <input type="hidden" name="id_item_terpilih" id="id_item_terpilih">
                  <input type="hidden" name="id_pelanggan" id="id_pelanggan" value="<?php echo $id_pelanggan ?>">
                  <table class="table">
                    <tr>
                      <td>Item</td>
                      <td>:</td>
                      <td id="item_terpilih"></td>
                    </tr>
                    <tr>
                      <td>Poin Dibutuhkan</td>
                      <td>:</td>
                      <td id="banyak_poin_dibutuhkan"></td>
                    </tr>
                    <tr>
                      <td>Qty</td>
                      <td>:</td>
                      <td><input type="number" name="qty" id="qty" required class="form-control"></td>
                    </tr>
                    <tr>
                      <td>Total Poin DIbutuhkan</td>
                      <td>:</td>
                      <td id="total_poin_dibutuhkan"></td>
                    </tr>
                  </table>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="tukarkan()">Tukarkan</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
</form>



<script type="text/javascript">
  $('.item_dipilih').click(function(){
    var id_item = $(this).val();

       var id_item_terpilih =  $('#tukarkan_poin').find('#id_item_terpilih').val(id_item);
    var qty =  $('#tukarkan_poin').find('#qty').val();
    $.ajax({
      url : '<?php echo base_url('user/admin/transaksi_poin/detail_item/') ?>' + id_item,
      dataType : 'json',
      success : function(data){
        var poin_digunakan = qty* data.poin;
        console.log(qty);
        $('#tukarkan_poin').find('#item_terpilih').html(data.nama_item_tukar_poin);
        $('#tukarkan_poin').find('#banyak_poin_dibutuhkan').html(data.poin);
        $('#tukarkan_poin').find('#total_poin_dibutuhkan').html(poin_digunakan);
        // $('#nohp_show').html(data.nohp);
        // $('#id_pelanggan_pemesan').val(data.id_pelanggan);
      }
    });
  });
  $('#qty').keyup(function(){
    var qty = $(this).val();
    var poin_item = $('#tukarkan_poin').find('#banyak_poin_dibutuhkan').html();
    var poin_dibutuhkan = qty*poin_item;
        $('#tukarkan_poin').find('#total_poin_dibutuhkan').html(poin_dibutuhkan);
    console.log(poin_dibutuhkan)
   
  });


  function tukarkan(){
       var id_item_terpilih =  $('#tukarkan_poin').find('#id_item_terpilih').val();
       var poin_penukaran =  $('#tukarkan_poin').find('#total_poin_dibutuhkan').html();
       var poin_tersedia =  <?php echo $sisa_poin ?>;
       var formdata = $('#form_penukaran_poin').serialize();
       console.log(formdata);

       var qty =  $('#tukarkan_poin').find('#qty').val();
       if (id_item_terpilih=='') {
          alert ('Anda belum memilih item');
       }
       else if (qty=='') {
          alert ('Harap input qty');
       }else{
         if (poin_penukaran > poin_tersedia) {
          alert ('Maaf, poin tidak cukup');
         }else{
          
          $.ajax({
            url : '<?php echo base_url('user/admin/transaksi_poin/simpan_transaksi_penukaran/') ?>',
            type : 'POST',
            data : formdata,
            success : function(data){
              window.location.href="<?php echo base_url('user/admin/transaksi_poin/riwayat/'.$id_pelanggan) ?>"
            },
            error : function(){
              console.log('e');
            }
          });
         }
       }

  }
</script>




