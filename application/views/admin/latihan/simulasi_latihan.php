 <!-- Main Content -->
<div class="hk-pg-wrapper">
	<nav class="hk-breadcrumb" aria-label="breadcrumb">
		<ol class="breadcrumb breadcrumb-light bg-transparent mb-1">
			<li class="breadcrumb-item"><i data-feather='bar-chart-2' class='icons-br-size'></i> <a href="<?= base_url('admin/'); ?>">Dashboard</a></li>
			<li class="breadcrumb-item"><i data-feather='edit-3' class='icons-br-size'></i> <a href="<?= base_url('admin/latihan'); ?>">Latihan</a></li>
			<li class="breadcrumb-item active" aria-current="page"><i data-feather='edit-2' class='icons-br-size'></i> <?= $latihan['nama_latihan']; ?></li>
		</ol>
	</nav>
	<!-- Container -->
	<div class="container mt-20">
		<div class="row">
			<div class="col-xl-12">
				<section class="hk-sec-wrapper">
					<?php if ($latihan['tipe_latihan'] == "1") { ?>
						<div class="row">
							<div class="col-sm-12">
								<span class="text-black"><i data-feather="edit-2" class="mr-1 icons-size"></i>Simulasi Latihan</span>
								<div class="pull-right">
									<?php if ($latihan['waktu_latihan'] >= 1) { ?>
										<span id="durasi" class="badge badge-info"></span>
									<?php } ?>
									<span class="badge badge-purple">Tipe : Pilihan Ganda</span>
									<span class="badge badge-success">Bernilai : <?= $latihan['point_latihan'] . " Point"; ?></span>
								</div>
							</div>
						</div>
					<?php } elseif ($latihan['tipe_latihan'] == "2") { ?>
						<div class="row">
							<div class="col-sm-12">
								<span class="text-black"><i data-feather="edit-2" class="mr-1 icons-size"></i>Simulasi Latihan</span>
								<div class="pull-right">
									<?php if ($latihan['waktu_latihan'] >= 1) { ?>
										<span id="durasi" class="badge badge-info"></span>
									<?php } ?>
									<span class="badge badge-purple">Tipe : Essay</span>
									<span class="badge badge-success">Bernilai : <?= $latihan['point_latihan'] . " Point"; ?></span>
								</div>
							</div>
						</div>
					<?php } elseif ($latihan['tipe_latihan'] == "3") { ?>
						<h5 class="d-flex align-items-end hk-sec-title mb-2"><i data-feather="edit-2" class="mr-1"></i>Simulasi Latihan
						</h5>
						<?php if ($latihan['waktu_latihan'] >= 1) { ?>
							<span id="durasi" class="badge badge-info"></span>
						<?php } ?>
						<span class="badge badge-dark">Tipe : Pilihan Ganda & Essay</span>
						<span class="badge badge-success">Bernilai : <?= $latihan['point_latihan'] . " Point"; ?></span>
					<?php } ?>
				</section>

				<?= Flasher::flash(); ?>

				<form id="form" action="<?= base_url('admin/simulasi_latihan/' . $latihan['id_latihan']); ?>" method="POST" autocomplete="off">

					<section class="hk-sec-wrapper">
						<input type="hidden" name="id_latihan" value="<?= $latihan['id_latihan']; ?>">
						<input type="hidden" name="point_bobot" value="<?= $latihan['point_latihan']; ?>">

						<div class="form-group">
							<label>Murid</label>
							<select class="select2" name="id_murid">
								<option selected="" disabled="">Pilih</option>
								<?php foreach ($data_murid as $key) { ?>
									<option value="<?= $key->id_murid; ?>"><?= $key->nama_murid; ?> | <?= $key->kelas_murid; ?> - <?= $key->jurusan_murid; ?></option>
								<?php } ?>
							</select>
							<?= form_error('id_murid', '<small class="text-danger">', '</small>'); ?>
						</div>
					</section>

					<?php if ($latihan['tipe_latihan'] == "1") { ?>

						<?php $num = 1;
						foreach ($bank_soal_result as $row) { ?>

							<section class="hk-sec-wrapper">
								<input type="hidden" name="id_soal" value="<?= $row->id_soal; ?>">
								<div class="row pl-3 mb-1 text-black">
									<div class="col-md-0 pr-1"><?= $num; ?>. </div>
									<div class="col-md-0 "><?= $row->soal; ?></div>

									<?php $hitung_point = $latihan['point_latihan'] / $bank_soal_num; ?>
									<div class="col-md-0 pl-2">
										<span class="badge badge-success"><?= $hitung_point . " Point"; ?></span>
									</div>
								</div>
								<!-- Jika E Kosong otomatis pilihan menjadi a,b,c ,d-->
								<?php if (empty($row->pilihan_e) && !empty($row->pilihan_d)) { ?>
									<div class="row pl-3">
										<div class="col-md-0 pr-1">
											<div class="custom-control custom-radio radio-primary">
												<input type="radio" id="jawaban_a_<?= $row->id_soal; ?>" name="jawaban_<?= $row->id_soal; ?>" class="custom-control-input" value="A">
												<label class="custom-control-label" for="jawaban_a_<?= $row->id_soal; ?>"><?= $row->pilihan_a; ?></label>
											</div>
										</div>
									</div>
									<div class="row pl-3">
										<div class="col-md-0 pr-1">
											<div class="custom-control custom-radio radio-primary">
												<input type="radio" id="jawaban_b_<?= $row->id_soal; ?>" name="jawaban_<?= $row->id_soal; ?>" class="custom-control-input" value="B">
												<label class="custom-control-label" for="jawaban_b_<?= $row->id_soal; ?>"><?= $row->pilihan_b; ?></label>
											</div>
										</div>
									</div>
									<div class="row pl-3">
										<div class="col-md-0 pr-1">
											<div class="custom-control custom-radio radio-primary">
												<input type="radio" id="jawaban_c_<?= $row->id_soal; ?>" name="jawaban_<?= $row->id_soal; ?>" class="custom-control-input" value="C">
												<label class="custom-control-label" for="jawaban_c_<?= $row->id_soal; ?>"><?= $row->pilihan_c; ?></label>
											</div>
										</div>
									</div>
									<div class="row pl-3">
										<div class="col-md-0 pr-1">
											<div class="custom-control custom-radio radio-primary">
												<input type="radio" id="jawaban_d_<?= $row->id_soal; ?>" name="jawaban_<?= $row->id_soal; ?>" class="custom-control-input" value="D">
												<label class="custom-control-label" for="jawaban_d_<?= $row->id_soal; ?>"><?= $row->pilihan_d; ?></label>
											</div>
										</div>
									</div>
									<!-- Jika D Kosong otomatis pilihan menjadi a,b,c -->
								<?php } elseif (empty($row->pilihan_d) && !empty($row->pilihan_c)) { ?>
									<div class="row pl-3">
										<div class="col-md-0 pr-1">
											<div class="custom-control custom-radio radio-primary">
												<input type="radio" id="jawaban_a_<?= $row->id_soal; ?>" name="jawaban_<?= $row->id_soal; ?>" class="custom-control-input" value="A">
												<label class="custom-control-label" for="jawaban_a_<?= $row->id_soal; ?>"><?= $row->pilihan_a; ?></label>
											</div>
										</div>
									</div>
									<div class="row pl-3">
										<div class="col-md-0 pr-1">
											<div class="custom-control custom-radio radio-primary">
												<input type="radio" id="jawaban_b_<?= $row->id_soal; ?>" name="jawaban_<?= $row->id_soal; ?>" class="custom-control-input" value="B">
												<label class="custom-control-label" for="jawaban_b_<?= $row->id_soal; ?>"><?= $row->pilihan_b; ?></label>
											</div>
										</div>
									</div>
									<div class="row pl-3">
										<div class="col-md-0 pr-1">
											<div class="custom-control custom-radio radio-primary">
												<input type="radio" id="jawaban_c_<?= $row->id_soal; ?>" name="jawaban_<?= $row->id_soal; ?>" class="custom-control-input" value="C">
												<label class="custom-control-label" for="jawaban_c_<?= $row->id_soal; ?>"><?= $row->pilihan_c; ?></label>
											</div>
										</div>
									</div>
									<!-- Jika C Kosong otomatis pilihan menjadi a,b -->
								<?php } elseif (empty($row->pilihan_c && !empty($row->pilihan_b))) { ?>
									<div class="row pl-3">
										<div class="col-md-0 pr-1">
											<div class="custom-control custom-radio radio-primary">
												<input type="radio" id="jawaban_a_<?= $row->id_soal; ?>" name="jawaban_<?= $row->id_soal; ?>" class="custom-control-input" value="A">
												<label class="custom-control-label" for="jawaban_a_<?= $row->id_soal; ?>"><?= $row->pilihan_a; ?></label>
											</div>
										</div>
									</div>
									<div class="row pl-3">
										<div class="col-md-0 pr-1">
											<div class="custom-control custom-radio radio-primary">
												<input type="radio" id="jawaban_b_<?= $row->id_soal; ?>" name="jawaban_<?= $row->id_soal; ?>" class="custom-control-input" value="B">
												<label class="custom-control-label" for="jawaban_b_<?= $row->id_soal; ?>"><?= $row->pilihan_b; ?></label>
											</div>
										</div>
									</div>
									<!-- Jika B Kosong otomatis pilihan menjadi a -->
								<?php } elseif (empty($row->pilihan_b && !empty($row->pilihan_a))) { ?>
									<div class="row pl-3">
										<div class="col-md-0 pr-1">
											<div class="custom-control custom-radio radio-primary">
												<input type="radio" id="jawaban_a_<?= $row->id_soal; ?>" name="jawaban_<?= $row->id_soal; ?>" class="custom-control-input" value="A">
												<label class="custom-control-label" for="jawaban_a_<?= $row->id_soal; ?>"><?= $row->pilihan_a; ?></label>
											</div>
										</div>
									</div>
									<!-- Jika A Kosong otomatis pilihan menjadi NULL -->
								<?php } elseif (empty($row->pilihan_a)) { ?>
									<span class="badge badge-danger">Tidak memilih pilihan</span>
								<?php } else { ?>
									<div class="row pl-3">
										<div class="col-md-0 pr-1">
											<div class="custom-control custom-radio radio-primary">
												<input type="radio" id="jawaban_a_<?= $row->id_soal; ?>" name="jawaban_<?= $row->id_soal; ?>" class="custom-control-input" value="A">
												<label class="custom-control-label" for="jawaban_a_<?= $row->id_soal; ?>"><?= $row->pilihan_a; ?></label>
											</div>
										</div>
									</div>
									<div class="row pl-3">
										<div class="col-md-0 pr-1">
											<div class="custom-control custom-radio radio-primary">
												<input type="radio" id="jawaban_b_<?= $row->id_soal; ?>" name="jawaban_<?= $row->id_soal; ?>" class="custom-control-input" value="B">
												<label class="custom-control-label" for="jawaban_b_<?= $row->id_soal; ?>"><?= $row->pilihan_b; ?></label>
											</div>
										</div>
									</div>
									<div class="row pl-3">
										<div class="col-md-0 pr-1">
											<div class="custom-control custom-radio radio-primary">
												<input type="radio" id="jawaban_c_<?= $row->id_soal; ?>" name="jawaban_<?= $row->id_soal; ?>" class="custom-control-input" value="C">
												<label class="custom-control-label" for="jawaban_c_<?= $row->id_soal; ?>"><?= $row->pilihan_c; ?></label>
											</div>
										</div>
									</div>
									<div class="row pl-3 mb-2">
										<div class="col-md-0 pr-1">
											<div class="custom-control custom-radio radio-primary">
												<input type="radio" id="jawaban_d_<?= $row->id_soal; ?>" name="jawaban_<?= $row->id_soal; ?>" class="custom-control-input" value="D">
												<label class="custom-control-label" for="jawaban_d_<?= $row->id_soal; ?>"><?= $row->pilihan_d; ?></label>
											</div>
										</div>
									</div>
									<div class="row pl-3 mb-2">
										<div class="col-md-0 pr-1">
											<div class="custom-control custom-radio radio-primary">
												<input type="radio" id="jawaban_e_<?= $row->id_soal; ?>" name="jawaban_<?= $row->id_soal; ?>" class="custom-control-input" value="E">
												<label class="custom-control-label" for="jawaban_e_<?= $row->id_soal; ?>"><?= $row->pilihan_e; ?></label>
											</div>
										</div>
									</div>
								<?php } ?>
								<?php $num++; ?>
							</section>
						<?php } ?>

						<!-- Jika tipe Essay -->
					<?php } else { ?>

						<?php $num = 1;
						foreach ($bank_soal_result as $row) { ?>

							<section class="hk-sec-wrapper">
								<div class="row pl-3 text-black">
									<div class="col-md-0 pr-1"><?= $num; ?>. </div>
									<div class="col-md-0"><?= $row->soal; ?></div>
									<?php $hitung_point = $latihan['point_latihan'] / $bank_soal_num; ?>

									<div class="col-md-0 pl-2">
										<span class="badge badge-success"><?= $hitung_point . " Point"; ?></span>
									</div>
								</div>

								<textarea class="form-control mt-2" name="jawaban_<?= $row->id_soal; ?>" placeholder="Masukan Jawaban"></textarea>
								<?php $num++; ?>
							</section>
						<?php } ?>

					<?php } ?>
					<div class="form-row">
						<div class="col-sm-12">
							<div class="form-group float-right mb-0">
								<a href="<?= base_url('admin/latihan'); ?>" class="btn btn-secondary"><i data-feather="arrow-left" class="icons-size"></i> Kembali</a>
								<button type="reset" class="btn btn-warning"><i data-feather="corner-down-left" class="icons-size"></i> Reset</button>
								<button type="submit" class="btn btn-primary" onclick="deleteStorage()"><i data-feather="save" class="icons-size"></i> Simpan Jawaban</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- /Container -->

	<script type="text/javascript">
		function disabledpg(value) {
			var st = $("#tipeSoal").val();

			if (st == "Essay") {
				document.getElementById("pgKu").style.display = 'none';
				document.getElementById("pgKu-2").style.display = 'none';
				document.getElementById("pgKu-3").style.display = 'none';
				document.getElementById("pgKu-4").style.display = 'none';
			} else {
				document.getElementById("pgKu").style.display = 'block';
				document.getElementById("pgKu-2").style.display = 'block';
				document.getElementById("pgKu-3").style.display = 'block';
				document.getElementById("pgKu-4").style.display = 'block';
			}
		}

		// Waktu Mundur (Countdown)
		// var countDownDate = new Date();
		// countDownDate.setMinutes(countDownDate.getMinutes() + )

		// console.log(countDownDate);

		// // Update the count down every 1 second
		// var x = setInterval(function() {

		// 	// Get today's date and time
		// 	var now = new Date().getTime();

		// 	// Find the distance between now and the count down date
		// 	var distance = countDownDate - now;

		// 	// Time calculations for days, hours, minutes and seconds
		// 	var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
		// 	var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
		// 	var seconds = Math.floor((distance % (1000 * 60)) / 1000);

		// 	// Output the result in an element with id="durasi"
		// 	document.getElementById("durasi").innerHTML = "0" + hours + " Jam : " +
		// 		minutes + " Menit : " + seconds + " Detik";

		// 	// If the count down is over, write some text 
		// 	if (distance < 0) {
		// 		clearInterval(x);
		// 		document.getElementById("form").submit();
		// 	}
		// }, 1000);

		const cookieName = 'countDown' + <?= $latihan['id_latihan'] ?>;
		const savedSeconds = localStorage.getItem(cookieName);

		// If there are seconds saved in localStorage, start with these.
		// Otherwise, start with 900 seconds
		const Minutes = <?= $latihan['waktu_latihan'] ?>;
		const Seconds = Minutes * 60; // 15 minutes in seconds
		const startingSeconds = savedSeconds || Seconds;
		let remainingSeconds = startingSeconds;

		const durasiLabel = document.querySelector('#durasi')

		const countdown = () => {
			// If there are any remainingSeconds left, decrement by 1
			// If there are no remainingSeconds left, reset to 15 minutes
			remainingSeconds = remainingSeconds ? remainingSeconds - 1 : document.getElementById("form").submit();
			localStorage.setItem(cookieName, remainingSeconds);
			// Update the DOM

			jam = Math.floor(remainingSeconds / 3600) + ' Jam';
			menit = Math.floor((remainingSeconds / 60) % 60) + ' Menit';
			detik = remainingSeconds % 60 + ' Detik';
			durasiLabel.innerHTML = `${jam}  ${menit}  ${detik} `;

			if (remainingSeconds < 1) {
				clearInterval(countdown);
				document.getElementById("form").submit();
				localStorage.removeItem(cookieName);
			}
		}



		// Call countdown every second.
		setInterval(
			countdown,
			1000
		);


		function deleteStorage() {
			localStorage.removeItem(cookieName);
		}
	</script>