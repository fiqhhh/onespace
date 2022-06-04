<main class="container px-8 mx-auto">
	<!-- tombol back -->
	<header class="flex mt-5 justify-items-start">
		<a href="<?= base_url('guru/materi/') . $materi['id_materi']; ?>" class="p-1 transition duration-100 border-2 border-transparent rounded-primary focus:border-secondary-300">
			<svg class="w-6 stroke-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
				<path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M10 19l-7-7m0 0l7-7m-7 7h18" />
			</svg>
		</a>
	</header>
	<div class=" mt-4">
		<h1 class="text-5xl font-semibold text-center">Materi</h1>
	</div>

	<form action="<?= base_url('guru/edit_materi_proses'); ?>" method="POST" class="mt-5" autocomplete="off" enctype="multipart/form-data">
		<input type="hidden" name="id_materi" value="<?= $materi['id_materi']; ?>">
		<input type="hidden" name="dibuat_materi" value="<?= $materi['dibuat_materi']; ?>">
		<input type="hidden" name="id_kelas" value="<?= $materi['id_kelas']; ?>">
		<div class="mb-5">
			<label class="font-semibold">Nama Materi</label>
			<input class="w-full p-3 text-sm font-medium bg-transparent border-2 appearance-none placeholder-secondary-100 border-secondary-300 focus:outline-none focus:bg-gray-200 rounded-primary" type="text" name="nama_materi" placeholder="Masukan Nama Materi" required="" value="<?= $materi['nama_materi']; ?>">
		</div>
		<div class="mb-5">
			<label class="font-semibold">Deskripsi Materi</label>
			<textarea rows="8" class="w-full p-3 text-sm font-medium bg-transparent border-2 appearance-none placeholder-secondary-100 border-secondary-300 focus:outline-none focus:bg-gray-200 rounded-primary" type="text" name="deksripsi_materi" placeholder="Masukan Deskripsi Materi" required=""><?= $materi['nama_materi']; ?></textarea>
		</div>
		<div class="mb-5">
			<label class="font-semibold">Lampiran</label>
			<div class="custom-file-container" data-upload-id="myUniqueUploadId">
				<label class="custom-file-container__image-clear"></label>
				<label class="custom-file-container__custom-file" >
					<input type="file" name="lampiran[]" class="custom-file-container__custom-file__custom-file-input" accept="*" multiple aria-label="Choose File" multiple>
					<span class="custom-file-container__custom-file__custom-file-control"></span>
				</label>
				<div class="custom-file-container__image-preview"></div>
			</div>
			<div class="bg-blue-200 px-6 py-4 mt-0 mx-2 mb-5 rounded-md flex items-center mx-auto w-full">
				<svg viewBox="0 0 24 24" class="text-blue-600 w-32 h-5 sm:w-5 sm:h-5 mr-3">
					<path fill="currentColor" d="M12,0A12,12,0,1,0,24,12,12.013,12.013,0,0,0,12,0Zm.25,5a1.5,1.5,0,1,1-1.5,1.5A1.5,1.5,0,0,1,12.25,5ZM14.5,18.5h-4a1,1,0,0,1,0-2h.75a.25.25,0,0,0,.25-.25v-4.5a.25.25,0,0,0-.25-.25H10.5a1,1,0,0,1,0-2h1a2,2,0,0,1,2,2v4.75a.25.25,0,0,0,.25.25h.75a1,1,0,1,1,0,2Z"></path>
				</svg>
				<small class="text-blue-800 text-xs">Jika anda menambah lampiran, maka lampiran sebelumnya akan terupdate dengan yang anda input disini. Jika tidak maka akan memakai yang sebelumnya.</small>
			</div>
		</div>

		<button onclick="return confirm('Anda yakin ingin mengubah materi?'); " class="w-full p-2 mt-3 mb-10 font-bold text-center text-secondary-300 border-2 border-b-8 bg-tertiary-300 focus:outline-none focus:bg-tertiary-200 border-secondary-300 focus:border-secondary-200 rounded-primary" type="submit"> Edit Materi </button>

	</form>

</main>

<script src="<?= base_url('assets/multiple/file-upload-with-preview.min.js'); ?>"></script>

<script type="text/javascript">
	var upload = new FileUploadWithPreview('myUniqueUploadId', {
		showDeleteButtonOnImages: true,
		text: {
			chooseFile: 'Masukan Lampiran',
			browse: 'Pilih',
			selectedCount: 'Custom Files Selected Copy',
		},
	})
</script>