<!-- Main Content -->
<div class="hk-pg-wrapper">
	<nav class="hk-breadcrumb" aria-label="breadcrumb">
		<ol class="breadcrumb breadcrumb-light bg-transparent mb-1">
			<li class="breadcrumb-item"><i data-feather='bar-chart-2' class='icons-br-size'></i> <a href="<?= base_url('admin/'); ?>">Dashboard</a></li>
			<li class="breadcrumb-item"><i data-feather='check-circle' class='icons-br-size'></i> <a href="<?= base_url('admin/hasil_latihan'); ?>">Hasil Latihan</a></li>
			<li class="breadcrumb-item"><i data-feather='search' class='icons-br-size'></i> <a href="<?= base_url('admin/hasil_latihan_detail/' . $latihan['id_latihan'] ); ?>"><?= $latihan['nama_latihan']; ?></a></li>
			<li class="breadcrumb-item active" aria-current="page"><i data-feather='user' class='icons-br-size'></i> <?= $hasil_row['nama_murid']; ?></li>
		</ol>
	</nav>
	<!-- Container -->
	<div class="container mt-20">
		<div class="row">
			<div class="col-xl-12">

				<section class="hk-sec-wrapper">
					<?php if($latihan['tipe_latihan'] == "1"){ ?>
						<div class="row">
							<div class="col-sm-12">
								<span class="text-black"><i data-feather="check-circle" class="mr-1 icons-size"></i> Hasil Latihan</span>
								<div class="pull-right">
									<span class="badge badge-secondary">Nama : <?= $hasil_row['nama_murid']; ?></span>
									<span class="badge badge-indigo">Tipe : Pilihan Ganda</span>
									<?php if($nilai_murid['point_hasil'] <= 50){ ?>
										<span class="badge badge-danger">Nilai : <?= $nilai_murid['point_hasil']; ?> dari <?= $hasil_row['point_bobot']; ?></span>
									<?php }elseif($nilai_murid['point_hasil'] <= 80){ ?>
										<span class="badge badge-warning">Nilai : <?= $nilai_murid['point_hasil']; ?> dari <?= $hasil_row['point_bobot']; ?></span>
									<?php }else{ ?>
										<span class="badge badge-success">Nilai : <?= $nilai_murid['point_hasil']; ?> dari <?= $hasil_row['point_bobot']; ?></span>
									<?php } ?>
								</div>
							</div>
						</div>
					<?php }elseif($latihan['tipe_latihan'] == "2"){ ?>
						<h5 class="d-flex align-items-end hk-sec-title mb-2"><i data-feather="check-circle" class="mr-1"></i>Hasil Latihan
						</h5>
						<h5>
							<span class="badge badge-secondary">Nama : <?= $hasil_row['nama_murid']; ?></span>
							<span class="badge badge-purple">Tipe : Essay</span>
							<span class="badge badge-success">Nilai : <?= $nilai_murid['point_hasil']; ?> dari <?= $latihan['point_latihan']." Point"; ?></span>
						</h5>
					<?php }elseif($latihan['tipe_latihan'] == "3"){ ?>
						<h5 class="d-flex align-items-end hk-sec-title mb-2"><i data-feather="check-circle" class="mr-1"></i>Hasil Latihan</h5>
						<h5>
							<span class="badge badge-secondary">Nama : <?= $hasil_row['nama_murid']; ?></span>
							<span class="badge badge-dark">Tipe : Pilihan Ganda & Essay</span> 
							<span class="badge badge-success">Nilai : <?= $nilai_murid['point_hasil']; ?> dari <?= $latihan['point_latihan']." Point"; ?></span>
						</h5>
					<?php } ?>
				</section>

				<?php if($latihan['tipe_latihan'] == "1"){ ?>

					<?php $hitung_point = $hasil_row['point_bobot'] / $jumlah_soal; ?>	

					<?php $num = 1; foreach($hasil_result as $row){ ?>

						<section class="hk-sec-wrapper">
							<input type="hidden" name="id_soal" value="<?= $row->id_soal; ?>" >
							<div class="row pl-3 mb-1 text-black">
								<div class="col-md-0 pr-1"><?= $num; ?>. </div>
								<div class="col-md-0 "><?= $row->soal; ?></div>

								<div class="col-md-0 pl-2">
									<?php if($row->point_hasil == 0){ ?>
										<span class="badge badge-danger"><?= $row->point_hasil; ?> / <?= $hitung_point.".00"; ?></span>
									<?php }else{ ?>
										<span class="badge badge-success"><?= $row->point_hasil; ?> / <?= $hitung_point.".00"; ?></span>
									<?php } ?>
								</div>
							</div>
							<!-- Jika E Kosong otomatis pilihan menjadi a,b,c ,d-->
							<?php if(empty($row->pilihan_e) && !empty($row->pilihan_d)){ ?>

								<!-- Pilihan A -->
								<?php if($row->jawaban == "A" && $row->kunci_jawaban == "A"){ ?>
									<div class="row pl-3">
										<div class="col-md-0 pr-1">
											<div class="custom-control custom-radio radio-success">
												<input type="radio" id="jawaban_a_<?= $row->id_soal; ?>" name="jawaban_<?= $row->id_soal; ?>" class="custom-control-input" value="A" checked disabled>
												<label class="custom-control-label text-success" for="jawaban_a_<?= $row->id_soal; ?>"><?= $row->pilihan_a; ?></label>
											</div>
										</div>
									</div>
								<?php }elseif($row->jawaban == "A" && $row->kunci_jawaban != "A"){ ?>
									<div class="row pl-3">
										<div class="col-md-0 pr-1">
											<div class="custom-control custom-radio radio-danger">
												<input type="radio" id="jawaban_a_<?= $row->id_soal; ?>" name="jawaban_<?= $row->id_soal; ?>" class="custom-control-input" value="A" checked disabled>
												<label class="custom-control-label text-danger" for="jawaban_a_<?= $row->id_soal; ?>"><?= $row->pilihan_a; ?></label>
											</div>
										</div>
									</div>
								<?php }else{ ?>
									<div class="row pl-3">
										<div class="col-md-0 pr-1">
											<div class="custom-control custom-radio radio-primary">
												<input type="radio" id="jawaban_a_<?= $row->id_soal; ?>" name="jawaban_<?= $row->id_soal; ?>" class="custom-control-input" value="A" disabled>
												<label class="custom-control-label" for="jawaban_a_<?= $row->id_soal; ?>"><?= $row->pilihan_a; ?></label>
											</div>
										</div>
									</div>
								<?php } ?>

								<!-- Pilihan B -->
								<?php if($row->jawaban == "B" && $row->kunci_jawaban == "B"){ ?>
									<div class="row pl-3">
										<div class="col-md-0 pr-1">
											<div class="custom-control custom-radio radio-success">
												<input type="radio" id="jawaban_b_<?= $row->id_soal; ?>" name="jawaban_<?= $row->id_soal; ?>" class="custom-control-input" value="B" checked disabled>
												<label class="custom-control-label text-success" for="jawaban_b_<?= $row->id_soal; ?>"><?= $row->pilihan_b; ?></label>
											</div>
										</div>
									</div>
								<?php }elseif($row->jawaban == "B" && $row->kunci_jawaban != "B"){ ?>
									<div class="row pl-3">
										<div class="col-md-0 pr-1">
											<div class="custom-control custom-radio radio-danger">
												<input type="radio" id="jawaban_b_<?= $row->id_soal; ?>" name="jawaban_<?= $row->id_soal; ?>" class="custom-control-input" value="B" checked disabled>
												<label class="custom-control-label text-danger" for="jawaban_b_<?= $row->id_soal; ?>"><?= $row->pilihan_b; ?></label>
											</div>
										</div>
									</div>
								<?php }else{ ?>
									<div class="row pl-3">
										<div class="col-md-0 pr-1">
											<div class="custom-control custom-radio radio-primary">
												<input type="radio" id="jawaban_b_<?= $row->id_soal; ?>" name="jawaban_<?= $row->id_soal; ?>" class="custom-control-input" value="B" disabled>
												<label class="custom-control-label" for="jawaban_b_<?= $row->id_soal; ?>"><?= $row->pilihan_b; ?></label>
											</div>
										</div>
									</div>
								<?php } ?>

								<!-- Pilihan C -->
								<?php if($row->jawaban == "C" && $row->kunci_jawaban == "C"){ ?>
									<div class="row pl-3">
										<div class="col-md-0 pr-1">
											<div class="custom-control custom-radio radio-success">
												<input type="radio" id="jawaban_c_<?= $row->id_soal; ?>" name="jawaban_<?= $row->id_soal; ?>" class="custom-control-input" value="C" checked disabled>
												<label class="custom-control-label text-success" for="jawaban_c_<?= $row->id_soal; ?>"><?= $row->pilihan_c; ?></label>
											</div>
										</div>
									</div>
								<?php }elseif($row->jawaban == "C" && $row->kunci_jawaban != "C"){ ?>
									<div class="row pl-3">
										<div class="col-md-0 pr-1">
											<div class="custom-control custom-radio radio-danger">
												<input type="radio" id="jawaban_c_<?= $row->id_soal; ?>" name="jawaban_<?= $row->id_soal; ?>" class="custom-control-input" value="C" checked disabled>
												<label class="custom-control-label text-danger" for="jawaban_c_<?= $row->id_soal; ?>"><?= $row->pilihan_c; ?></label>
											</div>
										</div>
									</div>
								<?php }else{ ?>
									<div class="row pl-3">
										<div class="col-md-0 pr-1">
											<div class="custom-control custom-radio radio-primary">
												<input type="radio" id="jawaban_c_<?= $row->id_soal; ?>" name="jawaban_<?= $row->id_soal; ?>" class="custom-control-input" value="C" disabled>
												<label class="custom-control-label" for="jawaban_c_<?= $row->id_soal; ?>"><?= $row->pilihan_c; ?></label>
											</div>
										</div>
									</div>
								<?php } ?>

								<!-- Pilihan D -->
								<?php if($row->jawaban == "D" && $row->kunci_jawaban == "D"){ ?>
									<div class="row pl-3">
										<div class="col-md-0 pr-1">
											<div class="custom-control custom-radio radio-success">
												<input type="radio" id="jawaban_d_<?= $row->id_soal; ?>" name="jawaban_<?= $row->id_soal; ?>" class="custom-control-input" value="D" checked disabled>
												<label class="custom-control-label text-success" for="jawaban_d_<?= $row->id_soal; ?>"><?= $row->pilihan_d; ?></label>
											</div>
										</div>
									</div>
								<?php }elseif($row->jawaban == "D" && $row->kunci_jawaban != "D"){ ?>
									<div class="row pl-3">
										<div class="col-md-0 pr-1">
											<div class="custom-control custom-radio radio-danger">
												<input type="radio" id="jawaban_d_<?= $row->id_soal; ?>" name="jawaban_<?= $row->id_soal; ?>" class="custom-control-input" value="D" checked disabled>
												<label class="custom-control-label text-danger" for="jawaban_d_<?= $row->id_soal; ?>"><?= $row->pilihan_d; ?></label>
											</div>
										</div>
									</div>
								<?php }else{ ?>
									<div class="row pl-3">
										<div class="col-md-0 pr-1">
											<div class="custom-control custom-radio radio-primary">
												<input type="radio" id="jawaban_d_<?= $row->id_soal; ?>" name="jawaban_<?= $row->id_soal; ?>" class="custom-control-input" value="D" disabled>
												<label class="custom-control-label" for="jawaban_d_<?= $row->id_soal; ?>"><?= $row->pilihan_d; ?></label>
											</div>
										</div>
									</div>
								<?php } ?>
								<!-- Jika D Kosong otomatis pilihan menjadi a,b,c -->
							<?php }elseif(empty($row->pilihan_d) && !empty($row->pilihan_c)){ ?>

								<!-- Pilihan A -->
								<?php if($row->jawaban == "A" && $row->kunci_jawaban == "A"){ ?>
									<div class="row pl-3">
										<div class="col-md-0 pr-1">
											<div class="custom-control custom-radio radio-success">
												<input type="radio" id="jawaban_a_<?= $row->id_soal; ?>" name="jawaban_<?= $row->id_soal; ?>" class="custom-control-input" value="A" checked disabled>
												<label class="custom-control-label text-success" for="jawaban_a_<?= $row->id_soal; ?>"><?= $row->pilihan_a; ?></label>
											</div>
										</div>
									</div>
								<?php }elseif($row->jawaban == "A" && $row->kunci_jawaban != "A"){ ?>
									<div class="row pl-3">
										<div class="col-md-0 pr-1">
											<div class="custom-control custom-radio radio-danger">
												<input type="radio" id="jawaban_a_<?= $row->id_soal; ?>" name="jawaban_<?= $row->id_soal; ?>" class="custom-control-input" value="A" checked disabled>
												<label class="custom-control-label text-danger" for="jawaban_a_<?= $row->id_soal; ?>"><?= $row->pilihan_a; ?></label>
											</div>
										</div>
									</div>
								<?php }else{ ?>
									<div class="row pl-3">
										<div class="col-md-0 pr-1">
											<div class="custom-control custom-radio radio-primary">
												<input type="radio" id="jawaban_a_<?= $row->id_soal; ?>" name="jawaban_<?= $row->id_soal; ?>" class="custom-control-input" value="A" disabled>
												<label class="custom-control-label" for="jawaban_a_<?= $row->id_soal; ?>"><?= $row->pilihan_a; ?></label>
											</div>
										</div>
									</div>
								<?php } ?>

								<!-- Pilihan B -->
								<?php if($row->jawaban == "B" && $row->kunci_jawaban == "B"){ ?>
									<div class="row pl-3">
										<div class="col-md-0 pr-1">
											<div class="custom-control custom-radio radio-success">
												<input type="radio" id="jawaban_b_<?= $row->id_soal; ?>" name="jawaban_<?= $row->id_soal; ?>" class="custom-control-input" value="B" checked disabled>
												<label class="custom-control-label text-success" for="jawaban_b_<?= $row->id_soal; ?>"><?= $row->pilihan_b; ?></label>
											</div>
										</div>
									</div>
								<?php }elseif($row->jawaban == "B" && $row->kunci_jawaban != "B"){ ?>
									<div class="row pl-3">
										<div class="col-md-0 pr-1">
											<div class="custom-control custom-radio radio-danger">
												<input type="radio" id="jawaban_b_<?= $row->id_soal; ?>" name="jawaban_<?= $row->id_soal; ?>" class="custom-control-input" value="B" checked disabled>
												<label class="custom-control-label text-danger" for="jawaban_b_<?= $row->id_soal; ?>"><?= $row->pilihan_b; ?></label>
											</div>
										</div>
									</div>
								<?php }else{ ?>
									<div class="row pl-3">
										<div class="col-md-0 pr-1">
											<div class="custom-control custom-radio radio-primary">
												<input type="radio" id="jawaban_b_<?= $row->id_soal; ?>" name="jawaban_<?= $row->id_soal; ?>" class="custom-control-input" value="B" disabled>
												<label class="custom-control-label" for="jawaban_b_<?= $row->id_soal; ?>"><?= $row->pilihan_b; ?></label>
											</div>
										</div>
									</div>
								<?php } ?>

								<!-- Pilihan C -->
								<?php if($row->jawaban == "C" && $row->kunci_jawaban == "C"){ ?>
									<div class="row pl-3">
										<div class="col-md-0 pr-1">
											<div class="custom-control custom-radio radio-success">
												<input type="radio" id="jawaban_c_<?= $row->id_soal; ?>" name="jawaban_<?= $row->id_soal; ?>" class="custom-control-input" value="C" checked disabled>
												<label class="custom-control-label text-success" for="jawaban_c_<?= $row->id_soal; ?>"><?= $row->pilihan_c; ?></label>
											</div>
										</div>
									</div>
								<?php }elseif($row->jawaban == "C" && $row->kunci_jawaban != "C"){ ?>
									<div class="row pl-3">
										<div class="col-md-0 pr-1">
											<div class="custom-control custom-radio radio-danger">
												<input type="radio" id="jawaban_c_<?= $row->id_soal; ?>" name="jawaban_<?= $row->id_soal; ?>" class="custom-control-input" value="C" checked disabled>
												<label class="custom-control-label text-danger" for="jawaban_c_<?= $row->id_soal; ?>"><?= $row->pilihan_c; ?></label>
											</div>
										</div>
									</div>
								<?php }else{ ?>
									<div class="row pl-3">
										<div class="col-md-0 pr-1">
											<div class="custom-control custom-radio radio-primary">
												<input type="radio" id="jawaban_c_<?= $row->id_soal; ?>" name="jawaban_<?= $row->id_soal; ?>" class="custom-control-input" value="C" disabled>
												<label class="custom-control-label" for="jawaban_c_<?= $row->id_soal; ?>"><?= $row->pilihan_c; ?></label>
											</div>
										</div>
									</div>
								<?php } ?>

								<!-- Jika C Kosong otomatis pilihan menjadi a,b -->
							<?php }elseif(empty($row->pilihan_c && !empty($row->pilihan_b))){ ?>

								<!-- Pilihan A -->
								<?php if($row->jawaban == "A" && $row->kunci_jawaban == "A"){ ?>
									<div class="row pl-3">
										<div class="col-md-0 pr-1">
											<div class="custom-control custom-radio radio-success">
												<input type="radio" id="jawaban_a_<?= $row->id_soal; ?>" name="jawaban_<?= $row->id_soal; ?>" class="custom-control-input" value="A" checked disabled>
												<label class="custom-control-label text-success" for="jawaban_a_<?= $row->id_soal; ?>"><?= $row->pilihan_a; ?></label>
											</div>
										</div>
									</div>
								<?php }elseif($row->jawaban == "A" && $row->kunci_jawaban != "A"){ ?>
									<div class="row pl-3">
										<div class="col-md-0 pr-1">
											<div class="custom-control custom-radio radio-danger">
												<input type="radio" id="jawaban_a_<?= $row->id_soal; ?>" name="jawaban_<?= $row->id_soal; ?>" class="custom-control-input" value="A" checked disabled>
												<label class="custom-control-label text-danger" for="jawaban_a_<?= $row->id_soal; ?>"><?= $row->pilihan_a; ?></label>
											</div>
										</div>
									</div>
								<?php }else{ ?>
									<div class="row pl-3">
										<div class="col-md-0 pr-1">
											<div class="custom-control custom-radio radio-primary">
												<input type="radio" id="jawaban_a_<?= $row->id_soal; ?>" name="jawaban_<?= $row->id_soal; ?>" class="custom-control-input" value="A" disabled>
												<label class="custom-control-label" for="jawaban_a_<?= $row->id_soal; ?>"><?= $row->pilihan_a; ?></label>
											</div>
										</div>
									</div>
								<?php } ?>

								<!-- Pilihan B -->
								<?php if($row->jawaban == "B" && $row->kunci_jawaban == "B"){ ?>
									<div class="row pl-3">
										<div class="col-md-0 pr-1">
											<div class="custom-control custom-radio radio-success">
												<input type="radio" id="jawaban_b_<?= $row->id_soal; ?>" name="jawaban_<?= $row->id_soal; ?>" class="custom-control-input" value="B" checked disabled>
												<label class="custom-control-label text-success" for="jawaban_b_<?= $row->id_soal; ?>"><?= $row->pilihan_b; ?></label>
											</div>
										</div>
									</div>
								<?php }elseif($row->jawaban == "B" && $row->kunci_jawaban != "B"){ ?>
									<div class="row pl-3">
										<div class="col-md-0 pr-1">
											<div class="custom-control custom-radio radio-danger">
												<input type="radio" id="jawaban_b_<?= $row->id_soal; ?>" name="jawaban_<?= $row->id_soal; ?>" class="custom-control-input" value="B" checked disabled>
												<label class="custom-control-label text-danger" for="jawaban_b_<?= $row->id_soal; ?>"><?= $row->pilihan_b; ?></label>
											</div>
										</div>
									</div>
								<?php }else{ ?>
									<div class="row pl-3">
										<div class="col-md-0 pr-1">
											<div class="custom-control custom-radio radio-primary">
												<input type="radio" id="jawaban_b_<?= $row->id_soal; ?>" name="jawaban_<?= $row->id_soal; ?>" class="custom-control-input" value="B" disabled>
												<label class="custom-control-label" for="jawaban_b_<?= $row->id_soal; ?>"><?= $row->pilihan_b; ?></label>
											</div>
										</div>
									</div>
								<?php } ?>

								<!-- Jika B Kosong otomatis pilihan menjadi a -->
							<?php }elseif(empty($row->pilihan_b && !empty($row->pilihan_a))){ ?>

								<!-- Pilihan A -->
								<?php if($row->jawaban == "A" && $row->kunci_jawaban == "A"){ ?>
									<div class="row pl-3">
										<div class="col-md-0 pr-1">
											<div class="custom-control custom-radio radio-success">
												<input type="radio" id="jawaban_a_<?= $row->id_soal; ?>" name="jawaban_<?= $row->id_soal; ?>" class="custom-control-input" value="A" checked disabled>
												<label class="custom-control-label text-success" for="jawaban_a_<?= $row->id_soal; ?>"><?= $row->pilihan_a; ?></label>
											</div>
										</div>
									</div>
								<?php }elseif($row->jawaban == "A" && $row->kunci_jawaban != "A"){ ?>
									<div class="row pl-3">
										<div class="col-md-0 pr-1">
											<div class="custom-control custom-radio radio-danger">
												<input type="radio" id="jawaban_a_<?= $row->id_soal; ?>" name="jawaban_<?= $row->id_soal; ?>" class="custom-control-input" value="A" checked disabled>
												<label class="custom-control-label text-danger" for="jawaban_a_<?= $row->id_soal; ?>"><?= $row->pilihan_a; ?></label>
											</div>
										</div>
									</div>
								<?php }else{ ?>
									<div class="row pl-3">
										<div class="col-md-0 pr-1">
											<div class="custom-control custom-radio radio-primary">
												<input type="radio" id="jawaban_a_<?= $row->id_soal; ?>" name="jawaban_<?= $row->id_soal; ?>" class="custom-control-input" value="A" disabled>
												<label class="custom-control-label" for="jawaban_a_<?= $row->id_soal; ?>"><?= $row->pilihan_a; ?></label>
											</div>
										</div>
									</div>
								<?php } ?>

								<!-- Jika A Kosong otomatis pilihan menjadi NULL -->
							<?php }elseif(empty($row->pilihan_a)){ ?>
								<span class="badge badge-danger">Tidak memilih pilihan</span>
							<?php }else{ ?>
								<!-- Pilihan A -->
								<?php if($row->jawaban == "A" && $row->kunci_jawaban == "A"){ ?>
									<div class="row pl-3">
										<div class="col-md-0 pr-1">
											<div class="custom-control custom-radio radio-success">
												<input type="radio" id="jawaban_a_<?= $row->id_soal; ?>" name="jawaban_<?= $row->id_soal; ?>" class="custom-control-input" value="A" checked disabled>
												<label class="custom-control-label text-success" for="jawaban_a_<?= $row->id_soal; ?>"><?= $row->pilihan_a; ?></label>
											</div>
										</div>
									</div>
								<?php }elseif($row->jawaban == "A" && $row->kunci_jawaban != "A"){ ?>
									<div class="row pl-3">
										<div class="col-md-0 pr-1">
											<div class="custom-control custom-radio radio-danger">
												<input type="radio" id="jawaban_a_<?= $row->id_soal; ?>" name="jawaban_<?= $row->id_soal; ?>" class="custom-control-input" value="A" checked disabled>
												<label class="custom-control-label text-danger" for="jawaban_a_<?= $row->id_soal; ?>"><?= $row->pilihan_a; ?></label>
											</div>
										</div>
									</div>
								<?php }else{ ?>
									<div class="row pl-3">
										<div class="col-md-0 pr-1">
											<div class="custom-control custom-radio radio-primary">
												<input type="radio" id="jawaban_a_<?= $row->id_soal; ?>" name="jawaban_<?= $row->id_soal; ?>" class="custom-control-input" value="A" disabled>
												<label class="custom-control-label" for="jawaban_a_<?= $row->id_soal; ?>"><?= $row->pilihan_a; ?></label>
											</div>
										</div>
									</div>
								<?php } ?>

								<!-- Pilihan B -->
								<?php if($row->jawaban == "B" && $row->kunci_jawaban == "B"){ ?>
									<div class="row pl-3">
										<div class="col-md-0 pr-1">
											<div class="custom-control custom-radio radio-success">
												<input type="radio" id="jawaban_b_<?= $row->id_soal; ?>" name="jawaban_<?= $row->id_soal; ?>" class="custom-control-input" value="B" checked disabled>
												<label class="custom-control-label text-success" for="jawaban_b_<?= $row->id_soal; ?>"><?= $row->pilihan_b; ?></label>
											</div>
										</div>
									</div>
								<?php }elseif($row->jawaban == "B" && $row->kunci_jawaban != "B"){ ?>
									<div class="row pl-3">
										<div class="col-md-0 pr-1">
											<div class="custom-control custom-radio radio-danger">
												<input type="radio" id="jawaban_b_<?= $row->id_soal; ?>" name="jawaban_<?= $row->id_soal; ?>" class="custom-control-input" value="B" checked disabled>
												<label class="custom-control-label text-danger" for="jawaban_b_<?= $row->id_soal; ?>"><?= $row->pilihan_b; ?></label>
											</div>
										</div>
									</div>
								<?php }else{ ?>
									<div class="row pl-3">
										<div class="col-md-0 pr-1">
											<div class="custom-control custom-radio radio-primary">
												<input type="radio" id="jawaban_b_<?= $row->id_soal; ?>" name="jawaban_<?= $row->id_soal; ?>" class="custom-control-input" value="B" disabled>
												<label class="custom-control-label" for="jawaban_b_<?= $row->id_soal; ?>"><?= $row->pilihan_b; ?></label>
											</div>
										</div>
									</div>
								<?php } ?>

								<!-- Pilihan C -->
								<?php if($row->jawaban == "C" && $row->kunci_jawaban == "C"){ ?>
									<div class="row pl-3">
										<div class="col-md-0 pr-1">
											<div class="custom-control custom-radio radio-success">
												<input type="radio" id="jawaban_c_<?= $row->id_soal; ?>" name="jawaban_<?= $row->id_soal; ?>" class="custom-control-input" value="C" checked disabled>
												<label class="custom-control-label text-success" for="jawaban_c_<?= $row->id_soal; ?>"><?= $row->pilihan_c; ?></label>
											</div>
										</div>
									</div>
								<?php }elseif($row->jawaban == "C" && $row->kunci_jawaban != "C"){ ?>
									<div class="row pl-3">
										<div class="col-md-0 pr-1">
											<div class="custom-control custom-radio radio-danger">
												<input type="radio" id="jawaban_c_<?= $row->id_soal; ?>" name="jawaban_<?= $row->id_soal; ?>" class="custom-control-input" value="C" checked disabled>
												<label class="custom-control-label text-danger" for="jawaban_c_<?= $row->id_soal; ?>"><?= $row->pilihan_c; ?></label>
											</div>
										</div>
									</div>
								<?php }else{ ?>
									<div class="row pl-3">
										<div class="col-md-0 pr-1">
											<div class="custom-control custom-radio radio-primary">
												<input type="radio" id="jawaban_c_<?= $row->id_soal; ?>" name="jawaban_<?= $row->id_soal; ?>" class="custom-control-input" value="C" disabled>
												<label class="custom-control-label" for="jawaban_c_<?= $row->id_soal; ?>"><?= $row->pilihan_c; ?></label>
											</div>
										</div>
									</div>
								<?php } ?>

								<!-- Pilihan D -->
								<?php if($row->jawaban == "D" && $row->kunci_jawaban == "D"){ ?>
									<div class="row pl-3">
										<div class="col-md-0 pr-1">
											<div class="custom-control custom-radio radio-success">
												<input type="radio" id="jawaban_d_<?= $row->id_soal; ?>" name="jawaban_<?= $row->id_soal; ?>" class="custom-control-input" value="D" checked disabled>
												<label class="custom-control-label text-success" for="jawaban_d_<?= $row->id_soal; ?>"><?= $row->pilihan_d; ?></label>
											</div>
										</div>
									</div>
								<?php }elseif($row->jawaban == "D" && $row->kunci_jawaban != "D"){ ?>
									<div class="row pl-3">
										<div class="col-md-0 pr-1">
											<div class="custom-control custom-radio radio-danger">
												<input type="radio" id="jawaban_d_<?= $row->id_soal; ?>" name="jawaban_<?= $row->id_soal; ?>" class="custom-control-input" value="D" checked disabled>
												<label class="custom-control-label text-danger" for="jawaban_d_<?= $row->id_soal; ?>"><?= $row->pilihan_d; ?></label>
											</div>
										</div>
									</div>
								<?php }else{ ?>
									<div class="row pl-3">
										<div class="col-md-0 pr-1">
											<div class="custom-control custom-radio radio-primary">
												<input type="radio" id="jawaban_d_<?= $row->id_soal; ?>" name="jawaban_<?= $row->id_soal; ?>" class="custom-control-input" value="D" disabled>
												<label class="custom-control-label" for="jawaban_d_<?= $row->id_soal; ?>"><?= $row->pilihan_d; ?></label>
											</div>
										</div>
									</div>
								<?php } ?>

								<!-- Pilihan E -->
								<?php if($row->jawaban == "E" && $row->kunci_jawaban == "E"){ ?>
									<div class="row pl-3">
										<div class="col-md-0 pr-1">
											<div class="custom-control custom-radio radio-success">
												<input type="radio" id="jawaban_e_<?= $row->id_soal; ?>" name="jawaban_<?= $row->id_soal; ?>" class="custom-control-input" value="E" checked disabled>
												<label class="custom-control-label text-success" for="jawaban_e_<?= $row->id_soal; ?>"><?= $row->pilihan_e; ?></label>
											</div>
										</div>
									</div>
								<?php }elseif($row->jawaban == "E" && $row->kunci_jawaban != "E"){ ?>
									<div class="row pl-3">
										<div class="col-md-0 pr-1">
											<div class="custom-control custom-radio radio-danger">
												<input type="radio" id="jawaban_e_<?= $row->id_soal; ?>" name="jawaban_<?= $row->id_soal; ?>" class="custom-control-input" value="D" checked disabled>
												<label class="custom-control-label text-danger" for="jawaban_e_<?= $row->id_soal; ?>"><?= $row->pilihan_e; ?></label>
											</div>
										</div>
									</div>
								<?php }else{ ?>
									<div class="row pl-3">
										<div class="col-md-0 pr-1">
											<div class="custom-control custom-radio radio-primary">
												<input type="radio" id="jawaban_e_<?= $row->id_soal; ?>" name="jawaban_<?= $row->id_soal; ?>" class="custom-control-input" value="E" disabled>
												<label class="custom-control-label" for="jawaban_e_<?= $row->id_soal; ?>"><?= $row->pilihan_e; ?></label>
											</div>
										</div>
									</div>
								<?php } ?>

							<?php } ?>
							<?php $num++; ?>
						</section>
					<?php } ?>

				<?php } ?>

			</div>
		</div>
	</div>