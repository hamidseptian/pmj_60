
  <div class="alert alert-info">Selamat Datang </div>

<div class="row">   
      <!-- <div id="gallery" class="span3">
        <img  src="../assets/user.jpg" style="width:100%" alt="">
      </div> -->
      <div class="span6">
        <h3><?php echo $user['nama_pelanggan'] ?></h3>
        Alamat : <?php echo $user['alamat_pelanggan'] ?><br> 
       
        No HP : <?php echo $user['nohp_pelanggan'] ?><br> 
        
      </div>
      
      

  </div>
      <hr class="soft">


<div class="row">   
      <div  class="span3">

        <div class="well well-small"><a href="<?php echo base_url() ?>user/pelanggan/keranjang"><center>Lihat Keranjang</center></a></div>
        
      </div>
    
      <div  class="span3">

        <div class="well well-small"><a href="<?php echo base_url() ?>user/pelanggan/order"><center>Riwayat Pemesanan</center> </a></div>
        
      </div>
      <div  class="span3">

        <div class="well well-small"><a href="<?php echo base_url() ?>user/pelanggan/user/edit_akun"><center>Edit Akun</center> </a></div>
        
      </div>
    
      <div  class="span3">

        
        
      </div>
    

  </div>













