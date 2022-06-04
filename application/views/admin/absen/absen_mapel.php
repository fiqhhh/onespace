<!-- Main Content -->
<div class="hk-pg-wrapper">

    <nav class="hk-breadcrumb" aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-light bg-transparent mb-1">
            <li class="breadcrumb-item"><i data-feather='bar-chart-2' class='icons-br-size'></i> <a href="<?= base_url('admin/'); ?>">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page"><i data-feather='activity' class='icons-br-size'></i> Absen Mapel</li>
        </ol>
    </nav>
    <!-- Container -->
    <div class="container mt-10">
        <div class="row">
            <div class="col-xl-12">
                <section class="hk-sec-wrapper">
                    <h5 class="d-flex align-items-end hk-sec-title mb-1"><i data-feather="activity" class="mr-1 icons-header-size"></i> Absen Mapel</h5>
                    <p class="mb-15">Data Absen Mapel</p>

                    <?= Flasher::flash(); ?>

                    <div class="row">
                        <div class="col-sm">
                            <div class="table-wrap">
                                <table id="datable_3" class="table table-striped w-100 mb-30 ">
                                    <thead>
                                        <tr>
                                            <th class="">No</th>
                                            <th class="">Nama Lengkap</th>
                                            <th class="">Kelas</th>
                                            <th class="">Ruang Kelas</th>
                                            <th class="">Waktu Masuk</th>
                                            <th class="">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no=1; foreach($absen_mapel as $key){ ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?= $key->nama_murid; ?></td>
                                                <td><?= $key->kelas_murid; ?> - <?= $key->jurusan_murid; ?></td>
                                                <td><?= $key->nama_kelas; ?> Tp. <?= $key->tahun_pembelajaran; ?></td>
                                                <td><?= time_since($key->waktu_masuk_mapel); ?></td>
                                                <td>
                                                    <a href="#" onclick="return confirm('Yakin Ingin Menghapus Data?')" class="btn btn-xs btn-icon btn-danger"><span class="btn-icon-wrap"><span class="feather-icon"><i data-feather="trash-2"></i></span></span></a>
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

