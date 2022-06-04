<main class="container px-8 mx-auto">

    <!-- tombol back -->
    <header class="flex mt-5 justify-items-start">
        <a href="<?= base_url('guru/kelas/') . $latihan['id_kelas']; ?>" class="p-1 transition duration-100 border-2 border-transparent rounded-primary focus:border-secondary-300">
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
        <div class="mb-10 mt-5">
            <p><?= $latihan['deksripsi_latihan']; ?></p>
        </div>

        <?= $this->session->flashdata('message'); ?>
        
        <div class="mt-10">
            <a href="<?= base_url('guru/edit_latihan/') . $latihan['id_latihan'];  ?>">
                <div class="mt-10 mb-2 w-full p-2 mb-3 font-bold text-center text-white border-2 bg-success-300 focus:outline-none focus:bg-success-200 border-secondary-300 focus:border-secondary-200 rounded-primary">Edit Latihan</div>
            </a>
        </div>
        <div class="mt-5">
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

                <a href="<?= base_url('guru/tambah_soal/') . $latihan['id_latihan']; ?>">
                    <div class="mt-5 mb-2 w-full p-2 mt-3 font-bold text-center text-white border-2 border-b-8 bg-success-300 focus:outline-none focus:bg-success-200 border-secondary-300 focus:border-secondary-200 rounded-primary">
                        Lihat & Buat Soal
                    </div>
                </a>
            </div>

            <?php 
            $jmlh_hasil_latihan = $this->m_hasil_latihan->NumMengerjakan($latihan['id_latihan'])->num_rows();
            $jmlh_murid = $this->m_gabung_kelas->Checking(['id_kelas' => $latihan['id_kelas']])->num_rows();
            $hasil_latihan = $this->m_hasil_latihan->CheckingLatihan($latihan['id_latihan'])->result();
            ?>

            <div class="flex justify-between">
                <span class="font-semibold text-sm">Data Mengerjakan</span>
                <span class="font-semibold text-sm"><?= $jmlh_hasil_latihan ?> dari <?= $jmlh_murid ?> Murid</span>
            </div>
            <div class="mb-2 border-b-2 border-secondary-300"></div>
            <div class="p-3 border bg-white-100 border-secondary-100 rounded mt-4">
                <table class="w-full text-xs text-center table-fixed sm:text-base">
                    <thead>
                        <tr class="border-b-2 border-secondary-300">
                            <th class="w-1/4 p-2">Nama</th>
                            <th class="w-1/4 p-2">Nilai</th>
                            <th class="w-1/4 p-2">Tanggal</th>
                            <th class="w-1/4 p-2">Lihat</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(empty($latihan_result)){ ?>
                            <td colspan="4" class="p-1 sm:p-2">Belum ada yang mengerjakan</td>
                        <?php }else{ ?>
                            <?php foreach($latihan_result as $key){ ?>
                                <?php $where_murid = $this->m_hasil_latihan->WhereMurid($key->id_murid, $latihan_row['id_latihan'])->result(); ?>
                            <?php } ?>
                            <?php $num=1; foreach($where_murid as $key){ ?>
                                <?php $nilai_murid = $this->m_hasil_latihan->NilaiMurid($key->id_murid, $latihan_row['id_latihan'])->result(); ?>
                                <tr>
                                    <td class="p-1 sm:p-2"><?= $key->nama_murid; ?></td>

                                    <?php foreach($nilai_murid as $row){ ?>
                                        <td class="p-1 sm:p-2"><?= floatval($row->point_hasil) ?>/<?= $latihan['point_latihan']; ?></td>
                                    <?php } ?>

                                    <td class="p-1 sm:p-2"><?= date('d M H:i A', strtotime($key->tgl_selesai)); ?></td>
                                    <td class="p-1 px-5 sm:p-2">
                                        <a href="<?= base_url('guru/detail_hasil/') . $latihan['id_latihan'] . "/" . $key->id_murid; ?>" class="grid p-1 text-white border-2 focus:text-secondary-300 focus:bg-secondary-100 justify-items-center rounded-primary border-secondary-300 bg-secondary-200">
                                            <svg class="w-5 font-bold h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
                            <?php } ?>
                        <?php } ?>

                    </tbody>
                </table>
            </div>

        </div>

    </div>
</main>