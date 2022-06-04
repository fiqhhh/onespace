<!-- Main Content -->
<div class="hk-pg-wrapper">
	<nav class="hk-breadcrumb" aria-label="breadcrumb">
		<ol class="breadcrumb breadcrumb-light bg-transparent mb-1">
			<li class="breadcrumb-item"><i data-feather='bar-chart-2' class='icons-br-size'></i> <a href="<?= base_url('admin/'); ?>">Dashboard</a></li>
			<li class="breadcrumb-item"><i data-feather='edit-3' class='icons-br-size'></i> <a href="<?= base_url('admin/materi'); ?>">Materi</a></li>
			<li class="breadcrumb-item active" aria-current="page"><i data-feather='edit' class='icons-br-size'></i> Edit Materi</li>
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

					<form action="<?= base_url('materi/update_materi'); ?>" method="POST" autocomplete="off" enctype="multipart/form-data">
						<div class="form-group">
							<label>Judul Tugas</label>
							<input type="hidden" name="id_materi" value="<?= $materi['id_materi']; ?>" >
							<input type="hidden" name="id_kelas" value="<?= $materi['id_kelas']; ?>" >
							<input type="hidden" name="dibuat_materi" value="<?= $materi['dibuat_materi']; ?>" >

							<input type="text" name="nama_materi" class="form-control" placeholder="Masukan Nama Materi" value="<?= $materi['nama_materi']; ?>">
						</div>

						<div class="form-group">
							<label>Kelas</label>
							<select class="select custom-select" name="id_kelas" disabled="">
								<option disabled="">Pilih</option>
								<?php foreach($kelas as $key){ ?>
									<?php if($materi['id_kelas']==$key->id_kelas) { ?>
										<option value="<?= $key->id_kelas;?>" selected=""><?= $key->nama_kelas; ?> | <?= $key->nama_guru; ?> <?= $key->gelar_guru; ?></option>
									<?php } else {  ?>
										<option value="<?= $key->id_kelas;?>"><?= $key->nama_kelas; ?> | <?= $key->nama_guru; ?> <?= $key->gelar_guru; ?></option>
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
								<!-- <input type="file" name="lampiran[]" multiple> -->
							</div>
						</div>

						<div class="form-group">
							<label>Deksripsi Materi</label>
							<div class="tinymce-wrap">
								<textarea class="tinymce" name="deksripsi_materi"><?= $materi['deksripsi_materi']; ?></textarea>
							</div>
						</div>

						<hr class="mb-3">
						<div class="form-row">
							<div class="col-sm-12">  
								<div class="form-group float-right mb-0">
									<a href="<?= base_url('admin/materi'); ?>" class="btn btn-secondary"><i data-feather="arrow-left" class="icons-size"></i> Kembali</a>
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