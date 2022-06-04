<!-- Footer -->
<div class="hk-footer-wrap container">
	<footer class="footer">
		<div class="row">
			<div class="col-md-6 col-sm-12">
				<p>Created By<a href="" class="text-dark" target="_blank">Muhammad Fiqih Shee Kcil Tamvan</a> © <?= date('Y'); ?></p>
			</div>
		</div>
	</footer>
</div>
<!-- /Footer -->
</div>
<!-- /Main Content -->

</div>
<!-- /HK Wrapper -->
<!-- jQuery -->
<script src="<?= base_url('assets/template/vendors/jquery/dist/jquery.min.js'); ?>"></script>

<!-- Bootstrap Core JavaScript -->
<script src="<?= base_url('assets/template/vendors/popper.js/dist/umd/popper.min.js'); ?>"></script>
<script src="<?= base_url('assets/template/vendors/bootstrap/dist/js/bootstrap.min.js'); ?>"></script>

<!-- Slimscroll JavaScript -->
<script src="<?= base_url('assets/template/dist/js/jquery.slimscroll.js'); ?>"></script>

<!-- Fancy Dropdown JS -->
<script src="<?= base_url('assets/template/dist/js/dropdown-bootstrap-extended.js'); ?>"></script>

<!-- FeatherIcons JavaScript -->
<script src="<?= base_url('assets/template/dist/js/feather.min.js'); ?>"></script>

<!-- Toggles JavaScript -->
<script src="<?= base_url('assets/template/vendors/jquery-toggles/toggles.min.js'); ?>"></script>
<script src="<?= base_url('assets/template/dist/js/toggle-data.js'); ?>"></script>

<!-- Init JavaScript -->
<script src="<?= base_url('assets/template/dist/js/init.js'); ?>"></script>
<script src="<?= base_url('assets/template/dist/js/dashboard2-data.js'); ?>"></script>

<!-- Select2 JavaScript -->
<script src="<?= base_url('assets/template/vendors/select2/dist/js/select2.full.min.js'); ?>"></script>
<script src="<?= base_url('assets/template/dist/js/select2-data.js'); ?>"></script>

<!-- Scanner -->
<script src="<?= base_url('assets/loginQrcode/scanner/js/app.js'); ?>"></script>
<script src="<?= base_url('assets/loginQrcode/scanner/vendor/vue/vue.min.js'); ?>"></script>
<script src="<?= base_url('assets/loginQrcode/scanner/vendor/modernizr/modernizr.js'); ?>"></script>
<script src="<?= base_url('assets/loginQrcode/scanner/vendor/instascan/instascan.min.js'); ?>"></script>

<script type="text/javascript">
	function hanyaAngka(evt) {
		var charCode = (evt.which) ? evt.which : event.keyCode
		if (charCode > 31 && (charCode < 48 || charCode > 57))

			return false;
		return true;
	}
	
</script>

</body>
</html>