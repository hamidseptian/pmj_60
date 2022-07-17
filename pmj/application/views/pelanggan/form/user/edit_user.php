<div class="well">
	<?php echo $this->session->userdata('pesan') ?>
	<form class="form-horizontal" action="<?php echo base_url() ?>user/pelanggan/user/simpanedit_user" method="post">
		<h4>Daftar Pelanggan</h4>
		<div class="control-group">
			<label class="control-label" for="inputFname1">Nama</label>
			<div class="controls">
			  <input type="text" name="nama" class="form-control" style="width:500px" value="<?php echo $user['nama_pelanggan'] ?>">
			</div>
		 </div>
	
	
		<div class="control-group">
			<label class="control-label" for="inputFname1">Alamat *</label>
			<div class="controls">
			  <input type="text" name="alamat" class="form-control" style="width:500px" value="<?php echo $user['alamat_pelanggan'] ?>">
			</div>
		 </div>


		<div class="control-group">
			<label class="control-label" for="inputFname1">No HP</label>
			<div class="controls">
			  <input type="text" name="nohp" class="form-control" style="width:500px" value="<?php echo $user['nohp_pelanggan'] ?>">
			</div>
		 </div>
	
		<div class="control-group">
			<label class="control-label" for="inputFname1">Username</label>
			<div class="controls">
			  <input type="text" name="username" class="form-control" style="width:500px" value="<?php echo $user['username'] ?>">
			</div>
		 </div>
	
	
		<div class="control-group">
			<label class="control-label" for="inputFname1">Password</label>
			<div class="controls">
			  <input type="password" name="password" class="form-control" style="width:500px" value="<?php echo $user['password'] ?>">
			</div>
		 </div>
	
	
		
		
	
	<div class="control-group">
			<div class="controls">
				<input type="hidden" name="email_create" value="1">
				<input type="hidden" name="is_new_customer" value="1">
				<input class="btn btn-sm btn-success" type="submit" value="Register">
			</div>
		</div>	
	
	<div class="control-group">
			<small>	* Alamat yang digunakan adalah alamat untuk pengiriman pesanan</small>
		</div>		
	</form>
</div>