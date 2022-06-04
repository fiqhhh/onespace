<!-- Main Content -->
<div class="hk-pg-wrapper">

    <nav class="hk-breadcrumb" aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-light bg-transparent mb-1">
            <li class="breadcrumb-item"><i data-feather='bar-chart-2' class='icons-br-size'></i> <a href="<?= base_url('admin/'); ?>">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page"><i data-feather='message-circle' class='icons-br-size'></i> Komentar Materi</li>
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
                            <label>Nama Materi</label>
                            <input type="hidden" name="id_komentar">
                            <input type="hidden" name="id_tugas">
                            <input type="hidden" name="dibuat_komentar">
                            <select class="select2" name="id_materi">
                                <option selected="" disabled="">Pilih</option>
                                <?php foreach ($materi as $key) { ?>
                                    <option value="<?= $key->id_materi; ?>"><?= $key->nama_materi; ?></option>
                                <?php } ?>
                            </select>
                            <?= form_error('id_materi', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label>Nama Murid</label>
                            <select class="select2" name="id_murid">
                                <option selected="" disabled="">Pilih</option>
                                <?php foreach($data_murid as $key){ ?>
                                    <option value="<?= $key->id_murid; ?>"><?= $key->nama_murid; ?> | <?= $key->kelas_murid; ?> - <?= $key->jurusan_murid; ?></option>
                                <?php } ?>
                            </select>
                            <?= form_error('id_murid','<small class="text-danger">','</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label>Isi Komentar</label>
                            <textarea class="form-control" name="isi_komentar" placeholder="Masukan Komentar"><?= set_value('isi_komentar'); ?></textarea>
                            <?= form_error('isi_komentar','<small class="text-danger">','</small>'); ?>
                        </div>

                        <hr class="mb-3">     
                        <div class="float-right mb-1">
                            <button type="submit" class="btn btn-secondary" data-dismiss="modal" >Batal</button>
                            <button type="submit" id="modalformsubmit" class="btn btn-primary"></button>
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
                    <h5 class="d-flex align-items-end hk-sec-title mb-1"><i data-feather="message-circle" class="mr-1 icons-header-size"></i> Komentar Materi</h5>
                    <p class="mb-15">Data Komentar Materi</p>

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
                                            <th class="">Nama Materi</th>
                                            <th class="">Ruang Kelas</th>
                                            <th class="">Nama Murid</th>
                                            <th class="">Kelas Murid</th>
                                            <th class="" style="padding-right:600px;">Isi Komentar</th>
                                            <th class="">Nama Guru</th>
                                            <th class="">Mata Pelajaran</th>
                                            <th class="">Tanggal Dibuat</th>
                                            <th class="">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php $no=1; foreach($komentar as $key){ ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $key->nama_materi; ?></td>
                                            <td><?= $key->nama_kelas; ?></td>
                                            <td><?= $key->nama_murid; ?></td>
                                            <td><?= $key->kelas_murid; ?> - <?= $key->jurusan_murid; ?></td>
                                            <td><?= $key->isi_komentar; ?></td>
                                            <td><?= $key->nama_guru; ?>, <?= $key->gelar_guru; ?></td>
                                            <td><?= $key->nama_mapel; ?></td>
                                            <td><?= time_since(strtotime($key->dibuat_komentar)); ?></td>

                                            <td>
                                                <a onclick="edit(<?= $key->id_komentar; ?>);" class="btn btn-xs btn-icon btn-warning text-white" data-toggle="modal" data-target="#modalform"><span class="btn-icon-wrap"><span class="feather-icon"><i data-feather="edit"></i></span></span></a>
                                                <a href="<?= base_url('komentar/delete_komentar/' . $key->id_komentar); ?>" onclick="return confirm('Yakin Ingin Menghapus Data?')" class="btn btn-xs btn-icon btn-danger"><span class="btn-icon-wrap"><span class="feather-icon"><i data-feather="trash-2"></i></span></span></a>
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
        $('#modalformtitle').html('Tambah Komentar'); 
        $('#modalformsubmit').html('Tambah Komentar');  
        document.getElementById('form').action = "<?= base_url('admin/komentar_materi'); ?>";
    }

    function edit(id_komentar){
        $('#modalformtitle').html('Edit Komentar'); 
        $('#modalformsubmit').html('Edit Komentar'); 
        document.getElementById('form').action = "<?= base_url('komentar/update_komentar') ?>";
        $.ajax({
            url : "<?= base_url('komentar/edit_komentar/') ?>" + id_komentar ,
            type: "GET",
            dataType : "JSON",
            success:function(data){
                $('[name="id_komentar"]').val(data.id_komentar);
                $('[name="id_tugas"]').val(data.id_tugas);
                $('[name="id_materi"]').val(data.id_materi);
                $('[name="id_murid"]').val(data.id_murid);
                $('[name="isi_komentar"]').val(data.isi_komentar);
                $('[name="dibuat_komentar"]').val(data.dibuat_komentar);
            },
            error:function(jqXHR,textStatus,errorThrown){
                alert('Gagal Mengambil Data, Silahkan Refresh Kembali');
            }
        })
    }

</script>


