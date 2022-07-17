

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Gelato Romance</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
<!--Less styles -->
   <!-- Other Less css file //different less files has different color scheam
  <link rel="stylesheet/less" type="text/css" href="<?php echo base_url() ?>bootstrap_shop/themes/less/simplex.less">
  <link rel="stylesheet/less" type="text/css" href="<?php echo base_url() ?>bootstrap_shop/themes/less/classified.less">
  <link rel="stylesheet/less" type="text/css" href="<?php echo base_url() ?>bootstrap_shop/themes/less/amelia.less">  MOVE DOWN TO activate
  -->
  <!--<link rel="stylesheet/less" type="text/css" href="<?php echo base_url() ?>bootstrap_shop/themes/less/bootshop.less">
  <script src="<?php echo base_url() ?>bootstrap_shop/themes/js/less.js" type="text/javascript"></script> -->
  
<!-- Bootstrap style --> 
    <link id="callCss" rel="stylesheet" href="<?php echo base_url() ?>bootstrap_shop/themes/bootshop/bootstrap.min.css" media="screen"/>
    <link href="<?php echo base_url() ?>bootstrap_shop/themes/css/base.css" rel="stylesheet" media="screen"/>
<!-- Bootstrap style responsive --> 
  <link href="<?php echo base_url() ?>bootstrap_shop/themes/css/bootstrap-responsive.min.css" rel="stylesheet"/>
  <link href="<?php echo base_url() ?>bootstrap_shop/themes/css/font-awesome.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url() ?>adminlte/bower_components/font-awesome/css/font-awesome.min.css">
    <script type="text/javascript" src="<?php echo base_url() ?>adminlte/js/jquery.js"></script>
<!-- Google-code-prettify --> 
  <link href="<?php echo base_url() ?>bootstrap_shop/themes/js/google-code-prettify/prettify.css" rel="stylesheet"/>
<!-- fav and touch icons -->
    <link rel="shortcut icon" href="<?php echo base_url() ?>file/logo.jpeg">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo base_url() ?>bootstrap_shop/themes/images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo base_url() ?>bootstrap_shop/themes/images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo base_url() ?>bootstrap_shop/themes/images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="<?php echo base_url() ?>bootstrap_shop/themes/images/ico/apple-touch-icon-57-precomposed.png">
  <style type="text/css" id="enject"></style>
  </head>
<body>
<div id="header">
<div class="container">
<!-- Navbar ================================================== -->
<div id="logoArea" class="navbar">
<a id="smallScreen" data-target="#topMenu" data-toggle="collapse" class="btn btn-navbar">
  <span class="icon-bar"></span>
  <span class="icon-bar"></span>
  <span class="icon-bar"></span>
</a>
  <div class="navbar-inner">
    <a class="brand" href="index.html"><img src="<?php echo base_url() ?>file/logo.jpeg" alt="Bootsshop" width="70px" /></a>
    <form class="form-inline navbar-search" method="post" action="<?php echo base_url() ?>homepage/produk" >
    <input class="srchTxt" type="text" name="keyword" placeholder="Cari Produk" />
    
      <button type="submit" id="submitButton" class="btn btn-primary">Go</button>
    </form>
    <ul id="topMenu" class="nav pull-right">
  <!--  <li class=""><a href="?h=daftar_akun">Buat Akun Pelanggan</a></li>
   <li class=""><a href="?h=daftar_toko">Daftarkan Toko</a></li> -->
     <?php if ($this->session->userdata('level')=='pelanggan') { ?>
   <a href="<?php echo base_url() ?>auth/logout"  style="padding-right:0"><span class="btn btn-large btn-success">Logout</span></a>
 <?php }else{ ?>
   <a href="#login" role="button" data-toggle="modal" style="padding-right:0"><span class="btn btn-large btn-success">Login</span></a>
 <?php } ?>
  <div id="login" class="modal hide fade in" tabindex="-1" role="dialog" aria-labelledby="login" aria-hidden="false" >
      <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      <h3>Anda akan login sebagai.?</h3>
      </div>
      <div class="modal-body">
      
      <center>
        <a href="<?php echo base_url() ?>homepage/login_pelanggan" class="btn btn-success btn-xs">Pelanggan</a>
      <a href="<?php echo base_url() ?>homepage/login_admin" class="btn btn-success btn-xs">Admin</a>
      </center>
      </div>
  </div>

    </ul>
  </div>
</div>
</div>
</div>





<div id="mainBody">
  <div class="container">
  <div class="row">



    <div id="carouselBlk">
  <div id="myCarousel" class="carousel slide">
    <div class="carousel-inner">


      
    </div>
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">&lsaquo;</a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">&rsaquo;</a>
    </div> 
</div>
<br>  


<!-- Sidebar ================================================== -->
  <div id="sidebar" class="span3">
    
    <?php if ($this->session->userdata('level')=='pelanggan') { 
      $id_user = $this->session->userdata('id_user');
      $user= $this->db->query("SELECT * from pelanggan where id_pelanggan='$id_user'")->row_array();

    ?>
      <div class="well well-small"><a id="myCart" href="product_summary.html"><img  src="<?php echo base_url() ?>file/gambar/user.jpg" tyle="width:100%" alt="cart"><center><?php echo $user['nama_pelanggan'] ?></center></a></div>

    <ul id="sideManu" class="nav nav-tabs nav-stacked">
     
      <li><a href="<?php echo base_url() ?>homepage/produk" style="color:blue">Produk</a></li>
      <li><a href="<?php echo base_url() ?>homepage/cara_pesan" style="color:blue">Cara Pemesanan</a></li>
      <li><a href="<?php echo base_url() ?>homepage/cp" style="color:blue">Contact Person</a></li>
    </ul>
<br>
    <ul id="sideManu" class="nav nav-tabs nav-stacked">
     
      <li><a href="<?php echo base_url() ?>user/pelanggan/dashboard">Dashboard</a></li>
      <li><a href="<?php echo base_url() ?>user/pelanggan/keranjang" style="color:blue" >Keranjang</a></li>
      <li><a href="<?php echo base_url() ?>user/pelanggan/order" >Pemesanan</a></li>
      <li><a href="<?php echo base_url() ?>user/pelanggan/user/edit_akun" style="color:blue">Edit Akun</a></li>
    </ul>
    <br>
  <?php } else{ ?>
     <ul id="sideManu" class="nav nav-tabs nav-stacked">
     
      <li><a href="<?php echo base_url() ?>homepage/produk" style="color:blue">Produk</a></li>
      <li><a href="<?php echo base_url() ?>homepage/cara_pesan" style="color:orange">Cara Pemesanan</a></li>
      <li><a href="<?php echo base_url() ?>homepage/cp" style="color:blue">Contact Person</a></li>
    </ul>


    <br>

    <ul id="sideManu" class="nav nav-tabs nav-stacked">
     
      <li><a href="<?php echo base_url() ?>homepage/daftar" style="color:blue">Daftar Akun</a></li>
    </ul>

<?php } ?>
   <!--  <ul id="sideManu" class="nav nav-tabs nav-stacked">
      
      <li class="subMenu"><a> Daftar Restoran </a>
      <ul style="display:none">
        <li>svscnj</li>        
      <li><a href="?h=data_toko">Lihat Data toko</a></li>
     
    </ul> -->
    <br/>
  
 
    <br/>
     
  </div>
<!-- Sidebar end=============================================== -->
    <div class="span9">   

         <?php echo $konten ?>
        <?php   
        // if (isset($_GET['h'])) {
        //   include "template/konten.php";
        // }else{
        //    if (isset($_SESSION['login'])==true &&isset($_SESSION['level'])=='Pelanggan') { 
        //       include "form/dashboard/dashboard_pelanggan.php";
        //     }else{
        //       include "form/produk/data_produk.php";
        //   }
        // }
         ?>
        
    </div>
    </div>
  </div>
</div>
<!-- Footer ================================================================== -->
  <div  id="footerSection">
  <div class="container">
    <div class="row">
      <div class="span12">
        <h5>Gelato Romance</h5>
        Jl. Belakang Pasar Siteba No. 35, Nanggalo, Padang <br>
        Email : romancegelato@gmail.com <br>
        HP : 081221758374
     
       </div>
     
     </div>
    <!-- <p class="pull-right">&copy; Bootshop</p> -->
  </div><!-- Container End -->
  </div>
<!-- Placed at the end of the document so the pages load faster ============================================= -->
  <script src="<?php echo base_url() ?>bootstrap_shop/themes/js/jquery.js" type="text/javascript"></script>
  <script src="<?php echo base_url() ?>bootstrap_shop/themes/js/bootstrap.min.js" type="text/javascript"></script>
  <script src="<?php echo base_url() ?>bootstrap_shop/themes/js/google-code-prettify/prettify.js"></script>
  
  <script src="<?php echo base_url() ?>bootstrap_shop/themes/js/bootshop.js"></script>
    <script src="<?php echo base_url() ?>bootstrap_shop/themes/js/jquery.lightbox-0.5.js"></script>
  
  <!-- <?php echo base_url() ?>bootstrap_shop/Themes switcher section ============================================================================================= -->

<span id="<?php echo base_url() ?>bootstrap_shop/themesBtn"></span>
</body>
</html>