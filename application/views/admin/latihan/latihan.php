<!-- Main Content -->
<div class="hk-pg-wrapper">
    <nav class="hk-breadcrumb" aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-light bg-transparent mb-1">
            <li class="breadcrumb-item"><i data-feather='bar-chart-2' class='icons-br-size'></i> <a href="<?= base_url('admin/'); ?>">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page"><i data-feather='edit-3' class='icons-br-size'></i> Latihan</li>
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
                            <input type="hidden" name="id_latihan">
                            <input type="hidden" name="dibuat_latihan">
                            <label>Nama Latihan</label>
                            <input type="text" name="nama_latihan" class="form-control" placeholder="Masukan Nama Latihan" value="<?= set_value('nama_latihan'); ?>">
                            <?= form_error('nama_latihan','<small class="text-danger">','</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label>Tipe Latihan</label>
                            <select class="form-control custom-select" name="tipe_latihan">
                                <option selected="" disabled="">Pilih</option>
                                <option value="1">Pilihan Ganda</option>
                                <option value="2">Essay</option>
                                <option value="3">Pilihan Ganda & Essay</option>
                            </select>
                            <?= form_error('tipe_latihan','<small class="text-danger">','</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label>Tenggat Latihan</label>
                            <input class="form-control" type="text" id="tenggat" name="tenggat_latihan" placeholder="Masukan Tenggat Waktu" value="<?= set_value('tenggat_latihan'); ?>" />
                        </div>
                        <div class="form-group">
                            <label>Tanggal Mulai</label>
                            <input class="form-control" type="text" id="tenggat" name="tanggal_mulai" placeholder="Masukan Tanggal Mulai" value="<?= set_value('tanggal_mulai'); ?>" />
                        </div>
                        <div class="form-group">
                            <label>Kelas</label>
                            <select class="select2" name="id_kelas">
                                <option selected="" disabled="">Pilih</option>
                                <?php foreach($kelas as $key){ ?>
                                    <option value="<?= $key->id_kelas; ?>"><?= $key->nama_kelas; ?> | <?= $key->nama_guru; ?> <?= $key->gelar_guru; ?> </option>
                                <?php } ?>
                            </select>
                            <?= form_error('id_kelas','<small class="text-danger">','</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label>Waktu Latihan</label>
                            <select class="select2" name="waktu_latihan">
                                <option selected="" disabled="">Pilih</option>
                                <option value="0">Tidak diwaktui</option>
                                <option value="1">1 Menit</option>
                                <option value="10">10 Menit</option>
                                <option value="30">30 Menit</option>
                                <option value="45">45 Menit</option>
                                <option value="60">60 Menit</option>
                                <option value="90">90 Menit</option>
                                <option value="120">120 Menit</option>
                                <option value="180">180 Menit</option>
                            </select>
                            <?= form_error('waktu_latihan','<small class="text-danger">','</small>'); ?>
                        </div>
                        <div class="form-group" id="pointKu">
                            <label>Point Latihan</label>
                            <input class="form-control" type="text" name="point_latihan" maxlength="3" placeholder="Masukan Point Latihan" value="<?= set_value('point_latihan'); ?>" onkeypress="return hanyaAngka(event)">
                            <?= form_error('point_latihan','<small class="text-danger">','</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label>Deksripsi Latihan</label>
                            <div class="tinymce-wrap">
                                <textarea class="tinymce" name="deksripsi_latihan"><?= set_value('deksripsi_latihan'); ?></textarea>
                                <?= form_error('deksripsi_latihan', '<small class="text-danger">', '</small>')  ?>
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
                    <h5 class="d-flex align-items-end hk-sec-title mb-1"><i data-feather="edit-3" class="mr-1 icons-header-size"></i> Latihan Kelas</h5>
                    <p class="mb-15">Data Latihan Kelas</p>

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
                                            <th class="">Nama Latihan</th>
                                            <th class="">Ruang Kelas & Guru</th>
                                            <th class="">Tipe Soal</th>
                                            <th class="">Point Latihan</th>
                                            <th class="" style="padding-right:600px;">Deksripsi Latihan</th>
                                            <th class="">Tenggat Latihan</th>
                                            <th class="">Tanggal Mulai</th>
                                            <th class="">Waktu Latihan</th>
                                            <th class="">Tanggal Dibuat</th>
                                            <th class="">Tanggal Diupdate</th>
                                            <th class="">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no=1; foreach($latihan as $key){ ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?= $key->nama_latihan; ?></td>
                                                <td><?= $key->nama_kelas; ?> | <?= $key->nama_guru; ?>, <?= $key->gelar_guru; ?></td>
                                                <td> 
                                                    <?php if($key->tipe_latihan == "1"){ ?>
                                                        <span class="badge badge-indigo">Pilihan Ganda</span>
                                                    <?php }elseif($key->tipe_latihan == "2"){ ?>
                                                        <span class="badge badge-purple">Essay</span>
                                                    <?php }elseif($key->tipe_latihan == "3"){ ?>
                                                        <span class="badge badge-dark">Pilihan Ganda & Essay</span>
                                                    <?php } ?>
                                                </td>
                                                <td><span class="badge badge-success"><?= $key->point_latihan." Point"; ?></span></td>

                                                <td><?= $key->deksripsi_latihan; ?></td>

                                                <?php if($key->tenggat_latihan == null){ ?>
                                                    <td><span class="badge badge-danger">Latihan tidak dibatasi</span></td>
                                                <?php }else{ ?>
                                                    <td><?= date('d M, Y H:i A', strtotime($key->tenggat_latihan)); ?></td>
                                                <?php } ?>

                                                <td><?= date('d M, Y H:i A', strtotime($key->tanggal_mulai)); ?></td>

                                                <?php if($key->waktu_latihan == null){ ?>
                                                    <td><span class="badge badge-danger">Latihan tidak diwaktui</span></td>
                                                <?php }else{ ?>
                                                    <td><?= $key->waktu_latihan; ?> Menit</td>
                                                <?php } ?>

                                                <td><?= time_since(strtotime($key->dibuat_latihan)) ?></td>
                                                <td><?= time_since(strtotime($key->diupdate_latihan)) ?></td>
                                                <td>
                                                    <a onclick="edit(<?= $key->id_latihan; ?>);" class="btn btn-xs btn-icon btn-warning text-white" data-toggle="modal" data-target="#modalform"><span class="btn-icon-wrap"><span class="feather-icon"><i data-feather="edit"></i></span></span></a>

                                                    <?php $num_soal = $this->m_soal->Checking(['id_latihan' => $key->id_latihan])->num_rows(); ?>
                                                    <?php if($num_soal == 0){ ?>
                                                        <a onclick="return confirm('Soal belum dibuat!');" class="btn btn-xs btn-info text-white">Simulasi</a>
                                                    <?php }else{ ?>
                                                        <a href="<?= base_url('admin/simulasi_latihan/' . $key->id_latihan); ?>" class="btn btn-xs btn-info">Simulasi</a>
                                                    <?php } ?>

                                                    <a href="<?= base_url('latihan/delete_latihan/' . $key->id_latihan); ?>" onclick="return confirm('Yakin Ingin Menghapus Data?')" class="btn btn-xs btn-icon btn-danger"><span class="btn-icon-wrap"><span class="feather-icon"><i data-feather="trash-2"></i></span></span></a>
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

    <script src="<?= base_url('assets/template/vendors/jquery/dist/jquery.min.js'); ?>"></script>


    <!-- Ajax -->
    <script type="text/javascript">
        function tambah(){
            $('#form')[0].reset();
            $('#modalformtitle').html('Tambah Latihan'); 
            document.getElementById('form').action = "<?= base_url('admin/latihan'); ?>";
        }

        function edit(id_latihan){
            $('#modalformtitle').html('Edit Latihan');
            document.getElementById('form').action = "<?= base_url('latihan/update_latihan') ?>";
            $.ajax({
                url : "<?= base_url('latihan/edit_latihan/') ?>" + id_latihan ,
                type: "GET",
                dataType : "JSON",
                success:function(data){
                    $('[name="id_latihan"]').val(data.id_latihan);
                    $('[name="id_kelas"]').val(data.id_kelas);
                    $('[name="nama_latihan"]').val(data.nama_latihan);
                    $('[name="tipe_latihan"]').val(data.tipe_latihan);
                    $('[name="deksripsi_latihan"]').val(data.deksripsi_latihan);
                    $('[name="waktu_latihan"]').val(data.waktu_latihan);
                    $('[name="tenggat_latihan"]').val(data.tenggat_latihan);
                    $('[name="tanggal_mulai"]').val(data.tanggal_mulai);
                    $('[name="point_latihan"]').val(data.point_latihan);
                    $('[name="dibuat_latihan"]').val(data.dibuat_latihan);
                },
                error:function(jqXHR,textStatus,errorThrown){
                    alert('Gagal Mengambil Data, Silahkan Refresh Kembali');
                }
            })
        }

        num=1;
        <?php $no=1; foreach($latihan as $key){ ?> 
            <?php $soal = $this->m_soal->Checking(['id_latihan' => $key->id_latihan])->result(); ?>

            <?php $num=1; foreach ($soal as $row) { ?>

                <?php if($row->tipe_soal == "1"){ ?>
                    var kj = document.getElementById('kj'+num).value;
                    $('.kj_'+kj+'_'+num).html("<i data-feather='check-square' class='icons-size text-success'></i>");
                    num++;
                <?php } ?>

            <?php } ?>

        <?php } ?>
    </script>




