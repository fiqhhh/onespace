<script type="text/javascript" src="<?= base_url('assets/templateuser/js/jquery-3.4.1.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/templateuser/js/jquery-3.4.1.min.js') ?>"></script>

<script>
	function hanyaAngka(evt) {
		var charCode = (evt.which) ? evt.which : event.keyCode
		if (charCode > 31 && (charCode < 48 || charCode > 57))

			return false;
		return true;
	}
	window.setTimeout(function () {
		$(".alert").fadeTo(500, 0).slideUp(500, function () {
			$(this).remove();
		});
	}, 4000);
</script>

</body>
</html>