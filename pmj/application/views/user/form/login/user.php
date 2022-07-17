







<div class="col-md-9">
	<h3>Login User</h3>
	<?php echo "<br>".$this->session->flashdata('pesan'); ?>
		<form action="<?php echo base_url('auth/proseslogin_user') ?>" method="post"> <br>
		<div class="form-group">
			<span>Username</span>
			<input type="text" class="form-control" name="username">
		</div> 				
		<div class="form-group"> 	
			<span class="me-at">Password</span>
			<input type="password" class="form-control" name="password"> 
		</div>
				
			<input type="submit" value="Submit" class="btn btn-info"> 
		</form>
				<div class="clearfix"> </div>

	    
<!---->

<!---->
			</div>

			


