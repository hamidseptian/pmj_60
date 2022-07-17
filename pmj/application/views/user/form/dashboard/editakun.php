
<div class="col-md-9">
	<h3>Perbaharui Akun Pelanggan</h3>
			<?php echo $this->session->flashdata('pesan'); ?>
			<form method="post" action="<?php echo base_url('user/user/user/simpanedit_pelanggan') ?>">
					<br>
		<div class="form-group">
			<span>Nama</span>
			<input type="text" name="nama" class="form-control" value="<?php echo $data['nama_pelanggan'] ?>">
		</div> 	
		<div class="form-group"> 	
			<span class="me-at">Domisili</span>
			<select name="idkel" class="form-control" id="idkecamatan">
				<?php foreach($kelurahan as $d1){ ?>
				<option value="<?php echo $d1['id_kelurahan'] ?>" <?php if($data['id_kelurahan']==$d1['id_kelurahan']){ echo "selected";} ?>>Kecamatan : <?php echo $d1['nama_kecamatan'] ?> - Kelurahan <?php echo $d1['nama_kelurahan'] ?></option>
				<?php } ?>
			</select>
		</div>					
		<div class="form-group"> 	
			<span class="me-at">Alamat</span>
			<input type="text" name="alm" class="form-control" value="<?php echo $data['alamat_pelanggan'] ?>"> 
		</div>		
		<div class="form-group"> 	
			<span class="me-at">No HP</span>
			<input type="text" name="hp" class="form-control" value="<?php echo $data['nohp_pelanggan'] ?>"> 
		</div>
		<div class="form-group"> 	
			<span class="me-at">Email</span>
			<input type="text" name="email" class="form-control" value="<?php echo $data['email_pelanggan'] ?>"> 
		</div>
		<div class="form-group"> 	
			<span class="me-at">Password</span>
			<input type="password" name="pass" class="form-control" value="<?php echo $data['password'] ?>"> 
		</div>
				
			<input type="submit" value="Simpan Perubahan" class="btn btn-info"> 
		</form>
				<div class="clearfix"> </div>

	    
<!---->

<!---->
			</div>

			


