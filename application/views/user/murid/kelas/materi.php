<main class="container px-8 mx-auto">

    <!-- tombol back -->
    <header class="flex mt-5 justify-items-start">
        <a href="<?= base_url('murid/kelas/') . $materi['id_kelas']; ?>" class="p-1 transition duration-100 border-2 border-transparent rounded-primary focus:border-secondary-300">
            <svg class="w-6 stroke-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
        </a>
    </header>
    <div class="container mt-10 mb-10 sm:px-20">
        <div class="container mt-10">
            <small class="font-semibold"><?= $materi['nama_guru']; ?>, <?= $materi['gelar_guru']; ?></small><br>
            <h1 class="font-bold"><?= $materi['nama_materi'] ?></h1>
            <small>Dibuat pada : <?= time_since(strtotime($materi['dibuat_materi'])); ?></small>
            <div class="mt-4 border-b-2 border-secondary-300"></div>
        </div>
        <div class="mt-5 mb-10">
            <p><?= $materi['deksripsi_materi']; ?></p>
        </div>

        <div class="mb-5">
            <?php $lampiran = $this->m_lampiran->Checking(['id_materi' => $materi['id_materi']])->result(); ?>

            <?php foreach ($lampiran as $row) { ?>
                <div class="flex justify-between px-5 py-4 mb-5 bg-text rounded shadow-custom ">
                    <?php if (strlen($row->nama_lampiran) <= 25) { ?>
                        <span class="mt-1"><?= $row->nama_lampiran; ?></span>
                    <?php }else{ ?>
                        <span class="mt-1"><?= substr($row->nama_lampiran, 0, 25) . "..." ?></span>
                    <?php } ?>
                    
                    <a href="<?= base_url('assets/admin/lampiran/') . $row->nama_lampiran;?>" class="flex p-1 my-auto border rounded-lg border-secondary-300 bg-tertiary-300">
                        <svg class="w-6 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                        </svg>
                    </a>
                </div>
            <?php } ?>
        </div>
    </div>
</main>