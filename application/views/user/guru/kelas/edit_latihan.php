<main class="container px-8 mx-auto">
	<!-- tombol back -->
	<header class="flex mt-5 justify-items-start">
		<a href="<?= base_url('guru/latihan/') . $latihan['id_latihan']; ?>" class="p-1 transition duration-100 border-2 border-transparent rounded-primary focus:border-secondary-300">
			<svg class="w-6 stroke-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
				<path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M10 19l-7-7m0 0l7-7m-7 7h18" />
			</svg>
		</a>
	</header>
	<div class=" mt-4">
		<h1 class="text-5xl font-semibold text-center">Latihan</h1>
	</div>

	<form action="<?= base_url('guru/edit_latihan_proses'); ?>" method="POST" class="mt-5" autocomplete="off">
		<input type="hidden" name="id_latihan" value="<?= $latihan['id_latihan']; ?>">
		<input type="hidden" name="dibuat_latihan" value="<?= $latihan['dibuat_latihan']; ?>">
		<input type="hidden" name="id_kelas" value="<?= $latihan['id_kelas']; ?>">
		<input type="hidden" name="tipe_latihan" value="<?= $latihan['tipe_latihan']; ?>">
		<div class="mb-5">
			<label class="font-semibold">Nama Latihan</label>
			<input class="w-full p-3 text-sm font-medium bg-transparent border-2 appearance-none placeholder-secondary-100 border-secondary-300 focus:outline-none focus:bg-gray-200 rounded-primary" type="text" name="nama_latihan" value="<?= $latihan['nama_latihan']; ?>" required>
		</div>
		<div class="mb-5">
			<label class="font-semibold">Tipe Latihan</label>
			<select class="w-full mt-2 p-3 text-sm font-medium bg-transparent border-2  placeholder-secondary-100 border-secondary-300 focus:outline-none focus:bg-gray-200 rounded-primary" name="tipe_latihan" disabled="" required="">
				<?php if($latihan['tipe_latihan'] == 1){ ?>
					<option selected="" value="<?= $latihan['tipe_latihan']; ?>">Pilihan Ganda</option>
				<?php }else{ ?>
					<option selected="" value="<?= $latihan['tipe_latihan']; ?>">Essay</option>
				<?php } ?>
			</select>
		</div>
		
		<div class="grid grid-cols-2 gap-3">
			<div class="mb-5">
				<label class="font-semibold">Tenggat Tanggal</label>
				<input class="w-full p-3 text-sm font-medium bg-transparent border-2 appearance-none placeholder-secondary-100 border-secondary-300 focus:outline-none focus:bg-gray-200 rounded-primary" type="date" value="<?= date('Y-m-d', strtotime($latihan['tenggat_latihan'])); ?>" name="tenggat_tanggal" required="">
			</div>
			<div class="mb-5">
				<label class="font-semibold">Tenggat Waktu</label>
				<input class="w-full p-3 text-sm font-medium bg-transparent border-2 appearance-none placeholder-secondary-100 border-secondary-300 focus:outline-none focus:bg-gray-200 rounded-primary" type="time" name="tenggat_waktu" value="<?= date('H:i:s', strtotime($latihan['tenggat_latihan'])); ?>" required="">
			</div>
		</div>

		<div class="grid grid-cols-2 gap-3">
			<div class="mb-5">
				<label class="font-semibold">Tanggal Mulai</label>
				<input class="w-full p-3 text-sm font-medium bg-transparent border-2 appearance-none placeholder-secondary-100 border-secondary-300 focus:outline-none focus:bg-gray-200 rounded-primary" type="date" name="tanggal_mulai" value="<?= date('Y-m-d', strtotime($latihan['tanggal_mulai'])); ?>" required="">
			</div>
			<div class="mb-5">
				<label class="font-semibold">Waktu Mulai</label>
				<input class="w-full p-3 text-sm font-medium bg-transparent border-2 appearance-none placeholder-secondary-100 border-secondary-300 focus:outline-none focus:bg-gray-200 rounded-primary" type="time" name="waktu_mulai" value="<?= date('H:i:s', strtotime($latihan['tanggal_mulai'])); ?>" required="">
			</div>
		</div>

		<div class="mb-5">
			<label class="font-semibold">Deskripsi Latihan</label>
			<textarea rows="8" class="w-full p-3 text-sm font-medium bg-transparent border-2 appearance-none placeholder-secondary-100 border-secondary-300 focus:outline-none focus:bg-gray-200 rounded-primary" type="text" name="deksripsi_latihan" placeholder="Masukan Deskripsi Latihan" required=""><?= $latihan['deksripsi_latihan']; ?></textarea>
		</div>

		<div class="mb-5">
			<label class="font-semibold">Waktu Latihan</label>
			<select class="w-full mt-2 p-3 text-sm font-medium bg-transparent border-2  placeholder-secondary-100 border-secondary-300 focus:outline-none focus:bg-gray-200 rounded-primary" name="waktu_latihan" required="">
				<option disabled="">Pilih</option>
				<option selected="" value="<?= $latihan['waktu_latihan']; ?>"><?= $latihan['waktu_latihan']; ?> Menit</option>
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
			<input class="w-full p-3 text-sm font-medium bg-transparent border-2 appearance-none placeholder-secondary-100 border-secondary-300 focus:outline-none focus:bg-gray-200 rounded-primary" type="text" maxlength="3" name="point_latihan" placeholder="Masukan Point Latihan" onkeypress="return hanyaAngka(event)" required="" value="<?= $latihan['point_latihan']; ?>">
		</div>

		<button onclick="return confirm('Anda yakin ingin mengubah latihan?'); " class="w-full p-2 mt-3 mb-10 font-bold text-center text-white border-2 border-b-8 bg-success-300 focus:outline-none focus:bg-success-200 border-secondary-300 focus:border-secondary-200 rounded-primary" type="submit"> Edit Latihan </button>
	</form>

</main>