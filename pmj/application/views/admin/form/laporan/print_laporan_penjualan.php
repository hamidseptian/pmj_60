

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
  <h4>Laporan Data Penjualan Bouquet </h4>   
 </div>

  <div style="width:50%;float:left" >
    <table class="font_laporan">
      <tr>  
        <td valign="top">Periode</td>
        <td valign="top">:</td>
        <td valign="top"> semua data </td>
      </tr>
    
    </table>
  </div>


  <div class="clearfix"></div>
<br>      
      <table class="font_laporan" id="tabel1" style="border-collapse: collapse; " border=1 width="100%">
            <thead>
                <tr>
                  <th>No</th>
                  <th>No Faktur</th>
                  <th>Tanggal Pesan</th>
                  <th>Tanggal Pengambilan</th>
                  <th>Nama Pelanggan</th>
                  <th>Alamat</th>
                  <th>No HP</th>
                  <th>Produk</th>
                  <th>Qty</th>
                  <th>Biaya</th>
                  <th>Total</th>
                </tr>
            </thead>
            
             <tbody>
      <?php  
      $no=1;
      $total_semua =0;
      foreach ($faktur as $k => $v) { 
        $total = $v['qty']*$v['biaya'];
        $total_semua += $total?>
      <tr>
        <td><?php echo $no++ ?></td>
        <td><?php echo $v['no_faktur'] ?></td>
        <td><?php echo $v['tanggal_pemesanan'] ?></td>
        <td><?php echo $v['tgl_pengambilan'] ?></td>
        <td><?php echo $v['nama_pelanggan'] ?></td>
        <td><?php echo $v['alamat_pelanggan'] ?></td>
        <td><?php echo $v['nohp_pelanggan'] ?></td>
        <td><?php echo $v['nama_produk'] ?></td>
        <td><?php echo $v['qty'] ?></td>
        <td><?php echo number_format($v['biaya']) ?></td>
        <td><?php echo number_format($total ); ?></td>
    
      </tr>
      <?php } ?>
    </tbody>
    <tr> 
      <td colspan="10"><center> Total</center></td>
      <td><?php echo  number_format($total_semua ) ?></td>
    </tr>
          </table>
    <br>  <br>  

  <div style="width:50%;float:left" >
   
  </div>
  <div style="width:25%; float:right; display:none" class="font_laporan">
   <div class="ratatengah">
     Padang, <?php echo date('d').' '.$bulan[date('n')].' '.date('Y') ?> <br>
     Hormat Kami 
     <br><br><br><br>
     <?php echo $karyawan['nama'] ?>
   </div>
  </div>
</body>

