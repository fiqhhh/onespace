<!-- Main Content -->
<div class="hk-pg-wrapper">

    <nav class="hk-breadcrumb" aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-light bg-transparent mb-1">
            <li class="breadcrumb-item"><i data-feather='bar-chart-2' class='icons-br-size'></i> <a href="<?= base_url('admin/'); ?>">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page"><i data-feather='archive' class='icons-br-size'></i> Data Guru</li>
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
                    <form method="POST" id="form" autocomplete="off">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Nama Lengkap</label>
                                    <input type="hidden" name="id_guru">
                                    <input type="hidden" name="id_alamat">
                                    <input type="hidden" name="dibuat_guru">
                                    <input type="text" name="nama_guru" class="form-control" placeholder="Masukan Nama Lengkap" value="<?= set_value('nama_guru'); ?>">
                                    <?= form_error('nama_guru', '<small class="text-danger">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Gelar Guru</label>
                                    <input type="text" name="gelar_guru" class="form-control" placeholder="Masukan Gelar Guru" value="<?= set_value('gelar_guru'); ?>">
                                    <?= form_error('gelar_guru', '<small class="text-danger">', '</small>'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>NIP Guru</label>
                            <input class="form-control" type="text" name="nip_guru" placeholder="Masukan NIP Guru" value="<?= set_value('nip_guru'); ?>" onkeypress="return hanyaAngka(event)">
                            <?= form_error('nip_guru', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email_guru" class="form-control" placeholder="Masukan Email" value="<?= set_value('email_guru'); ?>">
                            <?= form_error('email_guru', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label>Jenis Kelamin</label>
                            <select class="form-control custom-select" name="gender_guru">
                                <option selected="" disabled="">Pilih</option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                            <?= form_error('gender_guru', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Tempat Lahir</label>
                                    <input type="text" name="tempat_lahir_guru" class="form-control" placeholder="Masukan Tempat Lahir" value="<?= set_value('tempat_lahir_guru'); ?>">
                                    <?= form_error('tempat_lahir_guru', '<small class="text-danger">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Tanggal Lahir</label>
                                    <input class="form-control" name="tanggal_lahir_guru" placeholder="Enter Tanggal Lahir" value="<?= set_value('tanggal_lahir_guru'); ?>" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Nomor Telepon (Aktif)</label>
                            <input class="form-control" type="text" name="telepon_guru" maxlength="13" placeholder="Masukan Nomor Telepon" value="<?= set_value('telepon_guru'); ?>" onkeypress="return hanyaAngka(event)">
                            <?= form_error('telepon_guru', '<small class="text-danger">', '</small>'); ?>
                        </div>

                        <!-- Alamat -->
                        <div class="form-group">
                            <label>Nama Jalan / Kampung / Blok</label>
                            <textarea class="form-control" name="alamat" placeholder="Masukan Alamat"><?= set_value('alamat'); ?></textarea>
                            <?= form_error('alamat', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Kecamatan</label>
                                    <input class="form-control" type="text" name="kecamatan" placeholder="Masukan Kecamatan" value="<?= set_value('kecamatan'); ?>">
                                    <?= form_error('kecamatan', '<small class="text-danger">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Kelurahan</label>
                                    <input class="form-control" type="text" name="kelurahan" placeholder="Masukan Kelurahan" value="<?= set_value('kelurahan'); ?>">
                                    <?= form_error('kelurahan', '<small class="text-danger">', '</small>'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Kota</label>
                                    <input class="form-control" type="text" name="kota" placeholder="Masukan Kota" value="<?= set_value('kota'); ?>">
                                    <?= form_error('kota', '<small class="text-danger">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Provinsi</label>
                                    <input class="form-control" type="text" name="provinsi" placeholder="Masukan Provinsi" value="<?= set_value('provinsi'); ?>">
                                    <?= form_error('provinsi', '<small class="text-danger">', '</small>'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Kode Pos</label>
                            <input class="form-control" type="text" name="kode_pos" maxlength="5" placeholder="Masukan Kode Pos" value="<?= set_value('kode_pos'); ?>" onkeypress="return hanyaAngka(event)">
                            <?= form_error('kode_pos', '<small class="text-danger">', '</small>'); ?>
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
                    <h5 class="d-flex align-items-end hk-sec-title mb-1"><i data-feather="archive" class="mr-1 icons-header-size"></i> Guru SMK Negeri 1</h5>
                    <p class="mb-15">Data Semua Guru SMK Negeri 1</p>

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
                                            <option selected="" disabled="">Pelajaran</option>
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
                                            <th class="">Nama Lengkap</th>
                                            <th class="">NIP Guru</th>
                                            <th class="">Email Guru</th>
                                            <th class="">Jenis Kelamin</th>
                                            <th class="" style="padding-right:600px;">Alamat Rumah</th>
                                            <th class="">QR Code</th>
                                            <th class="">Nomor Telepon</th>
                                            <th class="">Tempat & Tanggal Lahir</th>
                                            <th class="">Tanggal Dibuat</th>
                                            <th class="">Tanggal Diupdate</th>
                                            <th class="">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1;
                                        foreach ($data_guru as $key) { ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?= ucwords($key->nama_guru); ?>, <?= $key->gelar_guru; ?></td>
                                                <td><?= $key->nip_guru ?></td>
                                                <td><?= $key->email_guru; ?></td>
                                                <td><?= $key->gender_guru ?></td>
                                                <td><?= $key->alamat . " Kec." . ucwords($key->kecamatan) . " Kel." . ucwords($key->kelurahan) . " Kota " . ucwords($key->kota) . ", " . ucwords($key->provinsi) . " " . $key->kode_pos; ?></td>
                                                <td><img src="<?= site_url('admin/QRcode/' . $key->nip_guru) ?>"></td>
                                                <td><?= $key->telepon_guru ?></td>
                                                <td><?= ucwords($key->tempat_lahir_guru); ?> <?= date('d M, Y', strtotime($key->tanggal_lahir_guru)) ?></td>
                                                <td><?= time_since(strtotime($key->dibuat_guru)) ?></td>
                                                <td><?= time_since(strtotime($key->diupdate_guru)) ?></td>

                                                <td>
                                                    <a onclick="edit(<?= $key->id_guru; ?>);" class="btn btn-xs btn-icon btn-warning text-white" data-toggle="modal" data-target="#modalform"><span class="btn-icon-wrap"><span class="feather-icon"><i data-feather="edit"></i></span></span></a>
                                                    <a href="<?= base_url('GuruAdmin/delete_guru/' . $key->id_guru); ?>" onclick="return confirm('Yakin Ingin Menghapus Data?')" class="btn btn-xs btn-icon btn-danger"><span class="btn-icon-wrap"><span class="feather-icon"><i data-feather="trash-2"></i></span></span></a>
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
            $('#modalformtitle').html('Tambah Guru');
            document.getElementById('form').action = "<?= base_url('admin/data_guru') ?>";
        }

        function edit(id_guru) {
            $('#modalformtitle').html('Edit Guru');
            document.getElementById('form').action = "<?= base_url('GuruAdmin/update_guru') ?>";
            $.ajax({
                url: "<?= base_url('GuruAdmin/edit_guru/') ?>" + id_guru,
                type: "GET",
                dataType: "JSON",
                success: function(data) {
                    $('[name="id_guru"]').val(data.id_guru);
                    $('[name="id_alamat"]').val(data.id_alamat);
                    $('[name="nama_guru"]').val(data.nama_guru);
                    $('[name="nip_guru"]').val(data.nip_guru);
                    $('[name="gelar_guru"]').val(data.gelar_guru);
                    $('[name="email_guru"]').val(data.email_guru);
                    $('[name="gender_guru"]').val(data.gender_guru);
                    $('[name="tempat_lahir_guru"]').val(data.tempat_lahir_guru);
                    $('[name="tanggal_lahir_guru"]').val(data.tanggal_lahir_guru);
                    $('[name="telepon_guru"]').val(data.telepon_guru);
                    $('[name="dibuat_guru"]').val(data.dibuat_guru);

                    // Alamat //
                    $('[name="alamat"]').val(data.alamat);
                    $('[name="kecamatan"]').val(data.kecamatan);
                    $('[name="kelurahan"]').val(data.kelurahan);
                    $('[name="kota"]').val(data.kota);
                    $('[name="provinsi"]').val(data.provinsi);
                    $('[name="kode_pos"]').val(data.kode_pos);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Gagal Mengambil Data, Silahkan Refresh Kembali');
                }
            })
        }
    </script>