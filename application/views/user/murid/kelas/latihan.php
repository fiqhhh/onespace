<main class="container px-8 mx-auto">

    <!-- tombol back -->
    <header class="flex mt-5 justify-items-start">
        <a href="<?= base_url('murid/kelas/') . $latihan['id_kelas']; ?>" class="p-1 transition duration-100 border-2 border-transparent rounded-primary focus:border-secondary-300">
            <svg class="w-6 stroke-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
        </a>
    </header>
    <div class="container w-full mx-auto mt-10 mb-10 sm:px-20">
        <div class="container mt-10">
            <small class="font-semibold"><?= $latihan['nama_guru']; ?>, <?= $latihan['gelar_guru']; ?></small><br>
            <small>Tenggat : <?= date('d M, Y H:i A', strtotime($latihan['tenggat_latihan'])); ?></small><br>
            <h1 class="font-bold"><?= $latihan['nama_latihan']; ?></h1>
            <small><?= $latihan['point_latihan']; ?> Poin</small>
            <div class="mt-4 border-b-2 border-secondary-300"></div>
        </div>
        <div class="mt-5 mb-10">
            <p><?= $latihan['deksripsi_latihan']; ?></p>
        </div>
        <div class="mt-10">
            <?= $this->session->flashdata('message'); ?>
            <div class="py-2 px-3 border border-secondary-100 rounded-lg mb-5">
                <div class="grid grid-cols-4 mt-2">
                    <div class="col-span-2 sm:col-span-1">
                        <p class="block">Tanggal Mulai</p>
                        <p class="block">Tipe Soal</p>
                        <p class="block">Waktu</p>
                        <p class="block">Jumlah Soal</p>
                    </div>
                    <div class="col-span-2">
                        <p class="block font-semibold">: <?= date('d M H:i:A', strtotime($latihan['tanggal_mulai'])); ?></p>
                        <?php if($latihan['tipe_latihan'] == "1"){ ?>
                            <p class="block font-semibold">: Pilihan Ganda</p>
                        <?php }elseif($latihan['tipe_latihan'] == "2"){ ?>
                            <p class="block font-semibold">: Essay</p>
                        <?php }elseif ($latihan['tipe_latihan'] == "3") { ?>
                            <p class="block font-semibold">: Pilihan Ganda & Essay</p>
                        <?php } ?>
                        <p class="block font-semibold">: <?= $latihan['waktu_latihan']; ?> Menit</p>
                        <p class="block font-semibold">: <?= $jumlah_soal; ?> Soal</p>
                    </div>
                </div>

                <?php if($jumlah_soal == 0){ ?>
                    <a onclick="confirm('Soal masih kosong!');" class="cursor-pointer">
                        <div class="mt-5 mb-2 w-full p-2 mt-3 font-bold text-center text-white border-2 border-b-8 bg-success-200 focus:outline-none focus:bg-success-200 border-secondary-300 focus:border-secondary-200 rounded-primary">
                            Mulai
                        </div>
                    </a>
                <?php }else{ ?>
                    <?php if(date('Y-m-d H:i:s') >= $latihan['tanggal_mulai']){ ?>
                        <?php if(date('Y-m-d H:i:s') >= $latihan['tenggat_latihan']){ ?>
                            <a onclick="confirm('Tidak bisa mengerjakan latihan ini, sudah lewat tenggat!');" class="cursor-pointer">
                                <div class="mt-5 mb-2 w-full p-2 mt-3 font-bold text-center text-white border-2 border-b-8 bg-success-200 focus:outline-none focus:bg-success-200 border-secondary-300 focus:border-secondary-200 rounded-primary">
                                    Mulai
                                </div>
                            </a>
                        <?php }else{ ?>
                            <?php $hasil_latihan_row = $this->m_hasil_latihan->CheckingLatihanMurid($latihan['id_latihan'], $murid['id_murid'])->row_array(); ?>

                            <?php if(empty($hasil_latihan_row)){ ?>
                                <a onclick="return confirm('Anda tidak bisa keluar selama mengerjakan latihan, anda yakin ingin memulainya?');" href="<?= base_url('murid/proses_latihan/') . $latihan['id_latihan']; ?>">
                                    <div class="mt-5 mb-2 w-full p-2 mt-3 font-bold text-center text-white border-2 border-b-8 bg-success-300 focus:outline-none focus:bg-success-200 border-secondary-300 focus:border-secondary-200 rounded-primary">
                                        Mulai
                                    </div>
                                </a>
                            <?php }else{ ?>
                                <a onclick="confirm('Anda sudah mengerjakan latihan ini!');" class="cursor-pointer">
                                    <div class="mt-5 mb-2 w-full p-2 mt-3 font-bold text-center text-white border-2 border-b-8 bg-success-200 focus:outline-none focus:bg-success-200 border-secondary-300 focus:border-secondary-200 rounded-primary">
                                        Mulai
                                    </div>
                                </a>
                            <?php } ?>
                        <?php } ?>
                    <?php }else{ ?>
                        <a onclick="confirm('Belum bisa mengerjakan latihan, belum waktunya!');" class="cursor-pointer">
                            <div class="mt-5 mb-2 w-full p-2 mt-3 font-bold text-center text-white border-2 border-b-8 bg-success-200 focus:outline-none focus:bg-success-200 border-secondary-300 focus:border-secondary-200 rounded-primary">
                                Mulai
                            </div>
                        </a>
                    <?php } ?>
                <?php } ?>
            </div>

        </div>

    </div>
</main>