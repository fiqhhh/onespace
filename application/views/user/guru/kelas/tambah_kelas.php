<main class="container px-8 mx-auto">
	<!-- tombol back -->
	<header class="flex mt-5 justify-items-start">
		<a href="<?= base_url('guru/'); ?>" class="p-1 transition duration-100 border-2 border-transparent rounded-primary focus:border-secondary-300">
			<svg class="w-6 stroke-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
				<path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M10 19l-7-7m0 0l7-7m-7 7h18" />
			</svg>
		</a>
	</header>
	<div class=" mt-4">
		<h1 class="text-5xl font-semibold text-center">Kelas</h1>
	</div>

	<form action="<?= base_url('guru/tambah_kelas_proses'); ?>" method="POST" class="mt-5" autocomplete="off">
		<input type="hidden" name="id_guru" value="<?= $guru['id_guru']; ?>">
		<div class="mb-5">
			<label class="font-semibold">Nama Kelas</label>
			<input class="w-full p-3 text-sm font-medium bg-transparent border-2 appearance-none placeholder-secondary-100 border-secondary-300 focus:outline-none focus:bg-gray-200 rounded-primary" type="text" name="nama_kelas" placeholder="Masukan Nama Kelas" required="">
		</div>
		<div class="mb-5">
			<label class="font-semibold">Mata Pelajaran</label>
			<select class="w-full mt-2 p-3 text-sm font-medium bg-transparent border-2  placeholder-secondary-100 border-secondary-300 focus:outline-none focus:bg-gray-200 rounded-primary" name="id_mapel" required="">
				<option selected="" disabled="">Pilih</option>
				<?php foreach($mapel as $key){ ?>
					<option value="<?= $key->id_mapel; ?>"><?= $key->nama_mapel; ?></option>
				<?php } ?>
			</select>
		</div>
		<div class="mb-5">
			<label class="font-semibold">Jurusan</label>
			<select class="w-full mt-2 p-3 text-sm font-medium bg-transparent border-2  placeholder-secondary-100 border-secondary-300 focus:outline-none focus:bg-gray-200 rounded-primary" name="id_jurusan" required="">
				<option selected="" disabled="">Pilih</option>
				<?php foreach($jurusan as $key){ ?>
					<option value="<?= $key->id_jurusan; ?>"><?= $key->nama_jurusan; ?></option>
				<?php } ?>
			</select>
		</div>
		<div class="mb-5">
			<label class="font-semibold">Tahun Pembelajaran</label>
			<input class="w-full p-3 text-sm font-medium bg-transparent border-2 appearance-none placeholder-secondary-100 border-secondary-300 focus:outline-none focus:bg-gray-200 rounded-primary" type="text" name="tahun_pembelajaran" placeholder="Masukan Tahun Pembelajaran" required="">
		</div>

		<button class="w-full p-2 mt-3 font-bold text-center text-white border-2 border-b-8 bg-primary-300 focus:outline-none focus:bg-primary-200 border-secondary-300 focus:border-secondary-200 rounded-primary" type="submit"> Tambah Kelas </button>

	</form>

</main>
