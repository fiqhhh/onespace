<!-- Main Content -->
<div class="hk-pg-wrapper">
    <nav class="hk-breadcrumb" aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-light bg-transparent mb-1">
            <li class="breadcrumb-item"><i data-feather='bar-chart-2' class='icons-br-size'></i> <a href="<?= base_url('admin/'); ?>">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page"><i data-feather='check-circle' class='icons-br-size'></i> Hasil Tugas</li>
        </ol>
    </nav>
    <!-- Modal Forms -->
    <div class="modal fade" id="modalform" tabindex="-1" role="dialog" aria-labelledby="modalform" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalformtitle"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="form" autocomplete="off" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Tugas</label>
                            <input type="hidden" name="id_hasil_tugas">
                            <select class="select2" name="id_tugas">
                                <option selected="" disabled="">Pilih</option>
                                <?php foreach ($tugas as $key) { ?>
                                    <option value="<?= $key->id_tugas; ?>"><?= $key->nama_tugas; ?> - <?= $key->nama_kelas; ?></option>
                                <?php } ?>
                            </select>
                            <?= form_error('id_tugas', '<small class="text-danger">', '</small>'); ?>
                        </div>

                        <div class="form-group">
                            <label>Nama Murid</label>
                            <select class="select2" name="id_murid">
                                <option selected="" disabled="">Pilih</option>
                                <?php foreach ($data_murid as $key) { ?>
                                    <option value="<?= $key->id_murid; ?>"><?= $key->nama_murid; ?> | <?= $key->kelas_murid ?> - <?= $key->jurusan_murid; ?></option>
                                <?php } ?>
                            </select>
                            <?= form_error('id_murid', '<small class="text-danger">', '</small>'); ?>
                        </div>

                        <div class="form-group">
                            <div class="custom-file-container" data-upload-id="myUniqueUploadId">
                                <label class="custom-file-container__image-clear">Lampiran</label>
                                <label class="custom-file-container__custom-file" >
                                    <input type="file" name="lampiran[]" class="custom-file-container__custom-file__custom-file-input" accept="*" multiple aria-label="Choose File" multiple required>
                                    <span class="custom-file-container__custom-file__custom-file-control"></span>
                                </label>
                                <div class="custom-file-container__image-preview"></div>
                            </div>
                        </div>

                        <hr class="mb-3">
                        <div class="float-right mb-1">
                            <button type="submit" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary"><i data-feather="save" class="mr-1 icons-size"></i>Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Container -->
    <div class="container mt-10">
        <div class="row">
            <div class="col-xl-12">
                <section class="hk-sec-wrapper">
                    <h5 class="d-flex align-items-end hk-sec-title mb-1"><i data-feather="check-circle" class="mr-1 icons-header-size"></i> Hasil Tugas Murid</h5>
                    <p class="mb-15">Data Hasil Tugas Murid</p>

                    <?= Flasher::flash(); ?>

                    <div class="row mb-5">
                        <div class="col-sm-9">
                            <button class="btn btn-primary btn-wth-icon icon-right mb-15" data-toggle="modal" data-target="#modalform" onclick="tambah();">
                                <span class="btn-text">Tambah Data</span> 
                                <span class="icon-label">
                                    <span class="feather-icon"><i data-feather="plus-circle"></i></span>
                                </span>
                            </button>
                        </div>
                        <div class="col-sm-3">
                            <form action="#" method="POST">
                                <div class="input-group">
                                    <div class="select2-container" style="width:80% !important;">
                                        <select class="select2" name="kelas">
                                            <option selected="" disabled="">Ruang Kelas</option>
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
                                            <th class="">Nama Murid</th>
                                            <th class="">Kelas Murid</th>
                                            <th class="">Nama Tugas</th>
                                            <th class="">Mata Pelajaran</th>
                                            <th class="" style="padding-right:600px;">Ruang Kelas & Guru</th>
                                            <th class="">Lampiran Hasil</th>
                                            <th class="">Tanggal Dikumpulkan</th>
                                            <th class="">Tanggal Diupdate</th>
                                            <th class="">Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php $no = 1;
                                        foreach ($hasil_tugas as $key) { ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?= $key->nama_murid; ?></td>
                                                <td><?= $key->kelas_murid; ?> - <?= $key->jurusan_murid; ?></td>
                                                <td><?= $key->nama_tugas; ?></td>
                                                <td><?= $key->nama_mapel; ?></td>
                                                <td><?= $key->nama_kelas; ?> | <?= $key->nama_guru; ?>, <?= $key->gelar_guru; ?></td>
                                                <td>
                                                    <?php $lampiran = $this->m_lampiran->Checking(['id_hasil_tugas' =>$key->id_hasil_tugas])->num_rows(); ?>
                                                    <?= "(<i data-feather='file-text' class='icons-size'></i> ".$lampiran . " Lampiran)"; ?>

                                                    <?php $lampiran = $this->m_lampiran->Checking(['id_hasil_tugas' =>$key->id_hasil_tugas])->result(); ?>

                                                    <?php foreach ($lampiran as $row) { ?>
                                                        <?= "</br>".$row->nama_lampiran; ?>
                                                    <?php } ?>
                                                </td>

                                                <?php if($key->dikumpulkan_tugas >= $key->tenggat_tugas){ ?>
                                                    <td><?= time_since(strtotime($key->dikumpulkan_tugas)); ?> <span class="badge badge-danger">Telat Mengumpulkan</span></td>
                                                <?php }else{ ?>
                                                    <td><?= time_since(strtotime($key->dikumpulkan_tugas)); ?> <span class="badge badge-success">Tepat Waktu</span></td>
                                                <?php } ?>

                                                <td><?= time_since(strtotime($key->diupdate_hasil)); ?></td>

                                                <td>
                                                    <a href="<?= base_url('admin/edit_hasil/' . $key->id_hasil_tugas); ?>" class="btn btn-xs btn-icon btn-warning"><span class="btn-icon-wrap"><span class="feather-icon"><i data-feather="edit"></i></span></span></a>
                                                    <a href="<?= base_url('hasil/delete_hasil/' . $key->id_hasil_tugas); ?>" onclick="return confirm('Yakin Ingin Menghapus Data?')" class="btn btn-xs btn-icon btn-danger"><span class="btn-icon-wrap"><span class="feather-icon"><i data-feather="trash-2"></i></span></span></a>
                                                </td>
                                            </tr>
                                        <?php } ?>
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


    <!-- Ajax -->
    <script type="text/javascript">
        function tambah() {
            $('#form')[0].reset();
            $('#modalformtitle').html('Tambah Hasil Tugas');
            document.getElementById('form').action = "<?= base_url('admin/hasil_tugas'); ?>";
        }
    </script>

    <script src="<?= base_url('assets/multiple/file-upload-with-preview.min.js'); ?>"></script>
    <script type="text/javascript">
        var upload = new FileUploadWithPreview('myUniqueUploadId', {
            showDeleteButtonOnImages: true,
            text: {
                chooseFile: 'Masukan Lampiran',
                browse: 'Pilih Lampiran',
                selectedCount: 'Custom Files Selected Copy',
            },
        })
    </script>