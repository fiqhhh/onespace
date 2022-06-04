<!-- Main Content -->
<div class="hk-pg-wrapper">
	<nav class="hk-breadcrumb" aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-light bg-transparent mb-1">
            <li class="breadcrumb-item"><i data-feather='bar-chart-2' class='icons-br-size'></i> <a href="<?= base_url('admin/'); ?>">Dashboard</a></li>
            <li class="breadcrumb-item"><i data-feather='file-text' class='icons-br-size'></i> <a href="<?= base_url('admin/bank_soal'); ?>">Bank Soal</a></li>
            <li class="breadcrumb-item active" aria-current="page"><i data-feather='edit' class='icons-br-size'></i> Edit Bank Soal</li>
        </ol>
    </nav>
	<!-- Container -->
	<div class="container mt-10">
		<div class="row">
			<div class="col-xl-12">
				<section class="hk-sec-wrapper">
                    <h5 class="d-flex align-items-end hk-sec-title mb-1"><i data-feather="edit" class="mr-1 icons-header-size"></i> Edit Bank Soal</h5>

					<hr>

					<?= Flasher::flash(); ?>

					<form action="<?= base_url('soal/update_soal'); ?>" method="POST" autocomplete="off" enctype="multipart/form-data">

						<div class="form-group">
							<input type="hidden" name="id_soal" value="<?= $bank_soal['id_soal']; ?>" >
							<input type="hidden" name="id_latihan" value="<?= $bank_soal['id_latihan']; ?>" >
							<input type="hidden" name="dibuat_soal" value="<?= $bank_soal['dibuat_soal']; ?>" >
							<label>Latihan</label>
							<select class="select custom-select" name="id_latihan" disabled="">
								<option disabled="">Pilih</option>
								<?php foreach($latihan as $key){ ?>
									<?php if($bank_soal['id_latihan'] == $key->id_latihan) { ?>
										<option value="<?= $key->id_latihan; ?>" selected=""><?= $key->nama_latihan; ?></option>
									<?php }else{  ?>
										<option value="<?= $key->id_latihan; ?>"><?= $key->nama_latihan; ?></option>
									<?php } ?>
								<?php } ?>
							</select>
						</div>

						<div class="form-group">
							<label>Tipe Soal</label>
							<select class="form-control custom-select" name="tipe_soal" id="tipeSoal" onChange="disabledpg(this)">
								<option disabled="">Pilih</option>
								<option value="<?= $bank_soal['tipe_soal']; ?>" selected=""><?= $bank_soal['tipe_soal']; ?></option>
								<option value="Pilihan Ganda">Pilihan Ganda</option>
								<option value="Essay">Essay</option>
							</select>
						</div>
						<div class="form-group">
							<label>Soal</label>
							<div class="tinymce-wrap">
								<textarea class="tinymce" name="soal"><?= $bank_soal['soal']; ?></textarea>
							</div>
						</div>
						
						<?php if($bank_soal['tipe_soal'] == "1"){ ?>
							<div class="form-group" id="pgKu">
								<div class="row">
									<div class="col-md-10"><label>Pilihan A</label></div>
									<div class="col-md-2">
										<?php if($bank_soal['kunci_jawaban'] == "A"){ ?>
											<div class="custom-control custom-radio radio-success">
												<input type="radio" id="kunci_jawaban_a" data-toggle="tooltip-success" data-placement="top" title="Anda memilih jawaban ini sebagai Kunci Jawaban" name="kunci_jawaban" class="custom-control-input" checked="" value="A">
												<label class="custom-control-label" for="kunci_jawaban_a">Jadikan Kunci</label>
											</div>
										<?php }else{ ?>
											<div class="custom-control custom-radio radio-success">
												<input type="radio" id="kunci_jawaban_a" data-toggle="tooltip-success" data-placement="top" title="Anda memilih jawaban ini sebagai Kunci Jawaban" name="kunci_jawaban" class="custom-control-input" value="A">
												<label class="custom-control-label" for="kunci_jawaban_a">Jadikan Kunci</label>
											</div>
										<?php } ?>
									</div>        
								</div>
								<div class="tinymce-wrap">
									<textarea class="tinymce" name="pilihan_a"><?= $bank_soal['pilihan_a']; ?></textarea>
								</div>
							</div>

							<div class="form-group" id="pgKu-2">
								<div class="row">
									<div class="col-md-10"><label>Pilihan B</label></div>
									<div class="col-md-2">
										<?php if($bank_soal['kunci_jawaban'] == "B"){ ?>
											<div class="custom-control custom-radio radio-success">
												<input type="radio" id="kunci_jawaban_b" data-toggle="tooltip-success" data-placement="top" title="Anda memilih jawaban ini sebagai Kunci Jawaban" name="kunci_jawaban" class="custom-control-input" checked="" value="B">
												<label class="custom-control-label" for="kunci_jawaban_b">Jadikan Kunci</label>
											</div>
										<?php }else{ ?>
											<div class="custom-control custom-radio radio-success">
												<input type="radio" id="kunci_jawaban_b" data-toggle="tooltip-success" data-placement="top" title="Anda memilih jawaban ini sebagai Kunci Jawaban" name="kunci_jawaban" class="custom-control-input" value="B">
												<label class="custom-control-label" for="kunci_jawaban_b">Jadikan Kunci</label>
											</div>
										<?php } ?>
									</div>        
								</div>
								<div class="tinymce-wrap">
									<textarea class="tinymce" name="pilihan_b"><?= $bank_soal['pilihan_b']; ?></textarea>
								</div>
							</div>

							<div class="form-group" id="pgKu-3">
								<div class="row">
									<div class="col-md-10"><label>Pilihan C</label></div>
									<div class="col-md-2">
										<?php if($bank_soal['kunci_jawaban'] == "C"){ ?>
											<div class="custom-control custom-radio radio-success">
												<input type="radio" id="kunci_jawaban_c" data-toggle="tooltip-success" data-placement="top" title="Anda memilih jawaban ini sebagai Kunci Jawaban" name="kunci_jawaban" class="custom-control-input" checked="" value="C">
												<label class="custom-control-label" for="kunci_jawaban_c">Jadikan Kunci</label>
											</div>
										<?php }else{ ?>
											<div class="custom-control custom-radio radio-success">
												<input type="radio" id="kunci_jawaban_c" data-toggle="tooltip-success" data-placement="top" title="Anda memilih jawaban ini sebagai Kunci Jawaban" name="kunci_jawaban" class="custom-control-input" value="C">
												<label class="custom-control-label" for="kunci_jawaban_c">Jadikan Kunci</label>
											</div>
										<?php } ?>
									</div>        
								</div>
								<div class="tinymce-wrap">
									<textarea class="tinymce" name="pilihan_c"><?= $bank_soal['pilihan_c']; ?></textarea>
								</div>
							</div>

							<div class="form-group" id="pgKu-4">
								<div class="row">
									<div class="col-md-10"><label>Pilihan D</label></div>
									<div class="col-md-2">
										<?php if($bank_soal['kunci_jawaban'] == "D"){ ?>
											<div class="custom-control custom-radio radio-success">
												<input type="radio" id="kunci_jawaban_d" data-toggle="tooltip-success" data-placement="top" title="Anda memilih jawaban ini sebagai Kunci Jawaban" name="kunci_jawaban" class="custom-control-input" checked="" value="D">
												<label class="custom-control-label" for="kunci_jawaban_d">Jadikan Kunci</label>
											</div>
										<?php }else{ ?>
											<div class="custom-control custom-radio radio-success">
												<input type="radio" id="kunci_jawaban_d" data-toggle="tooltip-success" data-placement="top" title="Anda memilih jawaban ini sebagai Kunci Jawaban" name="kunci_jawaban" class="custom-control-input" value="D">
												<label class="custom-control-label" for="kunci_jawaban_d">Jadikan Kunci</label>
											</div>
										<?php } ?>
									</div>        
								</div>
								<div class="tinymce-wrap">
									<textarea class="tinymce" name="pilihan_d"><?= $bank_soal['pilihan_d']; ?></textarea>
								</div>
							</div>
						<?php } ?>

						<hr class="mb-3">
						<div class="form-row">
							<div class="col-sm-12">  
								<div class="form-group float-right mb-0">
									<a href="<?= base_url('admin/bank_soal'); ?>" class="btn btn-secondary"><i data-feather="arrow-left" class="icons-size"></i> Kembali</a>
									<button type="submit" class="btn btn-primary"><i data-feather="edit" class="icons-size"></i> Edit Soal</button>
								</div>
							</div>
						</div>
					</form>
				</section>
			</div>
		</div>
	</div>
	<!-- /Container -->

	<script type="text/javascript">
		function disabledpg(value){
			var st = $("#tipeSoal").val();

			if(st == "Essay"){ 
				document.getElementById("pgKu").style.display='none';
				document.getElementById("pgKu-2").style.display='none'; 
				document.getElementById("pgKu-3").style.display='none'; 
				document.getElementById("pgKu-4").style.display='none'; 
			}else{ 
				document.getElementById("pgKu").style.display='block';
				document.getElementById("pgKu-2").style.display='block'; 
				document.getElementById("pgKu-3").style.display='block'; 
				document.getElementById("pgKu-4").style.display='block';  
			}
		}
	</script>