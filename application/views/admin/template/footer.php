<!-- Footer -->
<div class="hk-footer-wrap container">
	<footer class="footer">
		<div class="row">
			<div class="col-md-6 col-sm-12">
				<p>Created By<a href="" class="text-dark" target="_blank">SMKN 1 Depok Students</a> © <?= date('Y'); ?></p>
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

<!-- Dropify JavaScript -->
<script src="<?= base_url('assets/template/vendors/dropify/dist/js/dropify.min.js'); ?>"></script>

<!-- Dropzone JavaScript -->
<script src="<?= base_url('assets/template/vendors/dropzone/dist/dropzone.js'); ?>"></script>

<!-- Form Flie Upload Data JavaScript -->
<script src="<?= base_url('assets/template/dist/js/form-file-upload-data.js'); ?>"></script>

<!-- Toggles JavaScript -->
<script src="<?= base_url('assets/template/vendors/jquery-toggles/toggles.min.js'); ?>"></script>
<script src="<?= base_url('assets/template/dist/js/toggle-data.js'); ?>"></script>

<!-- Counter Animation JavaScript -->
<script src="<?= base_url('assets/template/vendors/waypoints/lib/jquery.waypoints.min.js'); ?>"></script>
<script src="<?= base_url('assets/template/vendors/jquery.counterup/jquery.counterup.min.js'); ?>"></script>



<!-- Sparkline JavaScript -->
<script src="<?= base_url('assets/template/vendors/jquery.sparkline/dist/jquery.sparkline.min.js'); ?>"></script>

<!-- Vector Maps JavaScript -->
<script src="<?= base_url('assets/template/vendors/vectormap/jquery-jvectormap-2.0.3.min.js'); ?>"></script>
<script src="<?= base_url('assets/template/vendors/vectormap/jquery-jvectormap-world-mill-en.js'); ?>"></script>
<script src="<?= base_url('assets/template/dist/js/vectormap-data.js'); ?>"></script>

<!-- Owl JavaScript -->
<script src="<?= base_url('assets/template/vendors/owl.carousel/dist/owl.carousel.min.js'); ?>"></script>

<!-- Toastr JS -->
<script src="<?= base_url('assets/template/vendors/jquery-toast-plugin/dist/jquery.toast.min.js'); ?>"></script>
<!-- <script src="<?= base_url('assets/template/dist/js/toast-data.js'); ?>"></script> -->

<!-- Tinymce JavaScript -->
<script src="<?= base_url('assets/template/vendors/tinymce/tinymce.min.js'); ?>"></script>

<!-- EChartJS JavaScript -->
<script src="<?= base_url('assets/template/vendors/echarts/dist/echarts-en.min.js'); ?>"></script>
<script src="<?= base_url('assets/template/dist/js/piecharts-data.js'); ?>"></script>
<script type="text/javascript">
	var echartsConfig = function() {

		if( $('#e_chart').length > 0 ){
			var eChart = echarts.init(document.getElementById('e_chart'));

			var option1 = {
				tooltip: {
					show: true,
					backgroundColor: '#fff',
					borderRadius:6,
					padding:6,
					axisPointer:{
						lineStyle:{
							width:0,
						}
					},
					textStyle: {
						color: '#324148',
						fontFamily: '-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji"',
						fontSize: 12
					}	
				},
				series: [
				{
					name:'',
					type:'pie',
					radius : '60%',
					center : ['50%', '50%'],
					roseType : 'radius',
					color: ['#00acf0', '#ffbf36', '#f83f37'],
					data:[
					{value:<?= $jmlh_guru; ?>, name:'Guru'},
					{value:<?= $jmlh_murid; ?>, name:'Murid'},
					{value:<?= $jmlh_ortu; ?>, name:'Orang Tua'},
					],
					label: {
						normal: {
							formatter: '{b}\n{d}%'
						},

					}
				}
				]
			};
			eChart.setOption(option1);
			eChart.resize();
		}

		if( $('#e_chart1').length > 0 ){
			var eChart1 = echarts.init(document.getElementById('e_chart1'));

			var option9 = {
				tooltip: {
					show: true,
					backgroundColor: '#fff',
					borderRadius:6,
					padding:6,
					axisPointer:{
						lineStyle:{
							width:0,
						}
					},
					textStyle: {
						color: '#324148',
						fontFamily: '-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji"',
						fontSize: 12
					}	
				},
				series: [
				{
					name:'',
					type:'pie',
					radius : '60%',
					center : ['50%', '50%'],
					roseType : 'radius',
					color: ['#00acf0', '#ffbf36'],
					data:[
					{value:<?= $jmlh_absen_guru; ?>, name:'Absen Guru'},
					{value:<?= $jmlh_absen_murid; ?>, name:'Absen Murid'},
					],
					label: {
						normal: {
							formatter: '{b}\n{d}%'
						},

					}
				}
				]
			};
			eChart1.setOption(option9);
			eChart1.resize();
		}
	}
	var sparkResize,echartResize;
	$(window).on("resize", function () {
		clearTimeout(echartResize);
		echartResize = setTimeout(echartsConfig, 200);
	}).resize(); 

	echartsConfig();
</script>


<!-- Tinymce Wysuhtml5 Init JavaScript -->
<script src="<?= base_url('assets/template/dist/js/tinymce-data.js'); ?>"></script>

<!-- Init JavaScript -->
<script src="<?= base_url('assets/template/dist/js/init.js'); ?>"></script>
<script src="<?= base_url('assets/template/dist/js/tooltip-data.js') ?>"></script>

<script src="<?= base_url('assets/template/dist/js/dashboard-data.js'); ?>"></script>

<!-- Bootstrap Tagsinput JavaScript -->
<script src="<?= base_url('assets/template/vendors/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') ?>"></script>

<!-- Bootstrap Input spinner JavaScript -->
<script src="<?= base_url('assets/template/vendors/bootstrap-input-spinner/src/bootstrap-input-spinner.js') ?>"></script>
<script src="<?= base_url('assets/template/dist/js/inputspinner-data.js') ?>"></script>

<!-- Jasny-bootstrap  JavaScript -->
<script src="<?= base_url('assets/template/vendors/jasny-bootstrap/dist/js/jasny-bootstrap.min.js') ?>"></script>

<!-- Ion JavaScript -->
<script src="<?= base_url('assets/template/vendors/ion-rangeslider/js/ion.rangeSlider.min.js') ?>"></script>
<script src="<?= base_url('assets/template/dist/js/rangeslider-data.js') ?>"></script>

<!-- Select2 JavaScript -->
<script src="<?= base_url('assets/template/vendors/select2/dist/js/select2.full.min.js') ?>"></script>
<script src="<?= base_url('assets/template/dist/js/select2-data.js') ?>"></script>

<!-- Pickr JavaScript -->
<script src="<?= base_url('assets/template/vendors/pickr-widget/dist/pickr.min.js') ?>"></script>
<script src="<?= base_url('assets/template/dist/js/pickr-data.js') ?>"></script>

<!-- Daterangepicker JavaScript -->
<script src="<?= base_url('assets/template/vendors/moment/min/moment.min.js') ?>"></script>
<script src="<?= base_url('assets/template/vendors/daterangepicker/daterangepicker.js') ?>"></script>
<script src="<?= base_url('assets/template/dist/js/daterangepicker-data.js') ?>"></script>

<!-- Slimscroll JavaScript -->
<script src="<?= base_url('assets/template/dist/js/jquery.slimscroll.js') ?>"></script>

<!-- Gallery JavaScript -->
<script src="<?= base_url('assets/template/vendors/lightgallery/dist/js/lightgallery-all.min.js') ?>"></script>
<script src="<?= base_url('assets/template/dist/js/froogaloop2.min.js') ?>"></script>
<script src="<?= base_url('assets/template/dist/js/gallery-data.js') ?>"></script>

<!-- Data Table JavaScript -->
<script src="<?= base_url('assets/template/dist/js/dataTables-data.js'); ?>"></script>
<script src="<?= base_url('assets/template/vendors/jszip/dist/jszip.min.js'); ?>"></script>
<script src="<?= base_url('assets/template/vendors/pdfmake/build/vfs_fonts.js'); ?>"></script>
<script src="<?= base_url('assets/template/vendors/pdfmake/build/pdfmake.min.js'); ?>"></script>
<script src="<?= base_url('assets/template/vendors/datatables.net/js/jquery.dataTables.min.js'); ?>"></script>
<script src="<?= base_url('assets/template/vendors/datatables.net-buttons/js/buttons.flash.min.js'); ?>"></script>
<script src="<?= base_url('assets/template/vendors/datatables.net-buttons/js/buttons.print.min.js'); ?>"></script>
<script src="<?= base_url('assets/template/vendors/datatables.net-buttons/js/buttons.html5.min.js'); ?>"></script>
<script src="<?= base_url('assets/template/vendors/datatables.net-dt/js/dataTables.dataTables.min.js'); ?>"></script>
<script src="<?= base_url('assets/template/vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js'); ?>"></script>
<script src="<?= base_url('assets/template/vendors/datatables.net-buttons/js/dataTables.buttons.min.js'); ?>"></script>
<script src="<?= base_url('assets/template/vendors/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js'); ?>"></script>
<script src="<?= base_url('assets/template/vendors/datatables.net-responsive/js/dataTables.responsive.min.js'); ?>"></script>


<!-- Number -->
<script type="text/javascript">
	function hanyaAngka(evt) {
		var charCode = (evt.which) ? evt.which : event.keyCode
		if (charCode > 31 && (charCode < 48 || charCode > 57))

			return false;
		return true;
	}

	// Input Uploads //
	$('.custom-file-input').on('change', function() {
		let fileName = $(this).val().split('\\').pop();
		$(this).next('.custom-file-label').addClass("selected").html(fileName);
	});
</script>

</body>
</html>

