<div class="well">
<?php echo $this->session->userdata('pesan') ?>
	<form class="form-horizontal" action="<?php echo base_url() ?>homepage/proseslogin_pelanggan" method="post">
		<h4>Login Pelanggan</h4>
	
	
		<div class="control-group">
			<label class="control-label" for="inputFname1">Username</label>
			<div class="controls">
			  <input type="text" name="username" class="form-control" style="width:500px">
			</div>
		 </div>
	
	
		<div class="control-group">
			<label class="control-label" for="inputFname1">Password</label>
			<div class="controls">
			  <input type="password" name="password" class="form-control" style="width:500px">
			</div>
		 </div>
	
	
		
		
	
	<div class="control-group">
			<div class="controls">
				<input class="btn btn-sm btn-success" type="submit" value="Login">
			</div>
		</div>		
	</form>
</div>