  <div id="carouselBlk">
  <div id="myCarousel" class="carousel slide">
    <div class="carousel-inner">
      <?php 
      $no=0;
      $banner = $this->db->get('banner')->result_array();
      foreach ($banner as $d_banner) {
        $no++;?>



      <div class="item <?php if($no==1){echo "active";} ?>">
      <div class="container">
      <a href="#"><img style="width:100%" src="<?php echo base_url() ?>file/banner/gambar/<?php echo $d_banner['gambar'] ?>" alt="<?php echo $d_banner['gambar'] ?>"/></a>
      <div class="carousel-caption">
          <h4>Second Thumbnail label</h4>
          <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
        </div>
      </div>
      </div>
    <?php } ?>

      
    </div>
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">&lsaquo;</a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">&rsaquo;</a>
    </div> 
</div>
