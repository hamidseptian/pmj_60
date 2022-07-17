<div class="tab-content">
	

	<div class="tab-pane  active" id="blockView">
		<h4>Contact Person</h4>
		
		<?php foreach ($cp as $k => $v) { ?>
		<h5><?php echo $v['nama'] ?></h5>
		<p>	Alamat : <?php echo $v['alamat'] ?><br>
			Email : <?php echo $v['email_k'] ?><br>
			No HP : <?php echo $v['nohp'] ?><br>
			
		</p>		
		<?php } ?>
		




	<hr class="soft">
	</div>
</div>