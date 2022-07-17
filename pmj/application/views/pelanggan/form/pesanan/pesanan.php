<ul class="breadcrumb">
		
		<li class="active"> Pesanan </li>
    </ul>

    <?php echo $this->session->flashdata('pesan') ?>
<?php 

if ($j_faktur==0) { ?>
	<ul class="breadcrumb">
		
		<li ><b><h4>Tidak ada data pemesanan</h4></b> </li>
    </ul>
<?php }else{
	
 ?>
  <table class="table table-bordered">
		<thead>
			<tr>
				<th>No</th>
        <th>No Faktur</th>
        <th>Tanggal Pesan</th>
        <th>Tanggal Pengambilan</th>
        <th>Total </th>
        <th>Status</th>
        <th>Option</th>
			</tr>
    </thead>
    <tbody>
      <?php  
      $no=1;
      foreach ($faktur as $k => $v) { ?>
      <tr>
        <th><?php echo $no++ ?></th>
        <th><?php echo $v['no_faktur'] ?></th>
        <th><?php echo $v['tanggal_pemesanan'] ?></th>
        <th><?php echo $v['tgl_pengambilan'] ?></th>
        <th><?php echo number_format($v['total']) ?></th>
        <th><?php echo $v['status'] ?></th>
        <th>
          <a href="<?php echo base_url() ?>user/pelanggan/order/detail_order/<?php echo $v['id_faktur'] ?>" class="btn btn-info btn-sm">Detail Order</a>
        </th>
      </tr>
      <?php } ?>
    </tbody>
		 
		
              	
             
				
  </table>

<?php } ?>