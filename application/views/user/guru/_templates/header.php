<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<meta name="description" content="A responsive bootstrap 4 admin dashboard template by hencework" />

	<title><?= $title; ?></title>
	
	<!-- Toggles CSS -->
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/template/vendors/jquery-toggles/css/toggles.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/template/vendors/jquery-toggles/css/themes/toggles-light.css'); ?>">
	<!-- select2 CSS -->
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/template/vendors/select2/dist/css/select2.min.css'); ?>" />
	<!-- Custom CSS -->
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/template/dist/css/style.css'); ?>">
	<!-- Scanner -->
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/loginQrcode/scanner/css/style.css'); ?>">
</head>
<body>
	<?php 
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
		}elseif($print == "1 Hari"){
			return "Kemarin";
		}else{
			return $print . ' yang lalu';
		}
	}
	?>

	<!-- Preloader -->
	<div class="preloader-it">
		<div class="loader-pendulums"></div>
	</div>
	<!-- /Preloader -->
	
	<!-- HK Wrapper -->
	<div class="hk-wrapper hk-horizontal-nav">

		<!-- Top Navbar -->
		<nav class="navbar navbar-expand-xl navbar-light fixed-top hk-navbar">
			<a id="navbar_toggle_btn" class="navbar-toggle-btn nav-link-hover" href="javascript:void(0);">
				<span class="feather-icon"><i data-feather="menu"></i></span>
			</a>
			<a class="navbar-brand" href="dashboard1.html">
				<img class="brand-img d-inline-block mr-1" src="dist/img/logo-light.png" />
				<span class="font-weight-bold" style="font-family:Poppins;">One Space</span>
			</a>
			<ul class="navbar-nav hk-navbar-content">
				<li class="nav-item">
					<a id="navbar_search_btn" class="nav-link nav-link-hover" href="javascript:void(0);"><span class="feather-icon"><i data-feather="search"></i></span></a>
				</li>
				<li class="nav-item">
					<a id="settings_toggle_btn" class="nav-link nav-link-hover" href="javascript:void(0);"><span class="feather-icon"><i data-feather="inbox"></i></span></a>
				</li>
				<li class="nav-item dropdown dropdown-notifications">
					<a class="nav-link dropdown-toggle no-caret" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="feather-icon"><i data-feather="bell"></i></span><span class="badge-wrap"><span class="badge badge-primary badge-indicator badge-indicator-sm badge-pill pulse"></span></span></a>
					<div class="dropdown-menu dropdown-menu-right" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
						<h6 class="dropdown-header">Notifications <a href="javascript:void(0);" class="">View all</a></h6>
						<div class="notifications-nicescroll-bar">
							<a href="javascript:void(0);" class="dropdown-item">
								<div class="media">
									<div class="media-img-wrap">
										<div class="avatar avatar-sm">
											<span class="avatar-text avatar-text-warning rounded-circle">
												<span class="initial-wrap"><span><i class="zmdi zmdi-notifications font-18"></i></span></span>
											</span>
										</div>
									</div>
									<div class="media-body">
										<div>
											<div class="notifications-text"><span class="text-dark text-capitalize">Evie Ono</span> accepted your invitation to join the team</div>
											<div class="notifications-time">12m</div>
										</div>
									</div>
								</div>
							</a>
							<div class="dropdown-divider"></div>
							<a href="javascript:void(0);" class="dropdown-item">
								<div class="media">
									<div class="media-img-wrap">
										<div class="avatar avatar-sm">
											<span class="avatar-text avatar-text-warning rounded-circle">
												<span class="initial-wrap"><span><i class="zmdi zmdi-notifications font-18"></i></span></span>
											</span>
										</div>
									</div>
									<div class="media-body">
										<div>
											<div class="notifications-text">New message received from <span class="text-dark text-capitalize">Misuko Heid</span></div>
											<div class="notifications-time">1h</div>
										</div>
									</div>
								</div>
							</a>
							<div class="dropdown-divider"></div>
							<a href="javascript:void(0);" class="dropdown-item">
								<div class="media">
									<div class="media-img-wrap">
										<div class="avatar avatar-sm">
											<span class="avatar-text avatar-text-primary rounded-circle">
												<span class="initial-wrap"><span><i class="zmdi zmdi-account font-18"></i></span></span>
											</span>
										</div>
									</div>
									<div class="media-body">
										<div>
											<div class="notifications-text">You have a follow up with<span class="text-dark text-capitalize"> Pangong head</span> on <span class="text-dark text-capitalize">friday, dec 19</span> at <span class="text-dark">10.00 am</span></div>
											<div class="notifications-time">2d</div>
										</div>
									</div>
								</div>
							</a>
							<div class="dropdown-divider"></div>
							<a href="javascript:void(0);" class="dropdown-item">
								<div class="media">
									<div class="media-img-wrap">
										<div class="avatar avatar-sm">
											<span class="avatar-text avatar-text-success rounded-circle">
												<span class="initial-wrap"><span>A</span></span>
											</span>
										</div>
									</div>
									<div class="media-body">
										<div>
											<div class="notifications-text">Application of <span class="text-dark text-capitalize">Sarah Williams</span> is waiting for your approval</div>
											<div class="notifications-time">1w</div>
										</div>
									</div>
								</div>
							</a>
							<div class="dropdown-divider"></div>
							<a href="javascript:void(0);" class="dropdown-item">
								<div class="media">
									<div class="media-img-wrap">
										<div class="avatar avatar-sm">
											<span class="avatar-text avatar-text-warning rounded-circle">
												<span class="initial-wrap"><span><i class="zmdi zmdi-notifications font-18"></i></span></span>
											</span>
										</div>
									</div>
									<div class="media-body">
										<div>
											<div class="notifications-text">Last 2 days left for the project</div>
											<div class="notifications-time">15d</div>
										</div>
									</div>
								</div>
							</a>
						</div>
					</div>
				</li>
				<li class="nav-item dropdown dropdown-authentication">
					<a class="nav-link dropdown-toggle no-caret" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<div class="media">
							<div class="media-img-wrap">
								<div class="avatar">
									<img src="<?= base_url('assets/img/foto_pengguna/') . $guru['foto_pengguna']; ?>" alt="user" class="avatar-img rounded-circle">
								</div>
								<span class="badge badge-success badge-indicator"></span>
							</div>
							<div class="media-body">
								<span><?= $guru['nama_guru']; ?>, <?= $guru['gelar_guru']; ?><i class="zmdi zmdi-chevron-down"></i></span>
							</div>
						</div>
					</a>
					<div class="dropdown-menu dropdown-menu-right" data-dropdown-in="bounceIn" data-dropdown-out="bounceOut">
						<a class="dropdown-item" href="<?= base_url('guru/profile'); ?>"><i class="dropdown-icon zmdi zmdi-account"></i><span>Profile</span></a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="#"><i class="dropdown-icon zmdi zmdi-settings"></i><span>Settings</span></a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="<?= base_url('guru/logout'); ?>" onclick="return confirm('Anda yakin ingin keluar dari pembelajaran?');"><i class="dropdown-icon zmdi zmdi-power"></i><span>Log out</span></a>
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

		<!--Horizontal Nav-->
		<nav class="hk-nav hk-nav-dark">
			<a href="javascript:void(0);" id="hk_nav_close" class="hk-nav-close"><span class="feather-icon"><i data-feather="x"></i></span></a>
			<div class="nicescroll-bar">
				<div class="navbar-nav-wrap">
					<ul class="navbar-nav flex-row">
						<li class="nav-item active">
							<a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#dash_drp">
								<span class="feather-icon"><i data-feather="home"></i></span>
								<span class="nav-link-text">Home</span>
							</a>
							<ul id="dash_drp" class="nav flex-column collapse collapse-level-1">
								<li class="nav-item">
									<ul class="nav flex-column">
										<li class="nav-item">
											<a class="nav-link" href="<?= base_url('guru/'); ?>">Home</a>
										</li>
									</ul>
								</li>
							</ul>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#dash_drp">
								<span class="feather-icon"><i data-feather="clipboard"></i></span>
								<span class="nav-link-text">Mata Pelajaran</span>
							</a>
						</li>
					</ul>
				</div>
			</div>
		</nav>
		<div id="hk_nav_backdrop" class="hk-nav-backdrop"></div>
        <!--/Horizontal Nav-->