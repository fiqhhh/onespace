<div class="hk-pg-wrapper">
	<!-- Container -->
	<div class="container mt-xl-50 mt-sm-30 mt-15">
		<!-- Title -->
		<div class="hk-pg-header align-items-top">
			<div>
				<h2 class="hk-pg-title font-weight-600 mb-0">Selamat Datang, Admin</h2>
				<p>Dashboard Admin Aplikasi One Space</p>
			</div>
		</div>
		<div class="row">
			<div class="col-xl-12">
				<div class="hk-row">
					<div class="col-sm-12">
						<div class="card-group hk-dash-type-2">
							<div class="card card-sm">
								<div class="card-body">
									<div class="d-flex justify-content-between mb-5">
										<div><span class="d-block font-15 text-dark font-weight-500">Data Guru</span></div>
									</div>
									<div>
										<span class="d-block display-4 text-dark mb-5"><span class="counter-anim"><?= $jmlh_guru; ?></span></span>
										<small class="d-block">Jumlah Semua Guru</small>
									</div>
								</div>
							</div>
							<div class="card card-sm">
								<div class="card-body">
									<div class="d-flex justify-content-between mb-5">
										<div><span class="d-block font-15 text-dark font-weight-500">Data Murid</span></div>
									</div>
									<div>
										<span class="d-block display-4 text-dark mb-5"><span class="counter-anim"><?= $jmlh_murid; ?></span></span>
										<small class="d-block">Jumlah Semua Murid</small>
									</div>
								</div>
							</div>
							<div class="card card-sm">
								<div class="card-body">
									<div class="d-flex justify-content-between mb-5">
										<div><span class="d-block font-15 text-dark font-weight-500">Data Orang Tua</span></div>
									</div>
									<div>
										<span class="d-block display-4 text-dark mb-5"><span class="counter-anim"><?= $jmlh_ortu; ?></span></span>
										<small class="d-block">Jumlah Semua Ortu</small>
									</div>
								</div>
							</div>

						</div>
					</div>	
				</div>
			</div>
			<div class="col-xl-12">
				<div class="hk-row">
					<div class="col-sm-12">
						<section class="hk-sec-wrapper">
							<h6 class="hk-sec-title">Chart Pie Data Pengguna</h6>
							<div class="row">
								<div class="col-sm">
									<div id="e_chart" class="echart" style="height:500px;"></div>
								</div>
							</div>
						</section>
					</div>
				</div>
			</div>

			<div class="col-xl-12">
				<div class="hk-row">
					<div class="col-sm-12">
						<section class="hk-sec-wrapper">
							<h6 class="hk-sec-title">Chart Pie Absen Hari ini</h6>
							<div class="row">
								<div class="col-sm">
									<div id="e_chart1" class="echart" style="height:500px;"></div>
								</div>
							</div>
						</section>
					</div>
				</div>
			</div>
		</div>
	</div>