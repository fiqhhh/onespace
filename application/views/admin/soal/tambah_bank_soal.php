<!-- Main Content -->
<div class="hk-pg-wrapper">
	<nav class="hk-breadcrumb" aria-label="breadcrumb">
		<ol class="breadcrumb breadcrumb-light bg-transparent mb-1">
			<li class="breadcrumb-item"><i data-feather='bar-chart-2' class='icons-br-size'></i> <a href="<?= base_url('admin/'); ?>">Dashboard</a></li>
			<li class="breadcrumb-item"><i data-feather='file-text' class='icons-br-size'></i> <a href="<?= base_url('admin/bank_soal'); ?>">Bank Soal</a></li>
			<li class="breadcrumb-item active" aria-current="page"><i data-feather='plus-circle' class='icons-br-size'></i> Tambah Bank Soal</li>
		</ol>
	</nav>

	<!-- Container -->
	<div class="container mt-10">
		<div class="row">
			<div class="col-xl-12">
				<section class="hk-sec-wrapper">
					<h5 class="d-flex align-items-end hk-sec-title mb-1"><i data-feather="plus-circle" class="mr-1 icons-header-size"></i> Tambah Bank Soal</h5>

					<hr>

					<?= Flasher::flash(); ?>
					
					<div class="container">

						<form action="<?= base_url('admin/tambah_bank_soal'); ?>" method="POST" id="form" autocomplete="off">
							<div class="form-group">
								<label>Nama Latihan</label>
								<select class="select2" name="id_latihan">
									<option selected="" disabled="">Pilih</option>
									<?php foreach($latihan as $key){ ?>
										<?php if($key->tipe_latihan == "1"){ ?>
											<option value="<?= $key->id_latihan; ?>"><?= $key->nama_latihan; ?> - Pg | <?= $key->nama_kelas; ?></option>
										<?php }elseif($key->tipe_latihan == "2"){ ?>
											<option value="<?= $key->id_latihan; ?>"><?= $key->nama_latihan; ?> - Essay | <?= $key->nama_kelas; ?></option>
										<?php }elseif($key->tipe_latihan == "3"){ ?>
											<option value="<?= $key->id_latihan; ?>"><?= $key->nama_latihan; ?> - Pg & Essay | <?= $key->nama_kelas; ?></option>
										<?php } ?>
									<?php } ?>
								</select>
								<?= form_error('id_latihan','<small class="text-danger">','</small>'); ?>
							</div>
							<div class="form-group">
								<label>Tipe Soal</label>
								<select class="form-control custom-select" name="tipe_soal" id="tipeSoal" onChange="disabledpg(this)">
									<option selected="" disabled="">Pilih</option>
									<option value="1">Pilihan Ganda</option>
									<option value="2">Essay</option>
								</select>
								<?= form_error('tipe_soal', '<small class="text-danger">', '</small>')  ?>
							</div>
							<div class="form-group">
								<label>Soal Latihan</label>
								<input type="file" name="file_soal" class="form-control mb-2"> 
								<div class="tinymce-wrap">
									<textarea class="tinymce" name="soal"><?= set_value('soal'); ?></textarea>
									<?= form_error('soal', '<small class="text-danger">', '</small>')  ?>
								</div>
							</div>
							<div class="form-group" id="pgKu">
								<div class="row">
									<div class="col-md-12">
										<label>Pilihan A</label>
										<div class="pull-right">
											<div class="custom-control custom-radio radio-success">
												<input type="radio" id="kunci_jawaban_a" data-toggle="tooltip-success" data-placement="top" title="Anda memilih jawaban ini sebagai Kunci Jawaban" name="kunci_jawaban" class="custom-control-input" value="A">
												<label class="custom-control-label" for="kunci_jawaban_a">Jadikan Kunci</label>
											</div>
										</div>   
									</div>     
								</div>
								<input type="file" name="file_a" class="form-control mb-2">
								<div class="tinymce-wrap">
									<textarea class="tinymce" name="pilihan_a"><?= set_value('pilihan_a'); ?></textarea>
									<small class="form-text text-muted">Contoh : Tidak perlu mengisi seperti ini (A. )</small>
								</div>
							</div>
							<div class="form-group" id="pgKu-2">
								<div class="row">
									<div class="col-md-12">
										<label>Pilihan B</label>
										<div class="pull-right">
											<div class="custom-control custom-radio radio-success">
												<input type="radio" id="kunci_jawaban_b" data-toggle="tooltip-success" data-placement="top" title="Anda memilih jawaban ini sebagai Kunci Jawaban" name="kunci_jawaban" class="custom-control-input" value="B">
												<label class="custom-control-label" for="kunci_jawaban_b">Jadikan Kunci</label>
											</div>
										</div>  
									</div>      
								</div>
								<input type="file" name="file_b" class="form-control mb-2"> 
								<div class="tinymce-wrap">
									<textarea class="tinymce" name="pilihan_b"><?= set_value('pilihan_b'); ?></textarea>
									<small class="form-text text-muted">Contoh : Tidak perlu mengisi seperti ini (B. )</small>
								</div>
							</div>
							<div class="form-group" id="pgKu-3">
								<div class="row">
									<div class="col-md-12">
										<label>Pilihan C</label>
										<div class="pull-right">
											<div class="custom-control custom-radio radio-success">
												<input type="radio" id="kunci_jawaban_c" data-toggle="tooltip-success" data-placement="top" title="Anda memilih jawaban ini sebagai Kunci Jawaban" name="kunci_jawaban" class="custom-control-input" value="C">
												<label class="custom-control-label" for="kunci_jawaban_c">Jadikan Kunci</label>
											</div>
										</div>
									</div>     
								</div>
								<input type="file" name="file_c" class="form-control mb-2"> 
								<div class="tinymce-wrap">
									<textarea class="tinymce" name="pilihan_c"><?= set_value('pilihan_c'); ?></textarea>
									<small class="form-text text-muted">Contoh : Tidak perlu mengisi seperti ini (C. )</small>
								</div>
							</div>
							<div class="form-group" id="pgKu-4">
								<div class="row">
									<div class="col-md-12">
										<label>Pilihan D</label>
										<div class="pull-right">
											<div class="custom-control custom-radio radio-success">
												<input type="radio" id="kunci_jawaban_d" data-toggle="tooltip-success" data-placement="top" title="Anda memilih jawaban ini sebagai Kunci Jawaban" name="kunci_jawaban" class="custom-control-input" value="D">
												<label class="custom-control-label" for="kunci_jawaban_d">Jadikan Kunci</label>
											</div>
										</div>
									</div>   
								</div>
								<input type="file" name="file_d" class="form-control mb-2"> 
								<div class="tinymce-wrap">
									<textarea class="tinymce" name="pilihan_d"><?= set_value('pilihan_d'); ?></textarea>
									<small class="form-text text-muted">Contoh : Tidak perlu mengisi seperti ini (D. )</small>
								</div>
							</div>
							<div class="form-group" id="pgKu-5">
								<div class="row">
									<div class="col-md-12">
										<label>Pilihan E</label>
										<div class="pull-right">
											<div class="custom-control custom-radio radio-success">
												<input type="radio" id="kunci_jawaban_e" data-toggle="tooltip-success" data-placement="top" title="Anda memilih jawaban ini sebagai Kunci Jawaban" name="kunci_jawaban" class="custom-control-input" value="E">
												<label class="custom-control-label" for="kunci_jawaban_e">Jadikan Kunci</label>
											</div>
										</div>
									</div>   
								</div>
								<input type="file" name="file_e" class="form-control mb-2"> 
								<div class="tinymce-wrap">
									<textarea class="tinymce" name="pilihan_e"><?= set_value('pilihan_e'); ?></textarea>
									<small class="form-text text-muted">Contoh : Tidak perlu mengisi seperti ini (E. )</small>
								</div>
							</div>

						</div>
						<hr class="mb-3">
						<div class="form-row">
							<div class="col-sm-12">  
								<div class="form-group float-right mb-0">
									<a href="<?= base_url('admin/bank_soal'); ?>" class="btn btn-secondary"><i data-feather="arrow-left" class="icons-size"></i> Kembali</a>
									<button type="submit" class="btn btn-primary"><i data-feather="plus-circle" class="icons-size"></i> Tambah Soal</button>
								</div>
							</div>
						</div>
					</form>
				</section>
			</div>
		</div>
	</div>

	<!-- Ajax -->
	<script type="text/javascript">

		function disabledpg(value){
			var st = $("#tipeSoal").val();

			if(st == "2"){ 
				document.getElementById("pgKu").style.display='none';
				document.getElementById("pgKu-2").style.display='none';
				document.getElementById("pgKu-3").style.display='none';
				document.getElementById("pgKu-4").style.display='none';
				document.getElementById("pgKu-5").style.display='none';
			}else if(st == "1"){
				document.getElementById("pgKu").style.display='block';
				document.getElementById("pgKu-2").style.display='block';
				document.getElementById("pgKu-3").style.display='block';
				document.getElementById("pgKu-4").style.display='block';
				document.getElementById("pgKu-5").style.display='block';
			}
		}

		function tambah(){
			$('#form')[0].reset();
			$('#modalformtitle').html('Tambah Soal'); 
			$('#modalformsubmit').html('Tambah Soal');  
			document.getElementById('form').action = "<?= base_url('admin/bank_soal'); ?>";
		}

	</script>