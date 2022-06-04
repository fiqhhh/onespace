<!DOCTYPE html>
<html>
<head>
	<title><?= $title ?></title>	
	<!-- Meta -->
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<meta name="description" content="A responsive bootstrap 4 admin dashboard template by hencework" />

	<link href="<?= base_url('assets/template/dist/css/style.css') ;?>" rel="stylesheet" type="text/css">
    <link rel="icon" type="text/css" href="<?= base_url('assets/img/icon/w-icons.png'); ?>">

	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/multiple/file-upload-with-preview.min.css'); ?>">

	<link href="<?= base_url('assets/template/vendors/dropzone/dist/dropzone.css') ?>" rel="stylesheet" type="text/css"/>
	<link href="<?= base_url('assets/template/vendors/jquery-toggles/css/toggles.css') ?>" rel="stylesheet" type="text/css">
	<link href="<?= base_url('assets/template/vendors/dropify/dist/css/dropify.min.css') ?>" rel="stylesheet" type="text/css"/>
	<link href="<?= base_url('assets/template/vendors/select2/dist/css/select2.min.css') ?>" rel="stylesheet" type="text/css" />
	<link href="<?= base_url('assets/template/vendors/daterangepicker/daterangepicker.css') ?>" rel="stylesheet" type="text/css" />
	<link href="<?= base_url('assets/template/vendors/vectormap/jquery-jvectormap-2.0.3.css') ?>" rel="stylesheet" type="text/css" />
	<link href="<?= base_url('assets/template/vendors/lightgallery/dist/css/lightgallery.min.css') ?>" rel="stylesheet" type="text/css">
	<link href="<?= base_url('assets/template/vendors/jquery-toggles/css/themes/toggles-light.css') ?>" rel="stylesheet" type="text/css">
	<link href="<?= base_url('assets/template/vendors/jquery-toast-plugin/dist/jquery.toast.min.css') ?>" rel="stylesheet" type="text/css">
	<link href="<?= base_url('assets/template/vendors/datatables.net-dt/css/jquery.dataTables.min.css'); ?>" rel="stylesheet" type="text/css" />
	<link href="<?= base_url('assets/template/vendors/datatables.net-responsive-dt/css/responsive.dataTables.min.css'); ?>" rel="stylesheet" type="text/css" />	


	<?php 
	date_default_timezone_set('Asia/Jakarta');
	function time_since($original){
		$chunks = array(
			array(60 * 60 * 24 * 365, 'Tahun'),
			array(60 * 60 * 24 * 30, 'Bulan'),
			array(60 * 60 * 24 * 7, 'Minggu'),
			array(60 * 60 * 24, 'Hari'),
			array(60 * 60, 'Jam'),
			array(60, 'Menit'),
		);
		$today = time();
		$since = $today - $original;

		if ($since > 604800)
		{
			$print = date("j M, Y", $original);
			// $print = date("j M, Y H:i A", $original);
			if ($since > 31536000)
			{
				$print .= ", " . date("Y", $original);
			}
			return $print;
		}
		for ($i = 0, $j = count($chunks); $i < $j; $i++)
		{
			$seconds = $chunks[$i][0];
			$name = $chunks[$i][1];

			if (($count = floor($since / $seconds)) != 0)
				break;
		}
		$print = ($count == 1) ? '1 ' . $name : "$count {$name}";
		if($print == 0){
			return "Baru Saja";
		}else{
			return $print . ' yang Lalu';
		}	
	}
	?>

</head>
<body>

	<div class="preloader-it">
		<div class="loader-pendulums"></div>
	</div>

	<div class="hk-wrapper hk-vertical-nav">

		<nav class="navbar navbar-expand-xl navbar-dark fixed-top hk-navbar">
			<a id="navbar_toggle_btn" class="navbar-toggle-btn nav-link-hover" href="javascript:void(0);"><span class="feather-icon"><i data-feather="menu"></i></span></a>
			<a class="navbar-brand" href="<?= base_url('Admin/') ?>">
				<img src="<?= base_url('assets/img/icon/w-logo.png');?>" class="mr-5 mb-1" width="110px">
			</a>
			<ul class="navbar-nav hk-navbar-content">
				<li class="nav-item">
					<a id="navbar_search_btn" class="nav-link nav-link-hover" href="javascript:void(0);"><span class="feather-icon"><i data-feather="search"></i></span></a>
				</li>
				<li class="nav-item dropdown dropdown-authentication">
					<a class="nav-link dropdown-toggle no-caret" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<div class="media">
							<div class="media-img-wrap">
								<div class="avatar">
									<img src="<?= base_url('assets/admin/') . $admin['foto'] ?>" alt="user" class="avatar-img rounded-circle">
								</div>
								<span class="badge badge-success badge-indicator"></span>
							</div>
							<div class="media-body">
								<span><?= $privilege['role_name']; ?><i class="zmdi zmdi-chevron-down"></i></span>
							</div>
						</div>
					</a>
					<div class="dropdown-menu dropdown-menu-right" data-dropdown-in="flipInX" data-dropdown-out="flipOutX">
						<a class="dropdown-item" href="profile.html"><i class="dropdown-icon zmdi zmdi-account"></i><span>Profile</span></a>
						<div class="dropdown-divider"></div>
						<div class="sub-dropdown-menu show-on-hover">
							<a href="#" class="dropdown-toggle dropdown-item no-caret"><i class="zmdi zmdi-check text-success"></i>Online</a>
							<div class="dropdown-menu open-left-side">
								<a class="dropdown-item" href="#"><i class="dropdown-icon zmdi zmdi-check text-success"></i><span>Online</span></a>
								<a class="dropdown-item" href="#"><i class="dropdown-icon zmdi zmdi-circle-o text-warning"></i><span>Busy</span></a>
								<a class="dropdown-item" href="#"><i class="dropdown-icon zmdi zmdi-minus-circle-outline text-danger"></i><span>Offline</span></a>
							</div>
						</div>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="<?= base_url('admin/logout'); ?>"><i class="dropdown-icon zmdi zmdi-power"></i><span>Log out</span></a>
					</div>
				</li>
			</ul>
		</nav>
		<form role="search" class="navbar-search">
			<div class="position-relative">
				<a href="javascript:void(0);" class="navbar-search-icon"><span class="feather-icon"><i data-feather="search"></i></span></a>
				<input type="text" name="example-input1-group2" class="form-control" placeholder="Type here to Search">
				<a id="navbar_search_close" class="navbar-search-close" href="#"><span class="feather-icon"><i data-feather="x"></i></span></a>
			</div>
		</form>
		<!-- /Top Navbar -->

		<!-- Sidebar -->
		<nav class="hk-nav hk-nav-dark">
			<a href="javascript:void(0);" id="hk_nav_close" class="hk-nav-close"><span class="feather-icon"><i data-feather="x"></i></span></a>
			<div class="nicescroll-bar">
				<div class="navbar-nav-wrap">

					<div class="nav-header">
						<span>Main Menu</span>
						<span>MN</span>
					</div>

					<ul class="navbar-nav flex-column">
						<li <?php if($sidebar == "Dashboard") echo 'class="nav-item active"';?> class="nav-item">
							<a class="nav-link" href="<?= base_url('admin/') ?>">
								<span class="feather-icon"><i data-feather="bar-chart-2"></i></span>
								<span class="nav-link-text">Dashboard</span>
							</a>
						</li>
					</ul>

					<hr class="nav-separator">
					<div class="nav-header">
						<span>Ruang Belajar</span>
						<span>RB</span>
					</div>
					<ul class="navbar-nav flex-column">
						<li <?php if($sidebar == "Kelas" || $sidebar == "Gabung Kelas" || $sidebar == "Jurusan") echo'class="nav-item active"'; ?> class="nav-item">
							<a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#ruangBelajar">
								<span class="feather-icon"><i data-feather="home"></i></span>
								<span class="nav-link-text">Ruang Kelas</span>
							</a>
							<ul id="ruangBelajar" class="nav flex-column collapse collapse-level-1">
								<li class="nav-item">
									<ul class="nav flex-column">
										<li <?php if($sidebar == "Kelas") echo'class="nav-item active"'; ?> class="nav-item">
											<a class="nav-link" href="<?= base_url('admin/kelas'); ?>">Kelas</a>
										</li>
										<li <?php if($sidebar == "Gabung Kelas") echo'class="nav-item active"'; ?> class="nav-item">
											<a class="nav-link" href="<?= base_url('admin/gabung_kelas'); ?>">Gabung Kelas</a>
										</li>
										<li <?php if($sidebar == "Jurusan") echo'class="nav-item active"'; ?> class="nav-item">
											<a class="nav-link" href="<?= base_url('admin/jurusan'); ?>">Jurusan Kelas</a>
										</li>
									</ul>
								</li>
							</ul>
						</li>
						<li <?php if($sidebar == "Materi" || $sidebar == "Tugas" || $sidebar == "Latihan") echo'class="nav-item active"'; ?> class="nav-item">
							<a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#fiturBelajar">
								<span class="feather-icon"><i data-feather="edit-3"></i></span>
								<span class="nav-link-text">Fitur Belajar</span>
							</a>
							<ul id="fiturBelajar" class="nav flex-column collapse collapse-level-1">
								<li class="nav-item">
									<ul class="nav flex-column">
										<li <?php if($sidebar == "Materi") echo'class="nav-item active"'; ?> class="nav-item">
											<a class="nav-link" href="<?= base_url('admin/materi'); ?>">Materi</a>
										</li>
										<li <?php if($sidebar == "Tugas") echo'class="nav-item active"'; ?> class="nav-item">
											<a class="nav-link" href="<?= base_url('admin/tugas'); ?>">Tugas</a>
										</li>
										<li <?php if($sidebar == "Latihan") echo'class="nav-item active"'; ?> class="nav-item">
											<a class="nav-link" href="<?= base_url('admin/latihan'); ?>">Latihan</a>
										</li>
									</ul>
								</li>
							</ul>
						</li>
						<li <?php if($sidebar == "Hasil Tugas" || $sidebar == "Hasil Latihan" ) echo'class="nav-item active"'; ?> class="nav-item">
							<a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#hasilBelajar">
								<span class="feather-icon"><i data-feather="check-circle"></i></span>
								<span class="nav-link-text">Hasil Belajar</span>
							</a>
							<ul id="hasilBelajar" class="nav flex-column collapse collapse-level-1">
								<li class="nav-item">
									<ul class="nav flex-column">
										<li <?php if($sidebar == "Hasil Tugas") echo'class="nav-item active"'; ?> class="nav-item">
											<a class="nav-link" href="<?= base_url('admin/hasil_tugas'); ?>">Hasil Tugas</a>
										</li>
										<li <?php if($sidebar == "Hasil Latihan") echo'class="nav-item active"'; ?> class="nav-item">
											<a class="nav-link" href="<?= base_url('admin/hasil_latihan'); ?>">Hasil Latihan</a>
										</li>
									</ul>
								</li>
							</ul>
						</li>
						<li <?php if($sidebar == "Komentar Materi" || $sidebar == "Komentar Tugas" || $sidebar == "Komentar Latihan") echo'class="nav-item active"'; ?> class="nav-item">
							<a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#komentarBelajar">
								<span class="feather-icon"><i data-feather="message-circle"></i></span>
								<span class="nav-link-text">Komentar</span>
							</a>
							<ul id="komentarBelajar" class="nav flex-column collapse collapse-level-1">
								<li class="nav-item">
									<ul class="nav flex-column">
										<li <?php if($sidebar == "Komentar Materi") echo'class="nav-item active"'; ?> class="nav-item">
											<a class="nav-link" href="<?= base_url('admin/komentar_materi'); ?>">Komentar Materi</a>
										</li>
										<li <?php if($sidebar == "Komentar Tugas") echo'class="nav-item active"'; ?> class="nav-item">
											<a class="nav-link" href="<?= base_url('admin/komentar_tugas'); ?>">Komentar Tugas</a>
										</li>
										<li <?php if($sidebar == "Komentar Latihan") echo'class="nav-item active"'; ?> class="nav-item">
											<a class="nav-link" href="<?= base_url('admin/komentar_latihan'); ?>">Komentar Latihan</a>
										</li>
									</ul>
								</li>
							</ul>
						</li>
					</ul>

					<hr class="nav-separator">
					<div class="nav-header">
						<span>Data Master</span>
						<span>AM</span>
					</div>
					<ul class="navbar-nav flex-column">
						<li <?php if($sidebar == "Absen Murid" || $sidebar == "Absen Guru" || $sidebar == "Absen Mapel") echo'class="nav-item active"'; ?> class="nav-item">
							<a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#absenData">
								<span class="feather-icon"><i data-feather="activity"></i></span>
								<span class="nav-link-text">Absen Data</span>
							</a>
							<ul id="absenData" class="nav flex-column collapse collapse-level-1">
								<li class="nav-item">
									<ul class="nav flex-column">
										<li <?php if($sidebar == "Absen Guru") echo'class="nav-item active"'; ?> class="nav-item">
											<a class="nav-link" href="<?= base_url('admin/absen_masuk_guru'); ?>">Absen Guru</a>
										</li>
										<li <?php if($sidebar == "Absen Murid") echo'class="nav-item active"'; ?> class="nav-item">
											<a class="nav-link" href="<?= base_url('admin/absen_masuk_murid'); ?>">Absen Murid</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="<?= base_url('admin/absen_mapel'); ?>">Absen Mata Pelajaran</a>
										</li>
									</ul>
								</li>
							</ul>
						</li>
						<li <?php if($sidebar == "Data Orang Tua" || $sidebar == "Data Murid" || $sidebar == "Data Guru") echo'class="nav-item active"'; ?> class="nav-item">
							<a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#arsipData">
								<span class="feather-icon"><i data-feather="archive"></i></span>
								<span class="nav-link-text">Arsip Data</span>
							</a>
							<ul id="arsipData" class="nav flex-column collapse collapse-level-1">
								<li class="nav-item">
									<ul class="nav flex-column">
										<li <?php if($sidebar == "Data Guru") echo'class="nav-item active"'; ?> class="nav-item">
											<a class="nav-link" href="<?= base_url('admin/data_guru'); ?>">Data Guru</a>
										</li>
										<li <?php if($sidebar == "Data Orang Tua") echo'class="nav-item active"'; ?> class="nav-item">
											<a class="nav-link" href="<?= base_url('admin/data_ortu'); ?>">Data Orang Tua</a>
										</li>
										<li <?php if($sidebar == "Data Murid") echo'class="nav-item active"'; ?> class="nav-item">
											<a class="nav-link" href="<?= base_url('admin/data_murid'); ?>">Data Murid</a>
										</li>
									</ul>
								</li>
							</ul>
						</li>
						<li <?php if($sidebar == "Mata Pelajaran") echo'class="nav-item active"'; ?> class="nav-item">
							<a class="nav-link" href="<?= base_url('admin/mapel'); ?>">
								<span class="feather-icon"><i data-feather="clipboard"></i></span>
								<span class="nav-link-text">Mata Pelajaran</span>
							</a>
						</li>
						<li <?php if($sidebar == "Bank Soal") echo'class="nav-item active"'; ?> class="nav-item">
							<a class="nav-link" href="<?= base_url('admin/bank_soal'); ?>">
								<span class="feather-icon"><i data-feather="file-text"></i></span>
								<span class="nav-link-text">Bank Soal</span>
							</a>
						</li>
					</ul>

					<hr class="nav-separator">
					<div class="nav-header">
						<span>Pengaturan</span>
						<span>PN</span>
					</div>
					<ul class="navbar-nav flex-column">
						<li <?php if($sidebar == "Data Orang Tua") echo'class="nav-item active"'; ?> class="nav-item">
							<a class="nav-link" style="cursor:pointer;" data-toggle="modal" data-target="#exampleModal">
								<span class="feather-icon"><i data-feather="log-out"></i></span>
								<span class="nav-link-text">Keluar</span>
							</a>
						</li>
					</ul>

				</div>
			</div>
		</nav>
		<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Logout Modal</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<p>Kamu yakin ingin keluar?</p>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
						<a href="<?= base_url('admin/logout'); ?>" class="btn btn-primary">Iya</a>
					</div>
				</div>
			</div>
		</div>
		<div id="hk_nav_backdrop" class="hk-nav-backdrop"></div>
		<!-- /Sidebar -->




