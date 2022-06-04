<main class="container px-8 mx-auto">

    <!-- tombol back -->
    <header class="flex mt-5 justify-items-start">
        <a href="<?= base_url('guru/latihan/') . $latihan['id_latihan']; ?>" class="p-1 transition duration-100 border-2 border-transparent rounded-primary focus:border-secondary-300">
            <svg class="w-6 stroke-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/200svg">
                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
        </a>
    </header>
    <div class="container w-full mx-auto mt-5 mb-10 sm:px-20">

        <?php if ($latihan['tipe_latihan'] == "1") { ?>

            <?php $hitung_point = $hasil_row['point_bobot'] / $jumlah_soal; ?>  

            <?php $num = 1; foreach($hasil_result as $row){ ?>
                <div class="py-5 px-5 shadow-custom rounded-lg mb-5 bg-white">
                    <div class="flex justify-between mb-0">
                        <span class="flex w-52 sm:w-auto"><?=$num++ . ".&nbsp;" . $row->soal;?></span>
                        <?php if($row->point_hasil == 0){ ?>
                            <span class="font-semibold text-danger-300"> <?= floatval($row->point_hasil); ?> / <?= $hitung_point; ?></span>
                        <?php }else{ ?>
                            <span class="font-semibold text-success-300"> <?= floatval($row->point_hasil); ?> / <?= $hitung_point; ?></span>
                        <?php } ?>
                    </div>

                    <?php if (empty($row->pilihan_e) && !empty($row->pilihan_d)) { ?>
                        <div class="w-full mt-0">
                            <div class="flex flex-col">
                                <?php if($row->jawaban == "A" && $row->kunci_jawaban == "A"){ ?>
                                    <label class="inline-flex items-center mt-3">
                                        <input type="radio" id="jawaban_a_<?= $row->id_soal; ?>" name="jawaban_<?= $row->id_soal; ?>" class="form-radio h-5 w-5 text-success-300" checked disabled value="A">
                                        <span class="ml-2 text-success-300 font-bold"><?= $row->pilihan_a; ?></span>
                                    </label>

                                <?php }elseif($row->jawaban == "A" && $row->kunci_jawaban != "A"){ ?>
                                    <label class="inline-flex items-center mt-3">
                                        <input type="radio" id="jawaban_a_<?= $row->id_soal; ?>" name="jawaban_<?= $row->id_soal; ?>" class="form-radio h-5 w-5 text-danger-300" checked disabled value="A">
                                        <span class="ml-2 text-danger-300 font-bold"><?= $row->pilihan_a; ?></span>
                                    </label>
                                <?php }else{ ?>
                                    <label class="inline-flex items-center mt-3">
                                        <input type="radio" id="jawaban_a_<?= $row->id_soal; ?>" name="jawaban_<?= $row->id_soal; ?>" class="form-radio h-5 w-5 text-danger-300"  value="A" disabled>
                                        <span class="ml-2"><?= $row->pilihan_a; ?></span>
                                    </label>

                                <?php } ?>

                                <?php if($row->jawaban == "B" && $row->kunci_jawaban == "B"){ ?>
                                    <label class="inline-flex items-center mt-3">
                                        <input type="radio" id="jawaban_b_<?= $row->id_soal; ?>" name="jawaban_<?= $row->id_soal; ?>" class="form-radio h-5 w-5 text-success-300" value="B" checked disabled>
                                        <span class="ml-2 text-success-300 font-bold"><?= $row->pilihan_b; ?></span>
                                    </label>

                                <?php }elseif($row->jawaban == "B" && $row->kunci_jawaban != "B"){ ?>
                                    <label class="inline-flex items-center mt-3">
                                        <input type="radio" id="jawaban_b_<?= $row->id_soal; ?>" name="jawaban_<?= $row->id_soal; ?>" class="form-radio h-5 w-5 text-danger-300" value="B" checked disabled>
                                        <span class="ml-2 text-danger-300 font-bold"><?= $row->pilihan_b; ?></span>
                                    </label>
                                <?php }else{ ?>
                                    <label class="inline-flex items-center mt-3">
                                        <input type="radio" id="jawaban_b_<?= $row->id_soal; ?>" name="jawaban_<?= $row->id_soal; ?>" class="form-radio h-5 w-5" value="B" disabled>
                                        <span class="ml-2"><?= $row->pilihan_b; ?></span>
                                    </label>
                                <?php } ?>

                                <?php if($row->jawaban == "C" && $row->kunci_jawaban == "C"){ ?>
                                    <label class="inline-flex items-center mt-3">
                                        <input type="radio" id="jawaban_c_<?= $row->id_soal; ?>" name="jawaban_<?= $row->id_soal; ?>" class="form-radio h-5 w-5 text-success-300" value="C" checked disabled>
                                        <span class="ml-2 text-success-300 font-bold"><?= $row->pilihan_c; ?></span>
                                    </label>
                                <?php }elseif($row->jawaban == "C" && $row->kunci_jawaban != "C"){ ?>
                                    <label class="inline-flex items-center mt-3">
                                        <input type="radio" id="jawaban_c_<?= $row->id_soal; ?>" name="jawaban_<?= $row->id_soal; ?>" class="form-radio h-5 w-5 text-danger-300" value="C" checked disabled>
                                        <span class="ml-2 text-danger-300 font-bold"><?= $row->pilihan_c; ?></span>
                                    </label>
                                <?php }else{ ?>
                                    <label class="inline-flex items-center mt-3">
                                        <input type="radio" id="jawaban_c_<?= $row->id_soal; ?>" name="jawaban_<?= $row->id_soal; ?>" class="form-radio h-5 w-5" value="C" disabled>
                                        <span class="ml-2"><?= $row->pilihan_c; ?></span>
                                    </label>
                                <?php } ?>

                                <?php if($row->jawaban == "D" && $row->kunci_jawaban == "D"){ ?>
                                    <label class="inline-flex items-center mt-3">
                                        <input type="radio" id="jawaban_d_<?= $row->id_soal; ?>" name="jawaban_<?= $row->id_soal; ?>" class="form-radio h-5 w-5 text-success-300" value="D" checked disabled>
                                        <span class="ml-2 text-success-300 font-bold"><?= $row->pilihan_d; ?></span>
                                    </label>
                                <?php }elseif($row->jawaban == "D" && $row->kunci_jawaban != "D"){ ?>
                                    <label class="inline-flex items-center mt-3">
                                        <input type="radio" id="jawaban_d_<?= $row->id_soal; ?>" name="jawaban_<?= $row->id_soal; ?>" class="form-radio h-5 w-5 text-danger-300" value="D" checked disabled>
                                        <span class="ml-2 text-danger-300 font-bold"><?= $row->pilihan_d; ?></span>
                                    </label>
                                <?php }else{ ?>
                                    <label class="inline-flex items-center mt-3">
                                        <input type="radio" id="jawaban_d_<?= $row->id_soal; ?>" name="jawaban_<?= $row->id_soal; ?>" class="form-radio h-5 w-5" value="D" disabled>
                                        <span class="ml-2"><?= $row->pilihan_d; ?></span>
                                    </label>
                                <?php } ?>

                            </div>
                        </div>
                    <?php } elseif (empty($row->pilihan_d) && !empty($row->pilihan_c)) {  ?>
                        <div class="w-full mt-0">
                            <div class="flex flex-col">
                                <?php if($row->jawaban == "A" && $row->kunci_jawaban == "A"){ ?>
                                    <label class="inline-flex items-center mt-3">
                                        <input type="radio" id="jawaban_a_<?= $row->id_soal; ?>" name="jawaban_<?= $row->id_soal; ?>" class="form-radio h-5 w-5 text-success-300" checked disabled value="A">
                                        <span class="ml-2 text-success-300 font-bold"><?= $row->pilihan_a; ?></span>
                                    </label>

                                <?php }elseif($row->jawaban == "A" && $row->kunci_jawaban != "A"){ ?>
                                    <label class="inline-flex items-center mt-3">
                                        <input type="radio" id="jawaban_a_<?= $row->id_soal; ?>" name="jawaban_<?= $row->id_soal; ?>" class="form-radio h-5 w-5 text-danger-300" checked disabled value="A">
                                        <span class="ml-2 text-danger-300 font-bold"><?= $row->pilihan_a; ?></span>
                                    </label>
                                <?php }else{ ?>
                                    <label class="inline-flex items-center mt-3">
                                        <input type="radio" id="jawaban_a_<?= $row->id_soal; ?>" name="jawaban_<?= $row->id_soal; ?>" class="form-radio h-5 w-5 text-danger-300"  value="A" disabled>
                                        <span class="ml-2"><?= $row->pilihan_a; ?></span>
                                    </label>

                                <?php } ?>

                                <?php if($row->jawaban == "B" && $row->kunci_jawaban == "B"){ ?>
                                    <label class="inline-flex items-center mt-3">
                                        <input type="radio" id="jawaban_b_<?= $row->id_soal; ?>" name="jawaban_<?= $row->id_soal; ?>" class="form-radio h-5 w-5 text-success-300" value="B" checked disabled>
                                        <span class="ml-2 text-success-300 font-bold"><?= $row->pilihan_b; ?></span>
                                    </label>

                                <?php }elseif($row->jawaban == "B" && $row->kunci_jawaban != "B"){ ?>
                                    <label class="inline-flex items-center mt-3">
                                        <input type="radio" id="jawaban_b_<?= $row->id_soal; ?>" name="jawaban_<?= $row->id_soal; ?>" class="form-radio h-5 w-5 text-danger-300" value="B" checked disabled>
                                        <span class="ml-2 text-danger-300 font-bold"><?= $row->pilihan_b; ?></span>
                                    </label>
                                <?php }else{ ?>
                                    <label class="inline-flex items-center mt-3">
                                        <input type="radio" id="jawaban_b_<?= $row->id_soal; ?>" name="jawaban_<?= $row->id_soal; ?>" class="form-radio h-5 w-5" value="B" disabled>
                                        <span class="ml-2"><?= $row->pilihan_b; ?></span>
                                    </label>
                                <?php } ?>

                                <?php if($row->jawaban == "C" && $row->kunci_jawaban == "C"){ ?>
                                    <label class="inline-flex items-center mt-3">
                                        <input type="radio" id="jawaban_c_<?= $row->id_soal; ?>" name="jawaban_<?= $row->id_soal; ?>" class="form-radio h-5 w-5 text-success-300" value="C" checked disabled>
                                        <span class="ml-2 text-success-300 font-bold"><?= $row->pilihan_c; ?></span>
                                    </label>
                                <?php }elseif($row->jawaban == "C" && $row->kunci_jawaban != "C"){ ?>
                                    <label class="inline-flex items-center mt-3">
                                        <input type="radio" id="jawaban_c_<?= $row->id_soal; ?>" name="jawaban_<?= $row->id_soal; ?>" class="form-radio h-5 w-5 text-danger-300" value="C" checked disabled>
                                        <span class="ml-2 text-danger-300 font-bold"><?= $row->pilihan_c; ?></span>
                                    </label>
                                <?php }else{ ?>
                                    <label class="inline-flex items-center mt-3">
                                        <input type="radio" id="jawaban_c_<?= $row->id_soal; ?>" name="jawaban_<?= $row->id_soal; ?>" class="form-radio h-5 w-5" value="C" disabled>
                                        <span class="ml-2"><?= $row->pilihan_c; ?></span>
                                    </label>
                                <?php } ?>
                            </div>
                        </div>
                    <?php } elseif (empty($row->pilihan_c && !empty($row->pilihan_b))) { ?>
                        <div class="w-full mt-0">
                            <div class="flex flex-col">
                                <?php if($row->jawaban == "A" && $row->kunci_jawaban == "A"){ ?>
                                    <label class="inline-flex items-center mt-3">
                                        <input type="radio" id="jawaban_a_<?= $row->id_soal; ?>" name="jawaban_<?= $row->id_soal; ?>" class="form-radio h-5 w-5 text-success-300" checked disabled value="A">
                                        <span class="ml-2 text-success-300 font-bold"><?= $row->pilihan_a; ?></span>
                                    </label>

                                <?php }elseif($row->jawaban == "A" && $row->kunci_jawaban != "A"){ ?>
                                    <label class="inline-flex items-center mt-3">
                                        <input type="radio" id="jawaban_a_<?= $row->id_soal; ?>" name="jawaban_<?= $row->id_soal; ?>" class="form-radio h-5 w-5 text-danger-300" checked disabled value="A">
                                        <span class="ml-2 text-danger-300 font-bold"><?= $row->pilihan_a; ?></span>
                                    </label>
                                <?php }else{ ?>
                                    <label class="inline-flex items-center mt-3">
                                        <input type="radio" id="jawaban_a_<?= $row->id_soal; ?>" name="jawaban_<?= $row->id_soal; ?>" class="form-radio h-5 w-5 text-danger-300"  value="A" disabled>
                                        <span class="ml-2"><?= $row->pilihan_a; ?></span>
                                    </label>

                                <?php } ?>

                                <?php if($row->jawaban == "B" && $row->kunci_jawaban == "B"){ ?>
                                    <label class="inline-flex items-center mt-3">
                                        <input type="radio" id="jawaban_b_<?= $row->id_soal; ?>" name="jawaban_<?= $row->id_soal; ?>" class="form-radio h-5 w-5 text-success-300" value="B" checked disabled>
                                        <span class="ml-2 text-success-300 font-bold"><?= $row->pilihan_b; ?></span>
                                    </label>

                                <?php }elseif($row->jawaban == "B" && $row->kunci_jawaban != "B"){ ?>
                                    <label class="inline-flex items-center mt-3">
                                        <input type="radio" id="jawaban_b_<?= $row->id_soal; ?>" name="jawaban_<?= $row->id_soal; ?>" class="form-radio h-5 w-5 text-danger-300" value="B" checked disabled>
                                        <span class="ml-2 text-danger-300 font-bold"><?= $row->pilihan_b; ?></span>
                                    </label>
                                <?php }else{ ?>
                                    <label class="inline-flex items-center mt-3">
                                        <input type="radio" id="jawaban_b_<?= $row->id_soal; ?>" name="jawaban_<?= $row->id_soal; ?>" class="form-radio h-5 w-5" value="B" disabled>
                                        <span class="ml-2"><?= $row->pilihan_b; ?></span>
                                    </label>
                                <?php } ?>
                            </div>
                        </div>
                    <?php } elseif (empty($row->pilihan_b && !empty($row->pilihan_a))) { ?>
                        <div class="w-full mt-0">
                            <div class="flex flex-col">
                                <?php if($row->jawaban == "A" && $row->kunci_jawaban == "A"){ ?>
                                    <label class="inline-flex items-center mt-3">
                                        <input type="radio" id="jawaban_a_<?= $row->id_soal; ?>" name="jawaban_<?= $row->id_soal; ?>" class="form-radio h-5 w-5 text-success-300" checked disabled value="A">
                                        <span class="ml-2 text-success-300 font-bold"><?= $row->pilihan_a; ?></span>
                                    </label>

                                <?php }elseif($row->jawaban == "A" && $row->kunci_jawaban != "A"){ ?>
                                    <label class="inline-flex items-center mt-3">
                                        <input type="radio" id="jawaban_a_<?= $row->id_soal; ?>" name="jawaban_<?= $row->id_soal; ?>" class="form-radio h-5 w-5 text-danger-300" checked disabled value="A">
                                        <span class="ml-2 text-danger-300 font-bold"><?= $row->pilihan_a; ?></span>
                                    </label>
                                <?php }else{ ?>
                                    <label class="inline-flex items-center mt-3">
                                        <input type="radio" id="jawaban_a_<?= $row->id_soal; ?>" name="jawaban_<?= $row->id_soal; ?>" class="form-radio h-5 w-5 text-danger-300"  value="A" disabled>
                                        <span class="ml-2"><?= $row->pilihan_a; ?></span>
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
                                <?php if($row->jawaban == "A" && $row->kunci_jawaban == "A"){ ?>
                                    <label class="inline-flex items-center mt-3">
                                        <input type="radio" id="jawaban_a_<?= $row->id_soal; ?>" name="jawaban_<?= $row->id_soal; ?>" class="form-radio h-5 w-5 text-success-300" checked disabled value="A">
                                        <span class="ml-2 text-success-300 font-bold"><?= $row->pilihan_a; ?></span>
                                    </label>

                                <?php }elseif($row->jawaban == "A" && $row->kunci_jawaban != "A"){ ?>
                                    <label class="inline-flex items-center mt-3">
                                        <input type="radio" id="jawaban_a_<?= $row->id_soal; ?>" name="jawaban_<?= $row->id_soal; ?>" class="form-radio h-5 w-5 text-danger-300" checked disabled value="A">
                                        <span class="ml-2 text-danger-300 font-bold"><?= $row->pilihan_a; ?></span>
                                    </label>
                                <?php }else{ ?>
                                    <label class="inline-flex items-center mt-3">
                                        <input type="radio" id="jawaban_a_<?= $row->id_soal; ?>" name="jawaban_<?= $row->id_soal; ?>" class="form-radio h-5 w-5 text-danger-300"  value="A" disabled>
                                        <span class="ml-2"><?= $row->pilihan_a; ?></span>
                                    </label>

                                <?php } ?>

                                <?php if($row->jawaban == "B" && $row->kunci_jawaban == "B"){ ?>
                                    <label class="inline-flex items-center mt-3">
                                        <input type="radio" id="jawaban_b_<?= $row->id_soal; ?>" name="jawaban_<?= $row->id_soal; ?>" class="form-radio h-5 w-5 text-success-300" value="B" checked disabled>
                                        <span class="ml-2 text-success-300 font-bold"><?= $row->pilihan_b; ?></span>
                                    </label>

                                <?php }elseif($row->jawaban == "B" && $row->kunci_jawaban != "B"){ ?>
                                    <label class="inline-flex items-center mt-3">
                                        <input type="radio" id="jawaban_b_<?= $row->id_soal; ?>" name="jawaban_<?= $row->id_soal; ?>" class="form-radio h-5 w-5 text-danger-300" value="B" checked disabled>
                                        <span class="ml-2 text-danger-300 font-bold"><?= $row->pilihan_b; ?></span>
                                    </label>
                                <?php }else{ ?>
                                    <label class="inline-flex items-center mt-3">
                                        <input type="radio" id="jawaban_b_<?= $row->id_soal; ?>" name="jawaban_<?= $row->id_soal; ?>" class="form-radio h-5 w-5" value="B" disabled>
                                        <span class="ml-2"><?= $row->pilihan_b; ?></span>
                                    </label>
                                <?php } ?>

                                <?php if($row->jawaban == "C" && $row->kunci_jawaban == "C"){ ?>
                                    <label class="inline-flex items-center mt-3">
                                        <input type="radio" id="jawaban_c_<?= $row->id_soal; ?>" name="jawaban_<?= $row->id_soal; ?>" class="form-radio h-5 w-5 text-success-300" value="C" checked disabled>
                                        <span class="ml-2 text-success-300 font-bold"><?= $row->pilihan_c; ?></span>
                                    </label>
                                <?php }elseif($row->jawaban == "C" && $row->kunci_jawaban != "C"){ ?>
                                    <label class="inline-flex items-center mt-3">
                                        <input type="radio" id="jawaban_c_<?= $row->id_soal; ?>" name="jawaban_<?= $row->id_soal; ?>" class="form-radio h-5 w-5 text-danger-300" value="C" checked disabled>
                                        <span class="ml-2 text-danger-300 font-bold"><?= $row->pilihan_c; ?></span>
                                    </label>
                                <?php }else{ ?>
                                    <label class="inline-flex items-center mt-3">
                                        <input type="radio" id="jawaban_c_<?= $row->id_soal; ?>" name="jawaban_<?= $row->id_soal; ?>" class="form-radio h-5 w-5" value="C" disabled>
                                        <span class="ml-2"><?= $row->pilihan_c; ?></span>
                                    </label>
                                <?php } ?>

                                <?php if($row->jawaban == "D" && $row->kunci_jawaban == "D"){ ?>
                                    <label class="inline-flex items-center mt-3">
                                        <input type="radio" id="jawaban_d_<?= $row->id_soal; ?>" name="jawaban_<?= $row->id_soal; ?>" class="form-radio h-5 w-5 text-success-300" value="D" checked disabled>
                                        <span class="ml-2 text-success-300 font-bold"><?= $row->pilihan_d; ?></span>
                                    </label>
                                <?php }elseif($row->jawaban == "D" && $row->kunci_jawaban != "D"){ ?>
                                    <label class="inline-flex items-center mt-3">
                                        <input type="radio" id="jawaban_d_<?= $row->id_soal; ?>" name="jawaban_<?= $row->id_soal; ?>" class="form-radio h-5 w-5 text-danger-300" value="D" checked disabled>
                                        <span class="ml-2 text-danger-300 font-bold"><?= $row->pilihan_d; ?></span>
                                    </label>
                                <?php }else{ ?>
                                    <label class="inline-flex items-center mt-3">
                                        <input type="radio" id="jawaban_d_<?= $row->id_soal; ?>" name="jawaban_<?= $row->id_soal; ?>" class="form-radio h-5 w-5" value="D" disabled>
                                        <span class="ml-2"><?= $row->pilihan_d; ?></span>
                                    </label>
                                <?php } ?>
                                <?php if($row->jawaban == "E" && $row->kunci_jawaban == "E"){ ?>
                                    <label class="inline-flex items-center mt-3">
                                        <input type="radio" id="jawaban_e_<?= $row->id_soal; ?>" name="jawaban_<?= $row->id_soal; ?>" class="form-radio h-5 w-5 text-success-300" value="E" checked disabled>
                                        <span class="ml-2 text-success-300 font-bold"><?= $row->pilihan_e; ?></span>
                                    </label>
                                <?php }elseif($row->jawaban == "E" && $row->kunci_jawaban != "E"){ ?>
                                    <label class="inline-flex items-center mt-3">
                                        <input type="radio" id="jawaban_e_<?= $row->id_soal; ?>" name="jawaban_<?= $row->id_soal; ?>" class="form-radio h-5 w-5 text-danger-300" value="E" checked disabled>
                                        <span class="ml-2 text-danger-300 font-bold"><?= $row->pilihan_e; ?></span>
                                    </label>
                                <?php }else{ ?>
                                    <label class="inline-flex items-center mt-3">
                                        <input type="radio" id="jawaban_e_<?= $row->id_soal; ?>" name="jawaban_<?= $row->id_soal; ?>" class="form-radio h-5 w-5" value="E" disabled>
                                        <span class="ml-2"><?= $row->pilihan_e; ?></span>
                                    </label>
                                <?php } ?>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            <?php }?>
        <?php } else { ?>
            <?php $num = 1; foreach($hasil_result as $row){ ?>
                <?php $hitung_point = $hasil_row['point_bobot'] / $jumlah_soal; ?>  
                <div class="py-5 px-5 shadow-custom rounded-lg mb-5 bg-white">
                    <div class="flex justify-between mb-0">
                        <span class="flex w-52 sm:w-auto"><?=$num++ . ".&nbsp;" . $row->soal;?></span>
                        <?php if($row->point_hasil == 0){ ?>
                            <span class="font-semibold text-danger-300"> <?= floatval($row->point_hasil); ?> / <?= $hitung_point; ?></span>
                        <?php }else{ ?>
                            <span class="font-semibold text-success-300"> <?= floatval($row->point_hasil); ?> / <?= $hitung_point; ?></span>
                        <?php } ?>
                    </div>
                    <div class="w-full mt-0">
                        <div class="flex flex-col">
                            <textarea class="border-custom focus:outline-none p-2" name="jawaban_<?= $row->id_soal; ?>" id="" cols="30" rows="5" placeholder="Ketik Jawaban..." disabled><?= $row->jawaban; ?></textarea>
                        </div>
                    </div>
                </div>
            <?php } ?>
        <?php } ?>
    </div>
</main>