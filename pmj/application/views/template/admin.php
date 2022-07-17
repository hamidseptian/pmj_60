<?php 
$id_user = $this->session->userdata('id_user');
$login = $this->session->userdata('login');
if ($login!=true) {
	redirect('/');
}else

$id_hak_akses = $this->session->userdata('id_hak_akses');
if ($id_hak_akses==3) {
  $q=$this->db->query("SELECT a.nama_guru, ha.nama_hak_akses, a.id_mapel, a.foto from guru a 
  	left join hak_akses ha on a.id_hak_akses=ha.id_hak_akses 
    where a.id_guru='$id_user'
    ")->row();

  $id_mapel =$q->id_mapel;
  if ($id_mapel=='psikologi') {
  		$mapel = "Psikologi";
  }else{
  		$q_mapel = $this->db->query("SELECT nama_mapel from mata_pelajaran where id_mapel='$id_mapel'")->row()->nama_mapel;
  		$mapel = $q_mapel;

  }
  $nama_user = $q->nama_guru;
  $level = $q->nama_hak_akses.' - '.$mapel;
  // $foto = base_url('file/gambar/guru/').$q->foto;
  $foto = $q->foto == '' ? base_url('file/user.jpg') : base_url('file/gambar/guru/').$q->foto;

}
elseif ($id_hak_akses==4) {
  $q=$this->db->query("SELECT a.nama_siswa, a.foto, ha.nama_hak_akses from siswa a left join hak_akses ha on a.id_hak_akses=ha.id_hak_akses
    where a.id_siswa='$id_user'
    ")->row();
  $nama_user = $q->nama_siswa;
  $level = $q->nama_hak_akses;
    $foto = $q->foto == '' ? base_url('file/user.jpg') : base_url('file/gambar/siswa/').$q->foto;
}
else{
  $q=$this->db->query("SELECT a.nama, ha.nama_hak_akses from admin a left join hak_akses ha on a.id_hak_akses=ha.id_hak_akses
    where a.id_admin='$id_user'
    ")->row();
  $nama_user = $q->nama;
  $level = $q->nama_hak_akses;
  $foto = base_url('file/user.jpg');
}


$mata_pelajaran=$this->db->query("SELECT * from mata_pelajaran where jenis_mapel='Umum'")->result_array();
		$kumpul_mapel = [];
		foreach ($mata_pelajaran as $key => $value) {
			$data_db = [
				'id_mapel'=>$value['id_mapel'],
				'nama_mapel'=>$value['nama_mapel'],
			];
			array_push($kumpul_mapel, $data_db);
		}

			$psk = [
				'id_mapel'=>'psikologi',
				'nama_mapel'=>'Psikologi',
			];
			array_push($kumpul_mapel, $psk);


 ?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 3 | Fixed Sidebar</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/adminlte3/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/adminlte3/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/adminlte3/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">



  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/adminlte3/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/adminlte3/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/adminlte3/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/adminlte3/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">


<!-- select2 -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/adminlte3/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/adminlte3/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

   <link rel="stylesheet" href="<?php echo base_url() ?>assets/adminlte3/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/adminlte3/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/adminlte3/dist/css/adminlte.min.css">

<!-- sweet alert -->

  <link rel="stylesheet" href="<?php echo base_url() ?>assets/adminlte3/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/adminlte3/plugins/toastr/toastr.min.css">

<!-- jquery -->
  <script type="text/javascript" src="<?php echo base_url() ?>assets/js/jquery.js"></script>

<!-- ck editor -->
  <script type="text/javascript" src="<?php echo base_url() ?>assets/ckeditor/ckeditor.js"></script>


</head>
<body class="hold-transition sidebar-mini layout-fixed">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
   
    </ul>

   

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <!-- <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a> -->
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-user"></i> <?php echo $nama_user ?> <br>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
         
       
          <!-- <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a> -->
          <div class="dropdown-divider"></div>
          <a href="<?php echo base_url() ?>redirect/logout" class="dropdown-item dropdown-footer menu_siswa"><i class="fa fa-log-out"></i> Logout</a>
        </div>
      </li>
      <!-- <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li> -->
      
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="<?php echo base_url() ?>assets/adminlte3/dist/img/AdminLTELogo.png"
           alt="AdminLTE Logo"
           class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Bimbel Sanjaya</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo $foto ?>" class="elevation-2" alt="User Image">
        </div>
        <div class="info" style="margin-top:-10px">
          <a href="#" class="d-block"><?php echo $nama_user ?> <br><?php echo $level ?> </a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- <li class="nav-header">Super Admin</li>
          <li class="nav-item">
            <a href="../widgets.html" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
               Backup Database
               <span class="right badge badge-danger">Belum</span>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="../widgets.html" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
               Backup File
               <span class="right badge badge-danger">Belum</span>
              </p>
            </a>
          </li> -->
          <?php if ($id_hak_akses==1) { ?>
          <li class="nav-header">Admin</li>
          <li class="nav-item">
            <a href="<?php echo base_url() ?>user/admin/admin" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
               Data Admin
               <span class="right badge badge-success">OK</span>
              </p>
            </a>
          </li>
          <?php } else if ($id_hak_akses==2) { ?>
          <li class="nav-header">Admin</li>
          <li class="nav-item">
            <a href="<?php echo base_url() ?>user/admin/guru" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
               Data Guru
               <!-- <span class="right badge badge-success">OK</span> -->
              </p>
            </a>
          </li>
          
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-bars"></i>
              <p>
                Data Siswa
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
               <li class="nav-item">
	            <a href="<?php echo base_url() ?>user/admin/siswa/index/1" class="nav-link">
	              <i class="nav-icon fas fa-pen"></i>
	              <p>
	              Aktif
	               <!-- <span class="right badge badge-success">OK</span> -->
	              </p>
	            </a>
	          </li>
	          <li class="nav-item">
	            <a href="<?php echo base_url() ?>user/admin/siswa/index/0" class="nav-link">
	              <i class="nav-icon fas fa-pen"></i>
	              <p>
	               Mendaftar Online
	               <!-- <span class="right badge badge-success">OK</span> -->
	              </p>
	            </a>
	          </li>
	          <li class="nav-item">
	            <a href="<?php echo base_url() ?>user/admin/siswa/index/2" class="nav-link">
	              <i class="nav-icon fas fa-pen"></i>
	              <p>
	               Alumni
	               <!-- <span class="right badge badge-success">OK</span> -->
	              </p>
	            </a>
	          </li>
             
            </ul>
          </li>






          <li class="nav-item">
            <a href="<?php echo base_url() ?>user/admin/periode" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
               Data Periode Bimbel
               <!-- <span class="right badge badge-success">OK</span> -->
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?php echo base_url() ?>user/admin/mata_pelajaran" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
               Data Mata Pelajaran
               <!-- <span class="right badge badge-success">OK</span> -->
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url() ?>user/guru/pembagian_kelompok" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
               Pembagian Kelompok
               <!-- <span class="right badge badge-warning">Revisi</span> -->
              </p>
            </a>
          </li>
            <li class="nav-item">
            <a href="<?php echo base_url() ?>user/guru/manajemen_soal" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              
               Manajemen Soal
               <!-- <span class="right badge badge-success">ok</span> -->
              
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_Url() ?>user/admin/dashboard/edit" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
               Edit Data
               <!-- <span class="right badge badge-success">OK</span> -->
              </p>
            </a>
          </li>
      
          <li class="nav-item">
            <a href="<?php echo base_Url() ?>user/guru/laporan/ujian_siswa" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
               Laporan Ujian Siswa
               <span class="right badge badge-success">OK</span>
              </p>
            </a>
          </li>
          	<?php }
          	else if($id_hak_akses==3){ ?>
            <li class="nav-header">Guru</li>
          <li class="nav-item">
            <a href="<?php echo base_url() ?>user/guru/manajemen_soal" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              
               Manajemen Soal
               <!-- <span class="right badge badge-success">ok</span> -->
              
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url() ?>user/guru/pembagian_kelompok" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
               Pembagian Kelompok
               <!-- <span class="right badge badge-warning">Revisi</span> -->
              </p>
            </a>
          </li>
           <li class="nav-item">
            <a href="<?php echo base_Url() ?>user/guru/laporan/ujian_siswa" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
               Laporan Ujian Siswa
               <!-- <span class="right badge badge-success">OK</span> -->
              </p>
            </a>
          </li>
            <li class="nav-item">
            <a href="<?php echo base_url() ?>user/guru/dashboard/edit_data" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
               Edit Data
               <!-- <span class="right badge badge-success">OK</span> -->
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url() ?>user/guru/dashboard/ganti_password" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
               Ganti Password
               <!-- <span class="right badge badge-success">OK</span> -->
              </p>
            </a>
          </li>

      <?php }
      else if($id_hak_akses==4){ ?>
            <li class="nav-header">Siswa</li>
          <li class="nav-item">
            <a href="<?php echo base_url() ?>user/siswa/ujian/ujian/pilih_periode" class="nav-link menu_siswa">
              <i class="nav-icon fas fa-book"></i>
              Ujian 
               <!-- <span class="right badge badge-warning">OTW</span> -->
              
            </a>
          </li>
        
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link menu_siswa">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Laporan 
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url() ?>user/siswa/laporan/pilih_periode" class="nav-link menu_siswa">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Laporan Penilaian</p>
                  <!-- <span class="right badge badge-warning">Print belum</span> -->
                </a>
      
            </ul>
          </li> 
            <li class="nav-item">
            <a href="<?php echo base_url() ?>user/siswa/dashboard/edit" class="nav-link menu_siswa">
              <i class="nav-icon fas fa-book"></i>
              <p>
               Edit Data
               <!-- <span class="right badge badge-success">OK</span> -->
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url() ?>user/siswa/dashboard/ganti_password" class="nav-link menu_siswa">
              <i class="nav-icon fas fa-book"></i>
              <p>
               Ganti Password
               <!-- <span class="right badge badge-success">OK</span> -->
              </p>
            </a>
          </li>
      <?php } 
      else if($id_hak_akses==5){ ?>
            <li class="nav-header">Admin</li>
        
       
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-bars"></i>
              <p>
                Data Siswa
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
               <li class="nav-item">
              <a href="<?php echo base_url() ?>user/admin/siswa/index/1" class="nav-link">
                <i class="nav-icon fas fa-pen"></i>
                <p>
                Aktif
                 <!-- <span class="right badge badge-success">OK</span> -->
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url() ?>user/admin/siswa/index/0" class="nav-link">
                <i class="nav-icon fas fa-pen"></i>
                <p>
                 Mendaftar Online
                 <!-- <span class="right badge badge-success">OK</span> -->
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url() ?>user/admin/siswa/index/2" class="nav-link">
                <i class="nav-icon fas fa-pen"></i>
                <p>
                 Alumni
                 <!-- <span class="right badge badge-success">OK</span> -->
                </p>
              </a>
            </li>
             
            </ul>
          </li>


      <?php } ?>

         
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <br>

    <!-- Main content -->
    <section class="content">

      <div class="container-fluid">
        <?php echo $konten ?>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<!-- Modal -->

<!-- Modal -->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 01
    </div>
    <strong>Copyright &copy; Bimbel Sanjaya | Template By <a href="http://adminlte.io">AdminLTE.io</a> | Development By <a href="">Hamid Septian</a> .</strong>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?php echo base_url() ?>assets/adminlte3/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url() ?>assets/adminlte3/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?php echo base_url() ?>assets/adminlte3/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url() ?>assets/adminlte3/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url() ?>assets/adminlte3/dist/js/demo.js"></script>


<!-- DataTables -->
<script src="<?php echo base_url() ?>assets/adminlte3/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url() ?>assets/adminlte3/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url() ?>assets/adminlte3/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url() ?>assets/adminlte3/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

<!-- select2 -->
<script src="<?php echo base_url() ?>assets/adminlte3/plugins/select2/js/select2.full.min.js"></script>

<!-- SweetAlert2 -->
<script src="<?php echo base_url() ?>assets/adminlte3/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="<?php echo base_url() ?>assets/adminlte3/plugins/toastr/toastr.min.js"></script>

<script>
  $(function () {
    $("#datatable1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $("#datatable2").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $("#datatable3").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $("#datatable4").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $("#datatable5").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $("#datatable6").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $("#datatable7").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });

 $('.select2').select2({
  placeholder: "Pilih",
      allowClear: false,
      width: 'style',
      theme: 'bootstrap4'
 });

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
</body>
</html>
