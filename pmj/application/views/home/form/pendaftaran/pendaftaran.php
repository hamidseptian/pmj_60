<style type="text/css">
  .judul{
    font-size:20px;
  }
</style>

<div class="wrapper row3">
  <main class="hoc container clear"> 
    <!-- main body -->
    <!-- ################################################################################################ -->
    
    <!-- ################################################################################################ -->
    <!-- ################################################################################################ -->
      
      <div id="comments">
       




<div class="row">
    <div class="col-12">
     
      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title judul">Login</h3>

           <?php echo $this->session->flashdata('pesan');

       ?>
          <div class="card-tools">
            
          </div>
        </div>
        <div class="card-body">
          <form action="<?php echo base_url() ?>home/beranda/proseslogin_admin" method="post" enctype="multipart/form-data" id="form_input">
         <div class="row">
                    <div class="col-md-4">
                     
                      <div class="form-group">
                        <label>Username</label>
                        <input required type="text" class="form-control" style="width: 100%;" id="username"  name="username">
                      </div>
                      <div class="form-group">
                        <label>Password</label>
                        <input required type="password" class="form-control" style="width: 100%;" id="password"  name="password">
                      </div>
                    
                      <div class="form-group">

                        <button type="submit" class="btn btn-primary">Login</button>
                      </div>
            
                    </div>
                    <div class="clearfix"></div>
                  </div>
                  </form>
        </div>
      <!-- /.card -->
    </div>
  </div>
</div>






        </form>
      </div>
      <!-- ################################################################################################ -->
    <!-- ################################################################################################ -->
    <!-- / main body -->
    <div class="clear"></div>
  </main>
</div