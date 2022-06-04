<!-- Main Content -->
<div class="hk-pg-wrapper">
	<nav class="hk-breadcrumb" aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-light bg-transparent mb-1">
            <li class="breadcrumb-item"><i data-feather='bar-chart-2' class='icons-br-size'></i> <a href="<?= base_url('admin/'); ?>">Dashboard</a></li>
            <li class="breadcrumb-item"><i data-feather='check-circle' class='icons-br-size'></i> <a href="<?= base_url('admin/hasil_tugas'); ?>">Hasil Tugas</a></li>
            <li class="breadcrumb-item active" aria-current="page"><i data-feather='edit' class='icons-br-size'></i> Edit Hasil Tugas</li>
        </ol>
    </nav>
	<!-- Container -->
	<div class="container mt-10">
		<div class="row">
			<div class="col-xl-12">
				<section class="hk-sec-wrapper">
					<h5 class="d-flex align-items-end hk-sec-title"><i data-feather="edit" class="mr-1 icons-header-size"></i> Edit Materi Kelas</h5>

					<hr>

					<?= Flasher::flash(); ?>

					<form action="<?= base_url('hasil/update_hasil'); ?>" method="POST" autocomplete="off" enctype="multipart/form-data">

						<input type="hidden" name="id_hasil_tugas" value="<?= $hasil_tugas['id_hasil_tugas']; ?>" >
						<input type="hidden" name="id_murid" value="<?= $hasil_tugas['id_murid']; ?>" >
						<input type="hidden" name="id_tugas" value="<?= $hasil_tugas['id_tugas']; ?>" >

						<div class="form-group">
							<label>Tugas</label>
							<select class="select custom-select" name="id_tugas" disabled="">
								<option disabled="">Pilih</option>
								<?php foreach($tugas as $key){ ?>
									<?php if($hasil_tugas['id_tugas']==$key->id_tugas) { ?>
										<option value="<?= $key->id_tugas;?>" selected=""><?= $key->nama_tugas; ?> | <?= $key->nama_kelas; ?></option>
									<?php } else {  ?>
										<option value="<?= $key->id_tugas;?>"><?= $key->nama_tugas; ?> | <?= $key->nama_kelas; ?></option>
									<?php } ?>
								<?php } ?>
							</select>
						</div>

						<div class="form-group">
							<label>Murid</label>
							<select class="select custom-select" name="id_murid" disabled="">
								<option disabled="">Pilih</option>
								<?php foreach($data_murid as $key){ ?>
									<?php if($hasil_tugas['id_murid']==$key->id_murid) { ?>
										<option value="<?= $key->id_murid;?>" selected=""><?= $key->nama_murid; ?> | <?= $key->kelas_murid ?> - <?= $key->jurusan_murid; ?></option>
									<?php } else {  ?>
										<option value="<?= $key->id_murid;?>"><?= $key->nama_murid; ?> | <?= $key->kelas_murid ?> - <?= $key->jurusan_murid; ?></option>
									<?php } ?>
								<?php } ?>
							</select>
						</div>

						<div class="form-group">
							<div class="custom-file-container" data-upload-id="myUniqueUploadId">
								<label class="custom-file-container__image-clear">Lampiran</label>
								<label class="custom-file-container__custom-file" >
									<input type="file" name="lampiran[]" class="custom-file-container__custom-file__custom-file-input" accept="*" multiple aria-label="Choose File" multiple>
									<span class="custom-file-container__custom-file__custom-file-control"></span>
								</label>
								<div class="custom-file-container__image-preview" ></div>
							</div>
						</div>

						<hr class="mb-3">
						<div class="form-row">
							<div class="col-sm-12">  
								<div class="form-group float-right mb-0">
									<a href="<?= base_url('admin/hasil_tugas'); ?>" class="btn btn-secondary"><i data-feather="arrow-left" class="icons-size"></i> Kembali</a>
									<button type="submit" class="btn btn-primary"><i data-feather="save" class="icons-size"></i> Simpan</button>
								</div>
							</div>
						</div>
					</form>
				</section>
			</div>
		</div>
	</div>
	<!-- /Container -->

	<script src="<?= base_url('assets/multiple/file-upload-with-preview.min.js'); ?>"></script>
	<script type="text/javascript">
		var upload = new FileUploadWithPreview('myUniqueUploadId', {
			showDeleteButtonOnImages: true,
			text: {
				chooseFile: 'Masukan Lampiran',
				browse: 'Pilih Lampiran',
				selectedCount: 'Custom Files Selected Copy',
			},
		});
	</script>