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
		<h1 class="text-5xl font-semibold text-center">Latihan</h1>
	</div>

	<form action="<?= base_url('guru/tambah_latihan_proses'); ?>" method="POST" class="mt-5" autocomplete="off">
		<input type="hidden" name="id_kelas" value="<?= $kelas['id_kelas']; ?>">
		<div class="mb-5">
			<label class="font-semibold">Nama Latihan</label>
			<input class="w-full p-3 text-sm font-medium bg-transparent border-2 appearance-none placeholder-secondary-100 border-secondary-300 focus:outline-none focus:bg-gray-200 rounded-primary" type="text" name="nama_latihan" placeholder="Masukan Nama Latihan" required="">
		</div>
		<div class="mb-5">
			<label class="font-semibold">Tipe Latihan</label>
			<select class="w-full mt-2 p-3 text-sm font-medium bg-transparent border-2  placeholder-secondary-100 border-secondary-300 focus:outline-none focus:bg-gray-200 rounded-primary" name="tipe_latihan" required="">
				<option selected="" disabled="">Pilih</option>
				<option value="1">Pilihan Ganda</option>
				<option value="2">Essay</option>
			</select>
		</div>

		<div class="grid grid-cols-2 gap-3">
			<div class="mb-5">
				<label class="font-semibold">Tenggat Tanggal</label>
				<input class="w-full p-3 text-sm font-medium bg-transparent border-2 appearance-none placeholder-secondary-100 border-secondary-300 focus:outline-none focus:bg-gray-200 rounded-primary" type="date" name="tenggat_tanggal" required="">
			</div>
			<div class="mb-5">
				<label class="font-semibold">Tenggat Waktu</label>
				<input class="w-full p-3 text-sm font-medium bg-transparent border-2 appearance-none placeholder-secondary-100 border-secondary-300 focus:outline-none focus:bg-gray-200 rounded-primary" type="time" name="tenggat_waktu" required="">
			</div>
		</div>

		<div class="grid grid-cols-2 gap-3">
			<div class="mb-5">
				<label class="font-semibold">Tanggal Mulai</label>
				<input class="w-full p-3 text-sm font-medium bg-transparent border-2 appearance-none placeholder-secondary-100 border-secondary-300 focus:outline-none focus:bg-gray-200 rounded-primary" type="date" name="tanggal_mulai" required="">
			</div>
			<div class="mb-5">
				<label class="font-semibold">Waktu Mulai</label>
				<input class="w-full p-3 text-sm font-medium bg-transparent border-2 appearance-none placeholder-secondary-100 border-secondary-300 focus:outline-none focus:bg-gray-200 rounded-primary" type="time" name="waktu_mulai" required="">
			</div>
		</div>

		<div class="mb-5">
			<label class="font-semibold">Deskripsi Latihan</label>
			<textarea rows="8" class="w-full p-3 text-sm font-medium bg-transparent border-2 appearance-none placeholder-secondary-100 border-secondary-300 focus:outline-none focus:bg-gray-200 rounded-primary" type="text" name="deksripsi_latihan" placeholder="Masukan Deskripsi Latihan" required=""></textarea>
		</div>

		<div class="mb-5">
			<label class="font-semibold">Waktu Latihan</label>
			<select class="w-full mt-2 p-3 text-sm font-medium bg-transparent border-2  placeholder-secondary-100 border-secondary-300 focus:outline-none focus:bg-gray-200 rounded-primary" name="waktu_latihan" required="">
				<option selected="" disabled="">Pilih</option>
				<option value="0">Tidak diwaktui</option>
				<option value="30">30 Menit</option>
				<option value="45">45 Menit</option>
				<option value="60">60 Menit</option>
				<option value="90">90 Menit</option>
				<option value="120">120 Menit</option>
				<option value="180">180 Menit</option>
			</select>
		</div>
		<div class="mb-5">
			<label class="font-semibold">Point Latihan</label>
			<input class="w-full p-3 text-sm font-medium bg-transparent border-2 appearance-none placeholder-secondary-100 border-secondary-300 focus:outline-none focus:bg-gray-200 rounded-primary" type="text" maxlength="3" name="point_latihan" placeholder="Masukan Point Latihan" onkeypress="return hanyaAngka(event)" required="">
		</div>

		<button class="w-full p-2 mt-3 mb-10 font-bold text-center text-white border-2 border-b-8 bg-success-300 focus:outline-none focus:bg-success-200 border-secondary-300 focus:border-secondary-200 rounded-primary" type="submit"> Tambah Latihan </button>
	</form>

</main>
