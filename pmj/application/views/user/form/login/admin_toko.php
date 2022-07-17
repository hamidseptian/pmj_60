<div class="contact">
		<div class="col-md-8">
			<?php echo $this->session->flashdata('pesan'); ?>
			<h3>Login Admin Toko</h3>
				<form action="<?php echo base_url('auth/proseslogin_admintoko') ?>" method="post"> <br>
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
		</div>
		
	<div class="clearfix"> </div>
</div>