
<main class="container px-8 mx-auto">

    <!-- tombol back -->
    <header class="flex mt-5 justify-items-start">
        <a href="<?= base_url('guru/'); ?>" class="p-1 transition duration-100 border-2 border-transparent rounded-primary focus:border-secondary-300">
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

        <div class="mt-5"><?= $this->session->flashdata('message'); ?></div>

        <!-- Tab Kelas -->
        <div x-show="tab === '1'">
            <div class="mt-8">
                <div class="w-full px-8 py-5 sm:px-10 sm:py-6 border-2 border-b-8 bg-primary-100 border-secondary-300 rounded-primary">
                    <div class="mr-16 text-left">
                        <h1 class="text-4xl leading-none mb-3 sm:mb-1 font-semibold"><?= $kelas['nama_mapel']; ?></h1>
                        <p class="text-base font-semibold"><?= $kelas['nama_kelas']; ?> Tp. <?= $kelas['tahun_pembelajaran']; ?></p>
                    </div>
                    <div class="flex content-center justify-between">
                        <p class="text-lg font-bold">Token : <?= $kelas['token_kelas']; ?></p>
                    </div>
                    <div class="flex content-center justify-between mt-0">
                        <div class="mt-5 sm:mt-10">
                            <h4 class="font-semibold"><?= $kelas['nama_guru']; ?>, <?= $kelas['gelar_guru']; ?></h4>
                            <p class="font-semibold"><?= $kelas['nama_jurusan']; ?></p>
                        </div>
                        <!-- <div>
                            <p class="font-semibold text-center">Edit</p>
                            <div class="p-1 bg-secondary-200 border-2 rounded-primary border-secondary-300">
                                <a href="<?= base_url('guru/absen') ?>">
                                    <svg class="sm:w-16 p-2 w-10 content-center text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </a>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
            <div class="mt-10 mb-10">
                <div class="w-full py-5 px-5 border-2 border-b-8 bg-primary-100 border-secondary-300 rounded-primary">   
                    <?php $teman_sekelas = $this->m_gabung_kelas->CheckingAll($kelas['id_kelas'])->result(); ?>
                    <?php if(empty($teman_sekelas)){ ?>
                        <h3 class="sm:text-2xl text-xl text-center font-semibold">Belum ada murid yang masuk kelas :(</h3>
                    <?php }else{ ?>
                        <span class="font-semibold text-xl">Murid Kelas</span>
                        <div class="border border-secondary-300 mt-2"></div>
                        <div class="sm:grid sm:grid-cols-4 sm:gap-2 sm:mt-4">
                            <?php 
                            $jmlh_murid = $this->m_gabung_kelas->Checking(['id_kelas' => $kelas['id_kelas']])->num_rows();
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
                    <?php } ?>
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
                        <div class="grid gap-1">
                            <p class="mt-5 font-bold">Tambah Materi</p>
                        </div>
                        <a href="<?= base_url('guru/tambah_materi/') . $kelas['id_kelas']; ?>" class="flex content-center justify-center mt-1 p-4 mb-5 text-white border-2 border-b-8 focus:bg-tertiary-200 bg-tertiary-300 rounded-primary border-secondary-300">
                            <svg class="w-10 font-semibold rounded-full border-2 border-secondary-300 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                        </a>

                        <a href="#" class="flex justify-center mt-5 p-5 mb-5 border-2 border-b-8 focus:bg-tertiary-200 bg-tertiary-300 rounded-primary border-secondary-300">
                            <div class="">
                                <h3 class="sm:text-3xl text-xl font-semibold">Anda Belum Memberi Materi Apapun :)</h3>
                            </div>
                        </a>
                    <?php }else{ ?>
                        <div class="grid gap-1">
                            <p class="mt-5 font-bold">Tambah Materi</p>
                        </div>
                        <a href="<?= base_url('guru/tambah_materi/') . $kelas['id_kelas']; ?>" class="flex content-center justify-center mt-1 p-4 mb-5 text-white border-2 border-b-8 focus:bg-tertiary-200 bg-tertiary-300 rounded-primary border-secondary-300">
                            <svg class="w-10 font-semibold rounded-full border-2 border-secondary-300 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                        </a>
                        <?php foreach($materi_result as $key){ ?>
                            <a href="<?= base_url('guru/materi/') . $key->id_materi; ?>" class="flex justify-between mt-5 p-5 mb-5 border-2 border-b-8 focus:bg-tertiary-200 bg-tertiary-300 rounded-primary border-secondary-300 hover:underline focus:underline">
                                <div>
                                    <h3 class="pb-0 leading-none text-3xl font-semibold"><?= $key->nama_materi; ?></h3>
                                    <span class="text-base font-semibold"><?= $key->nama_guru; ?>, <?= $key->gelar_guru; ?></span>
                                    <?php if (strlen($key->deksripsi_materi) <= 55) { ?>
                                        <p class="pt-3 text-base"><?= $key->deksripsi_materi; ?></p>
                                    <?php }else{ ?>
                                        <p class="pt-3 text-base"><?= substr($key->deksripsi_materi, 0, 55) . "..." ?></p>
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
                        <div class="grid gap-1">
                            <p class="mt-5 font-bold">Tambah Tugas</p>
                        </div>
                        <a href="<?= base_url('guru/tambah_tugas/') . $kelas['id_kelas']; ?>" class="flex content-center justify-center mt-1 p-4 mb-5 text-white border-2 border-b-8 focus:bg-danger-200 bg-danger-300 rounded-primary border-secondary-300">
                            <svg class="w-10 font-semibold rounded-full bg-secondary border-2 border-white-300 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                        </a>
                        <a href="#" class="flex justify-center mt-5 p-5 mb-5 border-2 border-b-8 focus:bg-danger-300 bg-danger-300 rounded-primary border-secondary-200 text-white">
                            <div>
                                <h3 class="sm:text-3xl text-xl font-semibold">Anda Belum Memberi Tugas Apapun :)</h3>
                            </div>
                        </a>
                    <?php }else{ ?>
                        <div class="grid gap-1">
                            <p class="mt-5 font-semibold">Tambah Tugas</p>
                        </div>
                        <a href="<?= base_url('guru/tambah_tugas/') . $kelas['id_kelas']; ?>" class="flex content-center justify-center mt-1 p-4 mb-5 text-white border-2 border-b-8 focus:bg-danger-200 bg-danger-300 rounded-primary border-secondary-300">
                            <svg class="w-10 font-semibold rounded-full bg-secondary border-2 border-white-300 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                        </a>
                        <?php foreach($tugas_result as $key){ ?>
                            <a href="<?= base_url('guru/tugas/') . $key->id_tugas; ?>" class="flex justify-between mt-5 p-5 mb-5 border-2 border-b-8 focus:bg-danger-200 bg-danger-300 rounded-primary border-secondary-200 text-white hover:underline focus:underline">
                                <div>
                                    <h3 class="pb-0 leading-none text-3xl font-semibold"><?= $key->nama_tugas; ?></h3>
                                    <span class="text-base font-semibold"><?= $key->nama_guru; ?>, <?= $key->gelar_guru; ?></span>
                                    <p class="text-base"><?= date('d M, Y H:i A', strtotime($key->tenggat_tugas)); ?></p>

                                    <?php if (strlen($key->deksripsi_tugas) <= 55) { ?>
                                        <p class="pt-3 text-base"><?= $key->deksripsi_tugas; ?></p>
                                    <?php }else{ ?>
                                        <p class="pt-3 text-base"><?= substr($key->deksripsi_tugas, 0, 55) . "..." ?></p>
                                    <?php } ?>
                                    <p class="mt-1 text-base"><?= time_since(strtotime($key->dibuat_tugas)); ?></p>
                                </div>
                            </a>
                        <?php } ?>
                    <?php } ?>
                </div>
                <div x-show="tab === 'latihan'">
                    <?php $latihan_result = $this->m_latihan->WhereKelas($kelas['id_kelas'])->result(); ?>

                    <?php if(empty($latihan_result)){ ?>
                        <div class="grid gap-1">
                            <p class="mt-5 font-semibold">Tambah Latihan</p>
                        </div>
                        <a href="<?= base_url('guru/tambah_latihan/') . $kelas['id_kelas']; ?>" class="flex content-center justify-center mt-1 p-4 mb-5 text-white border-2 border-b-8 focus:bg-success-200 bg-success-300 rounded-primary border-secondary-300">
                            <svg class="w-10 font-semibold rounded-full bg-secondary border-2 border-white-300 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                        </a>
                        <a href="#" class="flex justify-center mt-5 p-5 mb-5 border-2 border-b-8 focus:bg-success-300 bg-success-300 rounded-primary border-secondary-200 text-white">
                            <div>
                                <h3 class="sm:text-3xl text-xl font-semibold">Anda Belum Memberi Latihan Apapun :)</h3>
                            </div>
                        </a>
                    <?php }else{ ?>
                        <div class="grid gap-1">
                            <p class="mt-5 font-semibold">Tambah Latihan</p>
                        </div>
                        <a href="<?= base_url('guru/tambah_latihan/') . $kelas['id_kelas']; ?>" class="flex content-center justify-center mt-1 p-4 mb-5 text-white border-2 border-b-8 focus:bg-success-200 bg-success-300 rounded-primary border-secondary-300">
                            <svg class="w-10 font-semibold rounded-full bg-secondary border-2 border-white-300 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                        </a>
                        <?php foreach($latihan_result as $key){ ?>
                            <a href="<?= base_url('guru/latihan/') . $key->id_latihan; ?>" class="flex justify-between mt-5 p-5 mb-5 border-2 border-b-8 focus:bg-success-200 bg-success-300 rounded-primary border-secondary-200 text-white hover:underline focus:underline">
                                <div>
                                    <h3 class="pb-0 leading-none text-3xl font-semibold"><?= $key->nama_latihan; ?></h3>
                                    <span class="text-base font-semibold"><?= $key->nama_guru; ?>, <?= $key->gelar_guru; ?></span>
                                    <p class="text-base"><?= date('d M, Y H:i A', strtotime($key->tenggat_latihan)); ?></p>

                                    <?php if (strlen($key->deksripsi_latihan) <= 55) { ?>
                                        <p class="pt-3 text-base"><?= $key->deksripsi_latihan; ?></p>
                                    <?php }else{ ?>
                                        <p class="pt-3 text-base"><?= substr($key->deksripsi_latihan, 0, 55) . "..." ?></p>
                                    <?php } ?>
                                    <p class="mt-1 text-base"><?= time_since(strtotime($key->dibuat_latihan)); ?></p>
                                </div>
                            </a>
                        <?php } ?>
                    <?php } ?>
                </div>
            </div>
        </div>

        <!-- Tab Nilai -->
        <div x-show="tab === '3'">
            <?php $teman_sekelas = $this->m_gabung_kelas->CheckingAll($kelas['id_kelas'])->result(); ?>
            <?php if(empty($teman_sekelas)){ ?>
                <div class="w-full py-5 px-5 mb-10 border-2 border-b-8 bg-primary-100 border-secondary-300 rounded-primary">
                    <h3 class="sm:text-2xl text-xl text-center font-semibold">Belum ada murid yang masuk kelas :(</h3>
                </div>
            <?php }else{ ?>
                <?php 
                $jmlh_murid = $this->m_gabung_kelas->Checking(['id_kelas' => $kelas['id_kelas']])->num_rows();
                foreach($teman_sekelas as $key){ 
                    $detail_absen = $this->m_absen->TampilDetailMapelGuru($kelas['id_kelas'])->result();
                    $jmlh_absen = $this->m_absen->MapelHariIniGuru($kelas['id_kelas'])->num_rows();
                }
                ?>

                <div class="flex justify-between">
                    <span class="font-semibold">Hari Ini</span>
                    <?php if($jmlh_absen == $jmlh_murid){ ?>
                        <span class="font-semibold">Semua murid sudah absen</span>
                    <?php }else{ ?>
                        <span class="font-semibold"><?= $jmlh_absen; ?> dari <?= $jmlh_murid; ?> yang sudah absen</span>
                    <?php } ?> 
                </div>

                <div class="mb-5 border-b-2 border-secondary-300"></div>
                <table class="w-full text-center border-2 table-fixed border-secondary-300 mb-10">
                    <thead>
                        <tr class="border-2 border-secondary-300">
                            <th class="w-2/5 p-2">Nama</th>
                            <th class="w-2/5 p-2">Waktu</th>
                            <th class="w-2/5 p-2">Status</th>
                        </tr>
                    </thead>

                    <?php foreach($teman_sekelas as $key){ ?>
                        <tbody>
                            <tr>
                                <td class="p-1 text-center sm:p-2"><small><?= $key->nama_murid; ?></small></td>

                                <?php 
                                $absen_hari_ini = $this->m_absen->MapelHariIni($key->id_murid, $kelas['id_kelas'])->result();
                                ?>

                                <?php if(empty($absen_hari_ini)){ ?>
                                    <td class="p-1 text-center sm:p-2"><small>Belum Absen</small></td>
                                    <td class="p-1 sm:p-2 sm:px-32 px-9">
                                        <center>
                                            <div class="grid p-1 border-2  justify-items-center w-10 sm:w-10 rounded-primary border-secondary-300 bg-danger-300">
                                                <svg class="w-6 font-bold text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                            </div>
                                        </center>
                                    </td>
                                <?php }else{ ?>
                                    <?php foreach($absen_hari_ini as $key){ ?>
                                        <td class="p-1 text-center sm:p-2"><small><?= time_since($key->waktu_masuk_mapel); ?></small></td>
                                        <td class="p-1 sm:p-2 sm:px-32 px-9">
                                            <center>
                                                <div class="grid p-1 border-2 justify-items-center w-full sm:w-10 rounded-primary border-secondary-300 bg-success-300">
                                                    <svg class="w-6 font-bold text-white" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                    </svg>
                                                </div>
                                            </center>
                                        </td>
                                    <?php } ?>
                                <?php } ?>
                            </tr>
                        </tbody>
                    <?php } ?>
                </table>

                <?php foreach($detail_absen as $row){ ?>

                    <?php 
                    $detail_absen_tgl = $this->m_absen->TampilDetailMapelTgl($kelas['id_kelas'], $row->tgl_masuk_mapel)->result(); 
                    $jmlh_absen = $this->m_absen->TampilDetailMapelTgl($kelas['id_kelas'], $row->tgl_masuk_mapel)->num_rows(); 
                    ?>
                    
                    <?php if($row->tgl_masuk_mapel == date('Y-m-d')){ ?>
                        <?= null; ?>
                    <?php }else{ ?>

                        <div class="flex justify-between">
                            <span class="font-semibold"><?= time_since(strtotime($row->tgl_masuk_mapel)); ?></span>
                            <?php if($jmlh_absen == $jmlh_murid){ ?>
                                <span class="font-semibold">Semua murid sudah absen</span>
                            <?php }else{ ?>
                                <span class="font-semibold"><?= $jmlh_absen; ?> dari <?= $jmlh_murid; ?> Murid yang sudah absen</span>
                            <?php } ?> 
                        </div>

                        <div class="mb-5 border-b-2 border-secondary-300"></div>
                        <table class="w-full text-center border-2 table-fixed border-secondary-300 mb-10">
                            <thead>
                                <tr class="border-2 border-secondary-300">
                                    <th class="w-2/5 p-2">Nama</th>
                                    <th class="w-2/5 p-2">Waktu</th>
                                    <th class="w-2/5 p-2">Status</th>
                                </tr>
                            </thead>

                            <?php foreach($detail_absen_tgl as $key){ ?>
                                <tbody>
                                    <tr>
                                        <td class="p-1 text-center sm:p-2"><small><?= $key->nama_murid; ?></small></td>
                                        <td class="p-1 text-center sm:p-2"><small><?= time_since($key->waktu_masuk_mapel); ?></small></td>
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
                            <?php } ?>
                        </table>
                    <?php } ?>
                <?php } ?>

            <?php } ?>
        </div>
    </div>

</main>