<!DOCTYPE html>
<!--
Template Name: Foxclore
Author: <a href="https://www.os-templates.com/">OS Templates</a>
Author URI: https://www.os-templates.com/
Copyright: OS-Templates.com
Licence: Free to use under our free template licence terms
Licence URI: https://www.os-templates.com/template-terms
-->
<html lang="">
<!-- To declare your language - read more here: https://www.w3.org/International/questions/qa-html-language-declarations -->
<head>
<title>Pizza Hut</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link href="<?php echo base_url('assets/foxclore') ?>/layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">

<link rel="stylesheet" href="<?= base_url()?>assets/bootstrap/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="<?= base_url()?>assets/bootstrap/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


<!-- jquery -->
  <script type="text/javascript" src="<?php echo base_url() ?>assets/js/jquery.js"></script>

<!-- ck editor -->
  <script type="text/javascript" src="<?php echo base_url() ?>assets/ckeditor/ckeditor.js"></script>
</head>
<body id="top">
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- Top Background Image Wrapper -->
<div class="bgded overlay" style="background-image:url('<?php echo base_url('assets/foxclore') ?>/images/demo/backgrounds/01.png');"> 
  <!-- ################################################################################################ -->
    <header id="header" class="hoc clear"> 
    <!-- ################################################################################################ -->
    <div id="logo" class="one_quarter first">
      <h1><a href="index.html">Pizza Hut</a></h1>
      <p>Pizza Maker Junior</p>
    </div>
    <div class="three_quarter">
      <ul class="nospace clear">
        <li class="one_third first">
          <div class="block clear"><a href="#"><i class="fas fa-phone"></i></a> <span><strong>Telpon:</strong> +00 (123) 456 7890</span></div>
        </li>
        <li class="one_third">
          <div class="block clear"><a href="#"><i class="fas fa-envelope"></i></a> <span><strong>Send us a mail:</strong> support@domain.com</span></div>
        </li>
        <li class="one_third">
          <div class="block clear"><a href="#"><i class="fas fa-clock"></i></a> <span><strong> Mon. - Sat.:</strong> 08.00am - 18.00pm</span></div>
        </li>
      </ul>
    </div>
    <!-- ################################################################################################ -->
  </header>
  <!-- ################################################################################################ -->
  <!-- ################################################################################################ -->
  <!-- ################################################################################################ -->
  <section id="navwrapper" class="hoc clear"> 
    <!-- ################################################################################################ -->
     <nav id="mainav">
      <ul class="clear">
        <li class="active"><a href="<?php echo base_url('home/beranda') ?>">Home</a></li>
        <li class="active"><a href="<?php echo base_url('home/beranda/login') ?>">Login</a></li>
       
        <!-- <li><a class="drop" href="#">Dropdown</a>
          <ul>
            <li><a href="#">Level 2</a></li>
            <li><a class="drop" href="#">Level 2 + Drop</a>
              <ul>
                <li><a href="#">Level 3</a></li>
                <li><a href="#">Level 3</a></li>
                <li><a href="#">Level 3</a></li>
              </ul>
            </li>
            <li><a href="#">Level 2</a></li>
          </ul>
        </li>
        <li><a href="#">Link Text</a></li>
        <li><a href="#">Link Text</a></li>
        <li><a href="#">Link Text</a></li>
        <li><a href="#">Long Link Text</a></li> -->
      </ul>
    </nav>
    </nav>
    <!-- ################################################################################################ -->

    <!-- ################################################################################################ -->
  </section>
  <!-- ################################################################################################ -->
  <!-- ################################################################################################ -->
  <!-- ################################################################################################ -->
  <div id="breadcrumb" class="hoc clear"> 
    <!-- ################################################################################################ -->
    <h6 class="heading"><?php echo $judul_konten ?></h6>
    <ul>
      <li><a href="#">Menu</a></li>
      <li><a href="#"><?php echo $menu ?></a></li>
    </ul>
    <!-- ################################################################################################ -->
  </div>
  <!-- ################################################################################################ -->
</div>
<!-- End Top Background Image Wrapper -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<?php echo $konten ?>
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<div class="bgded overlay row4" style="background-image:url('<?php echo base_url('assets/foxclore') ?>/images/demo/backgrounds/01.png');">
  <footer id="footer" class="hoc clear"> 
    <!-- ################################################################################################ -->
    <div class="center btmspace-50">
      <h6 class="heading">Pizza Hut</h6>
      <ul class="faico clear">
        <li><a class="faicon-dribble" href="#"><i class="fab fa-dribbble"></i></a></li>
        <li><a class="faicon-facebook" href="#"><i class="fab fa-facebook"></i></a></li>
        <li><a class="faicon-google-plus" href="#"><i class="fab fa-google-plus-g"></i></a></li>
        <li><a class="faicon-linkedin" href="#"><i class="fab fa-linkedin"></i></a></li>
        <li><a class="faicon-twitter" href="#"><i class="fab fa-twitter"></i></a></li>
        <li><a class="faicon-vk" href="#"><i class="fab fa-vk"></i></a></li>
      </ul>
      <p class="nospace">Sed pellentesque in nisi nulla facilisi sed pretium duis varius ut ut.</p>
    </div>
    <!-- ################################################################################################ -->
    <hr class="btmspace-50">
    <!-- ################################################################################################ -->
    <div class="col-md-12">
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.2778625196415!2d100.35688471440282!3d-0.9430763993120427!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2fd4b936d68894b7%3A0x7a21db1196782a3a!2sPizza%20Hut%20Restoran!5e0!3m2!1sid!2sid!4v1653104659267!5m2!1sid!2sid" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>

   
    <!-- ################################################################################################ -->
  </footer>
</div>
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<div class="wrapper row5">
  <div id="copyright" class="hoc clear"> 
    <!-- ################################################################################################ -->
    <p class="fl_left">Copyright © Bimbel Sanjaya |  Development By <a href="https://www.instagram.com/hamidseptian" target="_blank">Hamid Septian</a>.</p>
    <p class="fl_right">Template by <a target="_blank" href="https://www.os-templates.com/" title="Free Website Templates">OS Templates</a></p>
    <!-- ################################################################################################ -->
  </div>
</div>
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<a id="backtotop" href="#top"><i class="fas fa-chevron-up"></i></a>
<!-- JAVASCRIPTS -->
<script src="<?php echo base_url('assets/foxclore') ?>/layout/scripts/jquery.min.js"></script>
<script src="<?php echo base_url('assets/foxclore') ?>/layout/scripts/jquery.backtotop.js"></script>
<script src="<?php echo base_url('assets/foxclore') ?>/layout/scripts/jquery.mobilemenu.js"></script>
</body>
</html>


<script type="text/javascript">
     function hanyaAngka(evt) {
      var charCode = (evt.which) ? evt.which : event.keyCode
       if (charCode > 31 && (charCode < 48 || charCode > 57))
 
        return false;
      return true;
    }

  function base_url(){
    return "<?php echo base_url() ?>";
  }
</script>