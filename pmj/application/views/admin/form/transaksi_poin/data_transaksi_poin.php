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
                <td width="20px">No</td>
                <td>Pelanggan</td>
                <td>No HP</td>
                <td>Poin masuk</td>
                <td>Poin Poin Keluar</td>
                <td>Poin Tersisa</td>
                <td width="90px">Option</td>
              </tr>
            </thead>
            <?php 
            $no=1;
            foreach ($transaksi_poin as $d1) { 
              $id_pelanggan = $d1['id_pelanggan'];
              $q_poin_masuk = $this->db->query("SELECT sum(poin) as poin_masuk from transaksi_poin where id_pelanggan='$id_pelanggan' and status_poin='+'")->row_array();
              $q_poin_keluar = $this->db->query("SELECT sum(poin) as poin_keluar from transaksi_poin where id_pelanggan='$id_pelanggan' and status_poin='-'")->row_array();


                $poin_masuk=  $q_poin_masuk['poin_masuk'] =='' ? 0 : $q_poin_masuk['poin_masuk'];
                $poin_keluar=   $q_poin_keluar['poin_keluar'] =='' ? 0 : $q_poin_keluar['poin_keluar'];
                $sisa_poin = $poin_masuk - $poin_keluar ; 
              // $q_poin_masuk = $this->db->query()->row_array();
              ?>
              <tr>
                <td><?php echo $no++ ?></td>
                <td><?php echo $d1['nama'] ?></td>
                <td><?php echo $d1['nohp'] ?></td>
                <td><?php echo $poin_masuk ?></td>
                <td><?php echo $poin_keluar ?></td>
                <td><?php echo $sisa_poin ?></td>
                <td>
                 
                    <a href="<?php echo base_url('user/admin/transaksi_poin/riwayat/'.$d1['id_pelanggan']) ?>" class="btn btn-info btn-xs" >Riwayat</a>
                  
                </td>
              </tr>
            <?php } ?>
            
          </table>
        </div>


      </div>
    </div>
  </div>


















