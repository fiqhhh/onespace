

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
            <div id="logo" class="font-bold text-secondary-300"><img class="w-24 mt-1 sm:24 mx-auto" src="<?= base_url('assets/img/icon/b-logo.png'); ?>"></div>
        </div>

        <!-- kalo udh login -->
        <div class="hidden sm:block">
            <a href="#" id="logo" class="mr-6 font-bold text-secondary-300 focus:text-secondary-200">Home</a>
            <a href="#" id="logo" class="mr-6 font-bold text-secondary-300 focus:text-secondary-200">Absen</a>

            <a href="<?= base_url('guru/logout'); ?>" id="logo" class="p-2 transition duration-200 border-2 rounded-primary border-secondary-300 hover:bg-primary-200 text-secondary-300 hover:text-white">
                <span class="font-bold">Keluar</span>
            </a>
        </div>

        <!-- icon kalo udah login -->
        <div class="cursor-pointer">
            <div class="-mt-2">
                <a href="<?= base_url('guru/profile'); ?>"><img class="w-10 p-1 border rounded-full border-secondary-300" src="<?= base_url('assets/img/foto_pengguna/') . $guru['foto_pengguna']; ?>" alt="avatar"></a>
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
            <a href="<?= base_url('guru/logout'); ?>" class="block py-2 text-danger-300 pl-3 border-2 border-danger-300 rounded-md focus:bg-danger-200">Keluar</a>
        </div>
    </div>
</header>

<!-- Content -->
<main class="container px-8 pt-8 mx-auto mt-8">

    <!-- Search -->
    <?= $this->session->flashdata('message'); ?>

    <div class="mt-5">
        <span class="text-xl font-semibold text-secondary-300">Absen Harian</span>
        <hr class="border-t-4 rounded-full rounded-full border-secondary-300">

        <?php
        $absensi_masuk = $this->m_absen->TampilGuruMasuk($guru['id_guru'])->result();
        ?>

        <?php if (empty($absensi_masuk)) { ?>

            <a href="<?= base_url('guru/absen_guru_masuk'); ?>" class="flex justify-center p-5 mt-4 mb-6 text-white border-2 border-b-8 focus:bg-tertiary-200 bg-tertiary-300 rounded-primary border-secondary-300">
                <div class="text-center">
                    <div class="text-xl font-semibold text-secondary-300">Absensi Masuk</div>

                    <div class="flex justify-center p-1 mb-2 my-auto border-2 rounded-primary border-secondary-300 bg-secondary-200">
                        <svg class="w-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path>
                        </svg>
                    </div>
                    <?php if(empty($absen_hari_ini)){ ?>
                        <span class="text-center text-white-300 bg-danger-300 px-3 py-0 rounded-primary border-secondary-300 border-2">Belum absen</span>
                    <?php }else{ ?>
                        <span class="text-center text-white-300 bg-success-300 px-3 py-0 rounded-primary border-white border-2">Sudah Absen</span>
                    <?php } ?>

                </div>
            </a>

        <?php }else{ ?>
            <?php foreach ($absensi_masuk as $row) { ?>

                <?php if (empty($row->tgl_absen_keluar) && empty($row->wkt_absen_keluar)) { ?>

                    <?php if ($row->id_guru != $guru['id_guru']) { ?>
                        <a href="<?= base_url('guru/absen_guru_masuk'); ?>" class="flex justify-center p-5 mt-4 mb-6 text-white border-2 border-b-8 focus:bg-primary-200 bg-tertiary-300 rounded-primary border-secondary-300">
                            <div class="text-center">
                                <div class="text-xl font-semibold text-secondary-300">Absensi Masuk</div>

                                <div class="flex justify-center p-1 mb-2 border-2 rounded-primary border-secondary-300 bg-danger-300">
                                    <svg class="w-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path>
                                    </svg>
                                </div>
                                <?php if(empty($absen_hari_ini)){ ?>
                                    <span class="text-center text-white-300 bg-danger-300 px-3 py-0 rounded-primary border-secondary-300 border-2">Belum absen</span>
                                <?php }else{ ?>
                                    <span class="text-center text-white-300 bg-success-300 px-3 py-0 rounded-primary border-white border-2">Sudah Absen</span>
                                <?php } ?>
                            </div>
                        </a>
                    <?php } else { ?>
                        <?php if(date('H:i:s') >= "17:00:00" ){ ?>
                            <a href="<?= base_url('guru/absen_guru_keluar/') . $row->id_absen_masuk; ?>" class="flex justify-center p-5 mt-4 mb-6 text-white border-2 border-b-8 focus:bg-primary-200 bg-tertiary-300 rounded-primary border-secondary-300">
                                <div class="text-center">
                                    <div class="text-xl font-semibold text-secondary-300">Absensi Pulang</div>
                                    <div class="flex justify-center p-1 mb-2 border-2 rounded-primary border-secondary-300 bg-danger-300">
                                        <svg class="w-full p-1 text-white" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-out"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                                    </div>
                                    <?php if(date('H:i:s',$absen_hari_ini['wkt_absen_masuk']) >= "07:00:00"){ ?>
                                        <span class="text-center text-white-300 bg-danger-300 px-3 py-0 rounded-primary border-secondary-300 border-2">Terlambat</span>
                                    <?php }else{ ?>
                                        <span class="text-center text-white-300 bg-success-300 px-3 py-0 rounded-primary border-white border-2">Tepat Waktu</span>
                                    <?php } ?>
                                </div>
                            </a>
                        <?php }else{ ?>
                            <a onclick="return confirm('Belum saatnya absen pulang')" class="flex justify-center p-5 mt-4 mb-6 text-white border-2 border-b-8 focus:bg-primary-200 bg-tertiary-300 cursor-pointer rounded-primary border-secondary-300">
                                <div class="text-center">
                                    <div class="text-xl font-semibold text-secondary-300">Absensi Pulang</div>
                                    <div class="flex justify-center p-1 mb-2 border-2 rounded-primary border-secondary-300 bg-danger-300">
                                        <svg class="w-full p-1 text-white" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-out"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                                    </div>
                                    <?php if(date('H:i:s', $absen_hari_ini['wkt_absen_masuk']) >= "07:00:00"){ ?>
                                        <span class="text-center text-white-300 bg-danger-300 px-3 py-0 rounded-primary border-secondary-300 border-2">Terlambat</span>
                                    <?php }else{ ?>
                                        <span class="text-center text-white-300 bg-success-300 px-3 py-0 rounded-primary border-white border-2">Tepat Waktu</span>
                                    <?php } ?>
                                </div>
                            </a>
                        <?php } ?>
                    <?php } ?>

                <?php } else { ?>
                    <a href="<?= base_url('guru/absen_guru_masuk'); ?>" class="flex justify-center p-5 mt-4 mb-6 text-white border-2 border-b-8 focus:bg-primary-200 bg-tertiary-300 rounded-primary border-secondary-300">
                        <div class="text-center">
                            <div class="text-xl font-semibold text-secondary-300">Absensi Masuk</div>

                            <div class="flex justify-center p-1 mb-2 border-2 rounded-primary border-secondary-300 bg-danger-300">
                                <svg class="w-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path>
                                </svg>
                            </div>
                            <?php if(empty($absen_hari_ini)){ ?>
                                <span class="text-center text-white-300 bg-danger-300 px-3 py-0 rounded-primary border-secondary-300 border-2">Belum absen</span>
                            <?php }else{ ?>
                                <span class="text-center text-white-300 bg-success-300 px-3 py-0 rounded-primary border-white border-2">Sudah Absen</span>
                            <?php } ?>
                        </div>
                    </a>
                <?php } ?>

            <?php } ?>
        <?php } ?>
    </div>

    <div class="mt-10">
        <span class="text-xl font-semibold text-secondary-300">Kelas</span>
        <hr class="border-t-4 rounded-full border-secondary-300">
    </div>

    <!-- Class -->
    <section class="mt-2">

        <div class="grid gap-1">
            <p class="mt-5 font-semibold">Tambah Kelas</p>
        </div>
        <a href="<?= base_url('guru/tambah_kelas/'); ?>" class="flex content-center justify-center mt-1 p-3 mb-5 text-white border-2 border-b-8 focus:bg-primary-200 bg-primary-300 rounded-primary border-secondary-300">
            <svg class="w-10 font-semibold rounded-full bg-secondary border-2 border-white-300 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
        </a>

        <?php if(empty($kelas)){ ?>
            <a href="#" class="flex justify-center mt-5 p-5 mb-5 border-2 border-b-8 focus:bg-primary-200 bg-primary-300 rounded-primary border-secondary-300 text-white">
                <div>
                    <h3 class="sm:text-3xl text-xl font-semibold">Belum membuat kelas</h3>
                </div>
            </a>
        <?php }else{ ?>

            <?php foreach ($kelas as $key) { ?>
                <div class="flex justify-between p-5 mb-5 text-white border-2 border-b-8 bg-primary-300 rounded-primary border-secondary-300">
                    <a href="<?= base_url('guru/kelas/') . $key->id_kelas; ?>" class="hover:underline focus:underline">
                        <h3 class="text-3xl font-semibold"><?= $key->nama_mapel; ?></h3>
                        <?php if (strlen($key->nama_kelas . " Tp. " . $key->tahun_pembelajaran) <= 23) { ?>
                            <span class="text-base"><?= $key->nama_kelas; ?> Tp. <?= $key->tahun_pembelajaran; ?></span>
                        <?php } else { ?>
                            <span class="text-base"><?= substr($key->nama_kelas . " Tp. " . $key->tahun_pembelajaran, 0, 23) . "..." ?></span>
                        <?php } ?>
                        <p class="mt-1 text-base"><?= $key->nama_guru; ?>, <?= $key->gelar_guru; ?></p>
                    </a>

             <!--    <a href="<?= base_url('guru/hapus_kelas/') . $key->id_kelas; ?>" class="flex p-1 my-auto border-2 rounded-primary border-secondary-300 bg-danger-300">
                    <svg class="p-1" xmlns="http://www.w3.org/2000/svg" width="33" height="33" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                </a> -->
            </div>
        <?php } ?>
    <?php } ?>
</section>
</main>