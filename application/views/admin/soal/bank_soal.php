<!-- Main Content -->
<div class="hk-pg-wrapper">
    <nav class="hk-breadcrumb" aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-light bg-transparent mb-1">
            <li class="breadcrumb-item"><i data-feather='bar-chart-2' class='icons-br-size'></i> <a href="<?= base_url('admin/'); ?>">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page"><i data-feather='file-text' class='icons-br-size'></i> Bank Soal</li>
        </ol>
    </nav>
  
    <!-- Container -->
    <div class="container mt-10">
        <div class="row">
            <div class="col-xl-12">
                <section class="hk-sec-wrapper">
                    <h5 class="d-flex align-items-end hk-sec-title mb-1"><i data-feather="file-text" class="mr-1 icons-header-size"></i> Bank Soal Latihan</h5>
                    <p class="mb-15">Data Semua Soal Latihan</p>

                    <?= Flasher::flash(); ?>

                    <div class="row mb-5">
                        <div class="col-sm-9">
                            <a href="<?= base_url('admin/tambah_bank_soal'); ?>" class="btn btn-primary btn-wth-icon icon-right mb-15" >
                                <span class="btn-text">Tambah Data</span> 
                                <span class="icon-label">
                                    <span class="feather-icon"><i data-feather="plus-circle"></i></span>
                                </span>
                            </a>
                        </div>
                        <div class="col-sm-3">
                            <form action="#" method="POST">
                                <div class="input-group">
                                    <div class="select2-container" style="width:80% !important;">
                                        <select class="select2" name="kelas">
                                            <option selected="" disabled="">Soal</option>
                                        </select>
                                    </div>
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>    
                    <div class="row">
                        <div class="col-sm">
                            <div class="table-wrap">
                                <table id="datable_3" class="table table-striped w-100 mb-30 ">
                                    <thead>
                                        <tr>
                                            <th class="">No</th>
                                            <th class="">Nama Latihan</th>
                                            <th class="">Ruang Kelas</th>
                                            <th class="">Tipe Soal</th>
                                            <th class="">Kunci Jawaban</th>
                                            <th class="" style="padding-right:600px;">Soal Latihan</th>
                                            <th class="">Tanggal Dibuat</th>
                                            <th class="">Tanggal Diupdate</th>
                                            <th class="">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no=1; foreach($bank_soal as $key){ ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?= $key->nama_latihan; ?></td>
                                                <td><?= $key->nama_kelas; ?> | <?= $key->nama_guru; ?>, <?= $key->gelar_guru; ?></td>
                                                <td>
                                                    <?php if($key->tipe_soal == "1"){ ?>
                                                        <span class="badge badge-indigo">Pilihan Ganda</span>
                                                    <?php }elseif($key->tipe_soal == "2"){ ?>
                                                        <span class="badge badge-purple">Essay</span>
                                                    <?php } ?>
                                                </td>
                                                <?php if($key->kunci_jawaban == null){ ?>
                                                    <td><span class="badge badge-danger">Tipe Soal Essay</span></td>
                                                <?php }else{ ?>
                                                    <td>
                                                        <div class="row pl-3">
                                                            <?php if($key->kunci_jawaban == "A"){ ?>
                                                                <div class="col-md-0 pr-1">A.</div>
                                                                <div class="col-md-0"><?= $key->pilihan_a; ?></div>
                                                            <?php }else if($key->kunci_jawaban == "B"){ ?>
                                                                <div class="col-md-0 pr-1">B.</div>
                                                                <div class="col-md-0"><?= $key->pilihan_b; ?></div>
                                                            <?php }else if($key->kunci_jawaban == "C"){ ?>
                                                                <div class="col-md-0 pr-1">C.</div>
                                                                <div class="col-md-0"><?= $key->pilihan_c; ?></div>
                                                            <?php }else if($key->kunci_jawaban == "D"){ ?>
                                                                <div class="col-md-0 pr-1">D.</div>
                                                                <div class="col-md-0"><?= $key->pilihan_d; ?></div>
                                                            <?php } ?>
                                                        </div>
                                                    </td>
                                                <?php } ?>
                                                <td>
                                                    <?= $key->soal; ?>
                                                    <?php if(empty($key->pilihan_d) && empty($key->pilihan_c) && empty($key->pilihan_b) && empty($key->pilihan_a)){ ?>
                                                        <?= null; ?>
                                                        <!-- Jika D Kosong otomatis pilihan menjadi a,b,c -->
                                                    <?php }elseif(empty($key->pilihan_d) && !empty($key->pilihan_c)){ ?>
                                                        <div class="row pl-3">
                                                            <div class="col-md-0 pr-1">A)</div>
                                                            <div class="col-md-0"><?= $key->pilihan_a; ?></div>
                                                        </div>
                                                        <div class="row pl-3">
                                                            <div class="col-md-0 pr-1">B)</div>
                                                            <div class="col-md-0"><?= $key->pilihan_b; ?></div>
                                                        </div>
                                                        <div class="row pl-3">
                                                            <div class="col-md-0 pr-1">C)</div>
                                                            <div class="col-md-0"><?= $key->pilihan_c; ?></div>
                                                        </div>
                                                        <!-- Jika C Kosong otomatis pilihan menjadi a,b -->
                                                    <?php }elseif(empty($key->pilihan_c && !empty($key->pilihan_b))){ ?>
                                                        <div class="row pl-3">
                                                            <div class="col-md-0 pr-1">A)</div>
                                                            <div class="col-md-0"><?= $key->pilihan_a; ?></div>
                                                        </div>
                                                        <div class="row pl-3">
                                                            <div class="col-md-0 pr-1">B)</div>
                                                            <div class="col-md-0"><?= $key->pilihan_b; ?></div>
                                                        </div>
                                                        <!-- Jika B Kosong otomatis pilihan menjadi a -->
                                                    <?php }elseif(empty($key->pilihan_b && !empty($key->pilihan_a))){ ?>
                                                        <div class="row pl-3">
                                                            <div class="col-md-0 pr-1">A)</div>
                                                            <div class="col-md-0"><?= $key->pilihan_a; ?></div>
                                                        </div>
                                                        <!-- Jika A Kosong otomatis pilihan menjadi NULL -->
                                                    <?php }elseif(empty($key->pilihan_a)){ ?>
                                                        <span class="badge badge-danger">Tidak memilih pilihan</span>
                                                    <?php }else{ ?>
                                                        <div class="row pl-3">
                                                            <div class="col-md-0 pr-1">A)</div>
                                                            <div class="col-md-0"><?= $key->pilihan_a; ?></div>
                                                        </div>
                                                        <div class="row pl-3">
                                                            <div class="col-md-0 pr-1">B)</div>
                                                            <div class="col-md-0"><?= $key->pilihan_b; ?></div>
                                                        </div>
                                                        <div class="row pl-3">
                                                            <div class="col-md-0 pr-1">C)</div>
                                                            <div class="col-md-0"><?= $key->pilihan_c; ?></div>
                                                        </div>
                                                        <div class="row pl-3">
                                                            <div class="col-md-0 pr-1">D)</div>
                                                            <div class="col-md-0"><?= $key->pilihan_d; ?></div>
                                                        </div>
                                                    <?php } ?>
                                                </td>
                                                <td><?= time_since(strtotime($key->dibuat_soal)); ?></td>
                                                <td><?= time_since(strtotime($key->diupdate_soal)); ?></td>
                                                <td>
                                                    <a href="<?= base_url('admin/edit_bank_soal/' . $key->id_soal); ?>" class="btn btn-xs btn-icon btn-warning"><span class="btn-icon-wrap"><span class="feather-icon"><i data-feather="edit"></i></span></span></a>
                                                    <a href="<?= base_url('soal/delete_soal/' . $key->id_soal); ?>" onclick="return confirm('Yakin Ingin Menghapus Data?')" class="btn btn-xs btn-icon btn-danger"><span class="btn-icon-wrap"><span class="feather-icon"><i data-feather="trash-2"></i></span></span></a>
                                                </td>
                                            </tr>   
                                        <?php }?>
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



