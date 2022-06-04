<main class="container px-8 mx-auto">

    <!-- tombol back -->
    <header class="flex mt-5 justify-items-start">
        <a href="#" class="p-1 transition duration-100 border-2 border-transparent rounded-primary focus:border-secondary-300">
            <svg class="w-6 stroke-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/200svg">
                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
        </a>
    </header>
    <div class="container w-full mx-auto mt-10 sm:px-20">
        <?php if ($latihan['waktu_latihan'] >= 1) {?>
            <div class="bg-yellow-100 px-6 py-4 mx-2 mb-5 rounded-md flex items-center mx-auto w-full">
                <svg viewBox="0 0 24 24" class="text-yellow-600 w-5 h-5 sm:w-5 sm:h-5 mr-3">
                    <path fill="currentColor" d="M23.119,20,13.772,2.15h0a2,2,0,0,0-3.543,0L.881,20a2,2,0,0,0,1.772,2.928H21.347A2,2,0,0,0,23.119,20ZM11,8.423a1,1,0,0,1,2,0v6a1,1,0,1,1-2,0Zm1.05,11.51h-.028a1.528,1.528,0,0,1-1.522-1.47,1.476,1.476,0,0,1,1.448-1.53h.028A1.527,1.527,0,0,1,13.5,18.4,1.475,1.475,0,0,1,12.05,19.933Z"></path>
                </svg>
                <span class="text-yellow-800" id="durasi">Waktu Latihan Terus Berjalan !</span>
            </div>
        <?php }?>
    </div>
    <div class="container w-full mx-auto mt-5 mb-10 sm:px-20">
        <form id="form" action="<?= base_url('murid/submit_latihan/'); ?>" method="POST" autocomplete="off">
            <input type="hidden" name="id_latihan" value="<?= $latihan['id_latihan']; ?>">
            <input type="hidden" name="point_bobot" value="<?= $latihan['point_latihan']; ?>">
            <input type="hidden" name="id_murid" value="<?= $murid['id_murid']; ?>">
            <?php if ($latihan['tipe_latihan'] == "1") { ?>
                <?php $num = 1;
                foreach ($bank_soal_result as $row) {?>
                    <div class="py-5 px-5 shadow-custom rounded-lg mb-5 bg-white">
                        <div class="flex justify-between mb-0">
                            <span class="flex w-56 sm:w-auto"><?=$num++ . ".&nbsp;&nbsp;" . $row->soal;?></span>
                            <?php $hitung_point = $latihan['point_latihan'] / $bank_soal_num; ?>
                            <span class="font-semibold text-xs"><?= round($hitung_point) ?> Point</span>
                        </div>

                        <?php if (empty($row->pilihan_e) && !empty($row->pilihan_d)) { ?>
                            <div class="w-full mt-0">
                                <div class="flex flex-col">
                                    <label class="inline-flex items-center mt-3">
                                        <input type="radio" required id="jawaban_a_<?= $row->id_soal; ?>" name="jawaban_<?= $row->id_soal; ?>" class="form-radio h-5 w-5 text-success-300" value="A">
                                        <span class="ml-2"><?= $row->pilihan_a; ?></span>
                                    </label>

                                    <label class="inline-flex items-center mt-3">
                                        <input type="radio" required id="jawaban_b_<?= $row->id_soal; ?>" name="jawaban_<?= $row->id_soal; ?>" class="form-radio h-5 w-5 text-success-300" value="B">
                                        <span class="ml-2"><?= $row->pilihan_b; ?></span>
                                    </label>

                                    <label class="inline-flex items-center mt-3">
                                        <input type="radio" required id="jawaban_c_<?= $row->id_soal; ?>" name="jawaban_<?= $row->id_soal; ?>" class="form-radio h-5 w-5 text-success-300" value="C">
                                        <span class="ml-2"><?= $row->pilihan_c; ?></span>
                                    </label>

                                    <label class="inline-flex items-center mt-3">
                                        <input type="radio" required id="jawaban_d_<?= $row->id_soal; ?>" name="jawaban_<?= $row->id_soal; ?>" class="form-radio h-5 w-5 text-success-300" value="D">
                                        <span class="ml-2"><?= $row->pilihan_d; ?></span>
                                    </label>
                                </div>
                            </div>
                        <?php } elseif (empty($row->pilihan_d) && !empty($row->pilihan_c)) {  ?>
                            <div class="w-full mt-0">
                                <div class="flex flex-col">
                                    <label class="inline-flex items-center mt-3">
                                        <input type="radio" required id="jawaban_a_<?= $row->id_soal; ?>" name="jawaban_<?= $row->id_soal; ?>" class="form-radio h-5 w-5 text-success-300" value="A">
                                        <span class="ml-2"><?= $row->pilihan_a; ?></span>
                                    </label>

                                    <label class="inline-flex items-center mt-3">
                                        <input type="radio" required id="jawaban_b_<?= $row->id_soal; ?>" name="jawaban_<?= $row->id_soal; ?>" class="form-radio h-5 w-5 text-success-300" value="B">
                                        <span class="ml-2"><?= $row->pilihan_b; ?></span>
                                    </label>

                                    <label class="inline-flex items-center mt-3">
                                        <input type="radio" required id="jawaban_c_<?= $row->id_soal; ?>" name="jawaban_<?= $row->id_soal; ?>" class="form-radio h-5 w-5 text-success-300" value="C">
                                        <span class="ml-2"><?= $row->pilihan_c; ?></span>
                                    </label>
                                </div>
                            </div>
                        <?php } elseif (empty($row->pilihan_c && !empty($row->pilihan_b))) { ?>
                            <div class="w-full mt-0">
                                <div class="flex flex-col">
                                    <label class="inline-flex items-center mt-3">
                                        <input type="radio" required id="jawaban_a_<?= $row->id_soal; ?>" name="jawaban_<?= $row->id_soal; ?>" class="form-radio h-5 w-5 text-success-300" value="A">
                                        <span class="ml-2"><?= $row->pilihan_a; ?></span>
                                    </label>

                                    <label class="inline-flex items-center mt-3">
                                        <input type="radio" required id="jawaban_b_<?= $row->id_soal; ?>" name="jawaban_<?= $row->id_soal; ?>" class="form-radio h-5 w-5 text-success-300" value="B">
                                        <span class="ml-2"><?= $row->pilihan_b; ?></span>
                                    </label>
                                </div>
                            </div>
                        <?php } elseif (empty($row->pilihan_b && !empty($row->pilihan_a))) { ?>
                            <div class="w-full mt-0">
                                <div class="flex flex-col">
                                    <label class="inline-flex items-center mt-3">
                                        <input type="radio" required id="jawaban_a_<?= $row->id_soal; ?>" name="jawaban_<?= $row->id_soal; ?>" class="form-radio h-5 w-5 text-success-300" value="A">
                                        <span class="ml-2"><?= $row->pilihan_a; ?></span>
                                    </label>
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
                                    <label class="inline-flex items-center mt-3">
                                        <input type="radio" required id="jawaban_a_<?= $row->id_soal; ?>" name="jawaban_<?= $row->id_soal; ?>" class="form-radio h-5 w-5 text-success-300" value="A">
                                        <span class="ml-2"><?= $row->pilihan_a; ?></span>
                                    </label>

                                    <label class="inline-flex items-center mt-3">
                                        <input type="radio" required id="jawaban_b_<?= $row->id_soal; ?>" name="jawaban_<?= $row->id_soal; ?>" class="form-radio h-5 w-5 text-success-300" value="B">
                                        <span class="ml-2"><?= $row->pilihan_b; ?></span>
                                    </label>

                                    <label class="inline-flex items-center mt-3">
                                        <input type="radio" required id="jawaban_c_<?= $row->id_soal; ?>" name="jawaban_<?= $row->id_soal; ?>" class="form-radio h-5 w-5 text-success-300" value="C">
                                        <span class="ml-2"><?= $row->pilihan_c; ?></span>
                                    </label>

                                    <label class="inline-flex items-center mt-3">
                                        <input type="radio" required id="jawaban_d_<?= $row->id_soal; ?>" name="jawaban_<?= $row->id_soal; ?>" class="form-radio h-5 w-5 text-success-300" value="D">
                                        <span class="ml-2"><?= $row->pilihan_d; ?></span>
                                    </label>

                                    <label class="inline-flex items-center mt-3">
                                        <input type="radio" required id="jawaban_e_<?= $row->id_soal; ?>" name="jawaban_<?= $row->id_soal; ?>" class="form-radio h-5 w-5 text-success-300" value="E">
                                        <span class="ml-2"><?= $row->pilihan_e; ?></span>
                                    </label>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                <?php }?>
            <?php } else { ?>
                <?php $num = 1;
                foreach ($bank_soal_result as $row) { ?>
                    <div class="py-5 px-5 shadow-custom rounded-lg mb-5 bg-white">
                        <div class="flex justify-between mb-3">
                            <span class="flex"><?=$num++ . ".&nbsp;" . $row->soal;?></span>
                            <?php $hitung_point = $latihan['point_latihan'] / $bank_soal_num; ?>
                            <span class="font-semibold text-base"><?= round($hitung_point); ?> Point</span>
                        </div>
                        <div class="w-full mt-0">
                            <div class="flex flex-col">
                                <textarea required class="border-custom focus:outline-none p-2" name="jawaban_<?= $row->id_soal; ?>" id="" cols="30" rows="5" placeholder="Ketik Jawaban..."></textarea>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            <?php } ?>
            <button onclick="return confirm('Sebelum anda kirim, anda yakin dengan jawaban anda?');" class="w-full p-2 mt-3 font-bold text-center text-white border-2 border-b-8 bg-success-300 focus:outline-none focus:bg-success-200 border-secondary-300 focus:border-secondary-200 rounded-primary" type="submit">
                Kirim
            </button>
        </form>
    </div>
</main>
<script>

    const cookieName = 'countDown' + <?= $latihan['id_latihan'] ?>;
    const savedSeconds = localStorage.getItem(cookieName);

    // If there are seconds saved in localStorage, start with these.
    // Otherwise, start with 900 seconds
    const Minutes = <?= $latihan['waktu_latihan'] ?>;
    const Seconds = Minutes * 60; // 15 minutes in seconds
    const startingSeconds = savedSeconds || Seconds;
    let remainingSeconds = startingSeconds;

    const durasiLabel = document.querySelector('#durasi');
    const form = document.getElementById("form");

    function deleteStorage() {
        localStorage.removeItem(cookieName);
    }

    form.addEventListener('submit', deleteStorage);

    const countdown = () => {
        // If there are any remainingSeconds left, decrement by 1
        // If there are no remainingSeconds left, reset to 15 minutes
        remainingSeconds = remainingSeconds ? remainingSeconds - 1 : form.submit();
        localStorage.setItem(cookieName, remainingSeconds);
        
        // Update the DOM
        jam = Math.floor(remainingSeconds / 3600) + ' Jam';
        menit = Math.floor((remainingSeconds / 60) % 60) + ' Menit';
        detik = remainingSeconds % 60 + ' Detik';
        durasiLabel.innerHTML = `${jam}  ${menit}  ${detik} `;

        if (remainingSeconds < 1) {
            clearInterval(countdown);
            document.getElementById("form").submit();
            localStorage.removeItem(cookieName);
        }
    }

    // Call countdown every second.
    setInterval(countdown, 1000 );

</script>