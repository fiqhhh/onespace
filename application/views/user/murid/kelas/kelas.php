
<main class="container px-8 mx-auto">

    <!-- tombol back -->
    <header class="flex mt-5 justify-items-start">
        <a href="<?= base_url('murid/'); ?>" class="p-1 transition duration-100 border-2 border-transparent rounded-primary focus:border-secondary-300">
            <svg class="w-6 stroke-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
        </a>
    </header>

    <div class="pt-5 mb-5">
        <h1 class="text-5xl font-semibold text-center">Ruang Kelas</h1>
    </div>

    <div x-data="{tab: '1'}">

        <div class="grid w-full grid-cols-3 gap-0">     
            <button :class="{ 'text-white bg-primary-300': tab === '1' }" @click="tab = '1'" class="p-2 font-semibold border-2 border-r-0 focus:outline-none rounded-l-primary border-secondary-300">Home</button>
            <button :class="{ 'text-white bg-primary-300': tab === '2' }" @click="tab = '2'" class="p-2 font-semibold border-2 focus:outline-none border-secondary-300">Kelas</button>
            <button :class="{ 'text-white bg-primary-300': tab === '3' }" @click="tab = '3'" class="p-2 font-semibold border-2 border-l-0 focus:outline-none rounded-r-primary border-secondary-300">Absensi</button>
            
        </div>

        <?= $this->session->flashdata('message'); ?>

        <!-- Tab Kelas -->
        <div x-show="tab === '1'">
            <div class="mt-8">
                <div class="w-full px-5 py-5 sm:px-10 sm:py-6 border-2 border-b-8 bg-primary-100 border-secondary-300 rounded-primary">
                    <div class="mr-16 text-left">
                        <h1 class="text-4xl leading-none mb-3 sm:mb-1 font-semibold"><?= $kelas['nama_mapel']; ?></h1>
                        <p class="text-base font-semibold w-48 sm:w-full"><?= $kelas['nama_kelas']; ?> Tp. <?= $kelas['tahun_pembelajaran']; ?></p>
                    </div>
                    <div class="flex content-center justify-between">
                        <p class="text-lg font-bold">Token : <?= $kelas['token_kelas']; ?></p>
                    </div>
                    <div class="flex content-center justify-between mt-0">
                        <div class="mt-5 sm:mt-10 w-48 sm:w-full">
                            <h4 class="font-semibold"><?= $kelas['nama_guru']; ?>, <?= $kelas['gelar_guru']; ?></h4>
                            <p class="font-semibold"><?= $kelas['nama_jurusan']; ?></p>
                        </div>
                        <div>
                            <p class="font-semibold text-center">PRESENSI</p>
                            <div class="p-1 bg-secondary-200 border-2 rounded-primary border-secondary-300">
                                <a href="<?= base_url('murid/absen_masuk_mapel/') . $kelas['id_kelas']; ?>">
                                    <svg class=" text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-10 mb-10">
                <div class="w-full py-5 px-5 border-2 border-b-8 bg-primary-100 border-secondary-300 rounded-primary">
                    <span class="font-semibold text-xl">Teman Sekelas</span>
                    <div class="border border-secondary-300 mt-2"></div>
                    <div class="sm:grid sm:grid-cols-4 sm:gap-2 sm:mt-4">
                        <?php 
                        $jmlh_murid = $this->m_gabung_kelas->Checking(['id_kelas' => $kelas['id_kelas']])->num_rows();
                        $teman_sekelas = $this->m_gabung_kelas->CheckingAll($kelas['id_kelas'])->result();
                        ?>

                        <?php foreach($teman_sekelas as $key){ ?>
                            <?php $tampil_murid = $this->m_user->TampilMurid($key->id_murid)->result(); ?>
                            <div class="grid grid-cols-10 mt-4 sm:block">
                                <div class="col-span-2 mr-3">
                                    <?php foreach($tampil_murid as $mrd){ ?>
                                        <img class="w-12 sm:mx-auto sm:mb-3 sm:w-20 h-auto p-1 border-2 rounded-full border-secondary-300" src="<?= base_url('assets/img/foto_pengguna/') . $mrd->foto_pengguna; ?>" alt="">
                                    <?php } ?>
                                </div>
                                <div class="col-span-8 sm:text-center sm:mt-2">
                                    <p class="font-semibold"><?= $key->nama_murid; ?></p>
                                    <small>bergabung: <?= time_since(strtotime($key->bergabung_pada)); ?></small>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>



        <!-- Tab Tugas -->
        <div x-show="tab === '2'">
            <div x-data="{tab: 'materi'}">
                <div class="grid grid-cols-3 gap-1 mt-6">
                    <button :class="{ 'box-border text-white bg-primary-300': tab === 'materi' }" @click="tab = 'materi'" class="py-2 px-3 rounded-primary border-2 inline-flex border-secondary-300 text-white focus:outline-none font-bold" >
                        <span class="">Materi</span>
                    </button>

                    <button :class="{ 'box-border text-white bg-primary-300': tab === 'tugas' }" @click="tab = 'tugas'" class="py-2 px-3 rounded-primary border-2 inline-flex border-secondary-300 text-white focus:outline-none font-bold">
                        <span class="">Tugas</span>
                    </button>

                    <button :class="{ 'box-border text-white bg-primary-300': tab === 'latihan' }" @click="tab = 'latihan'" class="py-2 px-3 rounded-primary border-2 inline-flex border-secondary-300 text-white focus:outline-none font-bold">
                        <span class="">Latihan</span>
                    </button>
                </div>

                <div x-show="tab === 'materi'">
                    <?php $materi_result = $this->m_materi->WhereKelas($kelas['id_kelas'])->result(); ?>

                    <?php if(empty($materi_result)){ ?>
                        <a href="#" class="flex justify-center mt-5 p-5 mb-5 border-2 border-b-8 focus:bg-tertiary-200 bg-tertiary-300 rounded-primary border-secondary-300">
                            <div class="">
                                <h3 class="text-xl font-semibold">Guru Belum Memberi Materi Apapun :)</h3>
                            </div>
                        </a>
                    <?php }else{ ?>
                        <?php foreach($materi_result as $key){ ?>
                            <a href="<?= base_url('murid/materi/') . $key->id_materi; ?>" class="flex justify-between mt-5 p-5 mb-5 border-2 border-b-8 bg-tertiary-300 rounded-primary border-secondary-300 hover:underline focus:underline">
                                <div>
                                    <h3 class="pb-0 leading-none text-3xl font-semibold"><?= $key->nama_materi; ?></h3>
                                    <span class="text-base font-semibold"><?= $key->nama_guru; ?>, <?= $key->gelar_guru; ?></span>
                                    <?php if (strlen($key->deksripsi_materi) <= 50) { ?>
                                        <p class="pt-3 text-base"><?= $key->deksripsi_materi; ?></p>
                                    <?php }else{ ?>
                                        <p class="pt-3 text-base"><?= substr($key->deksripsi_materi, 0, 50) . "..." ?></p>
                                    <?php } ?>
                                    <p class="mt-1 text-base"><?= time_since(strtotime($key->dibuat_materi)); ?></p>
                                </div>
                            </a>
                        <?php } ?>
                    <?php } ?>

                </div>
                <div x-show="tab === 'tugas'">
                    <?php $tugas_result = $this->m_tugas->WhereKelas($kelas['id_kelas'])->result(); ?>

                    <?php if(empty($tugas_result)){ ?>
                        <a href="#" class="flex justify-center mt-5 p-5 mb-5 border-2 border-b-8 focus:bg-danger-300 bg-danger-300 rounded-primary border-secondary-200 text-white">
                            <div>
                                <h3 class="text-xl font-semibold">Guru Belum Memberi Tugas Apapun :)</h3>
                            </div>
                        </a>
                    <?php }else{ ?>
                        <?php foreach($tugas_result as $key){ ?>
                            <div class="flex justify-between mt-5 p-5 mb-5 text-white border-2 border-b-8 bg-danger-300 rounded-primary border-secondary-300">
                                <a href="<?= base_url('murid/tugas/') . $key->id_tugas; ?>" class="hover:underline focus:underline">
                                    <h3 class="text-3xl font-semibold"><?= $key->nama_tugas; ?></h3>
                                    <span class="text-base font-semibold"><?= $key->nama_guru; ?>, <?= $key->gelar_guru; ?></span>
                                    <p class="text-base"><?= date('d M, Y H:i A', strtotime($key->tenggat_tugas)); ?></p>

                                    <?php if (strlen($key->deksripsi_tugas) <= 35) { ?>
                                        <p class="pt-2 text-base"><?= $key->deksripsi_tugas; ?></p>
                                    <?php }else{ ?>
                                        <p class="pt-2 text-base"><?= substr($key->deksripsi_tugas, 0, 35) . "..." ?></p>
                                    <?php } ?>
                                    <p class="pt-3 text-base"><?= time_since(strtotime($key->dibuat_tugas)); ?></p>
                                </a>

                                <?php $hasil_tugas_row = $this->m_hasil_tugas->CheckingAllMurid($key->id_tugas, $murid['id_murid'])->row_array(); ?>

                                <?php if(empty($hasil_tugas_row)){ ?>
                                    <div class="flex p-1 my-auto border-2 rounded-primary border-secondary-300 bg-danger-300">
                                        <svg class="w-10 font-bold text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </div>
                                <?php }else{ ?>
                                    <div class="flex p-1 my-auto border-2 rounded-primary border-secondary-300 bg-success-300">
                                        <svg class="w-10 font-bold text-white" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    </div>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    <?php } ?>
                </div>
                <div x-show="tab === 'latihan'">
                    <?php $latihan_result = $this->m_latihan->WhereKelas($kelas['id_kelas'])->result(); ?>

                    <?php if(empty($latihan_result)){ ?>
                        <a href="#" class="flex justify-center mt-5 p-5 mb-5 border-2 border-b-8 focus:bg-success-300 bg-success-300 rounded-primary border-secondary-200 text-white">
                            <div>
                                <h3 class="text-xl font-semibold">Guru Belum Memberi Latihan Apapun :)</h3>
                            </div>
                        </a>
                    <?php }else{ ?>
                        <?php foreach($latihan_result as $key){ ?>
                            <div class="flex justify-between p-5 mb-5 mt-5 text-white border-2 border-b-8 bg-success-300 rounded-primary border-secondary-300 focus:bg-success-200">
                                <a href="<?= base_url('murid/latihan/') . $key->id_latihan; ?>" class="hover:underline focus:underline">
                                    <h3 class="text-3xl font-semibold"><?= $key->nama_latihan; ?></h3>
                                    <span class="text-base font-semibold"><?= $key->nama_guru; ?>, <?= $key->gelar_guru; ?></span>
                                    <p class="text-base"><?= date('d M, Y H:i A', strtotime($key->tenggat_latihan)); ?></p>

                                    <?php if (strlen($key->deksripsi_latihan) <= 35) { ?>
                                        <p class="pt-2 text-base"><?= $key->deksripsi_latihan; ?></p>
                                    <?php }else{ ?>
                                        <p class="pt-2 text-base"><?= substr($key->deksripsi_latihan, 0, 35) . "..." ?></p>
                                    <?php } ?>
                                    <p class="pt-3 text-base"><?= time_since(strtotime($key->dibuat_latihan)); ?></p>
                                </a>

                                <?php $hasil_latihan_row = $this->m_hasil_latihan->CheckingLatihanMurid($key->id_latihan, $murid['id_murid'])->row_array(); ?>

                                <?php if(empty($hasil_latihan_row)){ ?>
                                    <div class="flex p-1 my-auto border-2 rounded-primary border-secondary-300 bg-danger-300">
                                        <svg class="w-10 font-bold text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </div>
                                <?php }else{ ?>
                                    <div class="flex p-1 my-auto border-2 rounded-primary border-secondary-300 bg-success-300">
                                        <svg class="w-10 font-bold text-white" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    </div>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    <?php } ?>
                </div>
            </div>
        </div>

        <!-- Tab Nilai -->
        <div x-show="tab === '3'">

            <?php if(empty($absen_hari_ini)){ ?>
                <h3 class="font-semibold mt-5">Hari Ini</h3>
                <div class="mb-5 border-b-2 border-secondary-300"></div>
                <table class="w-full text-center border-2 table-fixed border-secondary-300 mb-5">
                    <thead>
                        <tr class="border-2 border-secondary-300">
                            <th class="w-2/5 p-2">Nama</th>
                            <th class="w-2/5 p-2">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="p-1 text-center sm:p-2"><?= $murid['nama_murid']; ?></td>
                            <td class="p-1 sm:p-2 sm:px-32 px-9">
                                <center>
                                    <div class="grid p-1 border-2  justify-items-center w-10 sm:w-10 rounded-primary border-secondary-300 bg-danger-300">
                                        <svg class="w-6 font-bold text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </div>
                                </center>
                            </td>
                        </tr>
                    </tbody>
                </table>
            <?php } ?>
            <?php foreach($detail_absen as $key){ ?>
                <h3 class="font-semibold mt-5"><?= time_since($key->waktu_masuk_mapel);?></h3>
                <div class="mb-5 border-b-2 border-secondary-300"></div>
                <table class="w-full text-center border-2 table-fixed border-secondary-300 mb-10">
                    <thead>
                        <tr class="border-2 border-secondary-300">
                            <th class="w-2/5 p-2">Nama</th>
                            <th class="w-2/5 p-2">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="p-1 text-center sm:p-2"><?= $murid['nama_murid']; ?></td>
                            <td class="p-1 sm:p-2 sm:px-32 px-9">
                                <center>
                                    <div class="grid p-1 border-2  justify-items-center w-full sm:w-10 rounded-primary border-secondary-300 bg-success-300">
                                        <svg class="w-6 font-bold text-white" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    </div>
                                </center>
                            </td>
                        </tr>
                    </tbody>
                </table>
            <?php } ?>
        </div>


    </div>
</main>