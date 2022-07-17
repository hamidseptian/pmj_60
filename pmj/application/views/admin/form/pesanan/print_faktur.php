

<?php   
$bulan = array('', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');

 ?>
 <style>
  .font_laporan{
    font-size:11px;
    font-family: 'arial';
  }
 


  .logo{
   float:left;
   width : 70px;
  }
  .clearfix{
   clear:both;
   
  }
  .kop{
    margin-left:30px;
   font-family: 'arial';
  }
  .garis_kop1{
    margin-top:5px;
    border-width: 1.6px;
      border-style: solid;
  }
  .garis_kop2{
    margin-top:1px;
    border-width: 1px;
      border-style: solid;
  }

  .ratatengah{
    text-align:center;
  }


  .table {
    
    border-collapse: collapse;
    width:100%;
}
.table td, th {
    border: 0.01em solid ;
    padding:3px;
}
</style>

<body>
  <div class="logo">
  <img src="<?php echo base_url() ?>file/logo.PNG" >
</div>
<div >
    <div class="kop">
      <div><b>GELATO ROMANCE</b></div>
      <div class="alamat">
        Jl. Belakang Pasar Siteba No. 35, Nanggalo, Padang <br> Email : romancegelato@gmail.com <br>  
      HP : 081221758374
    </div>


     
    </div>
  </div>
  <div class="clearfix"></div>

<div class="garis_kop1"></div>
<div class="garis_kop2"></div>

 <div class="ratatengah"> 
  <h4>FAKTUR PEMESANAN</h4>   
 </div>

  <div style="width:50%;float:left" >
    <table class="font_laporan">
      <tr>  
        <td valign="top">No Faktur</td>
        <td valign="top">:</td>
        <td valign="top"> <?php echo $faktur['no_faktur'] ?> </td>
      </tr>
      <tr>  
        <td valign="top">Nama</td>
        <td valign="top">:</td>
        <td valign="top"> <?php echo $faktur['nama_pelanggan'] ?> </td>
      </tr>
      <tr>  
        <td valign="top">Alamat Pengiriman</td>
        <td valign="top">:</td>
        <td valign="top"> <?php echo $faktur['alamat_pelanggan'] ?> </td>
      </tr>
      <tr>  
        <td valign="top">No HP</td>
        <td valign="top">:</td>
        <td valign="top"> <?php echo $faktur['nohp_pelanggan'] ?> </td>
      </tr>
      <tr>  
        <td valign="top">Tgl Pemesanan</td>
        <td valign="top">:</td>
        <td valign="top"> <?php echo $faktur['tanggal_pemesanan'] ?> </td>
      </tr>
      <tr>  
        <td valign="top">Tgl Pengambilan</td>
        <td valign="top">:</td>
        <td valign="top"> <?php echo $faktur['tgl_pengambilan'] ?> </td>
      </tr>
    </table>
  </div>
  <div style="width:50%; float:right" >
    <table class="font_laporan">
      <tr>  
        <td valign="top">Metode Pembayaran</td>
        <td valign="top">:</td>
        <td valign="top">
          <?php echo $pembayaran['metode_pembayaran'] ?><br>
                 No Rekening : <?php echo $pembayaran['no_rek'] ?><br>
                 Atas Nama : <?php echo $pembayaran['nama_rek'] ?>
        </td>
      </tr>
      <tr>  
        <td valign="top">Metode Pengantaran</td>
        <td valign="top">:</td>
        <td valign="top"> <?php echo   $pengantaran['metode_pengantaran'] ?> </td>
      </tr>
    </table>
  </div>
  <div style="width:50%"></div>


  <div class="clearfix"></div>
<br>      
    <table class="table font_laporan  ">
      <tr>
        <td>No</td>
        <td>Produk</td>
        <td>Tipe</td>
        <td>Qty</td>
        <td>Biaya Penanganan</td>
        <td>Wrapping</td>
        <td>Topping</td>
        <td>Qty</td>
        <td>Biaya Topping</td>
        <td>Jumlah</td>
        <td>Total</td>
      </tr>
       <tbody>
                <?php 
                $no=1;
                $total_harga = 0;
                $total_harga_semuanya =0;
                foreach ($pesanan as $k => $v) {
                  if ($v['gambar_order']=='') {
            $gambar=base_url().'file/produk/default.JPG';
            # code...
          }else{
            $gambar=base_url().'file/produk/gambar/'.$v['gambar_order'];
          }
                $id_pesanan = $v['id_order']; 
                $q_topping =$this->db->query("SELECT tp.*, t.* from topping_pesanan tp left join topping t on tp.id_topping=t.id_topping where tp.id_order='$id_pesanan'");
                $j_topping = $q_topping->num_rows();
                $rowspan = $j_topping +1;

                $total_harga_jasa =$v['biaya'] * $v['qty'];
                $total_harga  += $total_harga_jasa ;
                ?>
                <tr>
                  <td ><?php echo $no++ ?></td>
                  <td><img src="<?php echo $gambar ?>" width="100px"></td>
                  <td ><?php echo $v['nama_produk'] ?></td>
                  <td ><?php echo $v['qty'] ?></td>
                  <td><?php echo number_format($v['biaya']) ?></td>
                  <td ><?php echo $v['wrapping'] ?></td>
                  <td>
                    <?php   if ($q_topping->num_rows()==0) {
                      echo "-";
                    }else{
                      foreach ($q_topping->result_array() as $k_t => $v_t) { 
                          echo $v_t['nama_topping'].'<br>';
                        }
                    } ?>
                  </td>
                  <td>
                    <?php   if ($q_topping->num_rows()==0) {
                      echo "-";
                    }else{
                      foreach ($q_topping->result_array() as $k_t => $v_t) { 
                          echo $v_t['qty_topping'].'<br>';
                        }
                    } ?>
                  </td>
                  <td>
                    <?php   if ($q_topping->num_rows()==0) {
                      echo "-";
                    }else{
                      foreach ($q_topping->result_array() as $k_t => $v_t) { 
                      
                          echo $v_t['harga'].'<br>';
                        }
                    } ?>
                  </td>
                  <td>
                    <?php   
                    $total_topping_gabungan = 0;
                    if ($q_topping->num_rows()==0) {
                      echo "-";
                    }else{
                      foreach ($q_topping->result_array() as $k_t => $v_t) { 
                          $total_harga_topping  =$v_t['harga'] *$v_t['qty_topping'];
                          $total_topping_gabungan   += $total_harga_topping ;
                          echo $total_harga_topping .'<br>';
                        }
                    } ?>
                  </td>
                  <td><?php 
                      $total_order = ($v['biaya'] * $v['qty'] ) + $total_topping_gabungan ; 
                      echo number_format($total_order)  ;
                      $total_harga_semuanya   += $total_order ;
                   ?> 
                 </td>
                  
               
                </tr>
              
                

                <?php } ?>
                <tr>
                  <td colspan="10" align="center">Ongkir (Rp.)</td>
                  <td> <?php echo number_format($faktur['ongkir']) ?> </td>
                </tr>
                <tr>
                  <td colspan="10" align="center">Total Pembayaran (Rp.)</td>
                  <td> <?php echo number_format($total_harga_semuanya) ?>  </td>
                </tr>
        </tbody>
    </table>
    <br>  <br>  

  <div style="width:50%;float:left" >
   
  </div>
  <div style="width:25%; float:right" class="font_laporan">
   <div class="ratatengah">
     Padang, <?php echo date('d').' '.$bulan[date('n')].' '.date('Y') ?> <br>
     Hormat Kami 
     <br><br><br><br>
     <?php echo $faktur['nama'] ?>
   </div>
  </div>
</body>

