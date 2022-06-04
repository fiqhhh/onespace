<main class="container px-8 mx-auto">
	<!-- tombol back -->
	<header class="flex mt-5 justify-items-start">
		<a href="<?= base_url('guru/kelas/') . $kelas['id_kelas']; ?>" class="p-1 transition duration-100 border-2 border-transparent rounded-primary focus:border-secondary-300">
			<svg class="w-6 stroke-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
				<path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M10 19l-7-7m0 0l7-7m-7 7h18" />
			</svg>
		</a>
	</header>
	<div class=" mt-4">
		<h1 class="text-5xl font-semibold text-center">Materi</h1>
	</div>

	<form action="<?= base_url('guru/tambah_materi_proses'); ?>" method="POST" class="mt-5" autocomplete="off" enctype="multipart/form-data">
		<input type="hidden" name="id_kelas" value="<?= $kelas['id_kelas']; ?>">
		<div class="mb-5">
			<label class="font-semibold">Nama Materi</label>
			<input class="w-full p-3 text-sm font-medium bg-transparent border-2 appearance-none placeholder-secondary-100 border-secondary-300 focus:outline-none focus:bg-gray-200 rounded-primary" type="text" name="nama_materi" placeholder="Masukan Nama Materi" required="">
		</div>
		<div class="mb-5">
			<label class="font-semibold">Deskripsi Materi</label>
			<textarea rows="8" class="w-full p-3 text-sm font-medium bg-transparent border-2 appearance-none placeholder-secondary-100 border-secondary-300 focus:outline-none focus:bg-gray-200 rounded-primary" type="text" name="deksripsi_materi" placeholder="Masukan Deskripsi Materi" required=""></textarea>
		</div>
		<div class="mb-5">
			<label class="font-semibold">Lampiran</label>
			<div class="custom-file-container" data-upload-id="myUniqueUploadId">
				<label class="custom-file-container__image-clear"></label>
				<label class="custom-file-container__custom-file" >
					<input type="file" name="lampiran[]" class="custom-file-container__custom-file__custom-file-input" accept="*" multiple aria-label="Choose File" multiple required>
					<span class="custom-file-container__custom-file__custom-file-control"></span>
				</label>
				<div class="custom-file-container__image-preview"></div>
			</div>
		</div>

		<button class="w-full p-2 mt-3 mb-10 font-bold text-center text-white border-2 border-b-8 bg-primary-300 focus:outline-none focus:bg-primary-200 border-secondary-300 focus:border-secondary-200 rounded-primary" type="submit"> Tambah Materi </button>

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