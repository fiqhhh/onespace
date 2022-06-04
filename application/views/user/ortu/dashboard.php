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
            <div id="logo" class="font-bold text-secondary-300"><img class="w-24 mt-1 sm:24 mx-auto" src="<?= base_url('assets/img/icon/b-logo.png'); ?>"></div>
        </div>

        <!-- kalo udh login -->
        <div class="hidden sm:block">
            <a href="#" id="logo" class="mr-6 font-bold text-secondary-300 focus:text-secondary-200">Home</a>
            <a href="#" id="logo" class="mr-6 font-bold text-secondary-300 focus:text-secondary-200">Absen</a>

            <a href="<?= base_url('ortu/logout'); ?>" id="logo" class="p-2 transition duration-200 border-2 rounded-primary border-secondary-300 hover:bg-primary-200 text-secondary-300 hover:text-white">
                <span class="font-bold">Keluar</span>
            </a>
        </div>

        <!-- icon kalo udah login -->
        <div class="cursor-pointer">
            <div class="-mt-2">
                <a href="<?= base_url('ortu/profile'); ?>"><img class="w-10 p-1 border rounded-full border-secondary-300" src="<?= base_url('assets/img/foto_pengguna/') . $ortu['foto_pengguna']; ?>" alt="avatar"></a>
            </div>
        </div>
    </nav>

    <!-- dropdown menu -->
    <div x-show="open" x-bind:class="{ 'hidden' : open == false }" id="dropdown-menu" class="text-center sm:hidden">
        <div class="container px-8 py-3 mx-auto font-semibold">
            <div class="space-y-6 text-base text-black-300">
                <a href="#" class="block py-2 pl-3 mb-1 border-2 border-transparent rounded-md focus:border-primary-300">Home</a>
                <a href="#" class="block py-2 pl-3 border-2 border-transparent rounded-md focus:border-primary-300">Absen</a>
            </div>
            <hr class="mx-12 my-6 border-primary-300">
            <a href="<?= base_url('ortu/logout'); ?>" class="block py-2 text-danger-300 pl-3 border-2 border-danger-300 rounded-md focus:bg-danger-200">Keluar</a>
        </div>
    </div>
</header>

<main class="container px-8 pt-5 mx-auto mt-5">

    <div x-data="{tab: '1'}">

        <div class="grid w-full grid-cols-2 gap-0">     
            <button :class="{ 'text-white bg-primary-300': tab === '1' }" @click="tab = '1'" class="p-2 font-semibold border-2 border-r-1 focus:outline-none rounded-l-primary border-secondary-300">Absen Harian</button>
            <button :class="{ 'text-white bg-primary-300': tab === '2' }" @click="tab = '2'" class="p-2 font-semibold border-2 border-l-0 focus:outline-none rounded-r-primary border-secondary-300">Absen Mapel</button>
        </div>

        <div x-show="tab === '1'">
            <section class="mt-5">
                <?php if (empty($absensi_masuk)) { ?>
                    <a href="#" class="flex justify-between p-5 mb-5 text-secondary-300 border-2 border-b-8 focus:bg-tertiary-200 bg-tertiary-300 rounded-primary border-secondary-300">
                        <div class="">
                            <h3 class="text-3xl font-semibold">Hari ini</h3>
                            <p class="text-base mb-5"><?= date('d M, Y'); ?></p>

                            <?php if(empty($absen_hari_ini)){ ?>
                                <span class="text-base text-white bg-danger-300 px-3 border-2 border-secondary-300 py-1 rounded-primary">Belum absen</span>
                            <?php }else{ ?>
                                <span class="text-base text-white bg-success-300 px-3 border-2 border-white-300 py-1 rounded-primary">Sudah absen</span>
                            <?php } ?>
                        </div>
                    </a>

                <?php }else{ ?>

                    <!-- Pulang -->
                    <?php foreach($absensi_masuk as $row){ ?>
                        <a href="#" class="flex justify-between p-5 mb-5 text-secondary-300 border-2 border-b-8 focus:bg-tertiary-200 bg-tertiary-300 rounded-primary border-secondary-300">
                            <div class="">
                                <h3 class="text-3xl font-semibold"><?= time_since($row->wkt_absen_masuk); ?></h3>
                                <p class="text-base"><?= date('d M, Y'); ?></p>
                                <?php if(empty($row->tgl_absen_keluar) && empty($row->wkt_absen_keluar)){ ?>
                                    <p class="text-base font-bold mb-5">Belum absen pulang</p>
                                <?php }else{ ?>
                                    <p class="text-base font-bold mb-5">Sudah absen pulang</p>
                                <?php } ?>

                                <?php if(date('H:i:s',$absen_hari_ini['wkt_absen_masuk']) >= "07:00:00"){ ?>
                                    <span class="text-base text-white bg-danger-300 px-3 border-2 border-secondary-300 py-1 rounded-primary">Terlambat</span>
                                <?php }else{ ?>
                                    <span class="text-base text-white bg-success-300 px-3 border-2 border-white-300 py-1 rounded-primary">Tepat Waktu</span>
                                <?php } ?>
                            </div>
                        </a>
                    <?php } ?>


                <?php } ?>

                <?php foreach($data_absensi_masuk as $key){ ?>
                    <?php if($key->tgl_absen_masuk == date('Y-m-d')){ ?>
                        <?= null; ?>
                    <?php }else{ ?>
                        <a href="#" class="flex justify-between p-5 mb-5 text-secondary-300 border-2 border-b-8 focus:bg-tertiary-200 bg-tertiary-300 rounded-primary border-secondary-300">
                            <div class="">
                                <h3 class="text-3xl font-semibold"><?= time_since($key->wkt_absen_masuk); ?></h3>
                                <p class="text-base"><?= date('d M, Y', strtotime($key->tgl_absen_masuk)); ?></p>
                                <?php if($key->tgl_absen_keluar == null){ ?>
                                    <p class="text-base font-bold mb-5">Belum absen pulang</p>
                                <?php }else{ ?>
                                    <p class="text-base font-bold mb-5">Sudah absen pulang</p>
                                <?php } ?>

                                <?php if(date('H:i:s', $key->wkt_absen_masuk) >= "07:00:00"){ ?>
                                    <span class="text-base text-white bg-danger-300 px-3 border-2 border-secondary-300 py-1 rounded-primary">Terlambat</span>
                                <?php }else{ ?>
                                    <span class="text-base text-white bg-success-300 px-3 border-2 border-white py-1 rounded-primary">Tepat Waktu</span>
                                <?php } ?>
                            </div>
                        </a>
                    <?php } ?>
                <?php } ?>

            </section>
        </div>

        <div x-show="tab === '2'">
            <!-- Class -->
            <section class="mt-5">
                <div class="flex justify-between mt-5">
                    <h3 class="font-semibold">Hari ini</h3>
                    <span class="font-semibold"><?= date('d M, Y'); ?></span>
                </div>
                <hr class="border-t-4 mb-5 border-secondary-300">

                <?php if(empty($kelas)){ ?>
                    <a href="#" class="flex justify-center mt-5 p-5 mb-5 border-2 border-b-8 focus:bg-primary-200 bg-primary-300 rounded-primary border-secondary-300 text-white">
                        <div>
                            <h3 class="text-xl font-semibold">Anak Belum bergabung dengan kelas</h3>
                        </div>
                    </a>
                <?php }else{ ?>

                    <?php $detail_absen = $this->m_absen->DetailMapelOrtu($ortu['id_murid'])->result(); ?>                
                    <?php foreach ($kelas as $key) { ?>
                        <a href="#" class="flex justify-between p-5 mb-5 text-white border-2 border-b-8 focus:bg-primary-200 bg-primary-300 rounded-primary border-secondary-300">
                            <div class="">
                                <h3 class="text-3xl font-semibold"><?= $key->nama_kelas; ?></h3>
                                <p class="text-base mb-5"><?= $key->nama_guru; ?>, <?= $key->gelar_guru; ?></p>

                                <?php $absen_hari_ini = $this->m_absen->MapelHariIni($ortu['id_murid'], $key->id_kelas)->result();  ?>

                                <?php if(empty($absen_hari_ini)){ ?>
                                    <span class="text-base bg-danger-300 px-3 border-2 border-secondary-300 py-1 rounded-primary">Belum absen</span>
                                <?php }else{ ?>
                                    <span class="text-base bg-success-300 px-3 border-2 border-white-300 py-1 rounded-primary">Sudah absen</span>
                                <?php } ?>

                            </div>
                        </a>
                    <?php } ?>

                    <?php foreach($detail_absen as $row){ ?>
                        <?php $jmlh_detail = $this->m_absen->DetailMapelOrtuTgl($ortu['id_murid'], $row->tgl_masuk_mapel)->num_rows(); ?>
                        <?php if($row->tgl_masuk_mapel == date('Y-m-d')){ ?>
                            <?= null; ?>
                        <?php }else{ ?>
                            <div class="flex justify-between mt-10">
                                <span class="font-semibold"><?= time_since($row->waktu_masuk_mapel); ?></span>
                                <h3 class="font-semibold">Absen <?= $jmlh_detail; ?> dari <?= $jmlh_kelas; ?> Kelas</h3>
                            </div>
                            <hr class="border-t-4 mb-5 border-secondary-300">

                            <a href="#" class="flex justify-between p-5 mb-5 text-white border-2 border-b-8 focus:bg-primary-200 bg-primary-300 rounded-primary border-secondary-300">
                                <div class="">
                                    <h3 class="text-3xl font-semibold"><?= $row->nama_kelas; ?></h3>
                                    <p class="text-base mb-5"><?= $row->nama_guru; ?>, <?= $row->gelar_guru; ?></p>
                                    <span class="text-base bg-success-300 px-3 border-2 border-white-300 py-1 rounded-primary">Sudah absen</span>
                                </div>
                            </a>
                        <?php } ?>
                    <?php } ?>

                <?php } ?>
            </section>

        </div>
    </div>

</main>