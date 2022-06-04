<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8" />

	<title><?= $title ?></title>
	<link rel="icon" type="text/css" href="<?= base_url('assets/img/icon/w-icons.png'); ?>">
	<link href="<?= base_url('assets/template/dist/css/style.css') ?>" rel="stylesheet" type="text/css">
	<link href="<?= base_url('assets/template/dist/css/login-admin.css') ?>" rel="stylesheet" type="text/css">

</head>
<body>
	<div class="preloader-it"><div class="loader-pendulums"></div></div>
	<div class="hk-wrapper">
		<div class="hk-pg-wrapper hk-auth-wrapper">
			<header class="d-flex justify-content-between align-items-center">
				<a class="d-flex auth-brand" href="#">
					<img class="brand-img" src="<?= base_url('assets/img/icon/w-logo.png'); ?>" width="100px" alt="brand" /> 
				</a>
			</header>
			<div class="container-fluid">
				<div class="row">
					<div class="col-xl-5 pa-0">
						<div id="owl_demo_1" class="owl-carousel dots-on-item owl-theme">
							<div class="fadeOut item auth-cover-img overlay-wrap">
								<div class="auth-cover-info py-xl-0 pt-100 pb-50 bg-blue-custom">
									<div class="auth-cover-content text-center w-xxl-75 w-sm-90 w-xs-100">
										<h1 class="display-3 text-white mb-20">Satu Tempat Untuk Semua Dengan <br>
										</h1>
										<center>
											<img style="width:260px;" src="<?= base_url('assets/img/icon/w-logo.png'); ?>" alt="brand" /> 
										</center>
									</div>
								</div>
								<div class="bg-overlay bg-trans-dark-50"></div>
							</div>
							<div class="fadeOut item auth-cover-img overlay-wrap">
								<div class="auth-cover-info py-xl-0 pt-100 pb-50 bg-blue-custom">
									<div class="auth-cover-content text-center w-xxl-75 w-sm-90 w-xs-100">
										<p class="display-4 text-white mb-20 text-capitalize">
											Buat belajar lebih menyenangkan. <br>
											kelas, jadwal pelajaran, dan cek kehadiran di satu tempat.
										</p>
									</div>
								</div>
								<div class="bg-overlay bg-trans-dark-50"></div>
							</div>
						</div>
					</div>
					<div class="col-xl-7 pa-0">
						<div class="auth-form-wrap py-xl-0 py-50">
							<div class="auth-form w-xxl-55 w-xl-75 w-sm-90 w-xs-100">

								<form action="<?= base_url('auth/'); ?>" method="POST" id="formlogin" name="formlogin" autocomplete="off">
									<h1 class="display-4 mb-10 font-weight-bold">Login One Space</h1>
									<p class="mb-30">Created By SMKN 1 Depok Students.</p>

									<?= Flasher::flash(); ?>

									<div class="form-group">
										<select class="form-control custom-select" name="id_privilege">
											<option selected="" disabled="">Sebagai</option>
											<?php foreach($privilege as $key){ ?>
												<option value="<?= $key->id_privilege ?>"><?= $key->role_name; ?></option>
											<?php } ?>
										</select>
										<?= form_error('id_privilege','<small class="text-danger">','</small>'); ?>
									</div>

									<div class="form-group">
										<div class="input-group">
											<input type="password" name="password" placeholder="Masukan Password" class="form-control">
											<span id="btn_view" class="input-group-text feather-icon" onclick="view()"><i data-feather="eye"></i></span>
											<span id="btn_hide" class="input-group-text feather-icon" onclick="hide()"><i data-feather="eye-off"></i></span>
										</div>
										<?= form_error('password','<small class="text-danger">','</small>'); ?>	
									</div>
									<button class="btn btn-primary btn-block" type="submit">Login</button>
									<!-- <p class="text-center mt-2">Belum Punya Akun? <a href="<?= base_url('auth/register'); ?>">Register</a></p> -->
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /Main Content -->

	</div>
	<!-- /HK Wrapper -->

	<script type="text/javascript">
		function view(){
			document.formlogin.password.type="text";
			document.getElementById("btn_view").style.display="none";
			document.getElementById("btn_hide").style.display="block";
		}	
		function hide(){
			document.formlogin.password.type="password";
			document.getElementById("btn_view").style.display="block";
			document.getElementById("btn_hide").style.display="none";
		}
	</script>

	<script src="<?= base_url('assets/template/vendors/jquery/dist/jquery.min.js') ?>"></script>
	<script src="<?= base_url('assets/template/vendors/popper.js/dist/umd/popper.min.js') ?>"></script>
	<script src="<?= base_url('assets/template/vendors/bootstrap/dist/js/bootstrap.min.js') ?>"></script>
	<script src="<?= base_url('assets/template/dist/js/jquery.slimscroll.js') ?>"></script>
	<script src="<?= base_url('assets/template/dist/js/dropdown-bootstrap-extended.js') ?>"></script>
	<script src="<?= base_url('assets/template/vendors/owl.carousel/dist/owl.carousel.min.js') ?>"></script>
	<script src="<?= base_url('assets/template/dist/js/feather.min.js') ?>"></script>
	<script src="<?= base_url('assets/template/dist/js/init.js') ?>"></script>
	<script src="<?= base_url('assets/template/dist/js/login-data.js') ?>"></script>

</body>
</html>