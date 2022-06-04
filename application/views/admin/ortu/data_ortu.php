<!-- Main Content -->
<div class="hk-pg-wrapper">

    <nav class="hk-breadcrumb" aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-light bg-transparent mb-1">
            <li class="breadcrumb-item"><i data-feather='bar-chart-2' class='icons-br-size'></i> <a href="<?= base_url('admin/'); ?>">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page"><i data-feather='archive' class='icons-br-size'></i> Data Orang Tua</li>
        </ol>
    </nav>

    <!-- Modal Forms -->
    <div class="modal fade" id="modalform" tabindex="-1" role="dialog" aria-labelledby="modalform" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalformtitle"></h5>
                    <button type="button" class="close"  data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="form" autocomplete="off">
                        <div class="form-group">
                            <label>Nama Anak</label>
                            <input type="hidden" name="id_orang_tua">
                            <input type="hidden" name="dibuat_ortu">
                            <select class="select2" name="id_murid">
                                <option selected="" disabled="">Pilih</option>
                                <?php foreach($data_murid as $key){ ?>
                                    <option value="<?= $key->id_murid; ?>"><?= $key->nama_murid; ?></option>
                                <?php } ?>
                            </select>
                            <?= form_error('id_murid','<small class="text-danger">','</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label>Nama Orang Tua / Wali</label>
                            <input type="text" name="nama_ortu" class="form-control" placeholder="Masukan Nama Orang Tua / Wali" value="<?= set_value('nama_ortu'); ?>">
                            <?= form_error('nama_ortu','<small class="text-danger">','</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label>Email Orang Tua / Wali</label>
                            <input type="email" name="email_ortu" class="form-control" placeholder="Masukan Email" value="<?= set_value('email_ortu'); ?>">
                            <?= form_error('email_ortu','<small class="text-danger">','</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label>Status Orang Tua Murid</label>
                            <select class="select2" name="status_ortu">
                                <option selected="" disabled="">Pilih</option>
                                <option value="Lengkap">Lengkap</option>
                                <option value="Yatim">Yatim</option>
                                <option value="Piatu">Piatu</option>
                                <option value="Yatim Piatu">Yatim Piatu</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Nomor Telepon (Aktif)</label>
                            <input class="form-control" type="text" name="telepon_ortu" maxlength="13" placeholder="Masukan Nomor Telepon" value="<?= set_value('telepon_ortu'); ?>" onkeypress="return hanyaAngka(event)">
                            <?= form_error('telepon_ortu','<small class="text-danger">','</small>'); ?>
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
                    <h5 class="d-flex align-items-end hk-sec-title mb-1"><i data-feather="archive" class="mr-1 icons-header-size"></i> Orang Tua Murid</h5>
                    <p class="mb-15">Data Orang Tua Murid</p>

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
                                            <option selected="" disabled="">Murid</option>
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
                                            <th class="">Orang Tua / Wali</th>
                                            <th class="">Nama Anak</th>
                                            <th class="">Email Orang Tua</th>
                                            <th class="">Nomor Telepon</th>
                                            <th class="" style="padding-right:600px;">Alamat Rumah</th>
                                            <th class="">Status Orang Tua Murid</th>
                                            <th class="">Tanggal Dibuat</th>
                                            <th class="">Tanggal Diupdate</th>
                                            <th class="">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no=1; foreach($data_ortu as $key){ ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?= $key->nama_ortu; ?></td>
                                                <td><?= $key->nama_murid; ?></td>
                                                <td><?= $key->email_ortu; ?></td>
                                                <td><?= $key->telepon_ortu ?></td>
                                                <td><?= $key->alamat."  Kec.".ucwords($key->kecamatan)." Kel.". ucwords($key->kelurahan)." Kota ".ucwords($key->kota).", ".ucwords($key->provinsi)." ".$key->kode_pos; ?></td>
                                                <td><?= $key->status_ortu; ?></td>
                                                <td><?= time_since(strtotime($key->dibuat_ortu)) ?></td>
                                                <td><?= time_since(strtotime($key->diupdate_ortu)) ?></td>

                                                <td>
                                                    <a onclick="edit(<?= $key->id_orang_tua; ?>);" class="btn btn-xs btn-icon btn-warning text-white" data-toggle="modal" data-target="#modalform"><span class="btn-icon-wrap"><span class="feather-icon"><i data-feather="edit"></i></span></span></a>
                                                    <a href="<?= base_url('OrtuAdmin/delete_ortu/' . $key->id_orang_tua); ?>" onclick="return confirm('Yakin Ingin Menghapus Data?')" class="btn btn-xs btn-icon btn-danger"><span class="btn-icon-wrap"><span class="feather-icon"><i data-feather="trash-2"></i></span></span></a>
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


    <!-- Ajax -->
    <script type="text/javascript">

        function tambah(){
            $('#form')[0].reset();
            $('#modalformtitle').html('Tambah Orang Tua'); 
            document.getElementById('form').action = "<?= base_url('admin/data_ortu') ?>";
        }

        function edit(id_orang_tua){
            $('#modalformtitle').html('Edit Orang Tua'); 
            document.getElementById('form').action = "<?= base_url('OrtuAdmin/update_ortu') ?>";
            $.ajax({
                url : "<?= base_url('OrtuAdmin/edit_ortu/') ?>" + id_orang_tua ,
                type: "GET",
                dataType : "JSON",
                success:function(data){
                    $('[name="id_orang_tua"]').val(data.id_orang_tua);
                    $('[name="id_murid"]').val(data.id_murid);
                    $('[name="nama_ortu"]').val(data.nama_ortu);
                    $('[name="email_ortu"]').val(data.email_ortu);
                    $('[name="status_ortu"]').val(data.status_ortu);
                    $('[name="telepon_ortu"]').val(data.telepon_ortu);
                    $('[name="dibuat_ortu"]').val(data.dibuat_ortu);
                },
                error:function(jqXHR,textStatus,errorThrown){
                    alert('Gagal Mengambil Data, Silahkan Refresh Kembali');
                }
            })
        }

    </script>


