  <main class="container px-8 mx-auto">
    <!-- tombol back -->
    <header class="flex mt-5 justify-items-start">
        <a href="<?= base_url('guru/latihan/') . $latihan['id_latihan']; ?>" class="p-1 transition duration-100 border-2 border-transparent rounded-primary focus:border-secondary-300">
            <svg class="w-6 stroke-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
        </a>
    </header>
    <div class="pt-5 mb-5">
        <h1 class="text-5xl font-semibold text-center">Soal</h1>
    </div>
    <?= $this->session->flashdata('message'); ?>

    <form action="<?= base_url('guru/tambah_soal_proses/'); ?>" method="POST" class="mt-5">
        <input type="hidden" name="id_latihan" value="<?= $latihan['id_latihan']; ?>">
        <input type="hidden" name="tipe_soal" value="<?= $latihan['tipe_latihan']; ?>">
        <?php if ($latihan['tipe_latihan'] == "1") { ?>
            <?php $hasil_latihan = $this->m_hasil_latihan->NumMengerjakan($latihan['id_latihan'])->result(); ?>
            <?php $num = 1;  foreach ($bank_soal_result as $row) {?>
                <div class="py-5 px-5 shadow-custom rounded-lg mb-5 bg-white">
                    <div class="flex justify-between">
                        <span class="flex w-56 sm:w-auto"><?=$num++ . ".&nbsp;" . $row->soal;?></span>

                        <?php $hitung_point = $latihan['point_latihan'] / $bank_soal_num; ?>
                        <span class="font-semibold text-base"><?= round($hitung_point) ?> Point</span>
                    </div>

                    <?php if (empty($row->pilihan_e) && !empty($row->pilihan_d)) { ?>
                        <div class="w-full mt-0">
                            <div class="flex flex-col">
                                <?php if($row->pilihan_a && $row->kunci_jawaban == "A"){ ?>
                                    <label class="inline-flex items-center mt-3 text-success-300">
                                        <span class="ml-2">A.</span>
                                        <span class="ml-2"><?= $row->pilihan_a; ?></span>
                                    </label>
                                    <label class="inline-flex items-center mt-3">
                                        <span class="ml-2">B.</span>
                                        <span class="ml-2"><?= $row->pilihan_b; ?></span>
                                    </label>
                                    <label class="inline-flex items-center mt-3">
                                        <span class="ml-2">C.</span>
                                        <span class="ml-2"><?= $row->pilihan_c; ?></span>
                                    </label>
                                    <label class="inline-flex items-center mt-3">
                                        <span class="ml-2">D.</span>
                                        <span class="ml-2"><?= $row->pilihan_d; ?></span>
                                    </label>
                                    <label class="inline-flex items-center mt-3">
                                        <span class="ml-2">E.</span>
                                        <span class="ml-2"><?= $row->pilihan_e; ?></span>
                                    </label>
                                <?php }elseif($row->pilihan_b && $row->kunci_jawaban == "B"){ ?>
                                    <label class="inline-flex items-center mt-3">
                                        <span class="ml-2">A.</span>
                                        <span class="ml-2"><?= $row->pilihan_a; ?></span>
                                    </label>
                                    <label class="inline-flex items-center mt-3 text-success-300">
                                        <span class="ml-2">B.</span>
                                        <span class="ml-2"><?= $row->pilihan_b; ?></span>
                                    </label>
                                    <label class="inline-flex items-center mt-3">
                                        <span class="ml-2">C.</span>
                                        <span class="ml-2"><?= $row->pilihan_c; ?></span>
                                    </label>
                                    <label class="inline-flex items-center mt-3">
                                        <span class="ml-2">D.</span>
                                        <span class="ml-2"><?= $row->pilihan_d; ?></span>
                                    </label>
                                    <label class="inline-flex items-center mt-3">
                                        <span class="ml-2">E.</span>
                                        <span class="ml-2"><?= $row->pilihan_e; ?></span>
                                    </label>
                                <?php }elseif($row->pilihan_c && $row->kunci_jawaban == "C"){ ?>
                                    <label class="inline-flex items-center mt-3">
                                        <span class="ml-2">A.</span>
                                        <span class="ml-2"><?= $row->pilihan_a; ?></span>
                                    </label>
                                    <label class="inline-flex items-center mt-3">
                                        <span class="ml-2">B.</span>
                                        <span class="ml-2"><?= $row->pilihan_b; ?></span>
                                    </label>
                                    <label class="inline-flex items-center mt-3 text-success-300">
                                        <span class="ml-2">C.</span>
                                        <span class="ml-2"><?= $row->pilihan_c; ?></span>
                                    </label>
                                    <label class="inline-flex items-center mt-3">
                                        <span class="ml-2">D.</span>
                                        <span class="ml-2"><?= $row->pilihan_d; ?></span>
                                    </label>
                                    <label class="inline-flex items-center mt-3">
                                        <span class="ml-2">E.</span>
                                        <span class="ml-2"><?= $row->pilihan_e; ?></span>
                                    </label>
                                <?php }elseif($row->pilihan_d && $row->kunci_jawaban == "D"){ ?>
                                    <label class="inline-flex items-center mt-3">
                                        <span class="ml-2">A.</span>
                                        <span class="ml-2"><?= $row->pilihan_a; ?></span>
                                    </label>
                                    <label class="inline-flex items-center mt-3">
                                        <span class="ml-2">B.</span>
                                        <span class="ml-2"><?= $row->pilihan_b; ?></span>
                                    </label>
                                    <label class="inline-flex items-center mt-3">
                                        <span class="ml-2">C.</span>
                                        <span class="ml-2"><?= $row->pilihan_c; ?></span>
                                    </label>
                                    <label class="inline-flex items-center mt-3 text-success-300">
                                        <span class="ml-2">D.</span>
                                        <span class="ml-2"><?= $row->pilihan_d; ?></span>
                                    </label>
                                    <label class="inline-flex items-center mt-3">
                                        <span class="ml-2">E.</span>
                                        <span class="ml-2"><?= $row->pilihan_e; ?></span>
                                    </label>
                                <?php }?>

                            </div>
                        </div>
                    <?php } elseif (empty($row->pilihan_d) && !empty($row->pilihan_c)) {  ?>
                        <div class="w-full mt-0">
                            <div class="flex flex-col">
                                <?php if($row->pilihan_a && $row->kunci_jawaban == "A"){ ?>
                                    <label class="inline-flex items-center mt-3 text-success-300">
                                        <span class="ml-2">A.</span>
                                        <span class="ml-2"><?= $row->pilihan_a; ?></span>
                                    </label>
                                    <label class="inline-flex items-center mt-3">
                                        <span class="ml-2">B.</span>
                                        <span class="ml-2"><?= $row->pilihan_b; ?></span>
                                    </label>
                                    <label class="inline-flex items-center mt-3">
                                        <span class="ml-2">C.</span>
                                        <span class="ml-2"><?= $row->pilihan_c; ?></span>
                                    </label>
                                    <label class="inline-flex items-center mt-3">
                                        <span class="ml-2">D.</span>
                                        <span class="ml-2"><?= $row->pilihan_d; ?></span>
                                    </label>
                                    <label class="inline-flex items-center mt-3">
                                        <span class="ml-2">E.</span>
                                        <span class="ml-2"><?= $row->pilihan_e; ?></span>
                                    </label>
                                <?php }elseif($row->pilihan_b && $row->kunci_jawaban == "B"){ ?>
                                    <label class="inline-flex items-center mt-3">
                                        <span class="ml-2">A.</span>
                                        <span class="ml-2"><?= $row->pilihan_a; ?></span>
                                    </label>
                                    <label class="inline-flex items-center mt-3 text-success-300">
                                        <span class="ml-2">B.</span>
                                        <span class="ml-2"><?= $row->pilihan_b; ?></span>
                                    </label>
                                    <label class="inline-flex items-center mt-3">
                                        <span class="ml-2">C.</span>
                                        <span class="ml-2"><?= $row->pilihan_c; ?></span>
                                    </label>
                                    <label class="inline-flex items-center mt-3">
                                        <span class="ml-2">D.</span>
                                        <span class="ml-2"><?= $row->pilihan_d; ?></span>
                                    </label>
                                    <label class="inline-flex items-center mt-3">
                                        <span class="ml-2">E.</span>
                                        <span class="ml-2"><?= $row->pilihan_e; ?></span>
                                    </label>
                                <?php }elseif($row->pilihan_c && $row->kunci_jawaban == "C"){ ?>
                                    <label class="inline-flex items-center mt-3">
                                        <span class="ml-2">A.</span>
                                        <span class="ml-2"><?= $row->pilihan_a; ?></span>
                                    </label>
                                    <label class="inline-flex items-center mt-3">
                                        <span class="ml-2">B.</span>
                                        <span class="ml-2"><?= $row->pilihan_b; ?></span>
                                    </label>
                                    <label class="inline-flex items-center mt-3 text-success-300">
                                        <span class="ml-2">C.</span>
                                        <span class="ml-2"><?= $row->pilihan_c; ?></span>
                                    </label>
                                    <label class="inline-flex items-center mt-3">
                                        <span class="ml-2">D.</span>
                                        <span class="ml-2"><?= $row->pilihan_d; ?></span>
                                    </label>
                                    <label class="inline-flex items-center mt-3">
                                        <span class="ml-2">E.</span>
                                        <span class="ml-2"><?= $row->pilihan_e; ?></span>
                                    </label>
                                <?php } ?>
                            </div>
                        </div>
                    <?php } elseif (empty($row->pilihan_c && !empty($row->pilihan_b))) { ?>
                        <div class="w-full mt-0">
                            <div class="flex flex-col">
                                <?php if($row->pilihan_a && $row->kunci_jawaban == "A"){ ?>
                                    <label class="inline-flex items-center mt-3 text-success-300">
                                        <span class="ml-2">A.</span>
                                        <span class="ml-2"><?= $row->pilihan_a; ?></span>
                                    </label>
                                    <label class="inline-flex items-center mt-3">
                                        <span class="ml-2">B.</span>
                                        <span class="ml-2"><?= $row->pilihan_b; ?></span>
                                    </label>
                                    <label class="inline-flex items-center mt-3">
                                        <span class="ml-2">C.</span>
                                        <span class="ml-2"><?= $row->pilihan_c; ?></span>
                                    </label>
                                    <label class="inline-flex items-center mt-3">
                                        <span class="ml-2">D.</span>
                                        <span class="ml-2"><?= $row->pilihan_d; ?></span>
                                    </label>
                                    <label class="inline-flex items-center mt-3">
                                        <span class="ml-2">E.</span>
                                        <span class="ml-2"><?= $row->pilihan_e; ?></span>
                                    </label>
                                <?php }elseif($row->pilihan_b && $row->kunci_jawaban == "B"){ ?>
                                    <label class="inline-flex items-center mt-3">
                                        <span class="ml-2">A.</span>
                                        <span class="ml-2"><?= $row->pilihan_a; ?></span>
                                    </label>
                                    <label class="inline-flex items-center mt-3 text-success-300">
                                        <span class="ml-2">B.</span>
                                        <span class="ml-2"><?= $row->pilihan_b; ?></span>
                                    </label>
                                    <label class="inline-flex items-center mt-3">
                                        <span class="ml-2">C.</span>
                                        <span class="ml-2"><?= $row->pilihan_c; ?></span>
                                    </label>
                                    <label class="inline-flex items-center mt-3">
                                        <span class="ml-2">D.</span>
                                        <span class="ml-2"><?= $row->pilihan_d; ?></span>
                                    </label>
                                    <label class="inline-flex items-center mt-3">
                                        <span class="ml-2">E.</span>
                                        <span class="ml-2"><?= $row->pilihan_e; ?></span>
                                    </label>
                                <?php } ?>
                            </div>
                        </div>
                    <?php } elseif (empty($row->pilihan_b && !empty($row->pilihan_a))) { ?>
                        <div class="w-full mt-0">
                            <div class="flex flex-col">
                                <?php if($row->pilihan_a && $row->kunci_jawaban == "A"){ ?>
                                    <label class="inline-flex items-center mt-3 text-success-300">
                                        <span class="ml-2">A.</span>
                                        <span class="ml-2"><?= $row->pilihan_a; ?></span>
                                    </label>
                                    <label class="inline-flex items-center mt-3">
                                        <span class="ml-2">B.</span>
                                        <span class="ml-2"><?= $row->pilihan_b; ?></span>
                                    </label>
                                    <label class="inline-flex items-center mt-3">
                                        <span class="ml-2">C.</span>
                                        <span class="ml-2"><?= $row->pilihan_c; ?></span>
                                    </label>
                                    <label class="inline-flex items-center mt-3">
                                        <span class="ml-2">D.</span>
                                        <span class="ml-2"><?= $row->pilihan_d; ?></span>
                                    </label>
                                    <label class="inline-flex items-center mt-3">
                                        <span class="ml-2">E.</span>
                                        <span class="ml-2"><?= $row->pilihan_e; ?></span>
                                    </label>
                                <?php } ?>
                            </div>
                        </div>
                    <?php } elseif (empty($row->pilihan_a)) { ?>
                        <div class="w-full mt-0">
                            <div class="flex flex-col">
                                <span class="bg-danger-300 shadow-custom rounded-lg text-white px-3 py-2 text-center">Tidak memilih pilihan</span>
                            </div>
                        </div>
                    <?php } else { ?>
                        <div class="w-full mt-0">
                            <div class="flex flex-col">
                                <?php if($row->pilihan_a && $row->kunci_jawaban == "A"){ ?>
                                    <label class="inline-flex items-center mt-3 text-success-300">
                                        <span class="ml-2">A.</span>
                                        <span class="ml-2"><?= $row->pilihan_a; ?></span>
                                    </label>
                                    <label class="inline-flex items-center mt-3">
                                        <span class="ml-2">B.</span>
                                        <span class="ml-2"><?= $row->pilihan_b; ?></span>
                                    </label>
                                    <label class="inline-flex items-center mt-3">
                                        <span class="ml-2">C.</span>
                                        <span class="ml-2"><?= $row->pilihan_c; ?></span>
                                    </label>
                                    <label class="inline-flex items-center mt-3">
                                        <span class="ml-2">D.</span>
                                        <span class="ml-2"><?= $row->pilihan_d; ?></span>
                                    </label>
                                    <label class="inline-flex items-center mt-3">
                                        <span class="ml-2">E.</span>
                                        <span class="ml-2"><?= $row->pilihan_e; ?></span>
                                    </label>
                                <?php }elseif($row->pilihan_b && $row->kunci_jawaban == "B"){ ?>
                                    <label class="inline-flex items-center mt-3">
                                        <span class="ml-2">A.</span>
                                        <span class="ml-2"><?= $row->pilihan_a; ?></span>
                                    </label>
                                    <label class="inline-flex items-center mt-3 text-success-300">
                                        <span class="ml-2">B.</span>
                                        <span class="ml-2"><?= $row->pilihan_b; ?></span>
                                    </label>
                                    <label class="inline-flex items-center mt-3">
                                        <span class="ml-2">C.</span>
                                        <span class="ml-2"><?= $row->pilihan_c; ?></span>
                                    </label>
                                    <label class="inline-flex items-center mt-3">
                                        <span class="ml-2">D.</span>
                                        <span class="ml-2"><?= $row->pilihan_d; ?></span>
                                    </label>
                                    <label class="inline-flex items-center mt-3">
                                        <span class="ml-2">E.</span>
                                        <span class="ml-2"><?= $row->pilihan_e; ?></span>
                                    </label>
                                <?php }elseif($row->pilihan_c && $row->kunci_jawaban == "C"){ ?>
                                    <label class="inline-flex items-center mt-3">
                                        <span class="ml-2">A.</span>
                                        <span class="ml-2"><?= $row->pilihan_a; ?></span>
                                    </label>
                                    <label class="inline-flex items-center mt-3">
                                        <span class="ml-2">B.</span>
                                        <span class="ml-2"><?= $row->pilihan_b; ?></span>
                                    </label>
                                    <label class="inline-flex items-center mt-3 text-success-300">
                                        <span class="ml-2">C.</span>
                                        <span class="ml-2"><?= $row->pilihan_c; ?></span>
                                    </label>
                                    <label class="inline-flex items-center mt-3">
                                        <span class="ml-2">D.</span>
                                        <span class="ml-2"><?= $row->pilihan_d; ?></span>
                                    </label>
                                    <label class="inline-flex items-center mt-3">
                                        <span class="ml-2">E.</span>
                                        <span class="ml-2"><?= $row->pilihan_e; ?></span>
                                    </label>
                                <?php }elseif($row->pilihan_d && $row->kunci_jawaban == "D"){ ?>
                                    <label class="inline-flex items-center mt-3">
                                        <span class="ml-2">A.</span>
                                        <span class="ml-2"><?= $row->pilihan_a; ?></span>
                                    </label>
                                    <label class="inline-flex items-center mt-3">
                                        <span class="ml-2">B.</span>
                                        <span class="ml-2"><?= $row->pilihan_b; ?></span>
                                    </label>
                                    <label class="inline-flex items-center mt-3">
                                        <span class="ml-2">C.</span>
                                        <span class="ml-2"><?= $row->pilihan_c; ?></span>
                                    </label>
                                    <label class="inline-flex items-center mt-3 text-success-300">
                                        <span class="ml-2">D.</span>
                                        <span class="ml-2"><?= $row->pilihan_d; ?></span>
                                    </label>
                                    <label class="inline-flex items-center mt-3">
                                        <span class="ml-2">E.</span>
                                        <span class="ml-2"><?= $row->pilihan_e; ?></span>
                                    </label>
                                <?php }elseif($row->pilihan_e && $row->kunci_jawaban == "E"){ ?>
                                    <label class="inline-flex items-center mt-3">
                                        <span class="ml-2">A.</span>
                                        <span class="ml-2"><?= $row->pilihan_a; ?></span>
                                    </label>
                                    <label class="inline-flex items-center mt-3">
                                        <span class="ml-2">B.</span>
                                        <span class="ml-2"><?= $row->pilihan_b; ?></span>
                                    </label>
                                    <label class="inline-flex items-center mt-3">
                                        <span class="ml-2">C.</span>
                                        <span class="ml-2"><?= $row->pilihan_c; ?></span>
                                    </label>
                                    <label class="inline-flex items-center mt-3">
                                        <span class="ml-2">D.</span>
                                        <span class="ml-2"><?= $row->pilihan_d; ?></span>
                                    </label>
                                    <label class="inline-flex items-center mt-3 text-success-300">
                                        <span class="ml-2">E.</span>
                                        <span class="ml-2"><?= $row->pilihan_e; ?></span>
                                    </label>
                                <?php } ?>
                            </div>
                        </div>
                        <?php if(empty($hasil_latihan)){ ?>
                            <a href="<?= base_url('guru/hapus/') . $row->id_soal; ?>" onclick="return confirm('Anda yakin ingin menghapus soal?');" class="w-full p-2 mt-3 font-bold text-center text-white border-2 mb-0 border-b-8 bg-danger-300 p-2 focus:outline-none focus:bg-danger-200 border-secondary-300 focus:border-secondary-100 rounded-primary" type="submit">Hapus soal</a>
                        <?php } ?>
                    <?php } ?>
                </div>
            <?php }?>

            <?php if(empty($hasil_latihan)){ ?>
                <div class="py-4 px-5 rounded-lg shadow-custom mb-5 bg-white">
                    <div class="mb-5">
                        <label class="font-semibold">Pertanyaan</label>
                        <textarea class="w-full resize-none p-3 mt-3 text-sm font-medium bg-transparent border-2 appearance-none placeholder-secondary-100 border-secondary-300 focus:outline-none focus:bg-gray-100 rounded-primary" type="text" rows="5" name="soal" placeholder="Masukan Pertanyaan"></textarea>
                    </div>
                    <div class="mb-5">
                        <div class="flex justify-between">
                            <label class="font-semibold">Pilihan A</label>
                            <div class="justify-end">
                                <input type="radio" class="text-success-300" required value="A" name="kunci_jawaban" id="kunci_jawaban_a">
                                <small class="">Jadikan Kunci</small>
                            </div> 
                        </div>
                        <textarea class="w-full resize-none p-3 mt-3 text-sm font-medium bg-transparent border-2 appearance-none placeholder-secondary-100 border-secondary-300 focus:outline-none focus:bg-gray-100 rounded-primary" type="text" rows="1" name="pilihan_a" placeholder="Pilihan A"></textarea>
                    </div>
                    <div class="mb-5">
                        <div class="flex justify-between">
                            <label class="font-semibold">Pilihan B</label>
                            <div class="justify-end">
                                <input type="radio" class="text-success-300" required value="B" name="kunci_jawaban" id="kunci_jawaban_b">
                                <small class="">Jadikan Kunci</small>
                            </div>
                        </div>
                        <textarea class="w-full resize-none p-3 mt-3 text-sm font-medium bg-transparent border-2 appearance-none placeholder-secondary-100 border-secondary-300 focus:outline-none focus:bg-gray-100 rounded-primary" type="text" rows="1" name="pilihan_b" placeholder="Pilihan B"></textarea>
                    </div>
                    <div class="mb-5">
                        <div class="flex justify-between">
                            <label class="font-semibold">Pilihan C</label>
                            <div class="justify-end">
                                <input type="radio" class="text-success-300" required value="C" name="kunci_jawaban" id="kunci_jawaban_c">
                                <small class="">Jadikan Kunci</small>
                            </div>
                        </div>
                        <textarea class="w-full resize-none p-3 mt-3 text-sm font-medium bg-transparent border-2 appearance-none placeholder-secondary-100 border-secondary-300 focus:outline-none focus:bg-gray-100 rounded-primary" type="text" rows="1" name="pilihan_c" placeholder="Pilihan C"></textarea>
                    </div>
                    <div class="mb-5">
                        <div class="flex justify-between">
                            <label class="font-semibold">Pilihan D</label>
                            <div class="justify-end">
                                <input type="radio" class="text-success-300" required value="D" name="kunci_jawaban" id="kunci_jawaban_d">
                                <small class="">Jadikan Kunci</small>
                            </div>
                        </div>
                        <textarea class="w-full resize-none p-3 mt-3 text-sm font-medium bg-transparent border-2 appearance-none placeholder-secondary-100 border-secondary-300 focus:outline-none focus:bg-gray-100 rounded-primary" type="text" rows="1" name="pilihan_d" placeholder="Pilihan D"></textarea>
                    </div>
                    <div class="mb-5">
                        <div class="flex justify-between">
                            <label class="font-semibold">Pilihan E</label>
                            <div class="justify-end">
                                <input type="radio" class="text-success-300" required value="E" name="kunci_jawaban" id="kunci_jawaban_e">
                                <small class="">Jadikan Kunci</small>
                            </div>
                        </div>
                        <textarea class="w-full resize-none p-3 mt-3 text-sm font-medium bg-transparent border-2 appearance-none placeholder-secondary-100 border-secondary-300 focus:outline-none focus:bg-gray-100 rounded-primary"
                        type="text" rows="1" name="pilihan_e" placeholder="Pilihan E"></textarea>
                    </div>
                </div>
            <?php }else{ ?>
                <div class="bg-blue-200 px-6 py-4 mx-2 mb-10 rounded-md flex items-center mx-auto w-full">
                    <svg viewBox="0 0 24 24" class="text-blue-600 w-32 h-5 sm:w-5 sm:h-5 mr-3">
                        <path fill="currentColor" d="M12,0A12,12,0,1,0,24,12,12.013,12.013,0,0,0,12,0Zm.25,5a1.5,1.5,0,1,1-1.5,1.5A1.5,1.5,0,0,1,12.25,5ZM14.5,18.5h-4a1,1,0,0,1,0-2h.75a.25.25,0,0,0,.25-.25v-4.5a.25.25,0,0,0-.25-.25H10.5a1,1,0,0,1,0-2h1a2,2,0,0,1,2,2v4.75a.25.25,0,0,0,.25.25h.75a1,1,0,1,1,0,2Z"></path>
                    </svg>
                    <small class="text-blue-800 text-xs">Tidak bisa menambahkan atau menghapus soal lagi, dikarnakan sudah dikerjakan murid!</small>
                </div>
            <?php } ?>

        <?php }else{ ?>
            <?php $hasil_latihan = $this->m_hasil_latihan->NumMengerjakan($latihan['id_latihan'])->result(); ?>

            <?php $num = 1; foreach ($bank_soal_result as $row) { ?>
                <div class="py-5 px-5 shadow-custom rounded-lg mb-5 bg-white">
                    <div class="flex justify-between">
                        <span class="flex w-56 sm:w-auto"><?=$num++ . ".&nbsp;" . $row->soal;?></span>
                        <?php $hitung_point = $latihan['point_latihan'] / $bank_soal_num; ?>
                        <span class="font-semibold text-base"><?= round($hitung_point) ?> Point</span>
                    </div>
                    <?php if(empty($hasil_latihan)){ ?>
                        <a href="<?= base_url('guru/hapus_soal/') . $row->id_soal; ?>" onclick="return confirm('Anda yakin ingin menghapus soal?');" class="w-full p-2 mt-3 font-bold text-center text-white border-2 mb-0 border-b-8 bg-danger-300 p-2 focus:outline-none focus:bg-danger-200 border-secondary-300 focus:border-secondary-100 rounded-primary" type="submit">Hapus soal</a>
                    <?php } ?>
                </div>

            <?php } ?>
            
            <?php if(empty($hasil_latihan)){ ?>
                <div class="py-4 px-5 rounded-lg shadow-custom mb-5 bg-white">
                    <div class="mb-5">
                        <label class="font-semibold">Pertanyaan</label>
                        <textarea class="w-full resize-none p-3 mt-3 text-sm font-medium bg-transparent border-2 appearance-none placeholder-secondary-100 border-secondary-300 focus:outline-none focus:bg-gray-100 rounded-primary" type="text" rows="5" name="soal" placeholder="Pertanyaan"></textarea>
                    </div>
                </div>
                <button class="w-full p-2 mt-3 font-bold text-center text-white border-2 mb-10 border-b-8 bg-success-300 p-2 focus:outline-none focus:bg-success-200 border-secondary-300 focus:border-secondary-100 rounded-primary" type="submit">Tambah Soal</button>
            <?php }else{ ?>
                <div class="bg-blue-200 px-6 py-4 mx-2 mb-10 rounded-md flex items-center mx-auto w-full">
                    <svg viewBox="0 0 24 24" class="text-blue-600 w-32 h-5 sm:w-5 sm:h-5 mr-3">
                        <path fill="currentColor" d="M12,0A12,12,0,1,0,24,12,12.013,12.013,0,0,0,12,0Zm.25,5a1.5,1.5,0,1,1-1.5,1.5A1.5,1.5,0,0,1,12.25,5ZM14.5,18.5h-4a1,1,0,0,1,0-2h.75a.25.25,0,0,0,.25-.25v-4.5a.25.25,0,0,0-.25-.25H10.5a1,1,0,0,1,0-2h1a2,2,0,0,1,2,2v4.75a.25.25,0,0,0,.25.25h.75a1,1,0,1,1,0,2Z"></path>
                    </svg>
                    <small class="text-blue-800 text-xs">Tidak bisa menambahkan atau menghapus soal lagi, dikarnakan sudah dikerjakan murid!</small>
                </div>
            <?php } ?>

        <?php } ?>


    </form>

</main>
