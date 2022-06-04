	<!-- header navbar -->
	<header x-data="{open: false}" class="bg-white shadow">

		<nav class="container flex justify-between px-8 py-5 mx-auto">
			<div class="flex">
				<!-- icon kalo udah login -->
				<div class="mr-2 cursor-pointer sm:hidden">
					<div id="dropdown">
						<a x-on:click="open = !open" class="box-border inline-flex text-base font-medium">
							<svg class="w-6 stroke-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
								<path x-bind:class="{ 'hidden': open == true }" strokeLinecap="round" strokeLinejoin="round"
								strokeWidth={2} d="M4 6h16M4 12h16M4 18h16" />
								<path x-bind:class="{ 'hidden': open == false }" strokeLinecap="round" strokeLinejoin="round"
								strokeWidth={2} d="M6 18L18 6M6 6l12 12" />
							</svg>
						</a>
					</div>
				</div>
				<div id="logo" class="font-bold text-secondary-300 mt-1"><img class="w-24 sm:24 mx-auto" src="<?=base_url('assets/img/icon/b-logo.png');?>"></div>
			</div>

			<!-- kalo udh login -->
			<div class="hidden sm:block">
				<a href="<?= base_url('murid/'); ?>" id="logo" class="mr-6 font-bold text-secondary-300 focus:text-secondary-200">Home</a>
				<a href="#" id="logo" class="mr-6 font-bold text-secondary-300 focus:text-secondary-200">Absen</a>

				<a href="<?=base_url('murid/logout');?>" id="logo" class="p-2 transition duration-200 border-2 rounded-primary border-secondary-300 hover:bg-primary-200 text-secondary-300 hover:text-white">
					<span class="font-bold">Keluar</span>
				</a>
			</div>

			<!-- icon kalo udah login -->
			<div class="cursor-pointer">
				<a href="<?=base_url('murid/profile')?>">
					<div class="-mt-2">
						<img class="w-10 p-1 border rounded-full border-secondary-300" src="<?=base_url('assets/img/foto_pengguna/') . $murid['foto_pengguna'];?>" alt="avatar">
					</div>
				</a>
			</div>
		</nav>

		<!-- dropdown menu -->
		<div x-show="open" x-bind:class="{ 'hidden' : open == false }" id="dropdown-menu" class="text-center sm:hidden">
			<div class="container px-8 py-3 mx-auto font-semibold">
				<div class="space-y-6 text-base text-black-300">
					<a href="<?= base_url('murid/'); ?>" class="block py-2 pl-3 mb-1 border-2 border-transparent rounded-md focus:border-primary-300">Home</a>
					<a href="#" class="block py-2 pl-3 border-2 border-transparent rounded-md focus:border-primary-300">Absen</a>
				</div>
				<hr class="mx-12 my-6 border-primary-300">
				<a href="<?=base_url('murid/logout');?>" class="block py-2 text-danger-300 pl-3 border-2 border-danger-300 rounded-md focus:bg-danger-200">Keluar</a>
			</div>
		</div>
	</header>


	<main class="container px-8 mx-auto">

		<div class="mt-12">
			<img class="w-32 p-1 border-2 rounded-full border-secondary-300" src="<?=base_url('assets/img/foto_pengguna/') . $murid['foto_pengguna'];?>" alt="avatar">
		</div>

		<div class="mt-10">
			<div class="flex my-auto">
				<h2 class="text-2xl font-bold pr-3"><?=$murid['nama_murid'];?></h2>
			</div>
			<span class="text-lg font-semibold mt-1">(<?=$murid['email_murid'];?>)</span>
			<div class="flex">
				<span class="text-lg font-semibold"><?=$murid['kelas_murid'];?> - <?=$murid['jurusan_murid'];?> (<?= $murid['nama_jurusan']; ?>)</span>
			</div>

			<?php if ($murid['gender_murid'] == "Laki-laki") {?>
				<div class="font-13">Pelajar Sekolah (<?=$murid['gender_murid'];?>)</div>
			<?php } else {?>
				<div class="font-13">Pelajar Sekolah (<?=$murid['gender_murid'];?>)</div>
			<?php }?>
			
		</div>
		<?= $this->session->flashdata('message'); ?>

		<div class="mt-10">
			<div class="flex justify-between mt-5 text-xl font-semibold">
				<span>Nomor Induk Siswa</span>
			</div>
			<span><?=$murid['nis_murid'];?></span>
			<div class="flex justify-between text-xl mt-5 font-semibold">
				<span>Nomor Induk Siswa Nasional</span>
			</div>
			<span><?=$murid['nisn_murid'];?></span>
			<div class="flex justify-between text-xl mt-5 font-semibold">
				<span>Tempat, Tanggal Lahir</span>
			</div>
			<span><?=$murid['tempat_lahir_murid'];?> - <?=date('d M, Y', strtotime($murid['tanggal_lahir_murid']));?></span>
			<div class="flex justify-between mt-5 text-xl font-semibold">
				<span>Nomor Telepon</span>
			</div>
			<span><?=$murid['telepon_murid'];?></span>
			<div class="flex justify-between mt-5 text-xl font-semibold">
				<span>Alamat</span>
			</div>
			<span><?=$murid['alamat'];?> Kec. <?= ucwords($murid['kecamatan']); ?> Kel. <?= ucwords($murid['kelurahan']); ?> Kota <?= ucwords($murid['kota']); ?>, <?= ucwords($murid['provinsi']); ?> <?= $murid['kode_pos']; ?> </span>
		</div>

		<div class="flex justify-center mt-10 text-white">
			<a href="<?=base_url('murid/edit_profile/') . $murid['id_murid'];?>" class="px-32 py-3 font-semibold text-center border-2 mb-10 border-b-4 focus:bg-primary-200 rounded-primary bg-primary-300 border-secondary-300">Edit</a>
		</div>

	</main>