<!-- Main Content -->
<div class="hk-pg-wrapper">
    <nav class="hk-breadcrumb" aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-light bg-transparent mb-1">
            <li class="breadcrumb-item"><i data-feather='bar-chart-2' class='icons-br-size'></i> <a href="<?= base_url('admin/'); ?>">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page"><i data-feather='home' class='icons-br-size'></i> Kelas</li>
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
                            <label>Nama Kelas</label>
                            <input type="hidden" name="id_kelas">
                            <input type="hidden" name="dibuat_kelas">
                            <input type="hidden" name="token_kelas">
                            <input type="text" name="nama_kelas" class="form-control" placeholder="Masukan Nama Kelas" value="<?= set_value('nama_kelas'); ?>">
                            <?= form_error('nama_kelas','<small class="text-danger">','</small>'); ?>
                        </div>
                        
                        <div class="form-group">
                            <label>Mapel</label>
                            <select class="select2" name="id_mapel">
                                <option selected="" disabled="">Pilih</option>
                                <?php foreach($mapel as $key){ ?>
                                    <option value="<?= $key->id_mapel; ?>"><?= $key->nama_mapel; ?></option>
                                <?php } ?>
                            </select>
                            <?= form_error('id_mapel','<small class="text-danger">','</small>'); ?>
                        </div>

                        <div class="form-group">
                            <label>Jurusan</label>
                            <select class="select2" name="id_jurusan">
                                <option selected="" disabled="">Pilih</option>
                                <?php foreach($jurusan as $key){ ?>
                                    <option value="<?= $key->id_jurusan; ?>"><?= $key->nama_jurusan; ?></option>
                                <?php } ?>
                            </select>
                            <?php if(empty($jurusan)){ ?>
                                <small><a href="<?= base_url('admin/jurusan'); ?>">Klik disini untuk menambah jurusan</a></small>
                            <?php } ?>
                            <?= form_error('id_jurusan','<small class="text-danger">','</small>'); ?>
                        </div>

                        <div class="form-group">
                            <label>Guru</label>
                            <select class="select2" name="id_guru">
                                <option selected="" disabled="">Pilih</option>
                                <?php foreach($data_guru as $key){ ?>
                                    <option value="<?= $key->id_guru; ?>"><?= $key->nama_guru; ?>, <?= $key->gelar_guru ?></option>
                                <?php } ?>
                            </select>
                            <?= form_error('id_guru','<small class="text-danger">','</small>'); ?>
                        </div>

                        <div class="form-group">
                            <label>Tahun Pembelajaran</label>
                            <input type="text" class="form-control" name="tahun_pembelajaran" placeholder="Masukan Tahun Pembelajaran" value="<?= set_value('tahun_pembelajaran'); ?>">
                            <?= form_error('tahun_pembelajaran','<small class="text-danger">','</small>'); ?>
                        </div>

                        <hr class="mb-3">     
                        <div class="float-right mb-1">
                            <button type="submit" class="btn btn-secondary" data-dismiss="modal" >Batal</button>
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
                    <h5 class="d-flex align-items-end hk-sec-title mb-1"><i data-feather="home" class="mr-1 icons-header-size"></i> Kelas SMK Negeri 1</h5>
                    <p class="mb-15">Data Kelas SMK Negeri 1</p>

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
                                            <option selected="" disabled="">Guru</option>
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
                                            <th class="">Nama Kelas</th>
                                            <th class="">Jurusan</th>
                                            <th class="">Nama Guru</th>
                                            <th class="" style="padding-right:700px;">Token Kelas</th>
                                            <th class="">Mata Pelajaran</th>
                                            <th class="">Murid Bergabung</th>
                                            <th class="">Materi Kelas</th>
                                            <th class="">Tugas Kelas</th>
                                            <th class="">Latihan Kelas</th>
                                            <th class="">Tanggal Dibuat</th>
                                            <th class="">Tanggal Diupdate</th>
                                            <th class="">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no=1; foreach($kelas as $key){ ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?= $key->nama_kelas; ?> Tp. <?= $key->tahun_pembelajaran; ?></td>
                                                <td><?= $key->nama_jurusan; ?></td>
                                                <td><?= $key->nama_guru; ?>, <?= $key->gelar_guru; ?></td>
                                                <td><?= $key->token_kelas; ?></td>
                                                <td><?= $key->nama_mapel; ?></td>
                                                <td>
                                                    <?php $murid = $this->m_gabung_kelas->Checking(['id_kelas' => $key->id_kelas])->num_rows(); ?>
                                                    <?= "(<i data-feather='users' class='icons-size'></i> ".$murid." Murid) di dalam kelas"; ?>
                                                    
                                                    <?php $murid = $this->m_gabung_kelas->CheckingAll($key->id_kelas)->result(); ?>

                                                    <?php $num=1; foreach ($murid as $row) { ?>
                                                        <?= "</br>".$num++.". ".$row->nama_murid; ?> | <?= $row->kelas_murid ?> - <?= $row->jurusan_murid; ?> (<?= time_since(strtotime($row->bergabung_pada)); ?>)
                                                    <?php } ?>
                                                </td>
                                                <td>
                                                    <?php  $materi = $this->m_materi->Checking(['id_kelas' => $key->id_kelas])->num_rows(); ?>
                                                    <?= "(<i data-feather='book' class='icons-size'></i> ".$materi." Materi) di dalam kelas"; ?>
                                                </td>
                                                <td>
                                                    <?php  $tugas = $this->m_tugas->Checking(['id_kelas' => $key->id_kelas])->num_rows(); ?>
                                                    <?= "(<i data-feather='book-open' class='icons-size'></i> ".$tugas." Tugas) di dalam kelas"; ?>
                                                </td>
                                                <td>
                                                    <?php  $latihan = $this->m_latihan->Checking(['id_kelas' => $key->id_kelas])->num_rows(); ?>
                                                    <?= "(<i data-feather='edit-2' class='icons-size'></i> ".$latihan." Latihan) di dalam kelas"; ?>
                                                </td>
                                                <td><?= time_since(strtotime($key->dibuat_kelas)) ?></td>
                                                <td><?= time_since(strtotime($key->diupdate_kelas)) ?></td>

                                                <td>
                                                    <a onclick="edit(<?= $key->id_kelas; ?>);" class="btn btn-xs btn-icon btn-warning text-white" data-toggle="modal" data-target="#modalform"><span class="btn-icon-wrap"><span class="feather-icon"><i data-feather="edit"></i></span></span></a>
                                                    <a href="<?= base_url('kelas/delete_kelas/' . $key->id_kelas); ?>" onclick="return confirm('Yakin Ingin Menghapus Data?')" class="btn btn-xs btn-icon btn-danger"><span class="btn-icon-wrap"><span class="feather-icon"><i data-feather="trash-2"></i></span></span></a>
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
            $('#modalformtitle').html('Tambah Kelas');
            document.getElementById('form').action = "<?= base_url('admin/kelas'); ?>";
        }

        function edit(id_kelas){
            $('#modalformtitle').html('Edit Kelas');
            document.getElementById('form').action = "<?= base_url('kelas/update_kelas') ?>";
            $.ajax({
                url : "<?= base_url('kelas/edit_kelas/') ?>" + id_kelas ,
                type: "GET",
                dataType : "JSON",
                success:function(data){
                    $('[name="id_kelas"]').val(data.id_kelas);
                    $('[name="id_mapel"]').val(data.id_mapel);
                    $('[name="id_guru"]').val(data.id_guru);
                    $('[name="id_jurusan"]').val(data.id_jurusan);
                    $('[name="nama_kelas"]').val(data.nama_kelas);
                    $('[name="tahun_pembelajaran"]').val(data.tahun_pembelajaran);
                    $('[name="token_kelas"]').val(data.token_kelas);
                    $('[name="dibuat_kelas"]').val(data.dibuat_kelas);
                },
                error:function(jqXHR,textStatus,errorThrown){
                    alert('Gagal Mengambil Data, Silahkan Refresh Kembali');
                }
            })
        }

    </script>


