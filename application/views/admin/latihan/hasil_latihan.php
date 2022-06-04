<!-- Main Content -->
<div class="hk-pg-wrapper">
    <nav class="hk-breadcrumb" aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-light bg-transparent mb-1">
            <li class="breadcrumb-item"><i data-feather='bar-chart-2' class='icons-br-size'></i> <a href="<?= base_url('admin/'); ?>">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page"><i data-feather='check-circle' class='icons-br-size'></i> Hasil Latihan</li>
        </ol>
    </nav>
    <!-- Container -->
    <div class="container mt-10">
        <div class="row">
            <div class="col-xl-12">
                <section class="hk-sec-wrapper">
                    <h5 class="d-flex align-items-end hk-sec-title mb-1"><i data-feather="check-circle" class="mr-1 icons-header-size"></i> Hasil Latihan</h5>
                    <p class="mb-15">Data Hasil Latihan</p>

                    <?= Flasher::flash(); ?>

                    <div class="row">
                        <div class="col-sm">
                            <div class="table-wrap">
                                <table id="datable_3" class="table table-striped w-100 mb-30 ">
                                    <thead>
                                        <tr>
                                            <th class="">No</th>
                                            <th class="">Nama Latihan</th>
                                            <th class="">Tipe Soal</th>
                                            <th class="">Jumlah Soal</th>
                                            <th class="">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(!empty($hasil_latihan)){ ?>

                                            <?php foreach($hasil_latihan as $key){ ?>
                                                <?php $group_latihan = $this->m_hasil_latihan->GroupLatihan($key->id_latihan)->result(); ?>
                                            <?php } ?>

                                            <?php $no =1; foreach($group_latihan as $key){ ?>
                                                <tr>
                                                    <td><?= $no++; ?></td>
                                                    <td><?= $key->nama_latihan; ?></td>
                                                    <td>
                                                        <?php if($key->tipe_latihan == "1"){ ?>
                                                            <span class="badge badge-indigo">Pilihan Ganda</span>
                                                        <?php }elseif($key->tipe_latihan == "2"){ ?>
                                                            <span class="badge badge-purple">Essay</span>
                                                        <?php }elseif($key->tipe_latihan == "3"){ ?>
                                                            <span class="badge badge-dark">Pilihan Ganda & Essay</span>
                                                        <?php } ?>
                                                    </td>    
                                                    <td>
                                                        <?php $num_soal = $this->m_soal->Checking(['id_latihan' => $key->id_latihan])->num_rows(); ?>
                                                        <?php if($num_soal == 0){ ?>
                                                            <span class="badge badge-danger">Soal Belum dibuat</span>
                                                        <?php }else{ ?>
                                                            <?= $num_soal." Soal"; ?>
                                                        <?php } ?>
                                                    </td>
                                                    <td>
                                                        <a href="<?= base_url('admin/hasil_latihan_detail/' . $key->id_latihan); ?>" class="btn btn-xs btn-pink"><i class="fa fa-search"></i> Detail Latihan</a>
                                                        <a href="<?= base_url('hasillatihan/delete_hasil/' . $key->id_latihan); ?>" onclick="return confirm('Anda yakin ingin menghapus data ini?');" class="btn btn-xs btn-icon btn-danger"><span class="btn-icon-wrap"><span class="feather-icon"><i data-feather="trash-2"></i></span></span></a>
                                                    </td>
                                                </tr>   
                                            <?php }?>

                                        <?php }else{null;} ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <!-- /Container -->

    <script type="text/javascript">

        function disabledpg(value){
            var st = $("#tipeSoal").val();

            if(st == "Essay"){ 
                document.getElementById("pgKu").style.display='none';
                document.getElementById("pgKu-2").style.display='none'; 
                document.getElementById("pgKu-3").style.display='none'; 
                document.getElementById("pgKu-4").style.display='none'; 
            }else{ 
                document.getElementById("pgKu").style.display='block';
                document.getElementById("pgKu-2").style.display='block'; 
                document.getElementById("pgKu-3").style.display='block'; 
                document.getElementById("pgKu-4").style.display='block';  
            }
        }
        function tambah(){
            $('#form')[0].reset();
            $('#modalformtitle').html('Tambah Hasil Latihan'); 
            $('#modalformsubmit').html('Tambah Hasil Latihan');  
            document.getElementById('form').action = "<?= base_url('admin/hasil_latihan'); ?>";
        }
    </script>
