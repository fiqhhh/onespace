<!-- Main Content -->
<div class="hk-pg-wrapper">

    <nav class="hk-breadcrumb" aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-light bg-transparent mb-1">
            <li class="breadcrumb-item"><i data-feather='bar-chart-2' class='icons-br-size'></i> <a href="<?= base_url('admin/'); ?>">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page"><i data-feather='archive' class='icons-br-size'></i> Data Murid</li>
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
                        <div class="form-group">
                            <label>Nama Lengkap</label>
                            <input type="hidden" name="id_murid">
                            <input type="hidden" name="id_alamat">
                            <input type="hidden" name="dibuat_murid">
                            <input type="text" name="nama_murid" class="form-control" placeholder="Masukan Nama Lengkap" value="<?= set_value('nama_murid'); ?>">
                            <?= form_error('nama_murid', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email_murid" class="form-control" placeholder="Masukan Email" value="<?= set_value('email'); ?>">
                            <?= form_error('email', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label>Jurusan</label>
                            <select class="select2" name="id_jurusan">
                                <option selected="" disabled="">Pilih</option>
                                <?php foreach($jurusan as $key){ ?>
                                    <option value="<?= $key->id_jurusan; ?>"><?= $key->nama_jurusan; ?></option>
                                <?php } ?>
                            </select>
                            <?= form_error('id_jurusan', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                            <label>Kelas</label>
                                <div class="form-group">
                                    <select class="form-control custom-select" name="kelas_murid">
                                        <option selected="" disabled="">Pilih</option>
                                        <option value="X">X</option>
                                        <option value="XI">XI</option>
                                        <option value="XII">XII</option>
                                    </select>
                                    <?= form_error('kelas_murid', '<small class="text-danger">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="col-sm-6">
                            <label>Kelas</label>
                                <div class="form-group">
                                    <select class="select2" name="jurusan_murid">
                                        <option selected="" disabled="">Pilih</option>
                                        <option value="AKL 1">AKL 1</option>
                                        <option value="AKL 2">AKL 2</option>
                                        <option value="RPL 1">RPL 1</option>
                                        <option value="RPL 2">RPL 2</option>
                                        <option value="APH 1">APH 1</option>
                                        <option value="APH 2">APH 2</option>
                                        <option value="MM 1">MM 1</option>
                                        <option value="MM 2">MM 2</option>
                                        <option value="MM 3">MM 3</option>
                                        <option value="TKRO 1">TKRO 1</option>
                                        <option value="TKRO 2">TKRO 2</option>
                                        <option value="TKRO 3">TKRO 3</option>
                                        <option value="TBSM 1">TBSM 1</option>
                                        <option value="TBSM 2">TBSM 2</option>
                                        <option value="TBSM 3">TBSM 3</option>
                                    </select>
                                    <?= form_error('jurusan_murid', '<small class="text-danger">', '</small>'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Jenis Kelamin</label>
                            <select class="form-control custom-select" name="gender_murid">
                                <option selected="" disabled="">Pilih</option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                            <?= form_error('gender_murid', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>NISN</label>
                                    <input class="form-control" type="text" name="nisn_murid" maxlength="10" placeholder="Masukan NISN" value="<?= set_value('nisn_murid'); ?>" onkeypress="return hanyaAngka(event)">
                                    <?= form_error('nisn_murid', '<small class="text-danger">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>NIS</label>
                                    <input class="form-control" type="text" name="nis_murid" maxlength="9" placeholder="Masukan NIS" value="<?= set_value('nis_murid'); ?>" onkeypress="return hanyaAngka(event)">
                                    <?= form_error('nis_murid', '<small class="text-danger">', '</small>'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Nomor Telepon (Aktif)</label>
                            <input class="form-control" type="text" name="telepon_murid" maxlength="13" placeholder="Masukan Nomor Telepon" value="<?= set_value('telepon_murid'); ?>" onkeypress="return hanyaAngka(event)">
                            <?= form_error('telepon_murid', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Tempat Lahir</label>
                                    <input type="text" name="tempat_lahir_murid" class="form-control" placeholder="Masukan Tempat Lahir" value="<?= set_value('tempat_lahir_murid'); ?>">
                                    <?= form_error('tempat_lahir_murid', '<small class="text-danger">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Tanggal Lahir</label>
                                    <input class="form-control" name="tanggal_lahir_murid" id="tanggal_lahir_murid" placeholder="Enter Tanggal Lahir" value="<?= set_value('tanggal_lahir_murid'); ?>" />
                                    <!-- <small class="form-text text-muted">Harap masukan tanggal lahir yang sesuai!</small> -->
                                </div>
                            </div>
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
                    <h5 class="d-flex align-items-end hk-sec-title mb-1"><i data-feather="archive" class="mr-1 icons-header-size"></i> Murid SMK Negeri 1</h5>
                    <p class="mb-15">Data Semua Murid SMK Negeri 1</p>

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
                                            <option selected="" disabled="">Kelas</option>
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
                                            <th class="">NISN | NIS</th>
                                            <th class="">Jurusan</th>
                                            <th class="">Kelas</th>
                                            <th class="">Jenis Kelamin</th>
                                            <th class="" style="padding-right:600px;">Alamat Rumah</th>
                                            <th class="">QR Code</th>
                                            <th class="">Email Murid</th>
                                            <th class="">Nomor Telepon</th>
                                            <th class="">Tempat & Tanggal Lahir</th>
                                            <th class="">Ruang Kelas</th>
                                            <th class="">Tanggal Dibuat</th>
                                            <th class="">Tanggal Diupdate</th>
                                            <th class="">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1;
                                        foreach ($data_murid as $key) { ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?= ucwords($key->nama_murid); ?></td>
                                                <td><?= $key->nisn_murid; ?> | <?= $key->nis_murid; ?></td>
                                                <td><?= $key->nama_jurusan; ?></td>
                                                <td><?= $key->kelas_murid; ?> - <?= $key->jurusan_murid; ?></td>
                                                <td><?= $key->gender_murid ?></td>
                                                <td><?= $key->alamat . "  Kec." . ucwords($key->kecamatan) . " Kel." . ucwords($key->kelurahan) . " Kota " . ucwords($key->kota) . ", " . ucwords($key->provinsi) . " " . $key->kode_pos; ?></td>
                                                <td><img src="<?= site_url('admin/QRcode/' . $key->nisn_murid) ?>"></td>
                                                <td><?= $key->email_murid; ?></td>
                                                <td><?= $key->telepon_murid; ?></td>
                                                <td><?= ucwords($key->tempat_lahir_murid); ?> <?= date('d M, Y', strtotime($key->tanggal_lahir_murid)) ?></td>
                                                <td>
                                                    <?php $kelas = $this->m_gabung_kelas->Checking(['id_murid' => $key->id_murid])->num_rows(); ?>

                                                    <?= "(Berada di " . $kelas . " Kelas) "; ?>

                                                    <?php $kelas = $this->m_gabung_kelas->CheckingMurid($key->id_murid)->result(); ?>

                                                    <?php foreach ($kelas as $row) { ?>
                                                        <?= "</br> <i data-feather='home' class='icons-size'></i> " . $row->nama_kelas; ?> | <?= "<i data-feather='user' class='icons-size'></i> " . $row->nama_guru ?>, <?= $row->gelar_guru; ?>
                                                    <?php } ?>
                                                </td>
                                                <td><?= time_since(strtotime($key->dibuat_murid)) ?></td>
                                                <td><?= time_since(strtotime($key->diupdate_murid)) ?></td>

                                                <td>
                                                    <a onclick=" edit(<?= $key->id_murid; ?>);" class="btn btn-xs btn-icon btn-warning text-white" data-toggle="modal" data-target="#modalform"><span class="btn-icon-wrap"><span class="feather-icon"><i data-feather="edit"></i></span></span></a>
                                                    <a href="<?= base_url('MuridAdmin/delete_murid/' . $key->id_murid); ?>" onclick="return confirm('Yakin Ingin Menghapus Data?')" class="btn btn-xs btn-icon btn-danger"><span class="btn-icon-wrap"><span class="feather-icon"><i data-feather="trash-2"></i></span></span></a>
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
            $('#modalformtitle').html('Tambah Murid');
            document.getElementById('form').action = "<?= base_url('admin/data_murid') ?>";
        }

        function edit(id_murid) {
            $('#modalformtitle').html('Edit Murid');
            document.getElementById('form').action = "<?= base_url('MuridAdmin/update_murid') ?>";
            $.ajax({
                url: "<?= base_url('MuridAdmin/edit_murid/') ?>" + id_murid,
                type: "GET",
                dataType: "JSON",
                success: function(data) {
                    $('[name="id_murid"]').val(data.id_murid);
                    $('[name="id_alamat"]').val(data.id_alamat);
                    $('[name="id_jurusan"]').val(data.id_jurusan);
                    $('[name="nama_murid"]').val(data.nama_murid);
                    $('[name="email_murid"]').val(data.email_murid);
                    $('[name="nisn_murid"]').val(data.nisn_murid);
                    $('[name="nis_murid"]').val(data.nis_murid);
                    $('[name="kelas_murid"]').val(data.kelas_murid);
                    $('[name="jurusan_murid"]').val(data.jurusan_murid);
                    $('[name="gender_murid"]').val(data.gender_murid);
                    $('[name="tempat_lahir_murid"]').val(data.tempat_lahir_murid);
                    $('[name="tanggal_lahir_murid"]').val(data.tanggal_lahir_murid);
                    $('[name="telepon_murid"]').val(data.telepon_murid);
                    $('[name="dibuat_murid"]').val(data.dibuat_murid);

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