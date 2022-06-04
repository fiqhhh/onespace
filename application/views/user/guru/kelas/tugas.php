
<main class="container px-8 mx-auto">

    <!-- tombol back -->
    <header class="flex mt-5 justify-items-start">
        <a href="<?= base_url('guru/kelas/') . $tugas['id_kelas']; ?>" class="p-1 transition duration-100 border-2 border-transparent rounded-primary focus:border-secondary-300">
            <svg class="w-6 stroke-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
        </a>
    </header>

    <div class="container mt-10 mb-10 sm:px-20">
        <div class="container mt-10">
            <small class="font-semibold"><?= $tugas['nama_guru']; ?>, <?= $tugas['gelar_guru']; ?></small><br>
            <?php if($tugas['tenggat_tugas'] == null){ ?>
                <?= null ?>
            <?php }else{ ?>
                <small>Tenggat : <?= date('d M, Y H:i A', strtotime($tugas['tenggat_tugas'])); ?></small><br>
            <?php } ?>
            <h1 class="font-bold"><?= $tugas['nama_tugas']; ?></h1>
            <small>Dibuat pada : <?= time_since(strtotime($tugas['dibuat_tugas'])); ?></small>
            <div class="mt-4 border-b-2 border-secondary-300"></div>
        </div>
        <div class="mt-5 mb-10">
            <p><?= $tugas['deksripsi_tugas']; ?></p>
        </div>

        <?= $this->session->flashdata('message'); ?>

        <div class="mb-5">
            <?php $lampiran = $this->m_lampiran->Checking(['id_tugas' => $tugas['id_tugas']])->result(); ?>
            
            <?php foreach ($lampiran as $row) { ?>
                <div class="flex justify-between px-5 py-4 mb-5 rounded shadow-custom">
                    <?php if (strlen($row->nama_lampiran) <= 25) { ?>
                        <span class="mt-1"><?= $row->nama_lampiran; ?></span>
                    <?php }else{ ?>
                        <span class="mt-1"><?= substr($row->nama_lampiran, 0, 25) . "..." ?></span>
                    <?php } ?>

                    <div class="p-1 border rounded-lg border-secondary-300 bg-danger-300">
                        <a href="<?= base_url('assets/admin/lampiran/') . $row->nama_lampiran;?>">
                            <svg class="w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            <?php } ?>

            <div class="mt-10 mb-5">
                <a href="<?= base_url('guru/edit_tugas/') . $tugas['id_tugas'];  ?>">
                    <div class="mt-10 mb-2 w-full p-2 mb-3 font-bold text-center text-white border-2 bg-danger-300 focus:outline-none focus:bg-danger-200 border-secondary-300 focus:border-secondary-200 rounded-primary">Edit Tugas</div>
                </a>
            </div>

            <?php 
            $jmlh_hasil_tugas = $this->m_hasil_tugas->Checking(['id_tugas' => $tugas['id_tugas']])->num_rows();
            $jmlh_murid = $this->m_gabung_kelas->Checking(['id_kelas' => $tugas['id_kelas']])->num_rows();
            $hasil_tugas = $this->m_hasil_tugas->CheckingAll($tugas['id_tugas'])->result(); 
            ?>
            
            <div class="flex justify-between">
                <span class="font-semibold text-sm">Data Pengumpulan</span>
                <span class="font-semibold text-sm"><?= $jmlh_hasil_tugas ?> dari <?= $jmlh_murid ?> Murid</span>
            </div>
            <div class="mb-2 border-b-2 border-secondary-300"></div>
            <div class="p-3 border bg-white-100 border-secondary-100 rounded mt-4">
                <table class="w-full text-xs text-center table-fixed sm:text-base">
                    <thead>
                        <tr class="border-b-2 border-secondary-300">
                            <th class="w-1/4 p-2">Nama</th>
                            <th class="w-1/4 p-2">Lampiran</th>
                            <th class="w-1/4 p-2">Tanggal</th>
                            <th class="w-1/4 p-2">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(empty($hasil_tugas)){ ?>
                            <tr>
                                <td colspan="5" class="p-1 text-center sm:p-2">Belum ada yang mengumpulkan</td>
                            </tr>
                        <?php }else{ ?>
                            <?php foreach($hasil_tugas as $key){ ?>
                                <?php $jmlh_lampiran = $this->m_lampiran->Checking(['id_hasil_tugas' => $key->id_hasil_tugas])->num_rows(); ?>

                                <tr>
                                    <td class="p-1 text-center sm:p-2"><?= $key->nama_murid; ?></td>
                                    <td class="p-1 text-center sm:p-2"><?= $jmlh_lampiran; ?></td>
                                    <td class="p-1 text-center sm:p-2"><?= time_since(strtotime($key->dikumpulkan_tugas)); ?></td>
                                    <?php if($key->dikumpulkan_tugas >= $key->tenggat_tugas){ ?>
                                        <td class="p-1 text-center sm:p-2 text-danger-300 font-bold">Telat</td>
                                    <?php }else{ ?>
                                        <td class="p-1 text-center sm:p-2 text-success-300 font-bold">Tepat</td>
                                    <?php } ?>
                                </tr>
                                <?php $lampiran_hasil = $this->m_lampiran->Checking(['id_hasil_tugas' => $key->id_hasil_tugas])->result(); ?>
                                <tr>
                                    <td colspan="4" class="p-1 text-center sm:p-2">
                                        <?php foreach ($lampiran_hasil as $row) { ?>
                                            <div class="flex justify-between px-5 py-3 mb-5 rounded shadow-custom">
                                                <?php if (strlen($row->nama_lampiran) <= 25) { ?>
                                                    <span class="mt-1"><?= $row->nama_lampiran; ?></span>
                                                <?php }else{ ?>
                                                    <span class="mt-1"><?= substr($row->nama_lampiran, 0, 25) . "..." ?></span>
                                                <?php } ?>

                                                <div class="p-1 border rounded-lg border-secondary-300 bg-danger-300">
                                                    <a href="<?= base_url('assets/admin/lampiran/') . $row->nama_lampiran;?>">
                                                        <svg class="sm:w-6 w-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                                        </svg>
                                                    </a>
                                                </div>
                                            </div>
                                        <?php } ?>
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

<script src="<?= base_url('assets/multiple/file-upload-with-preview.min.js'); ?>"></script>

<script type="text/javascript">
    var upload = new FileUploadWithPreview('myUniqueUploadId', {
        showDeleteButtonOnImages: true,
        text: {
            chooseFile: 'Masukan Lampiran',
            browse: 'Pilih',
            selectedCount: 'Custom Files Selected Copy',
        },
    })
</script>